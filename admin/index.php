<?php
// Halaman login admin sederhana
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit();
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    // Username dan password default (bisa diganti dengan database nanti)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    html {
        height: 100%;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }
    body {
        min-height: 100vh;
        height: 100vh;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #23272b 0%, #2453a7 100%);
        width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-box {
        width: 340px;
        height: 340px;
        max-width: 90vw;
        max-height: 90vh;
        margin: 0;
        padding: 24px 24px 18px 24px;
        background: rgba(34, 40, 49, 0.82);
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(36,83,167,0.18);
        backdrop-filter: blur(7px);
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(40px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .login-box .icon-lock {
        font-size: 3.2rem;
        background: linear-gradient(135deg, #2453a7 60%, #23d2c8 100%);
        color: #fff;
        border-radius: 50%;
        padding: 18px 22px;
        margin-bottom: 8px;
        box-shadow: 0 2px 12px #2453a7a0;
        display: inline-block;
    }
    .login-box h2 {
        font-size: 2.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
    }
    .form-label {
        font-size: 1.08rem;
        font-weight: 500;
        color: #e0e0e0;
    }
    .form-control {
        background: #23272b;
        color: #fff;
        border: 1.5px solid #2453a7;
        border-radius: 8px;
        font-size: 1.08rem;
    }
    .form-control:focus {
        border-color: #23d2c8;
        box-shadow: 0 0 0 2px #23d2c880;
        background: #23272b;
        color: #fff;
    }
    .btn-primary {
        background: linear-gradient(90deg, #2453a7 60%, #23d2c8 100%);
        border: none;
        font-size: 1.18rem;
        font-weight: 600;
        border-radius: 8px;
        padding: 12px 0;
        transition: background 0.2s;
        box-shadow: 0 2px 12px #2453a7a0;
        margin-top: 0.4rem;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #23d2c8 0%, #2453a7 100%);
    }
    .alert-danger {
        font-size: 1.02rem;
        border-radius: 7px;
    }
    .form-group {
        margin-bottom: 0.6rem !important;
    }
    </style>
</head>
<body>
<div class="login-box text-center">
  <span class="icon-lock"><i class="fas fa-lock"></i></span>
  <h2 class="mb-3">Login Admin</h2>
  <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
  <form method="post">
    <div class="form-group mb-3 text-start">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control form-control-lg" required autofocus>
    </div>
    <div class="form-group mb-4 text-start">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control form-control-lg" required>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block w-100">Login</button>
  </form>
</div>
</body>
</html> 