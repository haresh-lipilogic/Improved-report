<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
date_default_timezone_set("Asia/Calcutta");

require_once 'includes/config.php';
/** @var mysqli $con */
require_once 'includes/totp_helper.php';

$error = '';

if (!empty($_SESSION['userid'])) {
    header('Location: dashboard.php'); exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
    session_start();
}

if (isset($_POST['submit'])) {
    $username    = trim($_POST['username'] ?? '');
    $password    = trim($_POST['password'] ?? '');
    $userid      = null;
    $admin       = null;
    $totp_secret = null;

    $stmt = $con->prepare(
        'SELECT userid, admin, totp_secret FROM login WHERE username=? AND password=?'
    );
    if ($stmt === false) {
        $error = 'Database error. Please contact administrator.';
    } else {
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->bind_result($userid, $admin, $totp_secret);
        $stmt->fetch();
        $stmt->close();

        if (!empty($userid)) {
            $_SESSION['2fa_userid']   = $userid;
            $_SESSION['2fa_admin']    = $admin;
            $_SESSION['2fa_username'] = $username;

            if (empty($totp_secret)) {
                $_SESSION['2fa_setup'] = true;
                header('Location: totp_setup.php'); exit;
            } else {
                $_SESSION['2fa_pending'] = true;
                $_SESSION['2fa_secret']  = $totp_secret;
                header('Location: otp_verify.php'); exit;
            }
        } else {
            $error = 'Username or password is incorrect.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SVMobi Reports — Login</title>
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
                   Oxygen, Ubuntu, Cantarell, sans-serif;
    }

    /* ── Full page background ── */
    body {
      min-height: 100vh;
      background: linear-gradient(135deg, #F0F4FF 0%, #FAFCFF 55%, #FFF5F0 100%);
      background-attachment: fixed;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 32px 16px;
    }

    /* ── Card ── */
    .card {
      width: 100%;
      max-width: 420px;
      background: #ffffff;
      border-radius: 20px;
      border: 1px solid rgba(234, 88, 12, 0.10);
      box-shadow:
        0 1px 4px rgba(0, 0, 0, 0.04),
        0 10px 30px rgba(0, 0, 0, 0.07),
        0 30px 60px rgba(0, 0, 0, 0.05);
      padding: 48px 44px 40px;
      animation: fade-up 0.42s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes fade-up {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Logo + brand ── */
    .card-logo-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 28px;
    }

    .card-logo {
      width: 110px;
      height: auto;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .card-brand-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: #EA580C;
    }

    /* ── Heading ── */
    .card-title {
      font-size: 25px;
      font-weight: 800;
      color: #111827;
      letter-spacing: -0.4px;
      margin-bottom: 6px;
    }

    .card-sub {
      font-size: 14px;
      color: #6B7280;
      margin-bottom: 30px;
      line-height: 1.5;
    }

    /* ── Error ── */
    .err {
      display: flex;
      align-items: center;
      gap: 8px;
      background: #FFF7ED;
      border: 1px solid #FED7AA;
      border-left: 3px solid #EA580C;
      border-radius: 8px;
      color: #9A3412;
      font-size: 13px;
      font-weight: 500;
      padding: 11px 14px;
      margin-bottom: 22px;
      animation: shake 0.3s ease;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25%       { transform: translateX(-5px); }
      75%       { transform: translateX(5px); }
    }

    /* ── Fields ── */
    .field {
      margin-bottom: 18px;
    }

    .field label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 7px;
    }

    .pw-wrap { position: relative; }

    .field input {
      width: 100%;
      background: #F9FAFB;
      border: 1.5px solid #E5E7EB;
      border-radius: 10px;
      padding: 12px 40px 12px 14px;
      font-family: inherit;
      font-size: 14.5px;
      color: #111827;
      outline: none;
      transition: border-color 0.16s, box-shadow 0.16s, background 0.16s;
    }

    .field input::placeholder { color: #C4C9D4; }

    .field input:focus {
      border-color: #EA580C;
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.10);
    }

    .pw-eye {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #9CA3AF;
      font-size: 14px;
      cursor: pointer;
      padding: 4px;
      line-height: 1;
      transition: color 0.15s;
    }
    .pw-eye:hover { color: #EA580C; }

    /* ── Submit button ── */
    .btn {
      width: 100%;
      margin-top: 6px;
      padding: 14px;
      background: linear-gradient(135deg, #EA580C 0%, #C2410C 100%);
      border: none;
      border-radius: 10px;
      color: #ffffff;
      font-family: inherit;
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 0.1px;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(234, 88, 12, 0.30);
      transition: box-shadow 0.18s, transform 0.12s, opacity 0.15s;
    }

    .btn:hover {
      box-shadow: 0 6px 22px rgba(234, 88, 12, 0.42);
      transform: translateY(-1px);
    }

    .btn:active {
      transform: scale(0.98);
      opacity: 0.95;
    }

    /* ── Footer note ── */
    .note {
      margin-top: 24px;
      text-align: center;
      font-size: 12px;
      color: #9CA3AF;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
    }

    /* ── Mobile ── */
    @media (max-width: 480px) {
      .card { padding: 36px 24px 28px; border-radius: 16px; }
      .card-title { font-size: 22px; }
    }

    @media (prefers-reduced-motion: reduce) {
      .card { animation: none; }
    }
  </style>
</head>
<body>

  <div class="card">

    <!-- Logo + brand -->
    <div class="card-logo-wrap">
      <img src="images/logo.png" alt="SVMobi" class="card-logo"
           onerror="this.style.display='none'">
      <span class="card-brand-label">SVMobi Reports</span>
    </div>

    <!-- Heading -->
    <h1 class="card-title">Welcome back</h1>
    <p class="card-sub">Sign in to continue to your account.</p>

    <!-- Error -->
    <?php if ($error): ?>
    <div class="err">
      <i class="fa fa-exclamation-circle"></i>
      <?php echo htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="post" autocomplete="off" novalidate>

      <div class="field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"
               placeholder="Enter your username" required autofocus
               value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
      </div>

      <div class="field">
        <label for="password">Password</label>
        <div class="pw-wrap">
          <input type="password" id="password" name="password"
                 placeholder="Enter your password" required>
          <button type="button" class="pw-eye" onclick="togglePw(this)" aria-label="Toggle password">
            <i class="fa fa-eye"></i>
          </button>
        </div>
      </div>

      <button type="submit" name="submit" class="btn">Sign In</button>

    </form>

    <!-- Footer -->
    <div class="note">
      <i class="fa fa-shield"></i>
      Secured with Two-Factor Authentication (2FA)
    </div>

  </div>

<script>
function togglePw(btn) {
  var inp  = btn.closest('.pw-wrap').querySelector('input');
  var icon = btn.querySelector('i');
  if (inp.type === 'password') {
    inp.type = 'text';
    icon.className = 'fa fa-eye-slash';
  } else {
    inp.type = 'password';
    icon.className = 'fa fa-eye';
  }
}
</script>
</body>
</html>
