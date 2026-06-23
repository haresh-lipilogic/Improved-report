<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
error_reporting(0);

require_once 'includes/totp_helper.php';

if (isset($_GET['cancel'])) {
    session_unset();
    session_destroy();
    header('Location: login.php'); exit;
}

if (empty($_SESSION['2fa_pending'])) {
    header('Location: login.php'); exit;
}

$error = '';

if (isset($_POST['otp'])) {
    $entered = preg_replace('/\D/', '', trim($_POST['otp'] ?? ''));
    if (strlen($entered) !== 6) {
        $error = 'Please enter the complete 6-digit code from your authenticator app.';
    } elseif (totp_verify($_SESSION['2fa_secret'], $entered)) {
        $_SESSION['userid']   = $_SESSION['2fa_userid'];
        $_SESSION['admin']    = $_SESSION['2fa_admin'];
        $_SESSION['username'] = $_SESSION['2fa_username'];
        unset($_SESSION['2fa_pending'], $_SESSION['2fa_secret'],
              $_SESSION['2fa_userid'], $_SESSION['2fa_admin'], $_SESSION['2fa_username']);
        header('Location: dashboard.php'); exit;
    } else {
        $error = 'Invalid code. Please wait for the next code and try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SVMobi — 2FA Verification</title>
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
                   Oxygen, Ubuntu, Cantarell, sans-serif;
    }

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
        0 1px 4px rgba(0,0,0,0.04),
        0 10px 30px rgba(0,0,0,0.07),
        0 30px 60px rgba(0,0,0,0.05);
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
      width: 90px;
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

    /* ── Shield icon circle ── */
    .shield-wrap {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: #FFF7ED;
      border: 2px solid #FED7AA;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 22px;
      color: #EA580C;
    }

    /* ── Heading ── */
    .card-title {
      font-size: 22px;
      font-weight: 800;
      color: #111827;
      letter-spacing: -0.4px;
      text-align: center;
      margin-bottom: 8px;
    }

    .card-sub {
      font-size: 13.5px;
      color: #6B7280;
      text-align: center;
      margin-bottom: 30px;
      line-height: 1.55;
    }

    .card-sub strong { color: #111827; font-weight: 700; }

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

    /* ── OTP boxes ── */
    .otp-row {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    .otp-box {
      width: 48px;
      height: 56px;
      border: 2px solid #E5E7EB;
      border-radius: 12px;
      background: #F9FAFB;
      font-size: 22px;
      font-weight: 700;
      color: #111827;
      text-align: center;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
      caret-color: #EA580C;
    }

    .otp-box:focus {
      border-color: #EA580C;
      background: #ffffff;
      box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.12);
    }

    .otp-box.filled {
      border-color: #FB923C;
      background: #FFF7ED;
    }

    /* hidden real input */
    #otp-real { display: none; }

    /* timer */
    .timer-hint {
      text-align: center;
      font-size: 12px;
      color: #9CA3AF;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
    }

    .timer-num {
      font-weight: 700;
      color: #EA580C;
      min-width: 18px;
      display: inline-block;
    }

    /* ── Verify button ── */
    .btn {
      width: 100%;
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

    .btn:active { transform: scale(0.98); opacity: 0.95; }

    /* ── Back link ── */
    .back-link {
      display: block;
      text-align: center;
      margin-top: 22px;
      font-size: 13px;
      color: #9CA3AF;
      text-decoration: none;
      transition: color 0.15s;
    }

    .back-link:hover { color: #EA580C; text-decoration: none; }

    .back-link i { margin-right: 4px; }

    @media (max-width: 480px) {
      .card { padding: 36px 20px 28px; }
      .otp-box { width: 42px; height: 50px; font-size: 20px; }
      .card-title { font-size: 20px; }
    }

    @media (prefers-reduced-motion: reduce) {
      .card { animation: none; }
    }
  </style>
</head>
<body>

  <div class="card">

    <!-- Logo -->
    <div class="card-logo-wrap">
      <img src="images/logo.png" alt="SVMobi" class="card-logo"
           onerror="this.style.display='none'">
      <span class="card-brand-label">SVMobi Reports</span>
    </div>

    <!-- Shield icon -->
    <div class="shield-wrap">
      <i class="fa fa-shield"></i>
    </div>

    <!-- Heading -->
    <h1 class="card-title">2FA Verification</h1>
    <p class="card-sub">
      Open <strong>Google Authenticator</strong> or <strong>Authy</strong><br>
      and enter the 6-digit code for SVMobi.
    </p>

    <!-- Error -->
    <?php if ($error): ?>
    <div class="err">
      <i class="fa fa-exclamation-circle"></i>
      <?php echo htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>

    <!-- Form -->
    <form method="post" autocomplete="off" id="otpForm">
      <input type="hidden" name="otp" id="otp-real">

      <!-- 6 digit boxes -->
      <div class="otp-row" id="otpRow">
        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="one-time-code">
        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]">
        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]">
        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]">
        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]">
        <input class="otp-box" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]">
      </div>

      <!-- Timer -->
      <div class="timer-hint">
        <i class="fa fa-refresh"></i>
        Code refreshes in <span class="timer-num" id="timerNum">30</span>s
      </div>

      <button type="submit" class="btn" id="verifyBtn">
        <i class="fa fa-check-circle"></i>&nbsp; Verify
      </button>
    </form>

    <a href="otp_verify.php?cancel=1" class="back-link">
      <i class="fa fa-arrow-left"></i> Back to Login
    </a>

  </div>

<script>
(function () {
  var boxes = document.querySelectorAll('.otp-box');
  var real  = document.getElementById('otp-real');
  var form  = document.getElementById('otpForm');

  function sync() {
    var val = '';
    boxes.forEach(function (b) { val += b.value; });
    real.value = val;
    boxes.forEach(function (b) {
      b.classList.toggle('filled', b.value !== '');
    });
  }

  boxes.forEach(function (box, i) {
    box.addEventListener('input', function (e) {
      var v = box.value.replace(/\D/g, '');
      box.value = v ? v[v.length - 1] : '';
      sync();
      if (box.value && i < boxes.length - 1) boxes[i + 1].focus();
    });

    box.addEventListener('keydown', function (e) {
      if (e.key === 'Backspace') {
        if (!box.value && i > 0) {
          boxes[i - 1].value = '';
          boxes[i - 1].focus();
          sync();
        }
      } else if (e.key === 'ArrowLeft' && i > 0) {
        boxes[i - 1].focus();
      } else if (e.key === 'ArrowRight' && i < boxes.length - 1) {
        boxes[i + 1].focus();
      }
    });

    /* paste support */
    box.addEventListener('paste', function (e) {
      e.preventDefault();
      var pasted = (e.clipboardData || window.clipboardData)
                    .getData('text').replace(/\D/g, '').slice(0, 6);
      pasted.split('').forEach(function (ch, j) {
        if (boxes[j]) boxes[j].value = ch;
      });
      sync();
      var next = Math.min(pasted.length, boxes.length - 1);
      boxes[next].focus();
    });
  });

  /* auto-submit when all 6 filled */
  form.addEventListener('input', function () {
    if (real.value.length === 6) form.submit();
  });

  /* focus first empty box on load */
  boxes[0].focus();

  /* 30-second countdown timer (visual only) */
  var timerEl = document.getElementById('timerNum');
  function startTimer() {
    var sec = 30 - (Math.floor(Date.now() / 1000) % 30);
    timerEl.textContent = sec;
    setTimeout(startTimer, 1000);
  }
  startTimer();
})();
</script>
</body>
</html>
