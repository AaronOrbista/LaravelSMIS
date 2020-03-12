<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Item;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ItemsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Item::with(['brands'])->select(sprintf('%s.*', (new Item)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'item_show';
                $editGate      = 'item_edit';
                $deleteGate    = 'item_delete';
                $crudRoutePart = 'items';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('unit', function ($row) {
                return $row->unit ? ITEM::UNIT_SELECT[$row->unit] : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : "";
            });
            /*
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            */
            $table->editColumn('brand', function ($row) {
                $labels = [];

                foreach ($row->brands as $brand) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $brand->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('item_category', function ($row) {
                return $row->item_category ? Item::ITEM_CATEGORY_RADIO[$row->item_category] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'brand']);

            return $table->make(true);
        }

        return view('admin.items.index');
    }

    public function create()
    {
        abort_if(Gate::denies('item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::all()->pluck('name', 'id');

        return view('admin.items.create', compact('brands'));
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->all());
        $item->brands()->sync($request->input('brands', []));

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $item->id]);
        }

        return redirect()->route('admin.items.index');
    }

    public function edit(Item $item)
    {
        abort_if(Gate::denies('item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::all()->pluck('name', 'id');

        $item->load('brands');

        return view('admin.items.edit', compact('brands', 'item'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());
        $item->brands()->sync($request->input('brands', []));

        return redirect()->route('admin.items.index');
    }

    public function show(Item $item)
    {
        abort_if(Gate::denies('item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->load('brands', /* 'priceApprovedRequests', */ 'itemApprovedRequests');

        return view('admin.items.show', compact('item'));
    }

    public function destroy(Item $item)
    {
        abort_if(Gate::denies('item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->delete();

        return back();
    }

    public function massDestroy(MassDestroyItemRequest $request)
    {
        Item::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('item_create') && Gate::denies('item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Item();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media', 'public');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
