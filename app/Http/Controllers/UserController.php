<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\user;
use SweetAlert;
use App\User;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view('admin.user.create', compact('user'));
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
            'name' => 'required|min:3',
            'email' => 'required',
            'tipe' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = user::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'tipe' => $request['tipe'],
            'password' =>  bcrypt($request->password)
        ]);
        toast('Data berhasil disimpan','success');
        return redirect()->route('user.index');
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
        $user = user::findorfail($id);

        return view('admin.user.edit', compact('user'));
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
            'name' => 'required|min:3',
            'email' => 'required',
            'tipe' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = ([
            'name' => $request['name'],
            'email' => $request['email'],
            'tipe' => $request['tipe'],
            'password' => $request['password']
        ]);

        if ($user) {
            toast('Data berhasil diedit','success');
        } else {
            toast('Data berhasil diedit','error');
        }
        user::whereId($id)->update($user);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = user::findorfail($id);
        $model->delete();
        toast('Data berhasil dihapus','success');
        return redirect()->back()->with('success', 'Data kategori berhasil dihapus');
    }

    public function dataTable(){
        $user = user::query();
            return datatables()->of($user)
                ->addColumn('tipe', function($user){
                    if ($user->tipe == 1){
                        return '<span class="badge badge-danger">Admin</span>';
                    } else {
                        return '<span class="badge badge-primary">User</span>';
                    };
                })
                ->addColumn('action', function($user){
                                return '
                                <div>
                                    <a class="btn btn-primary btn-sm" href="'.url("user/".$user->id)."/edit".'"> <i class="fa fa-edit" aria-hidden="true"></i> Edit </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('.$user->id.')"> <i class="fa fa-trash" aria-hidden="true"></i> Delete </button>
                                </div>
                                ';
                            })
                ->addIndexColumn()
                ->rawColumns(['tipe', 'action'])->make(true);
    }
}
