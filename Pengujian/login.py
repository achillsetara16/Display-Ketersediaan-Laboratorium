from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
import time

# Inisialisasi WebDriver otomatis
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))

# Buka halaman login
driver.get("http://localhost/Display-Ketersediaan-Laboratorium/auth/login.php")

# Tunggu maksimal 10 detik sampai elemen input email muncul
wait = WebDriverWait(driver, 20)
email = wait.until(EC.presence_of_element_located((By.NAME, "email")))
password = driver.find_element(By.NAME, "password")
role_select = Select(driver.find_element(By.NAME, "role"))

# Isi form
email.send_keys("superadmin@gmail.com")
password.send_keys("admin123")
role_select.select_by_value("superadmin")  # atau "laboran", "dosen", sesuai kebutuhan

# Submit form
password.send_keys(Keys.RETURN)

# Tunggu sebentar
time.sleep(2)

# Verifikasi hasil login
if "Dashboard" in driver.page_source:
    print("Login berhasil!")
    driver.quit()
else:
    print("Login gagal!")
    driver.quit()
# Tutup browser
driver.quit()
