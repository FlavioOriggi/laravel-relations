<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            // crare l'istanza
            $newPost = new Post();

            // generare i dati
            $newPost->title = 'Post numero ' . ($i + 1);
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->content = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem voluptate voluptatem quasi sint vitae veritatis explicabo accusamus nulla veniam facere quae, velit ducimus commodi quo est. Laudantium veritatis incidunt quae. ';

            // salvare i dati
            $newPost->save();
        }
    }
}