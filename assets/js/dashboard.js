const ruangStatusData = [];
const ruangDiv = document.getElementById('daftarRuangan');
const statusOptions = ['tersedia', 'terpakai'];
let daftarHTML = '';

// Loop untuk mengisi data ruangan
for (let i = 1; i <= 12; i++) {
  const status = statusOptions[Math.floor(Math.random() * statusOptions.length)];
  ruangStatusData.push(status);
  daftarHTML += `<p data-status="${status}">Ruang ${100 + i}: <span class="status ${status}">${status}</span></p>`;
}

// Menambahkan HTML ke dalam div
ruangDiv.innerHTML = daftarHTML;

// Fungsi untuk menghitung jumlah status ruangan
function hitungStatus() {
  let tersedia = 0, terpakai = 0;
  ruangStatusData.forEach(status => {
    if (status === 'tersedia') tersedia++;
    if (status === 'terpakai') terpakai++;
  });
  return [tersedia, terpakai];
}

// Mendapatkan konteks dari canvas untuk chart
const ctx = document.getElementById('ruangChart').getContext('2d');

// Menghitung penggunaan ruangan
const total = ruangStatusData.length;
const usage = hitungStatus();

// Membuat chart menggunakan Chart.js
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
