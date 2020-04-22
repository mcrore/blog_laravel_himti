@extends('template_backend.home')
@section('sub_judul', 'Post')
@section('content')


      @if (Session::has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <font color="black"> <strong>  {{ Session('success') }} </strong>  </font>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      @if (Session::has('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <font color="black"> <strong>  {{ Session('danger') }} </strong>  </font>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @endif
    <br>
    <a href="{{ route('post.create') }}" class="btn btn-danger btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
    <br><br><br>

    <table  id="example1" class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" width="120px">Nomor</th>
          <th scope="col">Judul</th>
          <th scope="col">Kategori</th>
          <th scope="col">Daftar Tags</th>
          <th scope="col">Creator</th>
          <th scope="col">Gambar</th>
          <th scope="col" width="200px"> Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $p)
        <tr>
          <th scope="row"> {{ $loop->iteration  }} </th>
          <td>{{ $p->judul }}</td>
          <td>{{ $p->category->name }}</td>
          <td>
            @foreach ($p->tags as $tag)
            <ul>
              <li><h6> <span class="badge badge-info"> {{$tag->name}} </span> </h6></li>
            </ul>
            @endforeach
          </td>
          <td>{{ $p->users->name }}</td>
          <td><img src="{{asset($p->gambar)}}" class="img-fluid" style="width:100px"></td>
          <td>

              <form action="{{ route('post.destroy', $p->id)  }}" method="post">
                @csrf
                @method('delete')
                <a href="{{ route('post.edit', $p->id) }}" class="btn btn-primary btn-sm">  <i class="fa fa-edit" aria-hidden="true"></i> Edit </a>
                <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash" aria-hidden="true"></i> Delete </button>
              </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection