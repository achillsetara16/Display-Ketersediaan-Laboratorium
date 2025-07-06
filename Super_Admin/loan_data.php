<?php
include('../partials/header.php');
include('../partials/sidebar.php');
?>
<link rel="stylesheet" href="../assets/css/list_matkul.css">

<?php
$API_KEY     = '9a89a3be-1d44-4e81-96a8-585cb0453718';
$koderuangan = 'A101';
$tanggal     = date('Y-m-d'); // bisa diganti dengan GET/POST

$url = 'https://peminjaman.polibatam.ac.id/api-penru/data-peminjaman?' .
       http_build_query(compact('koderuangan', 'tanggal'));

$headers = ["API-Key: $API_KEY"];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => $headers,
    CURLOPT_CONNECTTIMEOUT => 5,
    CURLOPT_TIMEOUT        => 10,
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($response === false) {
    error_log('cURL error: ' . curl_error($ch));
}
curl_close($ch);

$data = [];
if ($httpCode === 200 && $response) {
    $decoded = json_decode($response, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $data = $decoded;
    } else {
        error_log('JSON decode error: ' . json_last_error_msg());
    }
}
?>

<div class="main-content">
  <div class="card">
    <h2>Data Peminjaman Ruangan (<?= htmlspecialchars($koderuangan) ?> – <?= htmlspecialchars($tanggal) ?>)</h2>
    <table id="roomTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Ruangan</th>
          <th>Penanggung Jawab</th>
          <th>Jenis Kegiatan</th>
          <th>Total Peminjam</th>
          <th>Tanggal Pinjam</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($data) && is_array($data)): ?>
          <?php foreach ($data as $row): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']               ?? '-') ?></td>
              <td><?= htmlspecialchars($row['ruangan']          ?? '-') ?></td>
              <td><?= htmlspecialchars($row['penanggung_jawab'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['jenis_kegiatan']   ?? '-') ?></td>
              <td><?= htmlspecialchars($row['total_peminjam']   ?? '-') ?></td>
              <td><?= htmlspecialchars($row['tanggal_pinjam']   ?? '-') ?></td>
              <td><?= htmlspecialchars($row['status']           ?? '-') ?></td>
              <td>
                <!-- Contoh tombol aksi, bisa sesuaikan URL/navigasi -->
                <a href="edit.php?id=<?= urlencode($row['id'] ?? '') ?>">Edit</a> |
                <a href="detail.php?id=<?= urlencode($row['id'] ?? '') ?>">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" style="text-align:center">
              Tidak ada data peminjaman untuk hari ini.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include('../partials/footer.php'); ?>
