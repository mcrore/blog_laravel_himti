	<!-- FOOTER -->
	<footer id="footer">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-4" align="center">
					<div class="footer-widget">
						<div class="footer-logo">
							{{-- <a href="index.html" class="logo"><img src="{{ ('public/assets/img/himti/logo.png') }}" alt=""></a> <br> <br> <br> --}}
							<a href="" class="logo"><img src="{{ asset('public/frontend/img/logo.png')}}" alt=""></a><br> <br> <br>
						</div>
						<p>HIMTI Stmik Akba Makassar</p>
						<ul class="contact-social">
							<li><a href="https://www.facebook.com/HimpunanMahasiswaTeknikInformatikaStmikAkba" target="_blank" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/himtistmikakba?lang=id" target="_blank" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="https://www.instagram.com/himti_akba/?igshid=jjncmrsyx8jh" target="_blank" class="social-instagram"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer-widget">
						<h3 class="footer-title">KATEGORI</h3>
						<div class="category-widget">
							<ul>
								@foreach($category_widget as $hasil)
								<li><a href="{{ route('blog.category', $hasil->slug) }}">{{ $hasil->name }} <span>{{ $hasil->posts->count() }}</span></a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer-widget">
						<h3 class="footer-title">TAG</h3>
						<div class="tags-widget">
							<ul>
								@foreach($tags_widget as $hasil)
								<li><a href="{{ route('blog.tag', $hasil->slug) }}">{{ $hasil->name }} <span>{{ $hasil->posts_tags->count() }}</span></a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /row -->

			<!-- row -->
			<div class="footer-bottom row">

				<div class="col-md-12">
					<div class="footer-copyright">
					 <center>	Copyright &copy;<script>document.write(new Date().getFullYear());</script> Website SISTEM INFORMASI | HIMTI STMIK AKBA <i class="fa fa-heart-o" aria-hidden="true"></i> Created by <a href="" target="_blank">Devisi Ilmu Pengetahuan dan TEKnologi </a>
					 </center>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/jquery.stellar.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/main.js') }}"></script>

</body>

</html>