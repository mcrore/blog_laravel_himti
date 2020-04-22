@extends('template_backend.home')
@section('sub_judul', 'User')
@section('content')

    <br>
    <a href="{{ route('user.create') }}" class="btn btn-danger btn-sm">  <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
    <br><br><br>

    <table  id="dataTable" class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" width="120px">Nomor</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Hak Akses</th>
          <th scope="col" width="200px"> Aksi</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
@endsection

@section('script')
    <script>
        function confirmDelete(id){
            swal({
                title: "Apakah anda yakin ingin menghapus file?",
                text: "File yang dihapus tidak dapat dikembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url : "{{ url('user/delete')}}" + '/' + id,
                        type : "GET",
                        data : {'_method' : 'DELETE'},
                        success: function(){
                            swal({
                                title: "Success!",
                                text : "Data berhasil dihapus",
                                icon : "success",
                            }).then(function() {
                                $('#dataTable').DataTable().ajax.reload();
                            });
                        },
                        error : function(){
                            swal({
                                title: 'Opps...',
                                icon : "error",
                                timer : '1500'
                            })
                        }
                    })
                } else {
                    swal({
                                title: 'Data gagal dihapus',
                                icon : "success",
                                timer : '1500'
                            })
                }
            });
        }

     $('#dataTable').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax : "{{ route('tabel.user') }}",
        columnDefs: [
                {targets: 0, className: 'text-left'},
                {targets: 1, className: 'text-left'},
            ],
        columns: [
          { data: 'DT_RowIndex', name:'id'},
          {data : 'name', name : 'name', true: true, searchable: true},
          {data : 'email', name : 'email', true: true, searchable: true},
          {data : 'tipe', name : 'tipe', true: true, searchable: true},
          {data : 'action', name : 'action', orderable: false, searchable: false},
        ],
        "columnDefs": [
                            { "width": "5%", "targets": 0 }
                         ]
      });



    </script>
    @endsection
