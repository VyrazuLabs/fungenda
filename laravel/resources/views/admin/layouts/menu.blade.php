<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ url('/images/user'.'/'.Auth::user()->where('type',2)->first()->getUserDetails()->pluck('user_image')[0]) }}" class="img-circle admin-menu-img" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->where('type',2)->pluck('first_name')[0] }} {{ Auth::user()->where('type',2)->pluck('last_name')[0] }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="{{ route('admin_dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ route('event_list') }}">
          <i class="fa fa-calendar" aria-hidden="true"></i>Events
        </a>
      </li>
      <li>
        <a href="{{ route('business_list') }}">
          <i class="fa fa-handshake-o" aria-hidden="true"></i>Business
        </a>
      </li>
      <li>
        <a href="{{ route('profile_list') }}">
          <i class="fa fa-user" aria-hidden="true"></i>Profile
        </a>
      </li>
      <li>
        <a href="{{ route('category_list') }}">
          <i class="fa fa-bars" aria-hidden="true"></i>Category
        </a>
      </li>
      <li>
        <a href="{{ route('tag_list') }}">
          <i class="fa fa-tags" aria-hidden="true"></i></i>Tags
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>