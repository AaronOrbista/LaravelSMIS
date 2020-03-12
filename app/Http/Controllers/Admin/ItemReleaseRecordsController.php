<?php

namespace App\Http\Controllers\Admin;

Use Alert;
use App\ApprovedRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemReleaseRecordRequest;
use App\Http\Requests\StoreItemReleaseRecordRequest;
use App\Http\Requests\UpdateItemReleaseRecordRequest;
use App\ItemReleaseRecord;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Item;

class ItemReleaseRecordsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ItemReleaseRecord::with(['control_number', 'date_requested'])->select(sprintf('%s.*', (new ItemReleaseRecord)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'item_release_record_show';
                $editGate      = 'item_release_record_edit';
                $deleteGate    = 'item_release_record_delete';
                $crudRoutePart = 'item-release-records';

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
            $table->addColumn('control_number_control_number', function ($row) {
                return $row->control_number ? $row->control_number->control_number : '';
            });

            $table->addColumn('date_requested_date_requested', function ($row) {
                return $row->date_requested ? $row->date_requested->date_requested : '';
            });
            /*
            $table->editColumn('date_requested.date_requested', function ($row) {
                return $row->date_requested ? (is_string($row->date_requested) ? $row->date_requested : $row->date_requested->date_requested) : '';
            }); 
            
            $table->editColumn('received_by', function ($row) {
                return $row->received_by ? $row->received_by : "";
            });
            */
            $table->editColumn('claimed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->claimed ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'control_number', 'date_requested', 'claimed']);

            return $table->make(true);
        }

        return view('admin.itemReleaseRecords.index');
    }

    public function create()
    {
        // dd('test');
        abort_if(Gate::denies('item_release_record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $control_numbers = ApprovedRequest::all()->pluck('control_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $date_requesteds = ApprovedRequest::all()->pluck('date_requested', 'id')->prepend(trans('global.pleaseSelect'), '');

        // dd($control_numbers);
        return view('admin.itemReleaseRecords.create', compact('control_numbers', 'date_requesteds'));
    }

    public function store(StoreItemReleaseRecordRequest $request)
    {
        // dd($request->all());

        $find = ApprovedRequest::where('id',$request->control_number_id)->first();
        $tool = Item::where('id',$find->item_id)->first();
      

        if($tool->quantity <= 5){
            // die('test');
            // Alert::alert('Title', 'Message', 'Type');
            // return redirect()->back();
            return redirect()->back()->withErrors('Need to Replenish Item Stock!');
        }

        // dd($find->quantity);
        $decrement = $tool->decrement('quantity',$find->quantity);
        
        

        $itemReleaseRecord = ItemReleaseRecord::create($request->all());
        // dd('tesdt');

        return redirect()->route('admin.item-release-records.index');
    }

    public function edit(ItemReleaseRecord $itemReleaseRecord)
    {
        abort_if(Gate::denies('item_release_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $control_numbers = ApprovedRequest::all()->pluck('control_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $date_requesteds = ApprovedRequest::all()->pluck('date_requested', 'id')->prepend(trans('global.pleaseSelect'), '');

        $itemReleaseRecord->load('control_number', 'date_requested');

        return view('admin.itemReleaseRecords.edit', compact('control_numbers', 'date_requesteds', 'itemReleaseRecord'));
    }

    public function update(UpdateItemReleaseRecordRequest $request, ItemReleaseRecord $itemReleaseRecord)
    {
        $itemReleaseRecord->update($request->all());

        return redirect()->route('admin.item-release-records.index');
    }

    public function show(ItemReleaseRecord $itemReleaseRecord)
    {
        abort_if(Gate::denies('item_release_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReleaseRecord->load('control_number', 'date_requested');

        return view('admin.itemReleaseRecords.show', compact('itemReleaseRecord'));
    }

    public function destroy(ItemReleaseRecord $itemReleaseRecord)
    {
        abort_if(Gate::denies('item_release_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReleaseRecord->delete();

        return back();
    }

    public function massDestroy(MassDestroyItemReleaseRecordRequest $request)
    {
        ItemReleaseRecord::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
