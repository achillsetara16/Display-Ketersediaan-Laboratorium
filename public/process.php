<?php
// Ambil data dari form
$nama   = htmlspecialchars($_POST['firts_name']);
$email  = htmlspecialchars($_POST['email']);
$topik  = htmlspecialchars($_POST['topik']);
$pesan  = htmlspecialchars($_POST['pesan']);

// Format email
$to = ""; // Ganti dengan email tujuan
$subject = "Pesan dari Formulir Kontak - $topik";
$message = "Nama: $nama\nEmail: $email\nTopik: $topik\nPesan:\n$pesan";
$headers = "From: $email";

// Kirim email
if (mail($to, $subject, $message, $headers)) {
    header("Location: index.php?status=sukses");
    exit();
} else {
    header("Location: index.php?status=gagal");
    exit();
}
?>
