<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{

    protected $table = 'Stores';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['StockId', 'StockNameAr', 'StockNameEn', 'StockTyp', 'status', 'userEntry', 'deleted_at', 'created_at', 'updated_at'];

}
