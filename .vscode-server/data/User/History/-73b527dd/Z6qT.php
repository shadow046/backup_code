
    <div style="user-select:none;">
      <img src="idsi.png" style="height: 90px; user-drag: none; -moz-user-select: none; -webkit-user-drag: none;-webkit-user-select: none;-ms-user-select: none; " >
      <a style="font-size:26px !important; font-weight: bold; user-select:none; color:#0d1a80;height:75px !important;line-height:75px !important;">TIME MONITORING SYSTEM</a>
    </div>
  <nav class="navbar navbar-expand-lg navbar-dark idsi" id="mainNav">
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
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Employees">
          <a class="nav-link xlink {{ Request::is('employees') ? 'active' : '' }}" href="{{ url('/employees') }}">
            Employees
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Branch">
          <a class="nav-link xlink {{ Request::is('branch') ? 'active' : '' }}" href="{{ url('/branch') }}">
            Branch
          </a>
        </li>
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
      </ul>
      <ul class="navbar-nav " style ="margin-left:270px !important;">
        <a class="nav-link" style="color: white; font-size: 16px; cursor: pointer;" onclick="$('#logout-form').submit();">
            <b>LOGOUT</b>&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </ul>
    </div>
  </nav>