<!-- resources/views/admin/layout/header.blade.php -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light text-uppercase">TheSara Cosmetics</span>
    </a>

    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.profile') }}" class="d-block text-white">
                    {{ auth()->user()->name ?? 'Admin' }}
                </a>
                <small class="text-white-50">Administrator</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MANAGEMENT</li>

                <!-- Products -->
                <li class="nav-item has-treeview {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Catalog
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Orders -->
              <li class="nav-item has-treeview {{ request()->routeIs('admin.orders.*') ? 'menu-open' : '' }}">

<a href="#" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">

<i class="nav-icon fas fa-shopping-cart"></i>

<p>
Orders
<i class="fas fa-angle-left right"></i>
</p>

</a>

<ul class="nav nav-treeview">

<li class="nav-item">
<a href="{{ route('admin.orders.index') }}" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>All Orders</p>
</a>
</li>

<li class="nav-item">
<a href="{{ route('admin.orders.pending') }}" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Pending Orders</p>
</a>
</li>

<li class="nav-item">
<a href="{{ route('admin.orders.completed') }}" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Completed Orders</p>
</a>
</li>

<li class="nav-item">
<a href="{{ route('admin.orders.cancelled') }}" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Cancelled Orders</p>
</a>
</li>

<li class="nav-item">
<a href="{{ route('admin.orders.index') }}" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Order Details</p>
</a>
</li>
<!-- 
<li class="nav-item">
<a href="{{ route('admin.orders.index') }}" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Order Timeline</p>
</a>
</li> -->

<li class="nav-item">
<a href="{{ route('admin.orders.index') }}" class="nav-link">
<i class="far fa-circle nav-icon"></i>
<p>Order Invoice</p>
</a>
</li>

</ul>

</li>
                <!-- Customers -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>

                <!-- Messages -->
                <li class="nav-item">
                    <a href="{{ route('admin.messages') }}" class="nav-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>Messages</p>
                        @if(!empty($directMessagesCount) && $directMessagesCount > 0)
                            <span class="badge badge-warning right">{{ $directMessagesCount }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-header">ACCOUNT</li>

                <!-- Profile -->
                <li class="nav-item">
                    <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profile Settings</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" 
                       class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
    @csrf
</form>