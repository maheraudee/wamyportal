<?php

namespace App\Models\Saving\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class boanalyse_guarantee_pivot extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    /* protected $fillable = ['analyse_id', 'guarantee_id', 'created_at', 'updated_at']; */
}
