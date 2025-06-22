<?php
$page_title = "Lecturer Availability Status";
include 'header_display.php';

/* ====== DATA LECTURER (contoh statis, bisa diganti query database) ====== */
$lecturers = [
  ["room" => "701", "name" => "Riwinoto, ST, M.Kom",         "department" => "Multimedia Engineering Technology", "sensorDetected" => true ],
  ["room" => "702", "name" => "Agus Fatulloh, S.T., M.T",     "department" => "Cyber Security Engineering",        "sensorDetected" => false],
  ["room" => "703", "name" => "Hilda Widyastuti, S.T., M.T.", "department" => "Informatics Engineering",           "sensorDetected" => true ],
  ["room" => "704", "name" => "Hamdani Arif, S.Pd., M.Sc",    "department" => "Cyber Security Engineering",        "sensorDetected" => false],
  ["room" => "705", "name" => "Suwarno, S.S., M.Pd",          "department" => "Software Engineering",              "sensorDetected" => true ],
  ["room" => "706", "name" => "Noper Ardi, S.Pd., M.Eng",     "department" => "Software Engineering Technology",   "sensorDetected" => false],
];

/* Konfigurasi status untuk warna strip & teks badge */
$statusConfig = [
  "available"    => ["label" => "Available in Room", "stripe" => "var(--green-500)",   "badgeClass" => "badge--available"],
  "busy"         => ["label" => "Teaching",          "stripe" => "var(--red-500)",     "badgeClass" => "badge--busy"],
  "consultation" => ["label" => "Consultation Time", "stripe" => "var(--yellow-500)",  "badgeClass" => "badge--consultation"],
  "unavailable"  => ["label" => "Not in Room",       "stripe" => "var(--red-500)",     "badgeClass" => "badge--unavailable"],
];

/* Fungsi menentukan status; di sini sederhana (hanya hadir/tidak) */
function getStatus(bool $sensorDetected): string {
  return $sensorDetected ? "available" : "unavailable";
}
?>

<style>
  /* Override untuk layout yang lebih rapi */
  .header-main {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.5rem 2rem;
    height: calc(100vh - 140px);
    display: flex;
    align-items: center;
  }

  .main {
    max-width: 1300px;
    margin: 0 auto;
    padding: 1.5rem 2rem;
    height: calc(100vh - 140px);
    display: flex;
    align-items: center;
  }

  .grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 1.6rem;
    width: 100%;
    height: 100%;
    max-height: 550px;
  }

  .card {
    position: relative;
    background: linear-gradient(135deg, var(--blue-50) 0%, #fff 100%);
    border: 2px solid var(--blue-200);
    border-radius: 1.3rem;
    padding: 1.7rem;
    box-shadow: 0 7px 22px rgba(37, 99, 235, .09), 0 0 0 1px rgba(255, 255, 255, .8) inset;
    display: flex;
    flex-direction: column;
    gap: 1.3rem;
    height: 100%;
    min-height: 250px;
    transition: all 0.3s ease;
    overflow: hidden;
  }

  .card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--stripe, var(--green-500));
    border-radius: 1.2rem 1.2rem 0 0;
  }

  .card::after {
    content: "";
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(37, 99, 235, .02) 0%, transparent 70%);
    z-index: 0;
    transition: transform .5s;
  }

  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 28px rgba(37, 99, 235, .12), 0 0 0 1px rgba(255, 255, 255, .9) inset;
    border-color: var(--blue-300);
  }

  .card:hover::after {
    transform: rotate(45deg) scale(1.1);
  }

  .card__head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    position: relative;
    z-index: 1;
    gap: 0.8rem;
  }

  .room {
    font-family: "Poppins", sans-serif;
    font-weight: 800;
    background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-700) 50%, var(--blue-800) 100%);
    color: #fff;
    padding: 0.6rem 1.2rem;
    border-radius: 0.8rem;
    font-size: 1.1rem;
    box-shadow: 0 3px 10px rgba(37, 99, 235, .2);
    position: relative;
    overflow: hidden;
    letter-spacing: 0.5px;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .room::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .2), transparent);
    transition: left .5s;
  }

  .room:hover::before {
    left: 100%;
  }

  .badge {
    padding: 0.5rem 1rem;
    border-radius: 0.8rem;
    font-weight: 700;
    font-size: 0.9rem;
    text-transform: uppercase;
    white-space: nowrap;
    position: relative;
    overflow: hidden;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
    flex-shrink: 0;
  }

  .badge--available {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
  }

  .badge--busy {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: #fff;
  }

  .badge--consultation {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #fff;
  }

  .badge--unavailable {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: #fff;
  }

  .name {
    font-family: "Poppins", sans-serif;
    font-size: 1.4rem;
    font-weight: 700;
    text-align: center;
    line-height: 1.3;
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
    color: var(--blue-800);
    text-shadow: 0 1px 2px rgba(255, 255, 255, .8);
    padding: 1rem 0.8rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, .7) 0%, rgba(255, 255, 255, .3) 100%);
    border-radius: 0.8rem;
    border: 1px solid rgba(37, 99, 235, .08);
    word-break: break-word;
    hyphens: auto;
  }

  .dept {
    text-align: center;
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--blue-600);
    opacity: 0.9;
    line-height: 1.4;
    position: relative;
    z-index: 1;
    padding: 0.6rem 0.8rem;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.06) 0%, rgba(37, 99, 235, 0.02) 100%);
    border-radius: 0.6rem;
    border: 1px solid rgba(37, 99, 235, 0.1);
    font-style: italic;
    word-break: break-word;
    hyphens: auto;
  }

  /* Responsive Design */
  @media(max-width: 1200px) {
    .grid {
      grid-template-columns: repeat(2, 1fr);
      grid-template-rows: repeat(3, 1fr);
      gap: 1.4rem;
      max-height: 520px;
    }
    
    .card {
      min-height: 230px;
      padding: 1.5rem;
    }
    
    .name {
      font-size: 1.35rem;
      padding: 1rem 0.8rem;
    }
  }

  @media(max-width: 768px) {
    .main {
      height: calc(100vh - 120px);
      padding: 1rem;
    }

    .grid {
      grid-template-columns: 1fr;
      grid-template-rows: repeat(6, 1fr);
      gap: 1rem;
      max-height: none;
    }

    .card {
      padding: 1.2rem;
      min-height: 170px;
      gap: 1rem;
    }

    .card__head {
      flex-direction: column;
      align-items: center;
      gap: 0.6rem;
    }

    .room {
      font-size: 0.9rem;
      padding: 0.5rem 1rem;
    }

    .badge {
      font-size: 0.7rem;
      padding: 0.4rem 0.8rem;
    }

    .name {
      font-size: 1rem;
      padding: 0.8rem 0.6rem;
    }

    .dept {
      font-size: 0.8rem;
      padding: 0.5rem 0.6rem;
    }
  }

  @media(max-width: 480px) {
    .main {
      padding: 0.8rem;
    }

    .card {
      padding: 1rem;
      min-height: 150px;
      gap: 0.8rem;
    }

    .name {
      font-size: 0.95rem;
      padding: 0.7rem 0.5rem;
    }

    .dept {
      font-size: 0.75rem;
      padding: 0.4rem 0.5rem;
    }
  }
</style>

<main class="main">
  <div class="grid">
    <?php foreach ($lecturers as $lec): 
      $status = getStatus($lec["sensorDetected"]);
      $cfg    = $statusConfig[$status];
    ?>
      <article class="card" style="--stripe:<?= $cfg['stripe']; ?>">
        <div class="card__head">
          <span class="room"><?= htmlspecialchars($lec["room"]); ?></span>
          <span class="badge <?= $cfg['badgeClass']; ?>"><?= $cfg['label']; ?></span>
        </div>
        <div class="name"><?= htmlspecialchars($lec["name"]); ?></div>
        <div class="dept"><?= htmlspecialchars($lec["department"]); ?></div>
      </article>
    <?php endforeach; ?>
  </div>
</main>