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
                    <h6>Deskripsi Proyek</h6>
                    <p class="mb-0">
                        Ngemil Spot GIS adalah aplikasi berbasis web yang memanfaatkan teknologi Geographic Information
                        System (GIS)
                        untuk membantu pengguna menemukan tempat jajan atau kuliner terdekat di wilayah Kota Palu.
                        Aplikasi ini menyediakan informasi detail lokasi, rute, jam operasional, dan deskripsi tempat.
                    </p>
                </div>

                <div class="about-section1">
                    <h6>Tim Pengembang</h6>
                    <div class="team-container">
                        <div class="team-member">
                            <img src="{{ asset('fototim/nan.jpg') }}" alt="Anggota 1" class="member-photo">
                            <div class="member-info">
                                <div class="member-name">Adnan Mufti Maulana</div>
                                <div class="member-nim">F55124061</div>
                            </div>
                        </div>
                        <div class="team-member">
                            <img src="{{ asset('fototim/wann.jpg') }}" alt="Anggota 2" class="member-photo">
                            <div class="member-info">
                                <div class="member-name">Wanda Remalia Toripalu</div>
                                <div class="member-nim">F55124063</div>
                            </div>
                        </div>
                        <div class="team-member">
                            <img src="{{ asset('fototim/mas.jpg') }}" alt="Anggota 3" class="member-photo">
                            <div class="member-info">
                                <div class="member-name">Dimas Reginald</div>
                                <div class="member-nim">F55124055</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-section2">
                    <h6>Tujuan Pembuatan</h6>
                    <p class="mb-0">
                        Proyek ini bertujuan untuk memudahkan masyarakat dalam menemukan tempat kuliner terdekat,
                        meningkatkan promosi UMKM kuliner lokal, serta menerapkan teknologi GIS dalam kehidupan
                        sehari-hari.
                    </p>
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