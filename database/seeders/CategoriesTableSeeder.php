<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Information Technology (IT) & Software Development',
            'Marketing & Sales',
            'Healthcare & Medical',
            'Education & Training',
            'Finance & Accounting',
            'Human Resources & Recruitment',
            'Engineering & Architecture',
            'Creative & Design',
            'Customer Service & Support',
            'Logistics & Supply Chain',
            'Administration & Office Support',
            'Legal & Compliance',
            'Hospitality & Tourism',
            'Manufacturing & Production',
            'Real Estate & Property Management',
            'Humanitarian & Non-Profit',
            'Science & Research',
            'Public Relations & Communications',
            'Retail & Wholesale',
            'Security & Defense',
            'Remote Work',
            'Part-Time / Freelance',
            'Startup Jobs',
        ];


        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
