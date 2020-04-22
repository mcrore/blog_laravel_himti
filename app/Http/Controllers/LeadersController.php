<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leaders;
use File;

use Illuminate\Support\Facades\Validator;
use Datatables;
use DB;
use Auth;
class LeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $leaders = Leaders::all();
        return view('admin.leader.index', compact('leaders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.leader.create');
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
            'nama' => 'required|min:3',
            'periode' => 'required',
            'angkatan' => 'required|min:3',
            'keterangan' => 'required',
            'foto' => 'required'
        ]);


        $foto = $request->foto;
        $new_foto = time().$foto->getClientOriginalName();

        if ($asd->fails()) {
            toast('Data gagal disimpan ','error');
            return redirect()->route('leader.index');
            // return back()->with('error', $asd->messages()->all()[0])->withInput();

        }
        $leaders = Leaders::create([
            'nama' => $request['nama'],
            'periode' => $request['periode'],
            'angkatan' => $request['angkatan'],
            'keterangan' => $request['keterangan'],
            'foto' => 'public/uploads/leaders/'.$new_foto
        ]);

        $foto->move('public/uploads/leaders/', $new_foto);
        toast('Data berhasil disimpan','success');
        return redirect()->route('leader.index');
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
        $leaders = Leaders::findorfail($id);
        return view('admin.leader.edit', compact('leaders'));
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
            'nama' => 'required|min:3',
            'periode' => 'required',
            'angkatan' => 'required|min:3',
            'keterangan' => 'required'
        ]);

        $leader = leaders::findorfail($id);
        //jika foto ada

        if ($request->has('foto')) {
            $foto = $request->foto;

            if ($foto) {
                $destinationPath = 'public/uploads/leaders/';
                File::delete($destinationPath, $leader->foto);
            }
            $new_foto = time().$foto->getClientOriginalName();
            $foto->move('public/uploads/leaders/', $new_foto);

            $leader_data = [
                'nama' => $request['nama'],
                'periode' => $request['periode'],
                'angkatan' => $request['angkatan'],
                'keterangan' => $request['keterangan'],
                'foto' => 'public/uploads/leaders/'.$new_foto
            ];


        } else {
            $leader_data = [
                'nama' => $request['nama'],
                'periode' => $request['periode'],
                'angkatan' => $request['angkatan'],
                'keterangan' => $request['keterangan']
            ];
        }
        toast('Data berhasil diedit','success');
        $leader->update($leader_data);

        return redirect()->route('leader.index')->with('success', 'Data leader berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leaders = Leaders::findorfail($id);
        $destinationPath = 'public/uploads/leaders/';
        File::delete($destinationPath, $leaders->foto);
        $leaders->delete();
        return redirect()->back()->with('success', 'Data leader berhasil dihapus');
    }


    public function dataTable(){
        $leaders = leaders::query();
            return datatables()->of($leaders)
                ->addColumn('show_file', function($leaders){
                    if ($leaders->foto == NULL){
                        return 'No Image';
                    }
                        return '<image clas="img-circle" width="50px" src="'.$leaders->foto.'" ></image>';
                })
                ->addColumn('action', function($leaders){
                    return '
                    <div>
                        <a class="btn btn-primary btn-sm" href="'.url("leader/".$leaders->id)."/edit".'"> <i class="fa fa-edit" aria-hidden="true"></i> Edit </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('.$leaders->id.')"> <i class="fa fa-trash" aria-hidden="true"></i> Delete </button>
                    </div>
                    ';
                })
                ->addIndexColumn()
                ->rawColumns(['show_file', 'action'])->make(true);
    }
}