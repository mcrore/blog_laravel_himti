@extends('template_backend.home')
@section('sub_judul', 'Edit Tag')
@section('content')

@if(count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-danger fade show" role="alert">
            <strong> {{ $error }}</strong>
        </div>
    @endforeach
@endif


<form action="{{ route('tag.update', $tags->id) }}" method="post">
    @method('patch')
    @csrf
    <div class="form-group">
        <label>Tag :</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $tags->name }}">
   </div>

   <div class="col order-12">
    <button class="btn btn-primary center-xs "> Update Tag</button>
</div>
</form>
@endsection