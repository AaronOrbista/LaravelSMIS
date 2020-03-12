<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemReleaseRecord extends Model
{
    use SoftDeletes;

    public $table = 'item_release_records';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'claimed',
        'created_at',
        'updated_at',
        'deleted_at',
      /*  'received_by', */
        'date_requested_id',
        'control_number_id',
    ];

    public function control_number()
    {
        return $this->belongsTo(ApprovedRequest::class, 'control_number_id');
    }

    public function date_requested()
    {
        return $this->belongsTo(ApprovedRequest::class, 'date_requested_id');
    }
}
