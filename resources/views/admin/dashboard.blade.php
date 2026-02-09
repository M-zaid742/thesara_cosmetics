@php use Illuminate\Support\Str; @endphp
@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Orders</span>
                            <span class="info-box-number">{{ $totalOrders }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Sales</span>
                            <span class="info-box-number">{{ $totalSales }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Revenue</span>
                            <span class="info-box-number">{{ $totalRevenue }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Users</span>
                            <span class="info-box-number">{{ $totalUsers }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Monthly Recap Report</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item">Something else here</a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center">
                                       <strong>
Sales: {{ now()->subMonths(11)->format('M Y') }} - {{ now()->format('M Y') }}
</strong>

                                    </p>

                                    <div class="chart">
                                        <!-- Sales Chart Canvas -->
                                        <canvas id="salesChart" height="180"></canvas>

                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($monthlySales->keys()),
            datasets: [{
                label: 'Monthly Revenue',
                data: @json($monthlySales->values()),
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23,162,184,0.15)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>

                                    </div>
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>Goal Completion</strong>
                                    </p>

                                    <!-- 🔥 UPDATED BLOCKS START HERE -->
                                    <div class="progress-group">
                                        Add Products to Cart
                                        <span class="float-right">
                                            <b>{{ $cartCount }}</b>/{{ $totalOrders }}
                                        </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary"
                                                 style="width: {{ $cartPercent }}%">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        Complete Purchase
                                        <span class="float-right">
                                            <b>{{ $completedCount }}</b>/{{ $totalOrders }}
                                        </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger"
                                                 style="width: {{ $completedPercent }}%">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        <span class="progress-text">Pending Orders</span>
                                        <span class="float-right">
                                            <b>{{ $pendingCount }}</b>/{{ $totalOrders }}
                                        </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success"
                                                 style="width: {{ $pendingPercent }}%">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        Total Orders
                                        <span class="float-right">
                                            <b>{{ $totalOrders }}</b>
                                        </span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning"
                                                 style="width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 🔥 UPDATED BLOCKS END HERE -->

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                      <span class="description-percentage 
    {{ $growthPercentage >= 0 ? 'text-success' : 'text-danger' }}">
    <i class="fas 
        {{ $growthPercentage >= 0 ? 'fa-caret-up' : 'fa-caret-down' }}">
    </i>
    {{ number_format(abs($growthPercentage), 1) }}%
</span>

                                        <h5 class="description-header">
    ${{ number_format($currentMonthRevenue, 2) }}
</h5>

                                        <span class="description-text">TOTAL REVENUE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                       <span class="description-percentage text-muted">
    Monthly Cost
</span>


                                        <h5 class="description-header">
    ${{ number_format($totalCost, 2) }}
</h5>

                                        <span class="description-text">TOTAL COST</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-muted">
    Net Profit
</span>


                                        <h5 class="description-header">
    ${{ number_format($totalProfit, 2) }}
</h5>

                                        <span class="description-text">TOTAL PROFIT</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block">
                                       <span class="description-percentage text-muted">
    Completed Goals
</span>


                                        <h5 class="description-header">
    ${{ number_format($GoalCompletions, 2) }}
</h5>
                                        <span class="description-text">GOAL COMPLETIONS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- MAP & BOX PANE -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">US-Visitors Report</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="d-md-flex">
                                <div class="p-1 flex-fill" style="overflow: hidden">
                                    <div id="world-map-markers" style="height: 325px;"></div>
                                </div>

                                <div class="card-pane-right bg-success pt-2 pb-2 pl-4 pr-4">

                                    <!-- Visits -->
                                    <div class="description-block mb-4">
                                        <canvas id="visitsSpark" height="40"></canvas>
                                        <h5 class="description-header">{{ $visitsCount }}</h5>
                                        <span class="description-text">Visits</span>
                                    </div>

                                    <!-- Referrals -->
                                    <div class="description-block mb-4">
                                        <h5 class="description-header">{{ $referralPercent }}%</h5>
                                        <span class="description-text">Referrals</span>
                                    </div>

                                    <!-- Organic -->
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $organicPercent }}%</h5>
                                        <span class="description-text">Organic</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- ✅ SCRIPTS ADDED HERE (right after the map card) -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/jvectormap-next"></script>
                    <script src="https://cdn.jsdelivr.net/npm/jvectormap-content/world-mill.js"></script>

                    <script>
                    document.addEventListener("DOMContentLoaded", function () {

                        // World Map
                        new jvm.Map({
                            container: document.getElementById('world-map-markers'),
                            map: 'world_mill',
                            backgroundColor: 'transparent',
                            regionStyle: {
                                initial: {
                                    fill: '#d4edda'
                                }
                            }
                        });

                        // Sparkline Chart (Last 7 Days)
                        new Chart(document.getElementById('visitsSpark'), {
                            type: 'line',
                            data: {
                                labels: ["","","","","","",""],
                                datasets: [{
                                    data: @json($last7Days),
                                    borderColor: "#ffffff",
                                    backgroundColor: "rgba(255,255,255,0.3)",
                                    fill: true,
                                    tension: 0.4,
                                    borderWidth: 2,
                                    pointRadius: 0
                                }]
                            },
                            options: {
                                plugins: { legend: { display: false }},
                                scales: {
                                    x: { display: false },
                                    y: { display: false }
                                }
                            }
                        });

                    });
                    </script>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- DIRECT CHAT -->
                            <div class="card direct-chat direct-chat-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Direct Chat</h3>

                                    <div class="card-tools">
                                        <span data-toggle="tooltip" title="3 New Messages" class="badge badge-warning">3</span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                                data-widget="chat-pane-toggle">
                                            <i class="fas fa-comments"></i></button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                        @foreach($latestMessages as $msg)
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">{{ $msg->name }}</span>
                                                <span class="direct-chat-timestamp float-right">
                                                    {{ $msg->created_at->diffForHumans() }}
                                                </span>
                                            </div>

                                            <img class="direct-chat-img"
                                                 src="{{ asset('admin/img/user.png') }}">

                                            <div class="direct-chat-text">
                                                {{ $msg->message }}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!--/.direct-chat-messages-->

                                    <!-- Contacts are loaded here -->
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="{{url('admin/img/user1-128x128.jpg')}}">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Count Dracula
                                                            <small class="contacts-list-date float-right">2/28/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="{{url('admin/img/user7-128x128.jpg')}}">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Sarah Doe
                                                            <small class="contacts-list-date float-right">2/23/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">I will be waiting for...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="{{url('admin/img/user3-128x128.jpg')}}">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Nadia Jolie
                                                            <small class="contacts-list-date float-right">2/20/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">I'll call you back at...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="{{url('admin/img/user5-128x128.jpg')}}">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Nora S. Vans
                                                            <small class="contacts-list-date float-right">2/10/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">Where is your new...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="{{url('admin/img/user6-128x128.jpg')}}">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            John K.
                                                            <small class="contacts-list-date float-right">1/27/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">Can I take a look at...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                            <li>
                                                <a href="#">
                                                    <img class="contacts-list-img" src="{{url('admin/img/user8-128x128.jpg')}}">

                                                    <div class="contacts-list-info">
                                                        <span class="contacts-list-name">
                                                            Kenneth M.
                                                            <small class="contacts-list-date float-right">1/4/2015</small>
                                                        </span>
                                                        <span class="contacts-list-msg">Never mind I found...</span>
                                                    </div>
                                                    <!-- /.contacts-list-info -->
                                                </a>
                                            </li>
                                            <!-- End Contact Item -->
                                        </ul>
                                        <!-- /.contacts-list -->
                                    </div>
                                    <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-warning">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!--/.direct-chat -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Latest Members</h3>
                                    <div class="card-tools">
                                        <span class="badge badge-danger">
                                            {{ $latestUsers->count() }} New Members
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <ul class="users-list clearfix">
                                        @foreach($latestUsers as $user)
                                        <li>
                                            <img src="{{ asset('admin/img/user.png') }}" alt="User Image">
                                            <a class="users-list-name">{{ $user->name }}</a>
                                            <span class="users-list-date">
                                                {{ $user->created_at->format('d M') }}
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Orders</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Items</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($latestOrders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->items->count() ?? 1 }} Items</td>
                                            <td>
                                                <span class="badge 
                                                    @if($order->status=='completed') badge-success
                                                    @elseif($order->status=='pending') badge-warning
                                                    @else badge-info
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>${{ $order->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <a href="#" class="btn btn-sm btn-info float-left">Place New Order</a>
                            <a href="#" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <!-- Info Boxes Style 2 - DYNAMIC VERSION -->
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Inventory</span>
                            <span class="info-box-number">{{ number_format($inventoryCount) }}</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="far fa-heart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mentions</span>
                            <span class="info-box-number">{{ number_format($mentionsCount) }}</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Downloads</span>
                            <span class="info-box-number">{{ number_format($downloadsCount) }}</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="far fa-comment"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Direct Messages</span>
                            <span class="info-box-number">{{ number_format($directMessagesCount) }}</span>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Browser Usage</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-responsive">
                                        <canvas id="pieChart" height="150"></canvas>
                                    </div>
                                    <!-- ./chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <ul class="chart-legend clearfix">
                                        <li><i class="far fa-circle text-danger"></i> Chrome</li>
                                        <li><i class="far fa-circle text-success"></i> IE</li>
                                        <li><i class="far fa-circle text-warning"></i> FireFox</li>
                                        <li><i class="far fa-circle text-info"></i> Safari</li>
                                        <li><i class="far fa-circle text-primary"></i> Opera</li>
                                        <li><i class="far fa-circle text-secondary"></i> Navigator</li>
                                    </ul>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-white p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        United States of America
                                        <span class="float-right text-danger">
                                            <i class="fas fa-arrow-down text-sm"></i>
                                            12%</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        India
                                        <span class="float-right text-success">
                                            <i class="fas fa-arrow-up text-sm"></i> 4%
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        China
                                        <span class="float-right text-warning">
                                            <i class="fas fa-arrow-left text-sm"></i> 0%
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /.card -->

                    <!-- PRODUCT LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recently Added Products</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($latestProducts as $product)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{ asset('storage/'.$product->image) }}"
                                             class="img-size-50">
                                    </div>

                                    <div class="product-info">
                                        <a class="product-title">
                                            {{ $product->name }}
                                            <span class="badge badge-info float-right">
                                                ${{ $product->price }}
                                            </span>
                                        </a>

                                        <span class="product-description">
                                            {{ Str::limit($product->description, 50) }}
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="javascript:void(0)" class="uppercase">View All Products</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection