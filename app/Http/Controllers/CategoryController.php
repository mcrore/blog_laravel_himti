<?php



namespace App\Http\Controllers;

use App\category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Datatables;
use DB;


class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $asd = $this->validate($request,[
        //     'name' => 'required|min:3'
        // ]);

        $asd = Validator::make($request->all(),[
            'name' => 'required|min:3'
        ]);

        if ($asd->fails()) {
            toast('Data gagal disimpan ','error');
            return redirect()->route('category.index');
            // return back()->with('error', $asd->messages()->all()[0])->withInput();

        }
        $category = category::create([
                'name' => $request['name'],
                'slug' => Str::slug($request->name)
            ]);
        toast('Data berhasil disimpan','success');
        return redirect()->route('category.index');




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
        $category = category::findorfail($id);

        return view('admin.category.edit', compact('category'));
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
        // $this->validate($request,[
        //     'name' => 'required|min:3'
        // ]);

        $category = ([
            'name' => $request['name'],
            'slug' => Str::slug($request->name)
        ]);

        category::whereId($id)->update($category);
        if ($category) {
            toast('Data berhasil diedit','success');
        } else {
            toast('Data gagal diedit','danger');
        }

        return redirect()->route('category.index')->with('success', 'Data kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $model = category::findorfail($id);
        $model->delete();
        toast('Data berhasil dihapus','success');
        return redirect()->back()->with('success', 'Data kategori berhasil dihapus');

    }

    public function dataTable(){
        $category = category::query();
            return datatables()->of($category)
                ->addColumn('show_file', function($category){
                    if ($category->file == NULL){
                        return 'No Image';
                    }
                        return '<a href="'.url('/upload/'.$category->file) .'" target="_blank" >'.$category->file.'</a>';
                })
                ->addColumn('action', function($category){
                                return '
                                <div>
                                    <a class="btn btn-primary btn-sm" href="'.url("category/".$category->id)."/edit".'"> <i class="fa fa-edit" aria-hidden="true"></i> Edit </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('.$category->id.')"> <i class="fa fa-trash" aria-hidden="true"></i> Delete </button>
                                </div>
                                ';
                            })
                ->addIndexColumn()
                ->rawColumns(['show_file', 'action'])->make(true);
    }


}
