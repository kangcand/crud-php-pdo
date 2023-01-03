<?php
// menghapus session dan cookie yang sudah dibuat
session_start();
if (isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    session_destroy();
    unset($_COOKIE['user_id']);
    setcookie('user_id', null, -1, '/');
    echo "<script type='text/javascript'>
alert('Logout Berhasil');window.location='/crud-pdo-3/login.php'
</script>";
}
