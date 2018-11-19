<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
       <?php if(!empty(Auth::user()->where('type',2)->first()->getUserDetails()->pluck('user_image')[0])): ?>
        <img src="<?php echo e(url('/images/user'.'/'.Auth::user()->where('type',2)->first()->getUserDetails()->pluck('user_image')[0])); ?>" class="img-circle admin-menu-img" alt="User Image">
      <?php else: ?>
        <img src="<?php echo e(url('/images/user/account_icon.png')); ?>" class="user-image " alt="User Image">
      <?php endif; ?>
      </div>
      <div class="pull-left info admin-sidebar-head">
        <p><?php echo e(Auth::user()->where('type',2)->pluck('first_name')[0]); ?> <?php echo e(Auth::user()->where('type',2)->pluck('last_name')[0]); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <?php 
     $url = $_SERVER['REQUEST_URI'];
     ?>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo e(strpos($url, 'dashboard') > 0?'active':''); ?>">
          <a href="<?php echo e(route('admin_dashboard')); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'event') > 0?'active':''); ?>">
          <a href="<?php echo e(route('event_list')); ?>">
            <i class="fa fa-calendar" aria-hidden="true"></i> <span>Events</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'business') > 0?'active':''); ?>">
          <a href="<?php echo e(route('business_list')); ?>">
            <i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Business</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'profile') > 0?'active':''); ?>">
          <a href="<?php echo e(route('profile_list')); ?>">
            <i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'category') > 0?'active':''); ?>">
          <a href="<?php echo e(route('category_list')); ?>">
            <i class="fa fa-bars" aria-hidden="true"></i> <span>Category</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'tags') > 0?'active':''); ?>">
          <a href="<?php echo e(route('tag_list')); ?>">
            <i class="fa fa-tags" aria-hidden="true"></i> <span>Tags</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'links') > 0?'active':''); ?>">
          <a href="<?php echo e(route('link_list')); ?>">
            <i class="fa fa-external-link" aria-hidden="true"></i> <span>Links</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'location') > 0?'active':''); ?>">
          <a href="<?php echo e(route('public_location_list')); ?>">
            <i class="fa fa-external-link" aria-hidden="true"></i> <span>Public Shared Locations</span>
          </a>
        </li>
        <li class="<?php echo e(strpos($url, 'location') > 0?'active':''); ?>">
          <a href="<?php echo e(route('public_location_list')); ?>">
            <i class="fa fa-external-link" aria-hidden="true"></i> <span>Set Email Template</span>
          </a>
        </li>
      </ul>
    </div>
  </section>
  <!-- /.sidebar -->
</aside>
