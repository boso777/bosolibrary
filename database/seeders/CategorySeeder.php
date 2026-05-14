<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Programmazione',
            'Elettronica',
            'Storia',
            'Business',
            'Filosofia',
            'DIY',
            'Narrativa',
            'Biografia',
            'Manuali',
            'Documenti',
            'Moodboard',
            'Progetti',
            'Appunti',
            'Reti e sistemi',
            'Cybersecurity',
            'Intelligenza artificiale',

        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
