@extends('template_backend.home')
@section('sub_judul', 'Post terhapus')
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
    <br><br>

    <table  id="example1" class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" width="120px">Nomor</th>
          <th scope="col">Judul</th>
          <th scope="col">Kategori</th>
          <th scope="col">Daftar Tags</th>
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
              <li>{{$tag->name}}</li>
            </ul>
            @endforeach
          </td>
          <td><img src="{{asset($p->gambar)}}" class="img-fluid" style="width:100px"></td>
          <td>

              <form action="{{route('post.kill', $p->id)}} " method="post">
                @csrf
                @method('delete')
                <a href="{{ route('post.restore', $p->id) }}" class="btn btn-info btn-sm">  <i class="fas fa-sync-alt" aria-hidden="true"></i> Restore </a>
                <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash" aria-hidden="true"></i> Delete Permanen </button>
              </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
@endsection