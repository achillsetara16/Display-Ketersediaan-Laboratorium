<?php
/*  file : header_display.php
 *  keterangan :
 *  - header reusable untuk semua halaman display
 *  - otomatis mendeteksi judul berdasarkan file pemanggil
 ---------------------------------------------------- */
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title ?? 'Room Display'); ?></title>

  <!--  Google Fonts  -->
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">

  <style>
    /* ---------- VARIABEL WARNA ---------- */
    :root{
      --blue-50:#eff6ff; --blue-100:#dbeafe; --blue-200:#1e40af;
      --blue-300:#93c5fd; --blue-600:#2563eb; --blue-700:#1e40af;
      --blue-800:#1e3a8a; --blue-900:#1e293b;
    }

    /* ---------- RESET DASAR ---------- */
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    html,body{
      font-family:"Source Sans Pro",sans-serif;
      background:linear-gradient(180deg,var(--blue-100),var(--blue-200));
      color:var(--blue-700);
      height:100vh; overflow:hidden;
    }

    /* ---------- HEADER UTAMA ---------- */
    .header{
      background:linear-gradient(135deg,var(--blue-700),var(--blue-800),var(--blue-900));
      color:#fff; box-shadow:0 4px 20px rgba(0,0,0,.25);
    }
    .header__inner{
      max-width:1400px; margin:0 auto; padding:2rem;
      display:flex; justify-content:space-between; align-items:center; gap:2rem;
      flex-wrap:wrap;
    }

    /* ---------- JUDUL & SUBJUDUL ---------- */
    .header-title{
      font-family:"Lora",serif;
      font-size:clamp(2.2rem,4vw+1rem,3.5rem);
      font-weight:700; line-height:1.1; letter-spacing:-.01em;
      text-shadow:0 2px 8px rgba(0,0,0,.3);
    }
    .header-subtitle{
      font-size:clamp(1rem,2vw+.5rem,1.4rem);
      font-weight:600; margin-top:.4rem; letter-spacing:.3px;
      color:rgba(255,255,255,.95); text-shadow:0 1px 4px rgba(0,0,0,.2);
    }

    /* ---------- WAKTU & TANGGAL ---------- */
    .datetime{display:flex;flex-wrap:wrap;gap:1rem;font-weight:700}
    .header-datetime__item{
      background:rgba(255,255,255,.15);
      border:1px solid rgba(255,255,255,.3);
      color:#fff; padding:.9rem 1.5rem; border-radius:.75rem;
      font-size:1rem; white-space:nowrap; letter-spacing:.2px;
      box-shadow:0 2px 8px rgba(0,0,0,.15); transition:.2s;
    }
    .header-datetime__item:hover{
      transform:translateY(-1px);
      background:rgba(255,255,255,.2);
      box-shadow:0 4px 12px rgba(0,0,0,.2);
    }

    /* ---------- RESPONSIVE ---------- */
    @media(max-width:1200px){
      .header-title  {font-size:2.5rem}
      .header-subtitle{font-size:1.1rem}
      .header-datetime__item{font-size:.95rem;padding:.8rem 1.3rem}
    }
    @media(max-width:768px){
      .header__inner{flex-direction:column;text-align:center;padding:1.5rem;gap:1.5rem}
      .header-title {font-size:2rem}
      .header-subtitle{font-size:1rem}
      .datetime{justify-content:center;gap:.75rem}
      .header-datetime__item{font-size:.9rem;padding:.75rem 1.2rem}
    }
    @media(max-width:480px){
      .header-title {font-size:1.75rem}
      .header-subtitle{font-size:.9rem}
      .header-datetime__item{font-size:.85rem;padding:.7rem 1rem}
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <div>
        <h1 class="header-title">
          <?php
            echo match($current){
              'display_class.php' => 'Class Room Display',
              'display_dosen.php' => 'Lecturer Room Display',
              default             => 'Real-Time Display'
            };
          ?>
        </h1>
        <p class="header-subtitle">Informatics Engineering & Internet of Things</p>
      </div>

      <div class="datetime">
        <span class="header-datetime__item" id="date"></span>
        <span class="header-datetime__item" id="time"></span>
      </div>
    </div>
  </header>

  <script>
    /* Jam & tanggal realtime */
    function tick(){const n=new Date();
      document.getElementById("date").textContent=n.toLocaleDateString("en-GB",
        {weekday:"long",year:"numeric",month:"long",day:"numeric"});
      document.getElementById("time").textContent=n.toLocaleTimeString("en-GB",
        {hour:"2-digit",minute:"2-digit",second:"2-digit"});
    }
    tick(); setInterval(tick,1000);
  </script>
</body>
</html>
