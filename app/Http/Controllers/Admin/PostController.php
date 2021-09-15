<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id'


        ]);



        $data = $request->all();

        $new_post = new Post();

        $slug = Str::slug($data['title'],'-');
        $slug_base = $slug;
        
        $slug_presente = Post::where('slug', $slug)->first();
        $contatore = 1;

        while($slug_presente){
            $slug = $slug_base . '-' .$contatore ;

            $slug_presente = Post::where('slug', $slug)->first();

            $contatore++;
        }

        $new_post->slug = $slug;
        $new_post->fill($data);

        $new_post->save();          
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact ('post'));
    }

    // collegamento con id
    // public function show(Post $post)
    // {        
    //     return view('admin.posts.show', compact ('post'));
    // }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        // dd($categories);
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id'
        ]);



        $data = $request->all();
        if($data['title'] != $post->title){

            $slug = Str::slug($data['title'], '-');
            $slug_base = $slug;

            $slug_presente = Post::where('slug', $slug)->first();

            $contatore = 1;
            while($slug_presente){

                $slug = $slug_base . '-' . $contatore;

                $slug_presente = Post::where('slug', $slug)->first();

                $contatore++;
            }

            $data['slug'] = $slug;



        }
        $post->update($data);

        return redirect()->route('admin.posts.index')->with('update', 'Modificato correttamente l\'id ' .$post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('delete', 'Hai cancellato l\'id ' .$post->id);
    }
}
