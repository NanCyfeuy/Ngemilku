<!DOCTYPE html>
<html>

<head>
  <title>Ngemil Spot GIS</title>
  <link rel="icon" href="{{ asset('brand.png') }}" type="image/png">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body {
      margin: 0;
    }

    #map {
      height: 100vh;
      width: 100%;
    }

    .navbar-floating {
      width: 40%;
      background: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      position: absolute;
      top: 15px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000;
      font-family: 'Segoe UI', sans-serif;
      transition: all 0.3s ease;
    }

    .navbar-floating:hover {
        background: rgba(255, 255, 255, 0.45);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }


    /* Brand logo */
    .brand-logo {
      width: 55px;
      height: 55px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #fff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Tombol Logout */
    .btn-logout {
            background: linear-gradient(135deg, #198754, #20c997);
            color: #fff;
            font-weight: 600;
            padding: 8px 24px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.25);
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, #157347, #198754);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(25, 135, 84, 0.35);
        }

    /* Tombol Lokasi Simple Elegan */
    .btn-lokasi {
      background: rgba(25, 135, 84, 0.1);
      color: #198754;
      font-weight: 500;
      padding: 6px 20px;
      border-radius: 20px;
      border: 1px solid #198754;
      transition: all 0.2s ease;
    }

    .btn-lokasi:hover {
      background: rgba(25, 135, 84, 0.2);
      color: #145c3a;
      cursor: pointer;
    }

    #lokasi-panel,
    #panel-body {
      overflow-x: hidden !important;
    }

    #panel-body .row {
      margin-left: 0;
      margin-right: 0;
    }

    /* Lokasi overlay */
    .lokasi-overlay {
      position: fixed;
      bottom: 0%;
      /* Naik sedikit dari bawah layar */
      left: 50%;
      /* Tengah horizontal */
      transform: translateX(-50%) translateY(100%);
      /* Mulai tersembunyi ke bawah */
      width: 70%;
      /* Lebar panel */
      max-height: 40%;
      /* Tinggi panel */
      overflow-y: auto;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.25);
      border-radius: 20px;
      transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
      opacity: 0;
      z-index: 9999;
      pointer-events: none;
    }

    .lokasi-overlay.show {
      transform: translateX(-50%) translateY(0);
      /* Naik ke posisi sebenarnya */
      opacity: 1;
      pointer-events: auto;
    }

    .legend {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 10px;
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            line-height: 1.4;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            max-height: 500px;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        .legend input {
            margin-right: 5px;
        }

        /* Tombol Legenda */
        .legend-toggle-btn {
            position: absolute;
            top: 10px;
            left: 50px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            color: #198754;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .legend-toggle-btn:hover {
            background: white;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
  </style>
</head>

<body>
  <!-- Navbar Floating -->
  <div class="navbar-floating d-flex align-items-center justify-content-between px-4 py-2">

    <!-- Kiri: Logo + Nama -->
    <div class="d-flex align-items-center">
      <img src="/brand.png" alt="Logo" class="brand-logo me-2">
      <span class="fw-bold fs-5 text-dark">Ngemilku</span>
    </div>

    <!-- Tengah: Tombol Lokasi -->
    <div class="flex-grow-1 d-flex justify-content-center">
      <button id="toggle-lokasi" class="btn-lokasi">Lokasi</button>
    </div>

    <!-- Kanan: Logout -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>

    <button class="legend-toggle-btn" id="legendToggleBtn">></button>



  <!-- Modal Tambah Lokasi -->
  <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form action="{{ route('lokasi.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="modalTambahLabel">Tambah Lokasi</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <!-- @if ($errors->any())
<div class="alert alert-danger">
  <ul class="mb-0">
    @foreach ($errors->all() as $err)
      <li>{{ $err }}</li>
    @endforeach
  </ul>
</div>
@endif -->

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nama Lokasi</label>
              <input type="text" name="nama" class="form-control" required>
              <small class="text-muted">Masukkan nama tempat yang jelas</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" required></textarea>
              <small class="text-muted">Alamat lengkap lokasi</small>
            </div>

            <div class="col-md-6">
              <label class="form-label">Latitude</label>
              <input type="text" name="latitude" class="form-control" required>
              <small class="text-muted">Format angka, contoh: -0.87</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Longitude</label>
              <input type="text" name="longitude" class="form-control" required>
              <small class="text-muted">Format angka, contoh: 119.87</small>
            </div>

            <div class="col-md-6">
              <label class="form-label">Jam Operasional</label>
              <input type="text" name="jam_operasional" class="form-control">
              <small class="text-muted">Contoh: 08.00 - 21.00</small>
            </div>
            <div class="col-md-6">
              <label class="form-label">Hotlink</label>
              <input type="text" name="hotlink" class="form-control">
              <small class="text-muted">Link Google Maps / Website</small>
            </div>

            <div class="col-12">
              <label class="form-label">Deskripsi</label>
              <textarea name="deskripsi" class="form-control"></textarea>
              <small class="text-muted">Tuliskan keterangan tambahan tentang lokasi</small>
            </div>

            <div class="col-12">
              <label class="form-label">Gambar</label>
              <input type="file" name="gambar" class="form-control">
              <small class="text-danger">Maksimal ukuran file 2MB (jpg/png)</small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>


  <!-- Modal Edit & Delete -->
  @foreach($lokasi as $l)
      <div class="modal fade" id="modalEdit{{ $l->id_tempat }}" tabindex="-1"
        aria-labelledby="modalEditLabel{{ $l->id_tempat }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <form action="{{ route('lokasi.update', $l->id_tempat) }}" method="POST" enctype="multipart/form-data"
            class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="modalEditLabel{{ $l->id_tempat }}">Edit Lokasi</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <!-- @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
    @endif -->
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Nama Lokasi</label>
                  <input type="text" name="nama" value="{{ $l->nama }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" required>{{ $l->alamat }}</textarea>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Latitude</label>
                  <input type="text" name="latitude" value="{{ $l->latitude }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Longitude</label>
                  <input type="text" name="longitude" value="{{ $l->longitude }}" class="form-control" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Jam Operasional</label>
                  <input type="text" name="jam_operasional" value="{{ $l->jam_operasional }}" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Hotlink</label>
                  <input type="text" name="hotlink" value="{{ $l->hotlink }}" class="form-control">
                </div>

                <div class="col-12">
                  <label class="form-label">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control">{{ $l->deskripsi }}</textarea>
                </div>

                <div class="col-12">
                  <label class="form-label">Gambar</label><br>
                  @if($l->gambar)
                    <img src="{{ asset('storage/' . $l->gambar) }}" alt="Gambar Lokasi" width="120" class="mb-2 rounded">
                  @endif
                  <input type="file" name="gambar" class="form-control">
                  <small class="text-danger">Maksimal ukuran file 2MB. Kosongkan jika tidak ingin mengubah gambar</small>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>


      <!-- Modal Delete -->
      <div class="modal fade" id="modalDelete{{ $l->id_tempat }}" tabindex="-1"
        aria-labelledby="modalDeleteLabel{{ $l->id_tempat }}" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ route('lokasi.destroy', $l->id_tempat) }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="modalDeleteLabel{{ $l->id_tempat }}">Hapus Lokasi</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Apakah kamu yakin ingin menghapus lokasi <strong>{{ $l->nama }}</strong>?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
  @endforeach

  <!-- Map -->
  <div id="map"></div>

  <!-- Panel Lokasi -->
  <!-- Panel Lokasi -->
  <div id="lokasi-panel" class="lokasi-overlay d-flex flex-column" style="height: 100%; overflow-x:hidden;">

    <!-- Panel Header -->
    <div
      class="panel-header d-flex justify-content-between align-items-center px-3 py-2 bg-success text-white sticky-top"
      style="z-index: 10;">
      <h5 class="mb-0" id="panel-title">Daftar Lokasi</h5>
      <div class="d-flex gap-2">
        <!-- Tombol Search -->
        <div class="input-group input-group-sm">
          <span class="input-group-text bg-white border-1"><i class="bi bi-search"></i></span>
          <input type="text" id="searchLokasi" class="form-control" placeholder="Cari lokasi...">
        </div>
        <button class="btn btn-success btn-sm d-flex align-items-center" data-bs-toggle="modal"
          data-bs-target="#modalTambah">
          <i class="bi bi-plus-lg me-1"></i> Tambah
        </button>
      </div>
    </div>

    <!-- Panel Body (scrollable only here) -->
    <div class="panel-body flex-grow-1 p-2 bg-white overflow-auto" id="panel-body">
      <!-- Isi daftar lokasi -->
    </div>

  </div>


  <!-- Toast Alert -->
  <div class="position-fixed top-0 end-0 p-3" style="z-index: 10500">
    @if(session('success'))
      <div id="toastSuccess" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            {{ session('success') }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
    @endif

    @if($errors->any())
      <div id="toastError" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            <ul class="mb-0">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
    @endif
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    // Init map
    var map = L.map('map', {
      center: [-0.8700, 119.8707], // pusat Palu agak ke atas
      zoom: 13,
      minZoom: 11,
      maxZoom: 18,
      maxBounds: [
        [-0.9700, 119.7900], // Southwest (lebih kecil)
        [-0.6600, 119.9800]  // Northeast (lebih kecil)
      ],
      maxBoundsViscosity: 1.0
    });

    var markers = [];
    var layerJalan;
    var layerKecamatan = {};

    var kecamatanLayers = [
      { file: "Mantikulore.geojson", color: "#ff4d4d" },  // merah
      { file: "Palu Barat.geojson", color: "#4d79ff" },  // biru
      { file: "Palu Selatan.geojson", color: "#ffb84d" },  // oranye
      { file: "Palu Timur.geojson", color: "#66cc66" },  // hijau
      { file: "Palu Utara.geojson", color: "#9933ff" },  // ungu
      { file: "Tatanga.geojson", color: "#ff66b2" },  // pink
      { file: "Tawaeli.geojson", color: "#33cccc" },  // cyan
      { file: "Ulujadi.geojson", color: "#999966" }   // cokelat zaitun
    ];

    kecamatanLayers.forEach(function (kec) {
      fetch(`/Poly kecamatan/${kec.file}`)
        .then(response => response.json())
        .then(data => {
          var layer = L.geoJSON(data, {
            style: {
              color: kec.color,
              weight: 2,
              fillColor: kec.color,
              fillOpacity: 0.4
            },
            onEachFeature: function (feature, layer) {
              const namaKec = feature.properties.NAMOBJ || kec.file.replace('.geojson', '');
              layer.bindTooltip(namaKec, { permanent: false, direction: "top" });
            }
          });
          layerKecamatan[kec.file.replace('.geojson', '')] = layer;
          layer.addTo(map);
        });
    });


    fetch('/jalan.geojson')
      .then(response => response.json())
      .then(data => {
        layerJalan = L.geoJSON(data, {
          style: {
            color: 'grey',
            weight: 1.5
          },
          onEachFeature: function (feature, layer) {
            if (feature.properties && feature.properties.NAMA) {
              layer.bindPopup(feature.properties.NAMA);
            }
          }
        });
        // defaultnya aktif
        layerJalan.addTo(map);
      });

    // === BUAT PANEL LEGENDA ===
    var legend = L.control({ position: "topleft" });

    legend.onAdd = function () {
      var div = L.DomUtil.create("div", "legend bg-white p-3 rounded shadow");

      div.innerHTML = `
        <h6 class="fw-bold mb-2">Layer Control</h6>
        <label><input type="checkbox" id="chkKecamatan" checked> Polygon Kecamatan</label><br>
        <label><input type="checkbox" id="chkJalan" checked> Garis Jalan</label><br>
        <label><input type="checkbox" id="chkTitik" checked> Titik Lokasi</label>
        <hr class="my-2">
        <h6 class="fw-bold mb-2">Legenda</h6>
        ${kecamatanLayers.map(k => `
            <div class="d-flex align-items-center mb-1">
                <span style="display:inline-block; width:15px; height:15px; background:${k.color}; margin-right:5px; border-radius:3px;"></span>
                ${k.file.replace('.geojson', '')}
            </div>
        `).join('')}
        <div class="d-flex align-items-center mb-1">
            <span style="display:inline-block; width:15px; height:2px; background:grey; margin-right:5px;"></span>
            Jalan
        </div>
        <div class="d-flex align-items-center mb-1">
            <i class="bi bi-geo-alt-fill text-danger me-1"></i> Titik Lokasi
        </div>
    `;
      return div;
    };
    legend.addTo(map);

    // === TOGGLE LEGENDA ===
        var legendPanel = legend.addTo(map);

        var legendToggleBtn = document.getElementById('legendToggleBtn');
        var isLegendVisible = true;
        
        legendToggleBtn.addEventListener('click', function() {
            if (isLegendVisible) {
                // Sembunyikan legenda
                map.removeControl(legendPanel);
                legendToggleBtn.innerHTML = '>';
                isLegendVisible = false;
            } else {
                // Tampilkan legenda
                legendPanel = legend.addTo(map);
                legendToggleBtn.innerHTML = '<';
                isLegendVisible = true;
            }
        });
    // === EVENT CHECKBOX UNTUK SHOW/HIDE LAYER ===
    document.addEventListener("change", function (e) {
      if (e.target.id === "chkJalan") {
        if (layerJalan) {
          if (e.target.checked) map.addLayer(layerJalan);
          else map.removeLayer(layerJalan);
        }
      }
      if (e.target.id === "chkKecamatan") {
        Object.values(layerKecamatan).forEach(layer => {
          if (e.target.checked) map.addLayer(layer);
          else map.removeLayer(layer);
        });
      }
      if (e.target.id === "chkTitik") {
        markers.forEach(m => {
          if (e.target.checked) map.addLayer(m);
          else map.removeLayer(m);
        });
      }
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const lokasiPanel = document.getElementById('lokasi-panel');
    const panelTitle = document.getElementById('panel-title');
    const panelBody = document.getElementById('panel-body');
    const toggleBtn = document.getElementById('toggle-lokasi');
    const searchInput = document.getElementById('searchLokasi');
    const modalEls = document.querySelectorAll('.modal');

    // Data lokasi dari Blade → dijadikan array JS
    const lokasiData = [
      @foreach($lokasi as $l)
          {
          id: "{{ $l->id_tempat }}",
          nama: "{{ $l->nama }}",
          alamat: "{{ $l->alamat }}",
          gambar: "{{ asset('storage/' . $l->gambar) }}"
        },
      @endforeach
    ];

    let selectedLokasi = null;

    function renderLokasi(list) {
      let html = "";

      // Bagian "Pilihan Kamu" hanya tampil jika ada selectedLokasi
      if (selectedLokasi) {
        html += `
            <h6 class="fw-bold mb-2">Pilihan Kamu</h6>
            <div class="lokasi-item d-flex align-items-center justify-content-between p-2 border rounded mb-3">
                <div class="d-flex align-items-center">
                    <img src="${selectedLokasi.gambar}" alt="${selectedLokasi.nama}" 
                         class="me-2 rounded" style="width:60px; height:60px; object-fit:cover;">
                    <div>
                        <strong>${selectedLokasi.nama}</strong><br>
                        <small class="text-muted">${selectedLokasi.alamat}</small>
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <button class="btn btn-primary btn-sm d-flex align-items-center" 
                        data-bs-toggle="modal" data-bs-target="#modalEdit${selectedLokasi.id}">
                        <i class="bi bi-pencil-fill me-1"></i>Edit
                    </button>
                    <button class="btn btn-danger btn-sm d-flex align-items-center" 
                        data-bs-toggle="modal" data-bs-target="#modalDelete${selectedLokasi.id}">
                        <i class="bi bi-trash-fill me-1"></i>Hapus
                    </button>
                </div>
            </div>`;
      }

      // Bagian "Daftar Lokasi"
      html += `<h6 class="fw-bold mt-2 mb-2">Daftar Lokasi</h6>`;

      if (!list || list.length === 0) {
        html += `<p class="text-center text-muted my-3">Data tidak ditemukan</p>`;
      } else {
        html += `<div class="row">`;
        list.forEach(l => {
          html += `
                <div class="col-md-6 mb-2">
                    <div class="lokasi-item d-flex align-items-center justify-content-between p-2 border rounded h-100">
                        <div class="d-flex align-items-center">
                            <img src="${l.gambar}" alt="${l.nama}" 
                                class="me-2 rounded" style="width:60px; height:60px; object-fit:cover;">
                            <div>
                                <strong>${l.nama}</strong><br>
                                <small class="text-muted">${l.alamat}</small>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <button class="btn btn-primary btn-sm d-flex align-items-center" 
                                data-bs-toggle="modal" data-bs-target="#modalEdit${l.id}">
                                <i class="bi bi-pencil-fill me-1"></i>Edit
                            </button>
                            <button class="btn btn-danger btn-sm d-flex align-items-center" 
                                data-bs-toggle="modal" data-bs-target="#modalDelete${l.id}">
                                <i class="bi bi-trash-fill me-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>`;
        });
        html += `</div>`;
      }

      panelBody.innerHTML = html;
    }

    function closeLokasiPanel() {
      // Tutup panel dan reset pilihan
      lokasiPanel.classList.remove('show');
      selectedLokasi = null;
      // kembalikan daftar penuh
      renderLokasi(lokasiData);
    }

    document.addEventListener("DOMContentLoaded", function () {
      renderLokasi(lokasiData);

      // Toggle tombol Lokasi: buka atau tutup. Jika menutup → reset pilihan
      toggleBtn.addEventListener('click', function () {
        const willShow = !lokasiPanel.classList.contains('show');
        if (willShow) {
          lokasiPanel.classList.add('show');
          // render daftar (tanpa mengubah selectedLokasi)
          renderLokasi(lokasiData);
          // scroll to top agar "Pilihan Kamu" terlihat
          panelBody.scrollTop = 0;
        } else {
          closeLokasiPanel();
        }
      });

      // Saat mengetik di search → reset selectedLokasi supaya "Pilihan Kamu" hilang
      searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        selectedLokasi = null; // RESET !
        const hasil = lokasiData.filter(l =>
          (l.nama || "").toLowerCase().includes(keyword) ||
          (l.alamat || "").toLowerCase().includes(keyword)
        );
        renderLokasi(hasil);
      });

      // Jika modal dibuka, tutup panel dan reset pilihan
      modalEls.forEach(modal => {
        modal.addEventListener('show.bs.modal', () => {
          closeLokasiPanel();
        });
      });

      // Toasts
      var toastSuccess = document.getElementById('toastSuccess');
      if (toastSuccess) {
        var bsSuccess = new bootstrap.Toast(toastSuccess, { delay: 3000 });
        bsSuccess.show();
      }
      var toastError = document.getElementById('toastError');
      if (toastError) {
        var bsError = new bootstrap.Toast(toastError, { delay: 5000 });
        bsError.show();
      }
    });

    // Tambahkan marker dan eventnya
    @foreach($lokasi as $l)
      var marker = L.marker([{{ $l->latitude }}, {{ $l->longitude }}]).addTo(map);

      // Hover popup kecil
      marker.on('mouseover', function (e) {
        var popup = L.popup({ closeButton: false, offset: L.point(0, -10), autoPan: false })
          .setLatLng(e.latlng)
          .setContent(`<b>{{ $l->nama }}</b><br>{{ $l->alamat }}`)
          .openOn(map);
      });
      marker.on('mouseout', function () { map.closePopup(); });

      marker.on('click', function () {
        // Set pilihan berdasarkan marker yang diklik
        selectedLokasi = {
          id: "{{ $l->id_tempat }}",
          nama: "{{ $l->nama }}",
          alamat: "{{ $l->alamat }}",
          gambar: "{{ asset('storage/' . $l->gambar) }}"
        };
        // Buka panel dan render daftar + pilihan
        lokasiPanel.classList.add('show');
        renderLokasi(lokasiData);
        // Pastikan scroll ke atas (agar user langsung melihat "Pilihan Kamu")
        panelBody.scrollTop = 0;
      });
      markers.push(marker);
    @endforeach

    // Klik map → tutup panel & reset pilihan
    map.on('click', function () {
      closeLokasiPanel();
    });
  </script>

</body>

</html>