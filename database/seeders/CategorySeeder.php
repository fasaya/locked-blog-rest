<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Tutorials', 'Life', 'Love', 'Other'];

        foreach ($data as $item) {
            Category::create([
                'slug' => Str::slug($item),
                'name' => $item,
                'description' => '',
                'status' => 1,
            ]);
        }
    }
}
