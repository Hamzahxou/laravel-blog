<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'resep_id',
        'user_id',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class, 'comment_id', 'id');
    }
}
