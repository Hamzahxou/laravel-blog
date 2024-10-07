<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'reseps';
    protected $fillable = [
        'nama_resep',
        'gambar',
        'deskripsi',
        'content',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagItems()
    {
        return $this->hasMany(TagItems::class);
    }

    public function comment()
    {
        return $this->hasMany(Comments::class);
    }
}
