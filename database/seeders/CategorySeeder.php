<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Nutrition', 'slug' => 'nutrition', 'description' => 'Evidence-based nutrition science and dietary guidance for optimal health.'],
            ['name' => 'Supplements', 'slug' => 'supplements', 'description' => 'Clinical insights into supplementation, bioavailability, and therapeutic efficacy.'],
            ['name' => 'Bio-Clinical Research', 'slug' => 'bio-clinical-research', 'description' => 'Cutting-edge research at the intersection of biology, biochemistry, and clinical medicine.'],
            ['name' => 'Lifestyle Medicine', 'slug' => 'lifestyle-medicine', 'description' => 'Holistic approaches to wellness through lifestyle modifications and behavioral change.'],
            ['name' => 'Wellness', 'slug' => 'wellness', 'description' => 'Practical wellness strategies for mind-body health and vitality.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
