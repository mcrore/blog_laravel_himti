
      @include('template_backend.header')

      @include('template_backend.sidebar')
      <!-- Main Content -->

      <div class="main-content">
        <section class="section">
          <div class="section-header bg-danger">
            <h1 class="text-white"> @yield('sub_judul') </h1>
          </div>
          <div class="section-body ">
            <div class="card card-primary">
              <div class="card-body ">
                <div class="table-responsive-xl">
                  @yield('content')
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


      @include('template_backend.footer')




