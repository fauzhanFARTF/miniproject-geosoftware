# 🗺️ WebGIS Persebaran Toko Modern vs Kepadatan Penduduk – Kabupaten Tangerang

> **Mini Project oleh Fauzan Nurrachman**  
> Aplikasi WebGIS interaktif untuk memetakan dan menganalisis distribusi toko modern (minimarket, supermarket, mall) berdasarkan kecamatan dan kepadatan penduduk di Kabupaten Tangerang.

![Tampilan WebGIS](https://github.com/fauzhanFARTF/miniproject-geosoftware/blob/main/static/img/1.jpg?raw=true)

---

## 📌 Deskripsi

Aplikasi ini memungkinkan pengguna untuk:
- 🔍 **Memfilter toko modern** berdasarkan **nama kecamatan** (misal: `Kelapa Dua`, `Balaraja`, `Cikupa`)
- 🔎 **Mencari toko** berdasarkan **nama toko** (misal: `Alfamart`, `Indomaret`)
- 📍 Melihat lokasi toko dalam bentuk **marker cluster** yang dinamis
- 🎨 Menampilkan **kepadatan penduduk per desa/kelurahan** sebagai latar belakang choropleth
- 📏 Mengukur jarak & luas area, mengganti basemap, dan berinteraksi langsung dengan peta

Dibangun menggunakan **Flask + Folium + Bootstrap**, aplikasi ini dirancang untuk kebutuhan akademik, perencanaan wilayah, dan analisis bisnis.

---

## 📊 Data yang Digunakan

### 1. `Toko_Modern_Centroids.json`
- **Jumlah Data**: 561 titik
- **Atribut Utama**:
  - `N_Alfamart`: Nama toko (contoh: `"ALFAMART KP. PANGGANG"`)
  - `Desa`: Nama desa/kelurahan
  - `Kecamatan`: Nama kecamatan → **digunakan sebagai filter utama**
  - Koordinat: Titik geografis (longitude, latitude)

### 2. `Desa.json`
- **Deskripsi**: Batas administratif desa/kelurahan di Kabupaten Tangerang
- **Digunakan Untuk**: Layer choropleth kepadatan penduduk (tahun 2015)
- **Atribut Penting**:
  - `DESA_KEL`: Nama desa/kelurahan
  - `KEP_PEND`: Kepadatan penduduk (jiwa/km²)

### 3. `Kecamatan.json` *(opsional)*
- Digunakan untuk overlay batas kecamatan atau agregasi data tingkat kecamatan.

---

## 🖼️ Screenshot Aplikasi

### 🏁 Tampilan Awal
![Tampilan Awal](https://github.com/fauzhanFARTF/miniproject-geosoftware/blob/main/static/img/1.jpg?raw=true)

### 🔍 Filter: Kecamatan "Kelapa Dua"
![Kelapa Dua](https://github.com/fauzhanFARTF/miniproject-geosoftware/blob/main/static/img/6.jpg?raw=true)

> Menampilkan **47 toko** dalam bentuk **marker cluster**.

### 🔬 Zoom In: Cluster Terpecah Menjadi Titik Lokasi
![Zoom In](https://github.com/fauzhanFARTF/miniproject-geosoftware/blob/main/static/img/7.jpg?raw=true)

### 🏘️ Contoh Filter Lain: Kecamatan "Balaraja"
![Balaraja](https://github.com/fauzhanFARTF/miniproject-geosoftware/blob/main/static/img/8.jpg?raw=true)

---

## ⚙️ Fitur Utama

- ✅ Filter dinamis berdasarkan **kecamatan** dan **nama toko**
- ✅ **Marker Cluster** otomatis (mengelompokkan titik saat zoom out)
- ✅ **Popup informasi** saat klik marker (menampilkan nama toko)
- ✅ **Choropleth map** kepadatan penduduk per desa
- ✅ **Multi-basemap**: Google Maps, Satellite, OpenStreetMap, dll.
- ✅ Tools interaktif: **Measure**, **Mouse Position**, **MiniMap**, **Draw**
- ✅ Responsif & kompatibel di desktop maupun mobile

---

## 🚀 Cara Menjalankan

### Prasyarat
- Language : Python 3.8+
- Framework : Flask
- Library : Folium, Geopandas, matplotlib, scikit-learn

### Instalasi
```bash
# Clone repositori
git clone https://github.com/fauzhanFARTF/miniproject-geosoftware
cd miniproject-geosoftware

# Install dependensi
pip install -r requirements.txt

# Jalankan aplikasi
python app.py