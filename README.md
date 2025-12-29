# Shipping/Courier Service - Kelompok 5

Repository ini berisi implementasi layanan pengiriman barang untuk sistem Online Marketplace Terdistribusi.

## [cite_start]📋 Tanggung Jawab [cite: 35-40]
- **Pengiriman Barang:** Mengelola proses pengiriman.
- **Estimasi Ongkir:** Memberikan informasi perkiraan biaya kirim.
- **Status Pengiriman:** Memantau posisi barang secara real-time.

## [cite_start]🛠️ Spesifikasi API [cite: 100-107]
- **POST /api/shipping/create**: Membuat data pengiriman baru.
- **GET /api/shipping/status/{order_id}**: Mengecek status pengiriman berdasarkan ID Order.

## [cite_start]💻 Ketentuan Teknis [cite: 109-112]
- **Bahasa:** PHP (Framework CodeIgniter).
- **Database:** MySQL.
- **Format:** REST API + JSON.
- **Komunikasi:** HTTP REST antar service.
