<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Domain extends Model
{

    use HasFactory;

    public function getCreatedAtAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d H:i:s');
    }
}
