@extends('template_backend.home')
@section('sub_judul', 'Edit Post')
@section('content')

@if(count($errors)>0)
    @foreach ($errors->all() as $error)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ $error }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
    @endforeach
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <font color="black"> <strong>  {{ Session('success') }} </strong>  </font>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{ route('leader.update', $leaders->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label>Nama :</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{$leaders->nama}} ">
    </div>
    <div class="form-group">
        <label>Periode :</label>
        <input type="text" class="form-control" id="periode" name="periode" value="{{$leaders->periode}} ">
    </div>
    <div class="form-group">
        <label>Angkatan :</label>
        <input type="text" class="form-control" id="angkatan" name="angkatan"  value="{{$leaders->angkatan}} ">
    </div>
    <div class="form-group">
        <label>Keterangan :</label>
       <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="10"> {{$leaders->keterangan}} </textarea>
    </div>
    <div class="form-group">
        <label>Foto :</label>
        <input type="file" class="form-control" id="foto" name="foto">
    </div>

    <div class="col order-12">
        <button class="btn btn-primary center-xs "> Update Leader</button>
   </div>
</form>
@endsection