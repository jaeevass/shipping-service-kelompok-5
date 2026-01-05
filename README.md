# Shipping/Courier Service - Kelompok 5

Repository ini berisi implementasi layanan pengiriman barang untuk sistem Online Marketplace Terdistribusi.

## 📋 Tanggung Jawab
- **Pengiriman Barang:** Mengelola proses pengiriman.
- **Estimasi Ongkir:** Memberikan informasi perkiraan biaya kirim.
- **Status Pengiriman:** Memantau posisi barang secara real-time.

## 🛠️ Spesifikasi API
- **POST /api/shipping/create**: Membuat data pengiriman baru.
- **GET /api/shipping/status/{order_id}**: Mengecek status pengiriman berdasarkan ID Order.
- **GET /api/shipping**: Mendapatkan semua data pengiriman.
- **PUT /api/shipping/{id}**: Update data pengiriman.
- **DELETE /api/shipping/{id}**: Hapus data pengiriman.

## 💻 Ketentuan Teknis
- **Bahasa:** PHP 8.0+
- **Framework:** CodeIgniter 4.6.4
- **Database:** MySQL / SQLite
- **Format:** REST API + JSON
- **Komunikasi:** HTTP REST antar service

## ✨ Status Implementasi

✅ **COMPLETE** - Semua fitur telah diimplementasikan dan teruji

### Fitur yang Telah Diimplementasi:
- ✅ Database migration dengan struktur lengkap
- ✅ Model dengan validasi data
- ✅ Controller RESTful dengan semua endpoint
- ✅ Auto-generate tracking number (secure)
- ✅ Auto-calculate estimated delivery
- ✅ Comprehensive error handling
- ✅ Input validation
- ✅ Dokumentasi lengkap (API, Database, Setup)
- ✅ Testing tools (Bash script & Postman collection)
- ✅ Code review & security scan passed

## 🚀 Quick Start

```bash
# Masuk ke direktori project
cd codeigniter4-framework-e4d3702

# Install dependencies
composer install

# Setup database (edit .env terlebih dahulu)
php spark migrate

# Jalankan server
php spark serve

# Test API
./test_api.sh
```

## 📖 Dokumentasi

Dokumentasi lengkap tersedia di folder `codeigniter4-framework-e4d3702/docs/`:

1. **[API Documentation](codeigniter4-framework-e4d3702/docs/API_DOCUMENTATION.md)** - Dokumentasi lengkap semua endpoint API
2. **[Database Schema](codeigniter4-framework-e4d3702/docs/DATABASE_SCHEMA.md)** - Struktur database dan field
3. **[Setup Guide](codeigniter4-framework-e4d3702/docs/SETUP_GUIDE.md)** - Panduan instalasi dan troubleshooting
4. **[README API](codeigniter4-framework-e4d3702/README_API.md)** - Overview lengkap project
5. **[Implementation Summary](codeigniter4-framework-e4d3702/IMPLEMENTATION_SUMMARY.md)** - Ringkasan implementasi

## 🧪 Testing

### Automated Testing Script
```bash
cd codeigniter4-framework-e4d3702
./test_api.sh
```

### Manual Testing dengan cURL
```bash
# Create shipping
curl -X POST http://localhost:8080/api/shipping/create \
  -d "order_id=ORD-001" \
  -d "recipient_name=John Doe" \
  -d "recipient_address=Jl. Merdeka No. 123" \
  -d "recipient_phone=081234567890" \
  -d "courier_service=JNE" \
  -d "shipping_cost=15000" \
  -d "weight=2.5"

# Get status
curl http://localhost:8080/api/shipping/status/ORD-001
```

### Testing dengan Postman
Import collection dari: `codeigniter4-framework-e4d3702/docs/Postman_Collection.json`

## 📊 Project Structure

```
codeigniter4-framework-e4d3702/
├── app/
│   ├── Controllers/
│   │   └── Shipping.php        # Shipping controller
│   ├── Models/
│   │   └── ShippingModel.php   # Shipping model
│   ├── Config/
│   │   ├── Routes.php          # API routes
│   │   └── Database.php        # Database config
│   └── Database/
│       └── Migrations/         # Database migrations
├── docs/
│   ├── API_DOCUMENTATION.md    # API docs
│   ├── DATABASE_SCHEMA.md      # DB schema
│   ├── SETUP_GUIDE.md          # Setup guide
│   └── Postman_Collection.json # Postman collection
├── test_api.sh                 # Test script
└── IMPLEMENTATION_SUMMARY.md   # Summary
```

## 🔧 Requirements

- PHP 8.0+
- Composer
- MySQL 5.7+ / SQLite3
- Web Server (Apache/Nginx) atau PHP Built-in Server

## 🤝 Contributing

Kelompok 5 - Shipping Service Team

## 📝 License

Project ini dibuat untuk keperluan pembelajaran.

---

**Framework:** CodeIgniter 4.6.4  
**Status:** Production Ready ✅  
**Last Updated:** January 5, 2026
