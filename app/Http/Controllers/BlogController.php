<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Category;
use App\Posts_tags;
use App\Tags;

class BlogController extends Controller
{
    public function index(Posts $posts){
        $category_widget = Category::all();
        $posts_tags = posts_tags::all();
        $tags_widget = tags::all();

    	$data = $posts->latest()->take(8)->get();
    	return view('blog', compact('data','category_widget','tags_widget','posts_tags'));
    }

    public function isi_blog($slug){
        $category_widget = Category::all();
         $tags_widget = tags::all();

    	$data = Posts::where('slug', $slug)->get();
    	return view('blog.isi_post', compact('data','category_widget','tags_widget'));
    }

    public function list_blog(){
        $tags_widget = tags::all();
        $category_widget = Category::all();

    	$data = Posts::latest()->paginate(6);
    	return view('blog.list_post', compact('data','category_widget','tags_widget'));
    }

    public function list_category(category $category){
         $category_widget = Category::all();
         $tags_widget = tags::all();

        $data = $category->posts()->paginate(6);
        return view('blog.list_post', compact('data','category_widget','tags_widget'));
    }

    public function list_tag(tags $tags){
        $category_widget = Category::all();
        $tags_widget = tags::all();
        $posts_tags = posts_tags::all();

        $data = $tags->posts()->paginate(6);
    	return view('blog.list_tag', compact('tags','category_widget','data','tags_widget'));

    }



    public function cari(request $request){
        $category_widget = Category::all();
        $tags_widget = tags::all();


        $data = Posts::where('judul', $request->cari)->orWhere('judul','like','%'.$request->cari.'%')->paginate(6);
        return view('blog.list_post', compact('data','category_widget','tags_widget'));
    }
}
