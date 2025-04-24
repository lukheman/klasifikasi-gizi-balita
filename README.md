# Breakdown aplikasi

# Konteks/Role

1. Admin/Ahli Gizi
    - [x] Input data balita
    - [x] Input data testing
    - [x] Input data training
2. Orang Tua Balita
    - [x] melihat hasil status gizi dan grafik KMS
3. User/Pimpinan
    - [x] Melihat laporan hasil status gizi

# Fitur-Fitur

- [x] Login dan registrasi (registrasi kusus orang tua) (50)
- [x] CRUD data pengguna (35)
- [x] CRUD data balita (35)
- [x] CRUD data hasil klasifikasi gizi balita (35)
- [x] CRUD data training (35)
- [x] Import dan export data training, data hasil klasifikasi, data balita, ke file excel (50)
- [x] Menampilkan hasil pengujian KNN dalam bentuk grafik KMS (50)
- [x] Implementasi algoritma KNN untuk memprediksi status gizi  (300)
- [x] Laporan hasil status gizi balita (50)

# Rincian Pembayaran

Total harga fitur: Rp 640.000
Pengerjaan Aplikasi + Revisi Sampai Tutup: Rp. 1.000.000
Total Pembayaran: Rp. 1.640.000

# NOTE

**Penambahan fitur tambahan selain yang tertera di atas dikenai biaya tambahan (jika fitur kompleks dan sulit, kalau
gampang, free ji) *


'name' => 'Sofhia',
'email' => 'sofhia@gmail.com',
'password' => bcrypt('password123'),
'role' => 'ahligizi'

'name' => 'Akmal',
'email' => 'akmal@gmail.com',
'password' => bcrypt('password123'),
'role' => 'admin'

'name' => 'Cici',
'email' => 'cici@gmail.com',
'password' => bcrypt('password123'),
'role' => 'orangtua'

'name' => 'Burhan S.Kom',
'email' => 'pimpinan@gmail.com',
'password' => bcrypt('password123'),
'role' => 'pimpinan'
