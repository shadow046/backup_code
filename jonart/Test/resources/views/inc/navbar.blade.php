<nav class="nav nav-tabs navbar-expand-md">
    <div class="navbar-collapse collapse justify-content-between align-items-center w-100">
        <ul class="nav mr-auto">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/home') ? 'active' : '' }}" href="{{ url('/admin/home') }}">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ url('/admin/dashboard') }}">CUSTOMERS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ url('/admin/users') }}">USERS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('Import') ? 'active' : '' }} import" href="#">IMPORT</a>
            </li>
        </ul>
            <ul class="nav">
                <a href="{{ route('auth.login')}}"><b>Logout</b>&nbsp;&nbsp;<i class="fa fa-sign-out pr-5" aria-hidden="true"></i></a>
            </ul>
    </div>
</nav>

@section('javascripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
         $('#datatable').DataTable();
        });
    </script>
    @endsection