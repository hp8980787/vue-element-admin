<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Table;

class Database extends Model
{
    use HasFactory;

    protected $table = 'remote_databases';

    public function tables()
    {
        return $this->hasMany(Table::class, 'database_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_domain','user_id','domain_id')->withTimestamps();
    }
}
