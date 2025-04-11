# SIP - Sistem Informasi Pelayanan Jemaat  
**Aplikasi Pelayanan Jemaat Digital untuk GKJ Manahan Surakarta**  
Dibangun dengan Laravel 11, Livewire v3, dan Filament v3

---

## 🚀 Deskripsi

SIP adalah sistem pelayanan jemaat berbasis web yang memfasilitasi proses pengajuan permohonan jemaat secara digital, verifikasi berjenjang oleh admin gereja, dan integrasi langsung ke dalam agenda rapat. Sistem ini juga terintegrasi dengan notifikasi WhatsApp untuk memberikan update status permohonan kepada jemaat.

Website: [https://sip.gkjmanahan.org/form-permohonan](https://sip.gkjmanahan.org/form-permohonan)

---

## 📦 Fitur Utama

- ✅ **Pengajuan Permohonan** oleh jemaat melalui form dinamis
- 🔐 **Role dan Akses**: Jemaat, Admin, Kepala Admin
- 🔄 **Verifikasi Multi-Level**:
  - Admin: validasi awal
  - Kepala Admin: validasi lanjutan
- 🗓️ **Agenda Rapat Otomatis** berdasarkan permohonan yang disetujui
- 📲 **Notifikasi WhatsApp** ke jemaat menggunakan Fonte API
- 📊 **Dashboard Admin (Filament)** untuk manajemen pengguna, agenda, dan data
- 📁 **Upload Dokumen** & kontrol kelengkapan

---

## 🛠️ Teknologi yang Digunakan

- Laravel 11
- Livewire v3
- Filament v3
- Fonte WA Blast API
- MySQL
- Tailwind CSS

---

## ⚙️ Instalasi Lokal

```bash
# 1. Clone repository
git clone https://github.com/WisnuErik04/sip_gkjmanahan.git
cd sip_gkjmanahan

# 2. Install dependency
composer install
npm install && npm run build

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database & WA API di .env

# 5. Migrasi dan seed
php artisan migrate --seed

# 6. Jalankan server lokal
php artisan serve

---

## ✉️ Kontak & Info
- Developer: Wisnu Erik
- WhatsApp: 6281227717471
- Email: erikwnugroho@gmail.com
- GitHub: https://github.com/WisnuErik04