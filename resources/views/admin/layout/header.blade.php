<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>

        <!-- Logout (POST) -->
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="nav-link"
               onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
                Logout
            </a>
        </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
<a class="nav-link" data-toggle="dropdown" href="#">
<i class="far fa-comments"></i>

<span class="badge badge-danger navbar-badge">
{{ $messageCount }}
</span>

</a>

<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

@foreach($messages as $msg)

<a href="#" class="dropdown-item">

<div class="media">

<img src="{{url('admin/img/user1-128x128.jpg')}}"
class="img-size-50 mr-3 img-circle">

<div class="media-body">

<h3 class="dropdown-item-title">
{{ $msg->name }}
</h3>

<p class="text-sm">
{{ Str::limit($msg->message,40) }}
</p>

<p class="text-sm text-muted">
<i class="far fa-clock mr-1"></i>
{{ $msg->created_at->diffForHumans() }}
</p>

</div>
</div>

</a>

<div class="dropdown-divider"></div>

@endforeach

<a href="{{ route('admin.messages') }}" class="dropdown-item dropdown-footer">
See All Messages
</a>

</div>
</li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">

<a class="nav-link" data-toggle="dropdown" href="#">

<i class="far fa-bell"></i>

<span class="badge badge-warning navbar-badge">
{{ $notificationCount }}
</span>

</a>

<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

<span class="dropdown-item dropdown-header">
{{ $notificationCount }} Notifications
</span>

<div class="dropdown-divider"></div>

@foreach($notifications as $noti)

<a href="#" class="dropdown-item">

<i class="fas fa-info-circle mr-2"></i>

{{ $noti->title }}

<span class="float-right text-muted text-sm">
{{ $noti->created_at->diffForHumans() }}
</span>

</a>

<div class="dropdown-divider"></div>

@endforeach

<a href="{{ route('admin.notifications') }}"
class="dropdown-item dropdown-footer">

See All Notifications

</a>

</div>
</li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
