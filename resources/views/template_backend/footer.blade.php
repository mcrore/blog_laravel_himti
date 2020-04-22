 <footer class="main-footer bg-info text-white" >
        <div class="footer-left">
          Copyright Website HIMTI &copy; <?= date('Y') ?> <div class="bullet"></div> Support By Devisi IPTEK & PKM Himti Stmik Akba
        </div>
        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>


  <!-- General JS Scripts -->
  <script src="{{ asset('public/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('public/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('public/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('public/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('public/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('public/assets/js/stisla.js') }}"></script>
  <script src="{{ asset('public/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

  <script type="text/javascript" charset="utf8" src="{{ asset('public/assets/js/jquery.dataTables.js') }}"></script>
  {{-- <script type="text/javascript" charset="utf8" src="{{ asset('public/frontend/js/ckeditor.js') }}"></script>  --}}

  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('content' );
  </script>

  <script src="{{ asset('public/assets/js/sweetalert.min.js') }}"></script>


  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{ asset('public/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('public/assets/js/custom.js') }}"></script>

  @yield('script')

  <script>
    $(function() {
      $("#example1").DataTable();
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.form-checkbox').click(function(){
        if($(this).is(':checked')){
          $('.form-password').attr('type','text');
        }else{
          $('.form-password').attr('type','password');
        }
      });
    });
  </script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.form-checkbox2').click(function(){
      if($(this).is(':checked')){
        $('.form-password2').attr('type','text');
      }else{
        $('.form-password2').attr('type','password');
      }
    });
  });
</script>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

</body>
</html>