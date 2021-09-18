<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'remote_tables';

    public function database()
    {
        return $this->belongsTo(Database::class, 'database_id', 'id');
    }

    public function format()
    {
        return $this->hasOne(Format::class,'id','format_id');
    }
}
