

@extends('template_blog.content')

@section('isi')

	@foreach($data as $isi_post)

	<div id="post-header" class="page-header">
			{{-- <div class="page-header-bg" style="background-image: url( {{asset($isi_post->gambar) }} );" data-stellar-background-ratio="0.5"></div> --}}
			<div class="page-header-bg" style="background-image: url('../public/assets/img/himti/head.jpg');" data-stellar-background-ratio="0.5"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-10">
						<div class="post-category">
							<a href="category.html">{{ $isi_post->category->name }}</a>
						</div>
						<h1>{{ $isi_post->judul }}</h1>
						<ul class="post-meta">
							<li><a href="author.html">{{ $isi_post->users->name }}</a></li>
							<li>{{ $isi_post->created_at }}</li>

							<!-- <li><i class="fa fa-eye"></i> 807</li> -->
						</ul>
					</div>
				</div>
			</div>
	</div>

		<!-- /PAGE HEADER -->
	</header>
	<div class="col-md-8">
	<br>
	<div class="section-row">
		<figure class="pull-right">
			<img src="{{asset($isi_post->gambar) }}" alt="">

			{!! $isi_post->content !!}
			<footer class="blockquote-footer"> {{ $isi_post->users->name }} -- {{ $isi_post->created_at }}</footer>
		</figure>
		</div>
	</div>
	@endforeach


@endsection