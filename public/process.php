<?php
// Ambil data dari form
$first_name   = htmlspecialchars($_POST['first_name']);
$last_nama   = htmlspecialchars($_POST['last_name']);
$email  = htmlspecialchars($_POST['email']);
$handphone  = htmlspecialchars($_POST['handphone']);
$topik  = htmlspecialchars($_POST['topik']);
$pesan  = htmlspecialchars($_POST['pesan']);

// Format email
$to = "babangrizkomuslimin@gmail.com"; // Ganti dengan email tujuan
$subject = "Pesan dari Formulir Kontak - $topik";
$message = "First Name: $first_name\nLast Name: $last_nama\nEmail: $email\nHandphone $handphone\nTopik: $topik\nPesan:\n$pesan";
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
