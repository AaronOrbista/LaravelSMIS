<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    public $table = 'accounts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_number',
        'last_name',
        'first_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'middle_name',
        'designation',
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function requestorApprovedRequests()
    {
        return $this->belongsToMany(ApprovedRequest::class);
    }
}
