<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Percakapan extends Model
{
    protected $fillable = ['type', 'name', 'created_by'];

    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'percakapan_id');
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'percakapan_id');
    }
}