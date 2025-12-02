<!-- Navbar -->
<div class="navbar-floating d-flex align-items-center justify-content-between px-4 py-2">
    <!-- Kiri: Logo + Nama -->
    <div class="d-flex align-items-center">
        <img src="/brand.png" alt="Logo" class="brand-logo me-2">
        <span class="fw-bold fs-5 text-dark">Ngemilku</span>
    </div>

    <!-- Tengah: Menu + Search -->
    <div class="d-flex align-items-center gap-4">
        <!-- Link About -->
        <div class="nav-item position-relative">
            <a href="#" class="nav-link-custom">About</a>
            <div class="about-dropdown">
                <h4 class="about-title">Sistem Informasi Geografis Ngemilku</h4>

                <div class="about-section">
                    <h6>Tentang Proyek</h6>
                    <p class="mb-0">
                        Ngemil Spot GIS merupakan aplikasi berbasis web yang mengintegrasikan teknologi Geographic
                        Information System (GIS) untuk membantu pengguna menemukan lokasi kuliner terbaik dan terdekat
                        di Kota Palu. Melalui tampilan peta interaktif, pengguna dapat melihat titik-titik kuliner,
                        detail lokasi, rute navigasi, jam operasional, serta deskripsi singkat dari setiap tempat.
                        <br><br>
                        Aplikasi ini dirancang agar mudah diakses dan bermanfaat bagi masyarakat, menghadirkan pencarian kuliner yang cepat, akurat, dan informatif. Antarmuka yang intuitif memungkinkan pengguna menemukan lokasi kuliner hanya dengan beberapa klik.
                    </p>
                </div>

                <div class="about-section2">
                    <h6>Tujuan Pengembangan</h6>
                    <p class="mb-0">
                        Pembuatan aplikasi ini bertujuan untuk menyediakan platform informasi kuliner yang mudah
                        diakses,
                        mendukung promosi UMKM lokal, memanfaatkan teknologi GIS sebagai solusi digital modern, serta
                        membantu masyarakat menemukan tempat jajan secara efisien dan terarah.
                    </p>
                </div>

                <div class="about-section3">
                    <h6>Manfaat Aplikasi</h6>
                    <ul class="mb-0">
                        <li>Memudahkan pencarian lokasi kuliner terdekat secara real-time.</li>
                        <li>Menyediakan rute dan informasi lengkap setiap titik kuliner.</li>
                        <li>Mendukung perkembangan UMKM kuliner di Kota Palu.</li>
                        <li>Menerapkan teknologi GIS sebagai media pemetaan digital modern.</li>
                        <li>Meningkatkan kemudahan akses informasi bagi masyarakat.</li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Search bar -->
        <div class="position-relative">
            <input type="text" id="search-bar" placeholder="Cari lokasi..." class="form-control search-input">
            <i class="bi bi-search search-icon"></i>
        </div>

        <!-- Kanan: Logout -->
        <a href="{{ route('login') }}" class="btn-login">Login</a>
    </div>
</div>

<!-- Tombol Toggle Legenda -->
<button class="legend-toggle-btn" id="legendToggleBtn">></button>

<!-- Detail Panel -->
<div id="detail-container">
    <div class="d-flex">
        <!-- Gambar kiri -->
        <img id="detail-gambar" src="" alt="Gambar Lokasi" class="me-3"
            style="width:120px; height:120px; object-fit:cover; border-radius:12px;">

        <!-- Info kanan -->
        <div class="flex-grow-1 d-flex flex-column justify-content-between">
            <!-- Atas: Nama, alamat, jam -->
            <div>
                <h5 id="detail-nama" class="mb-1 fw-bold"></h5>
                <p id="detail-alamat" class="mb-1 text-muted"></p>
                <p id="detail-jam" class="mb-2 text-success fw-semibold"></p>
            </div>

            <!-- Bawah: Deskripsi + Hotlink -->
            <div>
                <p id="detail-deskripsi" class="mb-1"></p>
                <a id="detail-hotlink" href="#" target="_blank" class="text-primary text-decoration-underline"></a>
            </div>
        </div>

        <!-- Tombol rute kanan -->
        <div class="ms-3 d-flex align-items-center">
            <a id="detail-rute" href="#" target="_blank" class="btn btn-success">Dapatkan Rute</a>
        </div>
    </div>
</div>