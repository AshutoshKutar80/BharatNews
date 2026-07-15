<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Politics',
            'Crime',
            'Sports',
            'Business',
            'Technology',
            'Entertainment',
            'Education',
            'Health',
            'World',
            'Lifestyle',
            'Automobile',
            'Science',
            'Environment',
            'Jobs',
            'Opinion',
        ];

        foreach ($categories as $index => $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category)],
                [
                    'name' => $category,
                    'description' => $category . ' News',
                    'display_order' => $index + 1,
                    'status' => 'active',
                ]
            );
        }
    }
}
