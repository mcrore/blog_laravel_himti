@extends('template_backend.home')
@section('sub_judul', 'Leader (Ketua Umum)')
@section('content')
<style>
  #imgView{
    padding:5px;
  }
  .loadAnimate{
    animation:setAnimate ease 2.5s infinite;
  }
  @keyframes setAnimate{
    0%  {color: #000;}
    50% {color: transparent;}
    99% {color: transparent;}
    100%{color: #000;}
  }
  .custom-file-label{
    cursor:pointer;
  }
</style>

    <br>
    <a href="{{ route('leader.create') }}"  class="btn btn-danger btn-sm "  data-toggle="modal" data-target="#newMenuModal">  <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data</a>
    <br><br><br>

    <table  id="dataTable" class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" width="120px">Nomor</th>
          <th scope="col">Nama</th>
          <th scope="col">Periode</th>
          <th scope="col">Angkatan</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Foto</th>
          <th scope="col" width="200px"> Aksi</th>
        </tr>
      </thead>
      <tbody>
    </table>
@endsection

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="newMenuModal">Tambah Leader</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('leader.store') }}" method="post" enctype="multipart/form-data">
              @csrf
               <div class="modal-body">
                  <div class="col">
                    <label>Nama :</label>
                    <input type="text" class="form-control" id="nama" name="nama"  value="{{old('nama')}} ">
                  </div>
              </div>
              <div class="modal-body">
                <div class="col">
                  <label>Periode :</label>
                  <input type="text" class="form-control" id="periode" name="periode" value="{{old('periode')}} ">
                </div>
              </div>
              <div class="modal-body">
                <div class="col">
                  <label>Angkatan :</label>
                  <input type="text" class="form-control" id="angkatan" name="angkatan"  value="{{old('angkatan')}} ">
                </div>
              </div>
              <div class="modal-body">
                <div class="col">
                  <label>Keterangan :</label>
                  <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="10"> {{old('keterangan')}} </textarea>
                </div>
              </div>
              <div class="modal-body">
                <div class="col">
                  <label>Foto :</label>
                  <div class="imgWrap">
                    <img src="no-image.png" id="imgView" class="card-img-top img-fluid">
                  </div>
                  <input type="file" class="form-control" id="inputFile" name="foto" class="imgFile custom-file-input" aria-describedby="inputGroupFileAddon01">
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
        $("#inputFile").change(function(event) {
            fadeInAdd();
            getURL(this);
          });

          $("#inputFile").on('click',function(event){
            fadeInAdd();
          });

          function getURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              var filename = $("#inputFile").val();
              filename = filename.substring(filename.lastIndexOf('\\')+1);
              reader.onload = function(e) {
                debugger;
                $('#imgView').attr('src', e.target.result);
                $('#imgView').hide();
                $('#imgView').fadeIn(500);
                $('.custom-file-label').text(filename);
              }
              reader.readAsDataURL(input.files[0]);
            }
            $(".alert").removeClass("loadAnimate").hide();
          }

          function fadeInAdd(){
            fadeInAlert();
          }
          function fadeInAlert(text){
            $(".alert").text(text).addClass("loadAnimate");
          }

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
                        url : "{{ url('leaders/delete')}}" + '/' + id,
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
    ajax : "{{ route('tabel.leaders') }}",
    columnDefs: [
            {targets: 0, className: 'text-left'},
            {targets: 1, className: 'text-left'},
        ],
    columns: [
      { data: 'DT_RowIndex', name:'id'},
      {data : 'nama', name : 'nama', true: true, searchable: true},
      {data : 'periode', name : 'periode', true: true, searchable: true},
      {data : 'angkatan', name : 'angkatan', true: true, searchable: true},
      {data : 'keterangan', name : 'keterangan', true: true, searchable: true},
      {data: 'show_file', name: 'show_file'},
      {data : 'action', name : 'action', orderable: false, searchable: false},
    ],
    "columnDefs": [
                        { "width": "5%", "targets": 0 }
                     ]
  });



</script>
@endsection