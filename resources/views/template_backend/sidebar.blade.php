
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand ">

            <a class="text-danger" lass="dropdown-toggle" data-toggle="dropdown" href="{{route('home')}}">Admin Himti</a>

          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a  href="{{route('home')}}">AH</a>
          </div>
          <ul class="sidebar-menu ">
              <li class="menu-header text-danger">Dashboard</li>
              <li class=""><a class="nav-link text-danger" href="{{route('home')}} "><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
              @if (auth::user()->tipe == 1)
              <li class="menu-header text-danger">Leaders</li>
              <li class=""><a class="nav-link text-danger" href="{{route('leader.index')}} "><i class="fas fa-male"></i> <span>Ketua Umum (Leader)</span></a></li>
              @endif
              <li class="menu-header text-danger">Menu Post</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown  text-danger" data-toggle="dropdown"><i class="fas fa-book-open"></i> <span>Posts</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link text-danger" href=" {{route('post.index')}} ">List Post </a></li>
                  <li><a class="nav-link text-danger" href=" {{route('post.tampil_hapus')}} ">List Post Terhapus</a></li>
                </ul>
              </li>
              @if (auth::user()->tipe == 1)
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown  text-danger" data-toggle="dropdown"><i class="far fa-clone"></i> <span>Kategori</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link text-danger" href=" {{route('category.index')}} ">List Kategori</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown  text-danger" data-toggle="dropdown"><i class="far fa-bookmark"></i> <span>Tag</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link text-danger" href=" {{route('tag.index')}} ">List Tag</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown text-danger" data-toggle="dropdown"><i class="far fa-user"></i> <span>User</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link text-danger" href=" {{route('user.index')}} ">List User</a></li>
                </ul>
              </li>
              @endif

        </aside>
      </div>