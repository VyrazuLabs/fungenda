<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
       @if(!empty(Auth::user()->where('type',2)->first()->getUserDetails()->pluck('user_image')[0]))
        <img src="{{ url('/images/user'.'/'.Auth::user()->where('type',2)->first()->getUserDetails()->pluck('user_image')[0]) }}" class="img-circle admin-menu-img" alt="User Image">
      @else
        <img src="{{ url('/images/user/account_icon.png') }}" class="user-image " alt="User Image">
      @endif
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->where('type',2)->pluck('first_name')[0] }} {{ Auth::user()->where('type',2)->pluck('last_name')[0] }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    @php
     $url = $_SERVER['REQUEST_URI'];
    @endphp
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ strpos($url, 'dashboard') > 0?'active':'' }}">
        <a href="{{ route('admin_dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ strpos($url, 'event') > 0?'active':'' }}">
        <a href="{{ route('event_list') }}">
          <i class="fa fa-calendar" aria-hidden="true"></i> <span>Events</span>
        </a>
      </li>
      <li class="{{ strpos($url, 'business') > 0?'active':'' }}">
        <a href="{{ route('business_list') }}">
          <i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Business</span>
        </a>
      </li>
      <li class="{{ strpos($url, 'profile') > 0?'active':'' }}">
        <a href="{{ route('profile_list') }}">
          <i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span>
        </a>
      </li>
      <li class="{{ strpos($url, 'category') > 0?'active':'' }}">
        <a href="{{ route('category_list') }}">
          <i class="fa fa-bars" aria-hidden="true"></i> <span>Category</span>
        </a>
      </li>
      <li class="{{ strpos($url, 'tags') > 0?'active':'' }}">
        <a href="{{ route('tag_list') }}">
          <i class="fa fa-tags" aria-hidden="true"></i> <span>Tags</span>
        </a>
      </li>
      <li class="{{ strpos($url, 'links') > 0?'active':'' }}">
        <a href="{{ route('link_list') }}">
          <i class="fa fa-external-link" aria-hidden="true"></i> <span>Links</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

