<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemRestock extends Model
{
    use SoftDeletes;

    public $table = 'item_restocks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        'pending'    => 'Pending',
        'delivered'  => 'Delivered',
        'cancelled'  => 'Cancelled',
    ];

    public function delivered_date()
    {
        return $this->belongsTo('App\DeliveredStockDate','item_restocks_id','id');
    }
    
    public function suppliers()
    {
        return $this->belongsTo('App\Supplier','supplier_id','id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
}
