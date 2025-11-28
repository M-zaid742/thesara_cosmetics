<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thesara Cosmetics | Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    :root {
      --gold: #D4AF37;
      --beige: #F5F0E6;
      --brown: #8B6F47;
      --dark-brown: #5D4037;
      --light-beige: #FAF7F2;
      --text: #333;
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: var(--light-beige);
      color: var(--text);
    }
    .header {
      background: white;
      padding: 1rem 2rem;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .logo {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      color: var(--dark-brown);
      font-weight: 700;
    }
    .logo span { color: var(--gold); }
    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 500;
    }
    .avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: var(--gold);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: bold;
    }
    .container {
      display: flex;
      min-height: calc(100vh - 80px);
    }
    /* Sidebar */
    .sidebar {
      width: 280px;
      background: white;
      padding: 2rem 1.5rem;
      box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }
    .nav-item {
      padding: 14px 20px;
      margin: 8px 0;
      border-radius: 12px;
      display: flex;
      align-items: center;
      gap: 15px;
      color: var(--text);
      font-weight: 500;
      transition: all 0.3s;
      cursor: pointer;
    }
    .nav-item:hover, .nav-item.active {
      background: var(--beige);
      color: var(--dark-brown);
    }
    .nav-item i { font-size: 1.2rem; width: 24px; }
    .nav-item.active i { color: var(--gold); }

    /* Main Content */
    .main {
      flex: 1;
      padding: 2rem;
    }
    .page-title {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      color: var(--dark-brown);
      margin-bottom: 2rem;
    }
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.5rem;
      margin-bottom: 3rem;
    }
    .stat-card {
      background: white;
      padding: 1.8rem;
      border-radius: 16px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .stat-value {
      font-size: 2.4rem;
      font-weight: 600;
      color: var(--dark-brown);
      margin: 0.5rem 0;
    }
    .stat-label {
      color: #777;
      font-size: 0.95rem;
    }
    .stat-icon {
      width: 60px;
      height: 60px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      color: white;
      float: right;
    }
    .orders { background: #E8DAB2; }
    .revenue { background: var(--gold); }
    .products { background: #C38E70; }
    .users { background: #8B6F47; }

    /* Recent Orders Table */
    .table-container {
      background: white;
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th {
      text-align: left;
      padding: 1rem 0;
      color: #555;
      font-weight: 600;
      border-bottom: 2px solid #eee;
    }
    td {
      padding: 1rem 0;
      border-bottom: 1px solid #f0f0f0;
    }
    .status {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
    }
    .status.completed { background: #e6f4ea; color: #2e7d32; }
    .status.pending { background: #fff8e1; color: #ff8f00; }
    .status.cancelled { background: #ffebee; color: #c62828; }

    @media (max-width: 992px) {
      .container { flex-direction: column; }
      .sidebar { width: 100%; padding: 1rem; }
      .nav-item { justify-content: center; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="logo">THESARA <span>COSMETICS</span></div>
    <div class="user-info">
      <span>Welcome, Admin</span>
      <div class="avatar">A</div>
    </div>
  </header>

  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <nav>
        <div class="nav-item active">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </div>
        <div class="nav-item">
          <i class="fas fa-box-open"></i> Products
        </div>
        <div class="nav-item">
          <i class="fas fa-shopping-cart"></i> Orders
        </div>
        <div class="nav-item">
          <i class="fas fa-users"></i> Customers
        </div>
        <div class="nav-item">
          <i class="fas fa-chart-bar"></i> Analytics
        </div>
        <div class="nav-item">
          <i class="fas fa-percentage"></i> Discounts & Offers
        </div>
        <div class="nav-item">
          <i class="fas fa-cog"></i> Settings
        </div>
        <div class="nav-item" style="margin-top: 3rem; color: #999;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <h1 class="page-title">Dashboard Overview</h1>

      <!-- Stats Cards -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon orders"><i class="fas fa-shopping-bag"></i></div>
          <div class="stat-value">1,428</div>
          <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon revenue"><i class="fas fa-pound-sign"></i></div>
          <div class="stat-value">£48,573</div>
          <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon products"><i class="fas fa-box"></i></div>
          <div class="stat-value">89</div>
          <div class="stat-label">Products in Stock</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon users"><i class="fas fa-user-friends"></i></div>
          <div class="stat-value">3,291</div>
          <div class="stat-label">Active Customers</div>
        </div>
      </div>

      <!-- Recent Orders -->
      <div class="table-container">
        <h2 style="margin-bottom: 1.5rem; color: var(--dark-brown);">Recent Orders</h2>
        <table>
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Product</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#TH9841</td>
              <td>Sophie Miller</td>
              <td>Hydraguard SPF 50 + Vitamin C Serum</td>
              <td>£89.00</td>
              <td><span class="status completed">Completed</span></td>
              <td>28 Nov 2025</td>
            </tr>
            <tr>
              <td>#TH9839</td>
              <td>James Carter</td>
              <td>Moisture Repair Cream</td>
              <td>£62.00</td>
              <td><span class="status pending">Pending</span></td>
              <td>27 Nov 2025</td>
            </tr>
            <tr>
              <td>#TH9835</td>
              <td>Emma Wilson</td>
              <td>Niacinamide 10% + Zinc Serum</td>
              <td>£48.00</td>
              <td><span class="status completed">Completed</span></td>
              <td>27 Nov 2025</td>
            </tr>
            <tr>
              <td>#TH9832</td>
              <td>Olivia Brown</td>
              <td>Lip Serum + Sun Block SPF60</td>
              <td>£75.00</td>
              <td><span class="status cancelled">Cancelled</span></td>
              <td>26 Nov 2025</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>