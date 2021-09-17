<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Domain extends Model
{

    use HasFactory;

    protected $fillable = ['name','url','country','remind_time','expired_time','check_status','check_time'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::create($value)->format('Y-m-d H:i:s');
    }


    public function getCheckStatusAttribute($value)
    {
        switch ($value) {
            case -1:
                return 'checked_fail';
            case 0:
                return 'not_checked';
            case 1:
                return 'checked';
        }
    }

}
