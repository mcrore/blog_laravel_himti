@extends('template_backend.home')
@section('sub_judul', 'Edit Kategori')
@section('content')

@if(count($errors)>0)
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <font color="black"> <strong> {{ $error }}</strong> </font>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endforeach
@endif

@if (Session::has('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <font color="black"> <strong>  {{ Session('danger') }} </strong>  </font>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif



<form action="{{ route('category.update', $category->id) }}" method="post" >
    @method('patch')
    @csrf
    <div class="form-group">
        <label>Kategori :</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
   </div>
   <div class="col order-12">
        <button class="btn btn-primary center-xs "> Update Kategori</button>
   </div>
</form>
@endsection