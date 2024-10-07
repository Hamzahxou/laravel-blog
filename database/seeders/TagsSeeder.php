<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tags::create([
            'nama_tag' => 'masakan',
        ]);
        Tags::create([
            'nama_tag' => 'minuman',
        ]);
        Tags::create([
            'nama_tag' => 'mudah',
        ]);
    }
}
