
@extends('template_blog.content')

@section('isi')
<div class="container">
<div class="col-md-12 hot-post-left">
	<!-- post -->
	<div class="post post-thumb">
		<a class="post-img" href=""><img src="{{ asset('public/frontend/img/background.jpg')}}" alt=""></a>
		<div class="post-body">
			<h3 class="post-title title-lg"><a href="">Sistem informasi HIMTI STMIK AKBA</a></h3>
			<ul class="post-meta">
				<li><a href="">admin</a></li>
				<li>{{ date('Y')}}</li>
			</ul>
		</div>
	</div>
	<!-- /post -->
 </div>
</div>

<!-- /container -->
</div>

	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<!-- row -->
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<h2 class="title">Postingan Terbaru</h2>
							</div>
						</div>
						<!-- post -->
						@foreach($data as $post_terbaru)
						<div class="col-md-6">
							<div class="post">
								<a class="post-img" href="{{ route('blog.isi', $post_terbaru->slug ) }}"><img src="{{ $post_terbaru->gambar }}" alt="" style="height: 200px"></a>
								<div class="post-body">
									<div class="post-category">
										<a href="">{{ $post_terbaru->category->name }}</a>
									</div>
									<h3 class="post-title"><a href="{{ route('blog.isi', $post_terbaru->slug ) }}">{{ $post_terbaru->judul }}</a></h3>
									<ul class="post-meta">
										<li><a href="">{{ $post_terbaru->users->name }}</a></li>
										<li>{{ $post_terbaru->created_at->diffForHumans() }}</li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach

					</div>
					<!-- /row -->


				</div>



			<!-- /row -->
@endsection




