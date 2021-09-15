<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Html', 'CSS', 'Php', 'Javascript', 'Vue Cli'];

        foreach($categories as $category) {
            $newCategory = new CAtegory();
            $newCategory->name = $category;
            $newCategory->slug = Str::slug($category,'-');

            $newCategory->save();
            

        }
    }
}
