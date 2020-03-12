<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Item extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ITEM_CATEGORY_RADIO = [
        'school_supplies'   => 'School Supplies',
        'cleaning_supplies' => 'Cleaning Supplies',
    ];

    protected $fillable = [
        'name',
        'quantity',
      //  'price',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'item_category',
        'unit',
    ];

    const UNIT_SELECT = [
        'piece/s' => 'piece/s',
        'box/es'  => 'box/es',
        'rm'      => 'rm',
        'roll/s'  => 'roll/s',
        'set/s'   => 'set/s',
        'pack/s'  => 'pack/s',
        'sheet/s' => 'sheet/s',
        'inch/es' => 'inch/es',
        'pair'    => 'pair',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }
    /*
    public function priceApprovedRequests()
    {
        return $this->hasMany(ApprovedRequest::class, 'price_id', 'id');
    }
    */
    public function itemApprovedRequests()
    {
        return $this->belongsToMany(ApprovedRequest::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function itemItemRestocks()
    {
        return $this->belongsToMany(ItemRestock::class);
    }
}
