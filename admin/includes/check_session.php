<?php
error_reporting(0);
if (session_status() === PHP_SESSION_NONE) session_start();

if (!empty($_SESSION['2fa_pending']) && empty($_SESSION['userid'])) {
    header('Location: otp_verify.php'); exit;
}
if (!empty($_SESSION['2fa_setup']) && empty($_SESSION['userid'])) {
    header('Location: totp_setup.php'); exit;
}
if (empty($_SESSION['userid'])) {
    header('Location: login.php'); exit;
}
?>
