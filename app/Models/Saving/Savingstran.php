<?php

namespace App\Models\Saving;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savingstran extends Model
{
    use HasFactory;

    protected $fillable = ['empno', 'premium', 'contribute', 'userEntry'];
}
