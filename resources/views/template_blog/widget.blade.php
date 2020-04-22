		<div class="col-md-4">
					<!-- social widget -->
					<div class="aside-widget">


						<div class="section-title">
							<h2 class="title">Social Media</h2>
						</div>
						<div class="social-widget">
							<ul>
								<li>
									<a href="https://www.facebook.com/HimpunanMahasiswaTeknikInformatikaStmikAkba" target="_blank" class="social-facebook">
										<i class="fa fa-facebook"></i>
										<span>21.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/himtistmikakba?lang=id" target="_blank" class="social-twitter">
										<i class="fa fa-twitter"></i>
										<span>10.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="https://www.instagram.com/himti_akba/?igshid=jjncmrsyx8jh" class="social-instagram">
										<i class="fa fa-instagram"></i>
										<span>5K<br>Followers</span>
									</a>
								</li>

							</ul>
						</div>
					</div>
					<!-- /social widget -->

					<!-- category widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">KATEGORI</h2>
						</div>
						<div class="category-widget">
							<ul>
								@foreach($category_widget as $hasil)
								<li><a href="{{ route('blog.category', $hasil->slug) }}">{{ $hasil->name }} <span>{{ $hasil->posts->count() }}</span></a></li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>