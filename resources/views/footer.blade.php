@if (Auth::check())
 <footer class="main-footer">
  <div class="float-right d-none d-sm-inline">
    AKHALLIA
  </div>
  <strong>Copyright &copy; 2020</strong> JRMOLINA All rights reserved.
</footer>
@endif
</div>
<script>
  @auth
    window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
  @else
    window.Permissions = [];
  @endauth
</script>
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{asset('js/adminlte.min.js')}}"></script>
</body>
</html>
