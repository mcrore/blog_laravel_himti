@extends('template_backend.home')
@section('sub_judul', 'Dashboard Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah User</div>
                            @foreach($users as $hasil)
                            @endforeach
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $hasil->count() }}</div>
                            </div>
                                <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>

                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Kategori</div>
                        @foreach($category as $hasil)
                        @endforeach
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $hasil->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-clone fa-2x text-gray-300"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Tags</div>
                        @foreach($tag as $hasil)
                        @endforeach
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $hasil->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-bookmark fa-2x text-gray-300"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Post</div>
                        @foreach($posts as $hasil)
                        @endforeach
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $hasil->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>


    </div>
</div>
@endsection

