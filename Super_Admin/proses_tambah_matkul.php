<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'display_rooms';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ambil data dari form
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $sks = $_POST['sks'];
    $semester = $_POST['semester'];

    // Cek apakah kode matakuliah sudah ada
    $cek = $pdo->prepare("SELECT * FROM matakuliah WHERE kode = :kode");
    $cek->execute(['kode' => $kode]);

    if ($cek->rowCount() > 0) {
        // Jika kode sudah ada, kembali ke form dengan pesan error (opsional)
       header("Location: ../Super_Admin/addmatkul.php?status=berhasil");
        exit();
    } else {
        // Simpan ke database
        $stmt = $pdo->prepare("INSERT INTO matakuliah (kode, nama, sks, semester) VALUES (:kode, :nama, :sks, :semester)");
        $stmt->execute([
            'kode' => $kode,
            'nama' => $nama,
            'sks' => $sks,
            'semester' => $semester
        ]);

        // Redirect ke halaman form setelah berhasil
       header("Location: ../Super_Admin/addmatkul.php?status=berhasil");
        exit();
    }

} catch (PDOException $e) {
    echo "Koneksi atau insert gagal: " . $e->getMessage();
}
?>
