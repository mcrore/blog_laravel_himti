<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tags;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\Validator;
use Datatables;
use DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tags::all();
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asd = Validator::make($request->all(),[
            'name' => 'required|min:3'
        ]);

        if ($asd->fails()) {
            toast('Data gagal disimpan ','error');
            return redirect()->route('tag.index');
            // return back()->with('error', $asd->messages()->all()[0])->withInput();

        }
        $tags = tags::create([
                'name' => $request['name'],
                'slug' => Str::slug($request->name)
            ]);
        toast('Data berhasil disimpan','success');
        return redirect()->route('tag.index');
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
        $tags = Tags::findorfail($id);
        return view('admin.tag.edit', compact('tags'));
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
            'name' => 'required|min:3'
        ]);

        $tags = ([
            'name' => $request['name'],
            'slug' => Str::slug($request->name)
        ]);

        tags::whereId($id)->update($tags);
        if ($tags) {
            toast('Data berhasil diedit','success');
        } else {
            toast('Data gagal diedit','danger');
        }

        return redirect()->route('tag.index')->with('success', 'Data kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = Tags::findorfail($id);
        $tags->delete();
        return redirect()->back()->with('success', 'Data tag berhasil dihapus');
    }

    public function dataTable(){
        $tags = tags::query();
            return datatables()->of($tags)
                ->addColumn('action', function($tags){
                                return '
                                <div>
                                    <a class="btn btn-primary btn-sm" href="'.url("tag/".$tags->id)."/edit".'"> <i class="fa fa-edit" aria-hidden="true"></i> Edit </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('.$tags->id.')"> <i class="fa fa-trash" aria-hidden="true"></i> Delete </button>
                                </div>
                                ';
                            })
                ->addIndexColumn()
                ->rawColumns(['action'])->make(true);
    }
}
