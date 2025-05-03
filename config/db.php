<?php
// Konfigurasi database
$host = 'localhost'; // Ganti dengan host database kamu
$dbname = 'display_rooms'; // Nama database yang sudah dibuat
$username = 'root'; // Nama pengguna MySQL kamu
$password = ''; // Password MySQL kamu (kosongkan jika tidak ada)

try {
    // Membuat koneksi menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set mode error untuk PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Jika koneksi gagal
    echo 'Koneksi gagal: ' . $e->getMessage();
}
?>
