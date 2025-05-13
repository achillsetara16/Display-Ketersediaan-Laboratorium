<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>

<div class="content">
    <div class="container">
        <div class="card">
            <h3>Status Ruangan</h3>
            <div id="daftarRuangan"></div>
        </div>

        <div class="card table-card">
            <h3>Jadwal Saat Ini</h3>
            <table id="jadwalTable">
                <thead>
                    <tr>
                        <th>Ruangan</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ruang 101</td>
                        <td>Matematika</td>
                        <td>Bu Siti</td>
                        <td>08:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>Ruang 102</td>
                        <td>Pemrograman</td>
                        <td>Pak Arif</td>
                        <td>10:00 - 12:00</td>
                    </tr>
                    <tr>
                        <td>Ruang 103</td>
                        <td>Fisika</td>
                        <td>Pak Joko</td>
                        <td>12:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Ruang 104</td>
                        <td>Kimia</td>
                        <td>Bu Indah</td>
                        <td>14:00 - 16:00</td>
                    </tr>
                    <tr>
                        <td>Ruang 105</td>
                        <td>Ekonomi</td>
                        <td>Pak Udin</td>
                        <td>16:00 - 18:00</td>
                    </tr>
                    <tr>
                        <td>Ruang 106</td>
                        <td>Biologi</td>
                        <td>Bu Wulan</td>
                        <td>08:00 - 10:00</td>
                    </tr>
                    <tr>
                        <td>Ruang 107</td>
                        <td>Geografi</td>
                        <td>Pak Budi</td>
                        <td>10:00 - 12:00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h3>Statistik Penggunaan</h3>
            <canvas id="ruangChart" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('../partials/footer.php'); ?>