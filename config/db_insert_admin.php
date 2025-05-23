<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'display_rooms';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Data akun superadmin
    $nama_lengkap = 'Super Admin';
    $email = 'superadmin@gmail.com';
    $plain_password = 'admin123'; // Ganti jika perlu
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
    $role = 'superadmin';

    // Periksa apakah email sudah ada
    $check = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $check->execute(['email' => $email]);
    if ($check->rowCount() > 0) {
        echo "Super Admin dengan email tersebut sudah terdaftar.";
    } else {
        // Masukkan ke tabel
        $stmt = $pdo->prepare("INSERT INTO users (email, password, role, nama_lengkap) VALUES (:email, :password, :role, :nama_lengkap)");
        $stmt->execute([
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'password' => $hashed_password,
            'role' => $role,
        ]);

        echo "Super Admin berhasil ditambahkan.";
    }

} catch (PDOException $e) {
    echo "Koneksi atau insert gagal: " . $e->getMessage();
}
?>
