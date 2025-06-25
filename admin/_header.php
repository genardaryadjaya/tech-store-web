<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// Redirect ke halaman login jika belum login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fontAwesome.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    html, body {
        height: 100%;
    }
    body {
        min-height: 100vh;
        height: 100vh;
        background: linear-gradient(135deg, #23272b 0%, #2453a7 100%) !important;
        color: #f8f9fa;
        margin: 0 0 24px 0;
    }
    .card, .card-header, .card-body, .card-footer {
        background: rgba(34, 40, 49, 0.92) !important;
        color: #f8f9fa !important;
        border: none;
        box-shadow: 0 4px 24px rgba(36,83,167,0.10);
    }
    .navbar, .navbar-dark.bg-dark {
        background: rgba(34, 40, 49, 0.98) !important;
        border-bottom: 1.5px solid #2453a7;
        padding-top: 18px;
        padding-bottom: 6px;
    }
    .navbar-brand, .navbar .nav-link {
        color: #23d2c8 !important;
    }
    .navbar .nav-link.text-warning {
        color: #ffc107 !important;
    }
    .table, .table th, .table td {
        background: transparent !important;
        color: #f8f9fa !important;
    }
    .form-control {
        background: #23272b !important;
        color: #fff !important;
        border: 1.5px solid #2453a7;
        border-radius: 8px;
    }
    .form-control:focus {
        border-color: #23d2c8;
        box-shadow: 0 0 0 2px #23d2c880;
        background: #23272b;
        color: #fff;
    }
    .btn-primary {
        background: linear-gradient(90deg, #2453a7 60%, #23d2c8 100%) !important;
        border: none;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: 0 2px 12px #2453a7a0;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #23d2c8 0%, #2453a7 100%) !important;
    }
    .alert-danger, .alert-success {
        font-size: 1.02rem;
        border-radius: 7px;
    }
    .navbar .container {
        padding-left: 40px;
        padding-right: 40px;
        display: flex !important;
        align-items: center;
        gap: 32px;
    }
    .navbar-brand {
        margin-right: 40px !important;
        font-size: 2.3rem !important;
        font-weight: 700 !important;
        letter-spacing: 1px;
        padding-top: 8px;
        padding-bottom: 8px;
    }
    .navbar-nav {
        gap: 24px;
    }
    .navbar .nav-link {
        margin-right: 18px !important;
        font-size: 1.25rem !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php"><b>Tech_Store</b> Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="products.php"><i class="fa fa-shopping-bag"></i> Produk</a></li>
        <li class="nav-item"><a class="nav-link text-warning" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

</body>
</html> 