<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use App\Item;
use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemRestockRequest;
use App\Http\Requests\StoreItemRestockRequest;
use App\Http\Requests\UpdateItemRestockRequest;
use App\ItemRestock;
use App\DeliveredStockDate;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ItemRestocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd('tesat');
        $item = ItemRestock::with('suppliers','items','brands')->get();
        // dd($item);
       
        return view('admin.itemRestocks.index')->with(compact('item'));
    
    }
    public function details($id){
        // dd('tet');
        $item = ItemRestock::find($id);

        $date = DeliveredStockDate::where('item_restocks_id',$id)->get();

        $check_delivered_already = DeliveredStockDate::
                where('item_restocks_id',$id)->sum('delivered_stock');
        // dd($check_delivered_already);
        $val = null;
        if($check_delivered_already == $item->quantity ){
            $val= true;
        }
        // dd($val);
        return view('admin.itemRestocks.details.index')->with(compact('item','date','val'));
    }
    //deliver stock. form here
    public function deliver_stock($item_re_id){
        $item = ItemRestock::find($item_re_id);
        return view('admin.itemRestocks.details.deliver.index')->with(compact('item'));
    }
        //store fucntion . increment part here in the item
        public function confirm(Request $request){
            // dd($request->all());
             

                $check_if_all_stocks_delivered =
                DeliveredStockDate::where('item_restocks_id',$request->item_re_id)->get();
                $sum = $check_if_all_stocks_delivered->sum('delivered_stock');

                $first_check = $request->quantity_item - $sum;

                if($request->quantity > $first_check){
                    return redirect()->back()->withErrors('Input only the remaining stock that has not been delivered or ');
                }

                if($sum > $request->quantity_item){
                    return redirect()->back()->withErrors('All ordered stock has already been delivered!');
                                }
                // dd($sum);

                if($request->quantity > $request->quantity_item){
                    return redirect()->back()->withErrors('Input quantity should not be more than the ordered quantity');
                }
                    $item = Item::find($request->item_id__);
                    // dd($item);
                    $item->increment('stock',$request->quantity);
                    // dd($item);

                    $new = new DeliveredStockDate;
                    $new->delivered_stock = $request->quantity;
                    $new->item_restocks_id = $request->item_re_id;
                    $new->date = Carbon::now();
                    $new->save();

                    return redirect(url('/admin/item-restocks/details',$request->item_re_id));
           
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // dd('tesst');
        abort_if(Gate::denies('item_restock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Supplier::all()->pluck('company_name', 'id');
        
        $items = Item::all()->pluck('name', 'id');
    
        $brands = Brand::all()->pluck('name', 'id');


        return view('admin.itemRestocks.create')->with(compact('suppliers','items','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRestockRequest $request)
    {
        // dd($request->all());
        //$itemRestock = ItemRestock::create($request->all());

      /*  $item = Item::where('id',$request->items[0])->first();
        // dd($item);
        if($request->quantity > $item->stock){
            return redirect()->back()->withErrors
            ('Requested stock is greater than the remaining stock of the item');
        } */

    $itemRestock = new ItemRestock();
    $itemRestock->supplier_id = $request->suppliers[0];
    $itemRestock->item_id = $request->items[0];
    $itemRestock->brand_id = $request->brands[0];
    $itemRestock->quantity = $request->quantity;
    $itemRestock->status =  'pending';
    $itemRestock->save();
    

    // $itemRestock->suppliers()->sync($request->input('suppliers', []));
    // $itemRestock->items()->sync($request->input('items', []));
    // $itemRestock->brands()->sync($request->input('brands', []));

        return redirect()->route('admin.item-restocks.index');
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

        $itemRestock->load('suppliers', 'items', 'brands');

        return view('admin.itemRestocks.show', compact('itemRestock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemRestock $itemRestock)
    {
        abort_if(Gate::denies('item_restock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Supplier::all()->pluck('company_name', 'id');
        
        $items = Item::all()->pluck('name', 'id');
    
        $brands = Brand::all()->pluck('name', 'id');

        $itemRestock->load('suppliers', 'items', 'brands');

        return view('admin.itemRestocks.edit', compact('suppliers', 'items', 'brands', 'itemRestock'));
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

        return redirect()->route('admin.item-restocks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('item_restock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemRestock->delete();

        return back();
    }
}
