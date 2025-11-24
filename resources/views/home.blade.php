@extends('layouts.app')

@section('title', 'Ngemil Spot GIS')

@section('content')
    @include('layouts.navbar')
    
    <div id="map"></div>
@endsection

@section('scripts')
<script>
    // Inisialisasi peta
    var map = L.map('map', {
        center: [-0.8700, 119.8707],
        zoom: 13,
        minZoom: 11,
        maxZoom: 19,
        maxBounds: [
            [-0.9700, 119.7900],
            [-0.6600, 119.9800]
        ],
        maxBoundsViscosity: 1.0
    });

    // Layer management
    var layerJalan;
    var layerKecamatan = {};

    // Data kecamatan
    var kecamatanLayers = [
        { file: "Mantikulore.geojson", color: "#ff4d4d" },
        { file: "Palu Barat.geojson", color: "#4d79ff" },
        { file: "Palu Selatan.geojson", color: "#ffb84d" },
        { file: "Palu Timur.geojson", color: "#66cc66" },
        { file: "Palu Utara.geojson", color: "#9933ff" },
        { file: "Tatanga.geojson", color: "#ff66b2" },
        { file: "Tawaeli.geojson", color: "#33cccc" },
        { file: "Ulujadi.geojson", color: "#999966" }
    ];

    // Load layer kecamatan
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

    // Load layer jalan
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
            layerJalan.addTo(map);
        });

    // === BUAT PANEL LEGENDA ===
    var legend = L.control({ position: "topleft" });

    legend.onAdd = function () {
        var div = L.DomUtil.create("div", "legend bg-white p-3 rounded shadow");

        div.innerHTML = `
            <h6 class="fw-bold mb-2">Layer</h6>
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
    
    // Tambahkan legenda ke peta
    var legendPanel = legend.addTo(map);
    
    // === TOGGLE LEGENDA ===
    var legendToggleBtn = document.getElementById('legendToggleBtn');
    var isLegendVisible = true;
    
    legendToggleBtn.addEventListener('click', function() {
        if (isLegendVisible) {
            map.removeControl(legendPanel);
            legendToggleBtn.innerHTML = '>';
            isLegendVisible = false;
        } else {
            legendPanel = legend.addTo(map);
            legendToggleBtn.innerHTML = '<';
            isLegendVisible = true;
        }
    });

    // Event listener untuk toggle layer
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

    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Detail panel elements
    var detailContainer = document.getElementById('detail-container');
    var namaEl = document.getElementById('detail-nama');
    var alamatEl = document.getElementById('detail-alamat');
    var jamEl = document.getElementById('detail-jam');
    var gambarEl = document.getElementById('detail-gambar');
    var deskripsiEl = document.getElementById('detail-deskripsi');
    var hotlinkEl = document.getElementById('detail-hotlink');
    var ruteEl = document.getElementById('detail-rute');

    var markers = [];

    // Tambahkan marker untuk setiap lokasi
    @foreach($lokasi as $l)
        var marker = L.marker([{{ $l->latitude }}, {{ $l->longitude }}]).addTo(map);

        marker.data = {
            nama: "{{ $l->nama }}",
            alamat: "{{ $l->alamat }}",
            jam: "{{ $l->jam_operasional }}",
            gambar: "{{ asset('storage/' . $l->gambar) }}",
            deskripsi: "{{ $l->deskripsi }}",
            hotlink: "{{ $l->hotlink }}",
            lat: {{ $l->latitude }},
            lng: {{ $l->longitude }}
        };

        marker.on('click', function () {
            map.flyTo([this.data.lat, this.data.lng], 16, { duration: 0.5 });

            namaEl.innerText = decodeHTML(this.data.nama);
            alamatEl.innerText = this.data.alamat;
            jamEl.innerText = this.data.jam;
            gambarEl.src = this.data.gambar;
            deskripsiEl.innerText = this.data.deskripsi;
            hotlinkEl.href = this.data.hotlink;
            hotlinkEl.innerText = this.data.hotlink;
            ruteEl.href = "https://www.google.com/maps/dir/?api=1&destination=" + this.data.lat + "," + this.data.lng;

            detailContainer.classList.add('show');
        });

        marker.on('mouseover', function (e) {
            var popup = L.popup({ closeButton: false, offset: L.point(0, -10), autoPan: false })
                .setLatLng(e.latlng)
                .setContent(`
                    <div style="animation: popupZoom 0.3s ease;">
                        <b>${this.data.nama}</b><br>
                        ${this.data.alamat}<br>
                        <i>${this.data.deskripsi}</i>
                    </div>
                `)
                .openOn(map);
        });
        marker.on('mouseout', function () { map.closePopup(); });

        markers.push(marker);
    @endforeach

    // Helper function untuk decode HTML entities
    function decodeHTML(html) {
        const txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }

    // Fungsi pencarian
    var searchInput = document.getElementById('search-bar');
    searchInput.addEventListener('input', function () {
        var query = this.value.toLowerCase();
        markers.forEach(function (m) {
            if (m.data.nama.toLowerCase().includes(query)) {
                if (!map.hasLayer(m)) map.addLayer(m);
            } else {
                if (map.hasLayer(m)) map.removeLayer(m);
            }
        });
    });

    // Tutup detail panel saat klik di peta
    map.on('click', function () {
        detailContainer.classList.remove('show');
    });
</script>
@endsection