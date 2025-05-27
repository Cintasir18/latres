<?php
include "koneksi.php"; // koneksi dengan database

// menangkap inputan dari form register 
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if (empty($username) || empty($password)) {
    echo "<script>
        alert('Username dan Password tidak boleh kosong!');
        window.location.href = '../pages/register.php';
    </script>";
    exit;
}

$query = "SELECT id FROM users WHERE username = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>
        alert('Username sudah ada');
        window.location.href = '../pages/register.php';
    </script>";
} else {
    $insert_query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt_insert = $connect->prepare($insert_query);
    $stmt_insert->bind_param("ss", $username, $password);

    if ($stmt_insert->execute()) {
        echo "<script>
            alert('Register Berhasil');
            window.location.href = '../pages/dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal melakukan register!');
            window.location.href = '../pages/register.php';
        </script>";
    }
}

$stmt->close();
$stmt_insert->close();
$connect->close();
?>
