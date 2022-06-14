
    <div style="user-select:none;">
      <img src="{{asset('idsi.png')}}" style="height: 90px; user-drag: none; -moz-user-select: none; -webkit-user-drag: none;-webkit-user-select: none;-ms-user-select: none; " >
      <a style="font-size:26px !important; font-weight: bold; user-select:none; color:#0d1a80;height:75px !important;line-height:75px !important;">TIME MONITORING SYSTEM</a>
      <div class="mt-2 p-2 ml-auto align-self-end d-flex" style="float:right">
        <div style="text-align: right; font-size: 12px;">
            <?php echo e(Carbon\Carbon::now()->isoformat('dddd, MMMM DD, YYYY')); ?>

            <span id="datetime"></span><br>
            <strong><?php echo e(auth()->user()->name); ?></strong>&nbsp;
            <?php echo e(strtoupper(str_replace('"', '', auth()->user()->getRoleNames()))); ?><br>
            <?php echo e(auth()->user()->email); ?><br>
            <a style="color: black;" href="<?php echo e(url('/changepassword')); ?>">Change Password</a>
        </div>
        <i class="fa fa-user-circle fa-4x p-2" aria-hidden="true"></i>
    </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark idsi" id="mainNav">
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Home">
            <a class="nav-link xlink <?php echo e(Request::is('/') ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>">
              Home
            </a>
        </li>
        <li class="nav-item mx-1 " data-toggle="tooltip" data-placement="right" title="DTR">
          <a class="nav-link xlink <?php echo e(Request::is('dtr') ? 'active' : ''); ?>" href="<?php echo e(url('/dtr')); ?>">
            DTR
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Employees">
          <a class="nav-link xlink <?php echo e(Request::is('employees') ? 'active' : ''); ?>" href="<?php echo e(url('/employees')); ?>">
            Employees
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Branch">
          <a class="nav-link xlink <?php echo e(Request::is('branch') ? 'active' : ''); ?>" href="<?php echo e(url('/branch')); ?>">
            Branch
          </a>
        </li>
        
        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Shift Maintenance">
          <a class="nav-link xlink <?php echo e(Request::is('shift') ? 'active' : ''); ?>" href="<?php echo e(url('/shift')); ?>">
            Shift Maintenance
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Leave Maintenance">
          <a class="nav-link xlink <?php echo e(Request::is('leave') ? 'active' : ''); ?>" href="<?php echo e(url('/leave')); ?>">
            Leave Maintenance
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="Holiday Maintenance">
          <a class="nav-link xlink <?php echo e(Request::is('holiday') ? 'active' : ''); ?>" href="<?php echo e(url('/holiday')); ?>">
            Holiday Maintenance
          </a>
        </li>
        <li class="nav-item mx-1" data-toggle="tooltip" data-placement="right" title="User">
          <a class="nav-link xlink <?php echo e(Request::is('user') ? 'active' : ''); ?>" href="<?php echo e(url('/user')); ?>">
              User
            </a>
        </li>
        <?php endif; ?>
      </ul>
     
        <a class="nav-link" style="height: 50px; line-height: 40px; text-decoration: none !important; float: right; color: white; font-size: 16px; cursor: pointer;" onclick="$('#logout-form').submit();">
            <b>LOGOUT</b>&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
     
    </div>
  </nav><?php /**PATH /var/www/html/ryan/sample/resources/views/inc/navbar.blade.php ENDPATH**/ ?>