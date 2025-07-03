<?php
session_start();
include '../config/db.php'; // Menghubungkan file koneksi database

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];

    // Redirect sesuai role
    if ($role === 'superadmin') {
        header("Location: ../Super_Admin/dashboard.php");
    } elseif ($role === 'laboran') {
        header("Location: ../Laboran/dashboard_laboran.php");
    } elseif ($role === 'dosen') {
        header("Location: ../Dosen/dashboard.php");
    } else {
        header("Location: ../public/index.php"); // Atau halaman default jika role tidak ditemukan
    }
    exit();
}

// Proses registrasi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];
    $role = $_POST['role'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'] ?? null;
    $prodi = $_POST['prodi'] ?? null;


    if ($password !== $password_confirmation) {
        $error = "Password and confirmation password do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $error = "Email is already registered!";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (email, password, role, nama_lengkap, nik, prodi)
                       VALUES (:email, :password, :role, :nama_lengkap, :nik, :prodi)");
            $stmt->execute([
                'email' => $email,
                'password' => $hashed_password,
                'role' => $role,
                'nama_lengkap' => $nama_lengkap,
                'nik' => $role === 'dosen' ? $nik : null,
                'prodi' => $role === 'dosen' ? $prodi : null
            ]);


            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
</head>

<body>
    <div class="form-container">
        <h2>Register</h2>
        
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <form action="register.php" method="POST">
            <div id="dosen-fields" style="display: none;">
                <div class="input-group">
                    <div class="icon"><i class="fas fa-id-badge"></i></div>
                    <input type="text" name="nik" id="nik" placeholder="NIK Dosen">
                </div>
            
                <div class="input-group">
                    <div class="icon"><i class="fas fa-graduation-cap"></i></div>
                        <input type="text" name="prodi" id="prodi" placeholder="Program Studi">
                </div>
            </div>

            <div class="input-group">
                <div class="icon"><i class="fas fa-user"></i></div>
                <input type="text" name="nama_lengkap" placeholder="Full Name" required>
                </div>
                
                <div class="input-group">
                    <div class="icon"><i class="fas fa-envelope"></i></div>
                    <input type="email" placeholder="Email" name="email" required>
                    </div>
            <div class="input-group">
                <div class="icon"><i class="fas fa-lock"></i></div>
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <div class="icon"><i class="fas fa-lock"></i></div>
                <input type="password" placeholder="Password Confirm" name="password_confirmation" required>
            </div>
            <div class="input-group">
                <div class="icon"><i class="fas fa-user-gear"></i></div>
                <select name="role" required>
                    <option value="" disabled selected>Role</option>
                    <option value="dosen">Dosen</option>
                    <option value="laboran">Laboran</option>
                </select>
            </div>

            <button type="submit">Register</button>
        </form>
            <br>
        <p>Do you already have an account? <a href="login.php">Login here</a></p>
    </div>
    
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.querySelector('select[name="role"]');
    const dosenFields = document.getElementById('dosen-fields');
    const nik = document.getElementById('nik');
    const prodi = document.getElementById('prodi');

    roleSelect.addEventListener('change', function () {
      if (this.value === 'dosen') {
        dosenFields.style.display = 'block';
        nik.required = true;
        prodi.required = true;
      } else {
        dosenFields.style.display = 'none';
        nik.required = false;
        prodi.required = false;
        nik.value = '';
        prodi.value = '';
      }
    });
  });
</script>

</body>

</html>

</html>