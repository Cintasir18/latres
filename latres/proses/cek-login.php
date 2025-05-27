<?php
session_start();
include "koneksi.php";

// Ambil data dari form login
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Validasi input tidak kosong
if (empty($username) || empty($password)) {
    echo "<script>
        alert('Username dan Password tidak boleh kosong!');
        window.location.href = '../pages/login.php';
    </script>";
    exit;
}

// Ambil data user berdasarkan username
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah user ditemukan
if ($user = $result->fetch_assoc()) {
    // Verifikasi password menggunakan password_verify
    if ($password === $user['password']) {
        // Password cocok, buat session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        echo "<script>
            alert('Login Berhasil');
            window.location.href = '../pages/dashboard.php';
        </script>";
    } else {
        // Password tidak cocok
        echo "<script>
            alert('Password salah!');
            window.location.href = '../pages/login.php';
        </script>";
    }
} else {
    // Username tidak ditemukan
    echo "<script>
        alert('Username tidak ditemukan!');
        window.location.href = '../pages/login.php';
    </script>";
}

// Tutup statement
$stmt->close();
?>
