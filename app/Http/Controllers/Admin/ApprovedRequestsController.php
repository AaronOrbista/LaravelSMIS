<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\ApprovedRequest;
use App\Brand;
use App\ItemRestock;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyApprovedRequestRequest;
use App\Http\Requests\StoreApprovedRequestRequest;
use App\Http\Requests\UpdateApprovedRequestRequest;
use App\Item;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ApprovedRequestsController extends Controller
{
    public function index(Request $request)
    {
        // dd('test');
        
        if ($request->ajax()) {
            //ItemRestock
            $query = ApprovedRequest::with(['requestors', 'items', 'brands' /*, 'price' */])->select(sprintf('%s.*', (new ApprovedRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'approved_request_show';
                $editGate      = 'approved_request_edit';
                $deleteGate    = 'approved_request_delete';
                $crudRoutePart = 'approved-requests';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('control_number', function ($row) {
                return $row->control_number ? $row->control_number : "";
            });
            $table->editColumn('requestor', function ($row) {
                $labels = [];

                foreach ($row->requestors as $requestor) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $requestor->id_number);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('item', function ($row) {
                $labels = [];

                foreach ($row->items as $item) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $item->name);
                }

                return implode(' ', $labels);
            });
            
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : "";
            });

            $table->editColumn('unit', function ($row) {
                return $row->unit ? $row->unit : "";
            });

            /*
            $table->addColumn('price_price', function ($row) {
                return $row->price ? $row->price->price : '';
            });
            */
            $table->rawColumns(['actions', 'placeholder', 'requestor', 'item', 'brand' /*, 'price' */ ]);

            return $table->make(true);
        }

        return view('admin.approvedRequests.index');

    }

    public function create()
    {
        // dd('tet');
        abort_if(Gate::denies('approved_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestors = Account::all()->pluck('id_number', 'id');

        $items = Item::all()->pluck('name', 'id');
        // dd($items);

        $brands = Brand::all()->pluck('name', 'id');

        /*
        $prices = Item::all()->pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');
        */

    return view('admin.approvedRequests.create', compact('requestors', 'items', 'brands' /*, 'prices' */ ));
    }

    public function store(StoreApprovedRequestRequest $request)
    {
        // dd($request->all());

        // $approvedRequest = ApprovedRequest::create($request->all());
            $item = Item::where('id',$request->items[0])->first();
            // dd($item);
            if($request->quantity > $item->quantity){
                return redirect()->back()->withErrors
                ('The quantity of the requested item is greater than its current quantity!');
            }

        $approvedRequest = new ApprovedRequest();
        $approvedRequest->item_id = $request->items[0];
        $approvedRequest->control_number = $request->control_number;
        $approvedRequest->quantity = $request->quantity;
        $approvedRequest->unit = $request->unit;
        $approvedRequest->date_requested = $request->date_requested;
       // $approvedRequest->price_id = $request->price_id;
        $approvedRequest->save();

        $approvedRequest->requestors()->sync($request->input('requestors', []));
        $approvedRequest->items()->sync($request->input('items', []));
        $approvedRequest->brands()->sync($request->input('brands', []));

        // dd($approvedRequest);

        return redirect()->route('admin.approved-requests.index');
    }

    public function edit(ApprovedRequest $approvedRequest)
    {
        abort_if(Gate::denies('approved_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requestors = Account::all()->pluck('id_number', 'id');

        $items = Item::all()->pluck('name', 'id');

        $brands = Brand::all()->pluck('name', 'id');

      //  $prices = Item::all()->pluck('price', 'id')->prepend(trans('global.pleaseSelect'), '');

    $approvedRequest->load('requestors', 'items', 'brands' /*, 'price' */ );

        return view('admin.approvedRequests.edit', compact('requestors', 'items', 'brands', /* 'prices', */ 'approvedRequest'));
    }

    public function update(UpdateApprovedRequestRequest $request, ApprovedRequest $approvedRequest)
    {
        $approvedRequest->update($request->all());
        $approvedRequest->requestors()->sync($request->input('requestors', []));
        $approvedRequest->items()->sync($request->input('items', []));
        $approvedRequest->brands()->sync($request->input('brands', []));

        return redirect()->route('admin.approved-requests.index');
    }

    public function show(ApprovedRequest $approvedRequest)
    {
        abort_if(Gate::denies('approved_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approvedRequest->load('requestors', 'items', 'brands', /* 'price', */ 'controlNumberItemReleaseRecords', 'dateRequestedItemReleaseRecords');

        return view('admin.approvedRequests.show', compact('approvedRequest'));
    }


    public function destroy(ApprovedRequest $approvedRequest)
    {
        abort_if(Gate::denies('approved_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approvedRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyApprovedRequestRequest $request)
    {
        ApprovedRequest::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

/*
$model = Item::find(1);
$model->increment('stock',600);
*/

/*

______________
add supplier table
entity
*supplier name

___________________
add requested_stocks table
*.supplier_id
* stocks
*status = pending/delivered/cancelled
_____________________

//
upon confirmation of delivered 
increment to (items)
________________________________

//




*/