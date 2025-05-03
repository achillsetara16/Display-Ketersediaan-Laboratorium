<footer>
  &copy; 2025 Sistem Kehadiran Dosen | Politeknik Negeri Batam
</footer>

<script>
  const ruangStatusData = [];
  const ruangDiv = document.getElementById('daftarRuangan');
  const statusOptions = ['tersedia', 'terpakai'];
  let daftarHTML = '';
  for (let i = 1; i <= 12; i++) {
    const status = statusOptions[Math.floor(Math.random() * statusOptions.length)];
    ruangStatusData.push(status);
    daftarHTML += `<p data-status="${status}">Ruang ${100 + i}: <span class="status ${status}">${status}</span></p>`;
  }
  ruangDiv.innerHTML = daftarHTML;

  function hitungStatus() {
    let tersedia = 0, terpakai = 0;
    ruangStatusData.forEach(status => {
      if (status === 'tersedia') tersedia++;
      if (status === 'terpakai') terpakai++;
    });
    return [tersedia, terpakai];
  }

  const ctx = document.getElementById('ruangChart').getContext('2d');
  const total = ruangStatusData.length;
  const usage = hitungStatus();

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Available', 'In Use'],
      datasets: [{
        data: usage,
        backgroundColor: ['#27ae60', '#e74c3c']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'bottom' },
        title: {
          display: true,
          text: 'Statistik Penggunaan Ruangan'
        },
        datalabels: {
          color: '#fff',
          formatter: (value, context) => {
            const percent = ((value / total) * 100).toFixed(0);
            return percent + '%';
          }
        }
      }
    },
    plugins: [ChartDataLabels]
  });
</script>

</body>
</html>
