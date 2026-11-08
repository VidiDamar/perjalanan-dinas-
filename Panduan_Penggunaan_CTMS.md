# Panduan Penggunaan Sistem Manajemen Perjalanan Dinas (CTMS) PT Jaya Abadi

Dokumen ini menjelaskan cara menggunakan aplikasi web **Corporate Travel Management System (CTMS)** PT Jaya Abadi secara ringkas dari pengajuan perjalanan dinas hingga pelaporan pertanggungjawaban biaya (*Settlement*).

---

## 1. Cara Membuka Aplikasi & Kredensial Login

Buka aplikasi melalui browser (misal `http://localhost:8000` atau URL Laragon Anda), lalu masuk melalui halaman `/login` menggunakan salah satu akun berikut (seluruh akun menggunakan kata sandi **`password123`**):

| Role / Peran | Nama Pengguna | Email Login | Password | Halaman Utama |
| :--- | :--- | :--- | :--- | :--- |
| **1. Karyawan (Pemohon)** | Ahmad Pegawai | `user@gmail.com` | `password123` | `/dashboard` |
| **2. Atasan (Approver Level 1)** | Budi Santoso | `atasan@gmail.com` | `password123` | `/approver/dashboard` |
| **2b. Direktur (Approver Level 2)** | Septianto Raharso | `direktur@gmail.com` | `password123` | `/approver/dashboard` |
| **3. Admin Travel Desk (GA)** | Siti Rahma | `travel@gmail.com` | `password123` | `/travel-admin/dashboard` |
| **4. Tim Keuangan (Finance)** | Hendra Wijaya | `finance@gmail.com` | `password123` | `/finance/dashboard` |
| **5. Super Admin** | Super Administrator | `admin@gmail.com` | `password123` | `/admin/dashboard` |

> **Tips Navigasi Cepat (Workspace Switcher):**
> Di bagian atas layar (Header), terdapat bilah **Workspace** (`Karyawan`, `Atasan`, `Admin Travel`, `Finance`, `Super Admin`). Anda dapat mengeklik tombol peran tersebut kapan saja untuk berpindah akun secara instan saat menguji alur lintas divisi tanpa perlu keluar-masuk (*logout/login*) manual.

---

## 2. Alur Penggunaan End-to-End (6 Langkah Utama)

### Langkah 1: Karyawan Mengajukan SPPD (`user@gmail.com`)
1. Masuk sebagai **Karyawan**, lalu klik tombol **Ajukan Perjalanan** di Dashboard atau menu **Pengajuan Saya**.
2. Isi tujuan perjalanan, kota asal & tujuan, tanggal berangkat & kembali, moda transportasi, serta estimasi biaya tiket dan hotel.
3. Sistem secara otomatis menghitung durasi hari, hak uang saku harian (*Per Diem*), dan memeriksa kepatuhan plafon hotel sesuai jabatan:
   - Jika tarif hotel melebihi plafon (`Rp 750.000/malam`), sistem akan menampilkan peringatan dan mewajibkan Anda mengisi **Alasan Justifikasi**.
4. Unggah dokumen pendukung (Surat Tugas/Undangan PDF/JPG), lalu klik **Kirim Pengajuan**.

### Langkah 2: Atasan Meninjau & Menyetujui SPPD (`atasan@gmail.com`)
1. Masuk atau pindah ke workspace **Atasan**.
2. Pada tabel **Daftar Pengajuan Menunggu Tinjauan Anda**, klik tombol **Tinjau** pada nomor SPPD terkait.
3. Periksa rincian agenda, lampiran dokumen, serta kartu **Audit Plafon Travel Policy** di sisi kanan.
4. Gunakan bilah keputusan di bagian bawah layar:
   - **Setujui Pengajuan (Approve)**: Menyetujui SPPD untuk diteruskan ke Travel Desk & Keuangan (atau diteruskan ke Direktur jika total anggaran mencapai `>= Rp 10.000.000`).
   - **Minta Revisi**: Mengembalikan pengajuan ke karyawan disertai catatan revisi (karyawan dapat memperbaiki dan mengirim ulang dari halaman detail SPPD).
   - **Tolak SPPD**: Membatalkan pengajuan disertai alasan penolakan.
5. Jika Atasan akan cuti atau dinas luar, buka menu **Delegasi Wewenang** untuk mengalihkan hak persetujuan sementara ke manajer rekan.

### Langkah 3: Admin Travel Menerbitkan Tiket & Voucher Hotel (`travel@gmail.com`)
1. Pindah ke workspace **Admin Travel**.
2. Pilih SPPD yang berstatus **Disetujui**, lalu klik **Proses Tiket & Voucher**.
3. Masukkan kode booking maskapai/kereta (**PNR**), nomor penerbangan, biaya riil tiket, kode reservasi hotel, dan biaya riil hotel.
4. Klik **Terbitkan Dokumen & Kirim ke Pemohon**. Status SPPD akan berubah menjadi **Tiket & Voucher Terbit**.

### Langkah 4: Finance Mencairkan Uang Muka / Kasbon (`finance@gmail.com`)
1. Pindah ke workspace **Finance**, lalu buka menu **Pencairan Uang Muka**.
2. Periksa nomor rekening bank karyawan dan nominal uang muka yang disetujui.
3. Ketik nomor referensi transfer bank (contoh: `BCA-TXN-88901`) pada kolom yang tersedia, lalu klik **Cairkan**.

### Langkah 5: Karyawan Check-in & Lapor Settlement (`user@gmail.com`)
1. Saat tiba di kota tujuan, Karyawan dapat menekan tombol **Check-in Lokasi Dinas** di halaman detail SPPD untuk memperbarui radar pemantauan lokasi.
2. Sepulang dinas, buka menu **Settlement & Klaim**.
3. Pilih SPPD yang telah selesai, lalu tambahkan rincian pengeluaran riil beserta unggahan foto nota/struk fisik.
4. Sistem otomatis menghitung selisih terhadap Uang Muka:
   - **Kurang Bayar (Reimbursement)**: Pengeluaran riil lebih besar dari uang muka.
   - **Lebih Bayar (Refund)**: Pengeluaran riil lebih kecil dari uang muka (isi nomor bukti setor balik).
   - **Seimbang (Nihil)**: Pengeluaran riil sama persis dengan uang muka.
5. Klik **Kirim Laporan Pertanggungjawaban**.

### Langkah 6: Finance Audit Nota & Tutup Buku (`finance@gmail.com`)
1. Pindah kembali ke workspace **Finance**, lalu buka menu **Audit Settlement**.
2. Klik **Audit Nota & Selisih** pada nomor settlement yang masuk.
3. Periksa daftar item biaya dan pratinjau bukti transaksi di sisi kanan:
   - Klik **Setujui Settlement & Tutup Buku** jika seluruh nota valid (status SPPD resmi menjadi **Selesai**).
   - Klik **Tolak / Minta Perbaikan Nota** jika ada struk yang tidak sesuai agar diperbaiki oleh karyawan.
4. Buka menu **Laporan & Export** dan klik **Download CSV / Excel** untuk mengunduh laporan buku besar (*General Ledger*).

---

## 3. Pengaturan Sistem oleh Super Admin (`admin@gmail.com`)

Melalui workspace **Super Admin**, Anda dapat mengelola konfigurasi utama sistem:
- **Executive Dashboard (`/admin/dashboard`)**: Memantau KPI perjalanan dinas, peringatan dini anggaran (*Early Warning System*), dan radar *check-in* lokasi karyawan secara langsung.
- **Master Karyawan (`/admin/users`)**: Menambah pengguna baru, mengatur level jabatan (*grade*), menetapkan struktur Atasan Langsung & Approver Level 2, serta mengaktifkan/menonaktifkan akun.
- **Travel Policy Engine (`/admin/policies`)**: Mengubah plafon tarif hotel per malam, uang saku harian (*Per Diem*), kelas transportasi per *grade*, ambang batas persetujuan Direktur, serta mode penegakan aturan (*Warn & Justify* vs *Strict Block*).
- **Audit Trail (`/admin/audit-logs`)**: Memfilter dan mengekspor seluruh rekam jejak aktivitas sistem ke format CSV untuk keperluan kepatuhan dan audit internal.
