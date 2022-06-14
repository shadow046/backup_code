
    <div style="user-select:none;">
      <a href="/" style="text-decoration: none;">
        <img src="{{asset('idsi.png')}}" style="height: 90px; user-drag: none; -moz-user-select: none; -webkit-user-drag: none;-webkit-user-select: none;-ms-user-select: none; " >
        <a href="/" style="text-decoration: none; font-size:26px !important; font-weight: bold; user-select:none; color:#0d1a80;height:75px !important;line-height:75px !important;">TIME MONITORING SYSTEM</a>
      </a>
      <div class="mt-2 p-2 ml-auto align-self-end d-flex" style="float:right">
        <div style="text-align: right; font-size: 12px;">
            {{ Carbon\Carbon::now()->isoformat('dddd, MMMM DD, YYYY') }}
            <span id="datetime"></span><br>
            <strong>{{ auth()->user()->name }}</strong>&nbsp;
            {{ strtoupper(str_replace('"', '', auth()->user()->getRoleNames())) }}<br>
            {{-- {{ auth()->user()->email }}<br> --}}
            {{-- <a style="color: black;" href="{{ url('/changepassword') }}">Change Password</a> --}}
        </div>
        <i class="fa fa-user-circle fa-4x p-2" aria-hidden="true"></i>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark idsi" id="mainNav" style="border-radius: 0px;">
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Home">
            <a class="nav-link xlink {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
              Home
            </a>
        </li>
        <li class="nav-item mx-1 " data-toggle="tooltip" data-placement="right" title="DTR">
          <a class="nav-link xlink {{ Request::is('dtr') ? 'active' : '' }}" href="{{ url('/dtr') }}">
            DTR
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Employee">
          <a class="nav-link xlink {{ Request::is('employee') ? 'active' : '' }}" href="{{ url('/employee') }}">
            Employee
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Branch">
          <a class="nav-link xlink {{ Request::is('branch') ? 'active' : '' }}" href="{{ url('/branch') }}">
            Branch
          </a>
        </li>
        {{-- @role('admin|employee') --}}
        @role('admin') {{-----ROLES-----}}
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Shift Maintenance">
          <a class="nav-link xlink {{ Request::is('shift') ? 'active' : '' }}" href="{{ url('/shift') }}">
            Shift Maintenance
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Leave Maintenance">
          <a class="nav-link xlink {{ Request::is('leave') ? 'active' : '' }}" href="{{ url('/leave') }}">
            Leave Maintenance
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Holiday Maintenance">
          <a class="nav-link xlink {{ Request::is('holiday') ? 'active' : '' }}" href="{{ url('/holiday') }}">
            Holiday Maintenance
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="User">
          <a class="nav-link xlink {{ Request::is('user') ? 'active' : '' }}" href="{{ url('/user') }}">
              User
            </a>
        </li>
        @endrole
      </ul>
        {{-- <a class="nav-link" style="height: 50px; line-height: 40px; text-decoration: none !important; float: right; color: white; font-size: 16px; cursor: pointer;" onclick="$('#logout-form').submit();">
            <b>LOGOUT</b>&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form> --}}
     
    </div>
  </nav>