<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_tag',
    ];

    public $timestamps = false;
    
    public function tagItems()
    {
        return $this->hasMany(TagItems::class);
    }
}
