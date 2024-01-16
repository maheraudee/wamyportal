<?php

namespace App\Models\Inventory;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{

    protected $table = 'Inventories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['InvId', 'HdwId', 'HdwBarcode', 'InvTypeId', 'StockIN', 'Note', 'status', 'userEntry', 'deleted_at', 'created_at', 'updated_at'];

    public function hardware()
    {
        return $this->belongsTo(Hardware::class,'HdwId');
    }
    public function stockin()
    {
        return $this->belongsTo(Store::class,'StockIN','StockId');
    }
    public function invtytype()
    {
        return $this->belongsTo(Invtytype::class,'InvTypeId','TypeId');
    }

}
