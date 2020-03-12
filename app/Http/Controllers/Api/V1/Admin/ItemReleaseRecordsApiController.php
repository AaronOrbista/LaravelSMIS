<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemReleaseRecordRequest;
use App\Http\Requests\UpdateItemReleaseRecordRequest;
use App\Http\Resources\Admin\ItemReleaseRecordResource;
use App\ItemReleaseRecord;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemReleaseRecordsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('item_release_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItemReleaseRecordResource(ItemReleaseRecord::with(['control_number', 'date_requested'])->get());
    }

    public function store(StoreItemReleaseRecordRequest $request)
    {
        $itemReleaseRecord = ItemReleaseRecord::create($request->all());

        return (new ItemReleaseRecordResource($itemReleaseRecord))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ItemReleaseRecord $itemReleaseRecord)
    {
        abort_if(Gate::denies('item_release_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItemReleaseRecordResource($itemReleaseRecord->load(['control_number', 'date_requested']));
    }

    public function update(UpdateItemReleaseRecordRequest $request, ItemReleaseRecord $itemReleaseRecord)
    {
        $itemReleaseRecord->update($request->all());

        return (new ItemReleaseRecordResource($itemReleaseRecord))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ItemReleaseRecord $itemReleaseRecord)
    {
        abort_if(Gate::denies('item_release_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReleaseRecord->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
