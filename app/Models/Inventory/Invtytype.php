<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invtytype extends Model
{

    protected $table = 'Invtytypes';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['TypeId', 'TypeNameAr', 'TypeNameEn', 'status', 'userEntry', 'deleted_at', 'created_at', 'updated_at'];

}
