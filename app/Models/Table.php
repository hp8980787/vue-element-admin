<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $table = 'remote_tables';
    protected $fillable = ['database_id', 'name', 'type_id', 'format_id', 'full_column', 'display_column', 'author', 'time_column'];
    protected $casts = ['display_column'=>'array','full_column'=>'array'];

    public function database()
    {
        return $this->belongsTo(Database::class, 'database_id', 'id');
    }

    public function format()
    {
        return $this->hasOne(Format::class, 'id', 'format_id');
    }
}
