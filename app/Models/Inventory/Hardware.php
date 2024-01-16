<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hardware extends Model
{

    protected $table = 'hardwares';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['HdwBarcode', 'TphdwId', 'ManfId', 'OSystems', 'HdwModel', 'img', 'status', 'userEntry', 'deleted_at', 'created_at', 'updated_at'];

    public function typhardware()
    {
        return $this->belongsTo(Typhardware::class,'TphdwId');
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class,'ManfId');
    }
}
