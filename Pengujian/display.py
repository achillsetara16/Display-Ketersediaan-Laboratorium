from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
import time

# Setup driver
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))
wait = WebDriverWait(driver, 15)

# Buka halaman index
driver.get("http://localhost/Display-Ketersediaan-Laboratorium/public/index.php")
print("Halaman dibuka.")

try:
    # Tunggu tombol muncul
    select_button = wait.until(
        EC.presence_of_element_located((By.XPATH, "//button[contains(translate(., 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), 'select room display')]"))
    )

    # Scroll ke tombol dengan offset agar tidak terlalu bawah
    driver.execute_script("""
        const element = arguments[0];
        const headerOffset = 100;
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.scrollY - headerOffset;
        window.scrollTo({
            top: offsetPosition,
            behavior: 'instant'
        });
    """, select_button)
    time.sleep(1.2)

    # Klik tombol
    wait.until(EC.element_to_be_clickable((By.XPATH, "//button[contains(translate(., 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), 'select room display')]"))).click()
    print("Tombol 'Select Room Display' diklik.")

    # Tunggu modal atau daftar ruangan muncul
    room_link = wait.until(
        EC.element_to_be_clickable((By.XPATH, "//a[contains(@href, 'display_class.php?room=')]"))
    )

    # Scroll ke ruangan (optional, jika dibutuhkan)
    driver.execute_script("arguments[0].scrollIntoView({behavior: 'smooth', block: 'center'});", room_link)
    time.sleep(1)

    # Klik link ruangan
    room_link.click()
    print("Ruangan dipilih dan halaman display terbuka.")

except Exception as e:
    print("Terjadi kesalahan:", e)
finally:
    time.sleep(2)
    driver.quit()
