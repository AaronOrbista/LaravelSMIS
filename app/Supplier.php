<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    public $table = 'suppliers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company_name',
        'tin_number',
        'contact_number',
        'address',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company_nameItemRestocks()
    {
        return $this->belongsToMany(ItemRestock::class);
    }
}
