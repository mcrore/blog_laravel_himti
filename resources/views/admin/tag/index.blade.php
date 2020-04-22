@extends('template_backend.home')
@section('sub_judul', 'Tag')
@section('content')

    <br>
    <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#newMenuModal">  <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
    <br><br><br>

    <table  id="dataTable" class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col" width="120px">Nomor</th>
          <th scope="col">Nama</th>
          <th scope="col" width="200px"> Aksi</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
@endsection

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="newMenuModal">Tambah Tag</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('tag.store') }}" method="post">
              @csrf
              <div class="modal-body">
                  <div class="col">
                    <label>Tags :</label>
                      <input type="text" class="form-control" placeholder="Masukan Tag" name="name"  value="{{old('name')}} ">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="sumbit" class="btn btn-primary">Add</button>
              </div>
          </form>
      </div>
  </div>
</div>

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
                        url : "{{ url('tag/delete')}}" + '/' + id,
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
    ajax : "{{ route('tabel.tag') }}",
    columnDefs: [
            {targets: 0, className: 'text-left'},
            {targets: 1, className: 'text-left'},
        ],
    columns: [
      { data: 'DT_RowIndex', name:'id'},
      {data : 'name', name : 'name', true: true, searchable: true},
      {data : 'action', name : 'action', orderable: false, searchable: false},
    ],
    "columnDefs": [
                        { "width": "5%", "targets": 0 }
                     ]
  });



</script>
@endsection