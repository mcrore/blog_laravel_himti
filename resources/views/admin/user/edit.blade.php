@extends('template_backend.home')
@section('sub_judul', 'Tambah User')
@section('content')

<br>
<form action="{{ route('user.update',  $user->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-row col-md">
        <div class="form-group col-md-6">
        <label>Nama : </label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  placehuserer="Masukan nama" value="{{ $user->name }}">
        @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>
        <div class="form-group col-md-6">
            <label>Email : </label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placehuserer="Masukan Email" value="{{ $user->email }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group  col-md">
        <label>Tipe User :</label>
        <select name="tipe" id=""  class="form-control">
            <option value="1" holder
            @if ($user->tipe == 1)
            selected
            @endif
            >Admin</option>
            <option value="0" holder
            @if ($user->tipe == 0)
            selected
            @endif
            >User</option>

        </select>
    </div>
    <div class="form-row col-md">
        <div class="form-group col-md-6">
        <label>Password :</label>
        <input type="password" id="password" class="form-control form-password2  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> <br>
        <input type="checkbox" class="form-checkbox2"> Tampilkan password
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="password-confirm">Konfirmasi Password :</label>
            <input id="password-confirm" type="password" class="form-control form-password" name="password_confirmation" required autocomplete="new-password"> <br>
            <input type="checkbox" class="form-checkbox"> Tampilkan password Konfirmasi
        </div>
    </div>
    <div class="form-group col-md-3 .offset-md-3 ">
        <button class="btn btn-primary btn-block "> + Update data </button>
    </div>
    <br><br>
</form>
@endsection

