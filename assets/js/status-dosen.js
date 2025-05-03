const links = document.querySelectorAll('.nav-links a');
  links.forEach(link => {
    link.addEventListener('click', function() {
      links.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
    });
  });

    const form = document.getElementById("statusForm");
    const currentStatusSpan = document.getElementById("currentStatus");
    const iconStatus = document.getElementById("iconStatus");

    function updateDisplay(status) {
      currentStatusSpan.textContent = status;
      if (status === "Ada") {
        iconStatus.textContent = "✅";
        iconStatus.className = "status-icon status-ada";
      } else if (status === "Tidak Ada") {
        iconStatus.textContent = "❌";
        iconStatus.className = "status-icon status-tidak";
      } else {
        iconStatus.textContent = "⏳";
        iconStatus.className = "status-icon";
      }
    }

    const savedStatus = localStorage.getItem("dosenStatus");
    if (savedStatus) {
      updateDisplay(savedStatus);
      document.getElementById("status").value = savedStatus;
    }

    form.addEventListener("submit", function(event) {
      event.preventDefault();
      const status = document.getElementById("status").value;
      localStorage.setItem("dosenStatus", status);
      updateDisplay(status);
    });

    // Optional: Ganti judul halaman tergantung URL hash (simulasi navigasi)
    window.addEventListener("hashchange", () => {
      const page = location.hash.replace("#", "");
      const title = document.getElementById("pageTitle");
      const caption = document.getElementById("pageCaption");

      if (page === "status") {
        title.textContent = "Status Dosen";
        caption.textContent = "Perbarui Status Kehadiran Anda";
      } else {
        title.textContent = "Dashboard";
        caption.textContent = "Selamat Datang di Dashboard";
      }
    });