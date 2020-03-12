<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovedRequest extends Model
{
    use SoftDeletes;

    public $table = 'approved_requests';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'date_requested',
    ];

    protected $fillable = [
        'unit',
        'quantity',
     // 'price_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'control_number',
        'date_requested',
    ];


    public function controlNumberItemReleaseRecords()
    {
        return $this->hasMany(ItemReleaseRecord::class, 'control_number_id', 'id');
    }
    
    public function dateRequestedItemReleaseRecords()
    {
        return $this->hasMany(ItemReleaseRecord::class, 'date_requested_id', 'id');
    }
    
    public function requestors()
    {
        return $this->belongsToMany(Account::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }
    /*
    public function price()
    {
        return $this->belongsTo(Item::class, 'price_id');
    }
    */
    public function getDateRequestedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateRequestedAttribute($value)
    {
        $this->attributes['date_requested'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
