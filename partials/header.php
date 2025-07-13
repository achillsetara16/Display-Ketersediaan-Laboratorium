<?php
$current = basename($_SERVER['PHP_SELF']);
?>
<!-- HEADER START -->
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

<style>
  .header {
    background: linear-gradient(135deg, var(--blue-700), var(--blue-800), var(--blue-900));
    color: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, .25);
  }

  .header__inner {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
  }

  .header-title {
    font-family: "Lora", serif;
    font-size: clamp(2.2rem, 4vw + 1rem, 3.5rem);
    font-weight: 700;
    text-shadow: 0 2px 8px rgba(0, 0, 0, .3);
  }

  .header-subtitle {
    font-size: clamp(1rem, 2vw + .5rem, 1.4rem);
    font-weight: 600;
    margin-top: .4rem;
    color: rgba(255, 255, 255, .95);
    text-shadow: 0 1px 4px rgba(0, 0, 0, .2);
  }

  .datetime {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-weight: 700;
  }

  .header-datetime__item {
    background: rgba(255, 255, 255, .15);
    border: 1px solid rgba(255, 255, 255, .3);
    color: #fff;
    padding: .9rem 1.5rem;
    border-radius: .75rem;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
    white-space: nowrap;
  }

  .header-datetime__item:hover {
    transform: translateY(-1px);
    background: rgba(255, 255, 255, .2);
    box-shadow: 0 4px 12px rgba(0, 0, 0, .2);
  }

  @media(max-width:768px){
    .header__inner {
      flex-direction: column;
      text-align: center;
      gap: 1.5rem;
    }
    .header-title { font-size: 2rem; }
    .header-subtitle { font-size: 1rem; }
    .datetime { justify-content: center; }
    .header-datetime__item { font-size: .95rem; padding: .8rem 1.2rem; }
  }
</style>

<script>
  function tick() {
    const now = new Date();
    document.getElementById("date").textContent = now.toLocaleDateString("en-GB", {
      weekday: "long", year: "numeric", month: "long", day: "numeric"
    });
    document.getElementById("time").textContent = now.toLocaleTimeString("en-GB", {
      hour: "2-digit", minute: "2-digit", second: "2-digit"
    });
  }
  tick();
  setInterval(tick, 1000);
</script>
<!-- HEADER END -->
