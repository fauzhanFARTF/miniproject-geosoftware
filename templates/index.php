{% extends "layout.php" %}

{% block body %}
<div class="container py-4">
    <!-- Judul & Tujuan -->
    <div class="content mb-4">
        <h4>Peta Persebaran Toko Modern vs Kepadatan Penduduk – Kabupaten Tangerang</h4>
        <p><strong>Tujuan:</strong> Menampilkan persebaran toko modern berdasarkan kecamatan dan kepadatan penduduk.</p>

        <!-- Form Filter -->
        <form action="/" method="POST" class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="kecamatan" class="form-label fs-5">Kecamatan</label>
                <input type="text" id="kecamatan" name="kecamatan" class="form-control form-control-lg" 
                       placeholder="Contoh: Cikupa, Serpong, Legok" value="{{ kecamatan or '' }}">
            </div>
            <div class="col-md-6">
                <label for="keyword" class="form-label fs-5">Nama Toko Mengandung</label>
                <input type="text" id="keyword" name="keyword" class="form-control form-control-lg" 
                       placeholder="Contoh: Indomaret, Alfamart" value="{{ keyword or '' }}">
            </div>
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-lg px-5">Terapkan Filter</button>
            </div>
        </form>

        <!-- Feedback Jumlah Toko -->
        {% if total_toko > 0 %}
            <div class="alert alert-success mt-3">
                🔍 Ditemukan <strong>{{ total_toko }}</strong> toko modern sesuai filter.
            </div>
        {% elif request.method == 'POST' %}
            <div class="alert alert-warning mt-3">
                ⚠️ Tidak ada toko yang ditemukan dengan filter tersebut.
            </div>
        {% endif %}
    </div>

    <!-- Peta Dinamis -->
    <div class="border rounded shadow-sm mb-5">
        {{ map_html | safe }}
    </div>

    <!-- About Section -->
    <div id="about" class="bg-customnav text-white py-5">
        <div class="container">
            <h3 class="text-center mb-4">Tentang Website Ini</h3>
            <p class="fs-5 text-center">
                Website ini memetakan lokasi toko modern di Kabupaten Tangerang dan menampilkannya berdasarkan wilayah kecamatan serta latar belakang kepadatan penduduk.
            </p>
            <p class="fs-5 text-center">
                Dengan memfilter berdasarkan <strong>kecamatan</strong>, pengguna dapat dengan mudah mengeksplorasi ketersediaan layanan ritel di wilayah tertentu.
            </p>
        </div>
    </div>
</div>
{% endblock %}