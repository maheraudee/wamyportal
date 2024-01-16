<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invtytrack extends Model
{

    protected $table = 'Invtytracks';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['HdwId', 'HdwBarcode', 'InvTypeId', 'StockIN', 'StockOUT', 'Note', 'status', 'userEntry', 'deleted_at', 'created_at', 'updated_at'];

    public function hardware()
    {
        return $this->belongsTo(Hardware::class,'HdwId');
    }
    public function stockin()
    {
        return $this->belongsTo(Store::class,'StockIN','StockId');
    }
    public function stockout()
    {
        return $this->belongsTo(Store::class,'StockOUT','StockId');
    }
    public function invtype()
    {
        return $this->belongsTo(Invtytype::class,'InvTypeId','TypeId');
    }
}
