<?php
include('../partials/header.php');
include('../partials/sidebar.php');
?>
<link rel="stylesheet" href="../assets/css/list_matkul.css">
<!-- jQuery (wajib) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<?php
$API_KEY     = '9a89a3be-1d44-4e81-96a8-585cb0453718';
// $koderuangan = 'A101';
$tanggal     = date('Y-m-d'); // bisa diganti dengan GET/POST

$url = 'https://peminjaman.polibatam.ac.id/api-penru/data-peminjaman?' .
       http_build_query(compact( 'tanggal'));

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
    <h2>Data Peminjaman Ruangan <?= htmlspecialchars($tanggal) ?></h2>
    <table id="roomTable">
      <thead>
        <tr>
          <th>Borrower</th>
          <th>Activity</th>
          <th>Borrow Date</th>
          <th>Time</th>
          <th>Code</th>
          <th>Name Room</th>
          <th>Building</th>
          <th>Penanggung Jawab</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($data) && is_array($data)): ?>
          <?php foreach ($data as $row): ?>
            <?php
        $start = isset($row['start_time']) ? str_replace('.', ':', $row['start_time']) : '-';
        $end   = isset($row['end_time'])   ? str_replace('.', ':', $row['end_time'])   : '-';
        $timeDisplay = ($start !== '-' && $end !== '-') ? "$start – $end" : '-';
      ?>
            <tr>
              <td><?= htmlspecialchars($row['nama_mahasiswa'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['jenis_kegiatan'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['tanggal_pinjam'] ?? '-') ?></td>
              <td><?= htmlspecialchars($timeDisplay) ?></td>
              <td><?= htmlspecialchars($row['kode_ruangan'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['nama_ruangan'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['gedung_ruangan'] ?? '-') ?></td>
              <td><?= htmlspecialchars($row['nama_penanggungjawab'] ?? '-') ?></td>
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
<script>
  $.fn.dataTable.ext.pager.three_button = function (page, pages) {
    var numbers = [];
    var buttons = [];
    var current = page;
    var total = pages;

    var start = current - 1;
    var end = current + 1;

    if (start < 0) {
      start = 0;
      end = 2;
    }

    if (end >= total) {
      end = total - 1;
      start = total - 3;
    }

    start = Math.max(start, 0);
    end = Math.min(end, total - 1);

    for (var i = start; i <= end; i++) {
      numbers.push(i);
    }

    buttons.push('previous');
    $.merge(buttons, numbers);
    buttons.push('next');

    return buttons;
  };

  $(document).ready(function () {
    if ($.fn.DataTable.isDataTable('#roomTable')) {
      $('#roomTable').DataTable().clear().destroy();
    }

    $('#roomTable').DataTable({
      pagingType: "three_button", // gunakan custom pager di atas
      pageLength: 10,
      info: true,
      searching: true,
      ordering: true
    });
  });
</script>
<?php include('../partials/footer.php'); ?>
