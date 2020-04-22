<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\posts;
use App\Tags;
use App\category;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Storage;
use File;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //mengambil file tags
        $tags = Tags::all();
        //mengambil file category
        $category = Category::all();
        return view('admin.post.create', compact('category','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required|min:3',
            'category_id' => 'required',
            'content' => 'required|min:3',
            'gambar' => 'required'
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $post = Posts::create([
            'judul' => $request['judul'],
            'category_id' => $request['category_id'],
            'content' => $request['content'],
            'gambar' => 'public/uploads/posts/'.$new_gambar,
            'slug' => Str::slug($request->judul),
            'users_id' => Auth::id()
        ]);

        //mengambil tags array
        $post->tags()->attach($request->tags);

        $gambar->move('public/uploads/posts/', $new_gambar);

        return redirect()->back()->with('success', 'Data postingan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $tags = Tags::all();
        $posts = Posts::findorfail($id);
        return view('admin.post.edit', compact('posts', 'tags','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required|min:3',
            'category_id' => 'required',
            'content' => 'required|min:3'
        ]);

        $post = Posts::findorfail($id);


        //jika gambar ada

        if ($request->has('gambar')) {
            $gambar = $request->gambar;

            if ($gambar) {
                $destinationPath = 'public/uploads/posts/';
                File::delete($destinationPath, $post->gambar);
            }


            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move('public/uploads/posts/', $new_gambar);

            $post_data = [
                'judul' => $request['judul'],
                'category_id' => $request['category_id'],
                'content' => $request['content'],
                'gambar' => 'public/uploads/posts/'.$new_gambar,
                'slug' => Str::slug($request->judul),
                'users_id' => Auth::id()
            ];


        } else {
            $post_data = [
                'judul' => $request['judul'],
                'category_id' => $request['category_id'],
                'content' => $request['content'],
                'slug' => Str::slug($request->judul),
                'users_id' => Auth::id()
            ];
        }

        //mengambil tags array
        $post->tags()->sync($request->tags);
        $post->update($post_data);

        return redirect()->route('post.index')->with('success', 'Data postingan berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Posts::findorfail($id);
        $posts->delete();
        return redirect()->back()->with('success', 'Data Post berhasil dihapus ( Silahkan cek submenu List Post Terhapus)');
    }

    public function tampil_hapus()
    {
        $posts = Posts::onlyTrashed()->get();
        return view('admin.post.tampil_hapus', compact('posts'));
    }


    public function restore($id)
    {
        $posts = Posts::withTrashed()->where('id', $id)->first();
        $posts->restore();

        return redirect()->back()->with('success', 'Data Post berhasil direstore ( Silahkan cek submenu List Post)');
    }

    public function kill($id)
    {
        $posts = Posts::withTrashed()->where('id', $id)->first();
        $image_path = app_path($posts->gambar);


        $destinationPath = 'public/uploads/posts/';
        File::delete($destinationPath, $posts->gambar);

        $posts->tags()->detach();
        $posts->forceDelete();





        return redirect()->back()->with('success', 'Data Post berhasil dihapus secara permanen');
        // return redirect()->route('post.trashed')->with('delete','Post Berhasil di Hapus Permanen');



    }
}
