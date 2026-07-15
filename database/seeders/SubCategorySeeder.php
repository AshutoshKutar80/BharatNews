<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            'Politics' => [
                'Election',
                'Parliament',
                'Government',
                'Policy',
            ],

            'Crime' => [
                'Murder',
                'Fraud',
                'Cyber Crime',
                'Police',
            ],

            'Sports' => [
                'Cricket',
                'Football',
                'Hockey',
                'Olympics',
            ],

            'Business' => [
                'Stock Market',
                'Startup',
                'Economy',
                'Finance',
            ],

            'Technology' => [
                'AI',
                'Mobile',
                'Gadgets',
                'Internet',
            ],

            'Entertainment' => [
                'Bollywood',
                'Hollywood',
                'OTT',
                'TV Shows',
            ],

            'Education' => [
                'School',
                'College',
                'Exams',
                'Results',
            ],

            'Health' => [
                'Fitness',
                'Medicine',
                'Nutrition',
                'Mental Health',
            ],

            'World' => [
                'Asia',
                'Europe',
                'America',
                'Middle East',
            ],

            'Lifestyle' => [
                'Fashion',
                'Travel',
                'Food',
                'Culture',
            ],

            'Automobile' => [
                'Cars',
                'Bikes',
                'EV',
                'Reviews',
            ],

            'Science' => [
                'Space',
                'Research',
                'Innovation',
            ],

            'Environment' => [
                'Climate',
                'Wildlife',
                'Pollution',
            ],

            'Jobs' => [
                'Government Jobs',
                'Private Jobs',
                'Recruitment',
            ],

            'Opinion' => [
                'Editorial',
                'Analysis',
                'Interviews',
            ],
        ];

        foreach ($data as $categoryName => $subcategories) {

            $category = Category::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($subcategories as $index => $subcategory) {

                SubCategory::updateOrCreate(
                    [
                        'slug' => Str::slug($subcategory),
                    ],
                    [
                        'category_id' => $category->id,
                        'name' => $subcategory,
                        'description' => $subcategory . ' News',
                        'display_order' => $index + 1,
                        'status' => 'active',
                    ]
                );
            }
        }
    }
}
