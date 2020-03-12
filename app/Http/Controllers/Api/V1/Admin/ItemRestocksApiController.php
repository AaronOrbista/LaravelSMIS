<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\ItemRestock;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRestockRequest;
use App\Http\Requests\UpdateItemRestockRequest;
use App\Http\Resources\Admin\ItemRestockResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemRestocksApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('item_restock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItemRestockResource(ItemRestock::with(['suppliers', 'items', 'brands'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRestockRequest $request)
    {
        $itemRestock = ItemRestock::create($request->all());
        $itemRestock->suppliers()->sync($request->input('suppliers', []));
        $itemRestock->items()->sync($request->input('items', []));
        $itemRestock->brands()->sync($request->input('brands', []));

        return (new ItemRestockResource($itemRestock))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ItemRestock $itemRestock)
    {
        abort_if(Gate::denies('item_restock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItemRestockResource($itemRestock->load(['suppliers', 'items', 'brands']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRestockRequest $request, ItemRestock $itemRestock)
    {
        $itemRestock->update($request->all());
        $itemRestock->suppliers()->sync($request->input('suppliers', []));
        $itemRestock->items()->sync($request->input('items', []));
        $itemRestock->brands()->sync($request->input('brands', []));

        return (new ItemRestockResource($itemRestock))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemRestock $itemRestock)
    {
        abort_if(Gate::denies('item_restock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemRestock->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
