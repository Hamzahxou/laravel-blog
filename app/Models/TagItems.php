<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagItems extends Model
{
    use HasFactory;
    protected $table = 'tag_items';
    protected $fillable = [
        'resep_id',
        'tag_id',
    ];

    public $timestamps = false;

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tags::class, 'tag_id');
    }
}
