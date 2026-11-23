const fs = require('fs');
const { destinationDetails } = require('./destination_details.js');

const originalJs = fs.readFileSync('public/js/destinasi.js', 'utf8');

// Parse the original desaWisataData
const match = originalJs.match(/const desaWisataData = (\[[\s\S]*?\]);\s*\/\/\s*Alias/);
if (!match) {
  console.error("Could not find desaWisataData");
  process.exit(1);
}

const originalData = eval(match[1]);

// Enrich originalData with per-destination deskripsi and fasilitas
const enrichedData = originalData.map(item => {
  const enrichedDest = item.destinasi.map(dName => {
    const detail = destinationDetails[dName] || {
      deskripsi: `Destinasi ${dName} menawarkan keindahan alam dan potensi wisata unggulan khas pedesaan Kabupaten Ciamis.`,
      fasilitas: ["Area Parkir", "Toilet", "Spot Foto", "Warung Kuliner"]
    };
    return {
      nama: dName,
      deskripsi: detail.deskripsi,
      fasilitas: detail.fasilitas
    };
  });

  return {
    ...item,
    destinasi: enrichedDest
  };
});

// Construct new code
const newJs = `/* =========================================================
   DATA DESA WISATA & KELOMPOK DESTINASI KABUPATEN CIAMIS
   Berdasarkan Surat Keputusan (SK) Data Desa Wisata 2020 - 2023
   Setiap desa wisata memiliki kelompok potensi destinasi wisata
   dengan deskripsi spesifik dan fasilitas lengkap per destinasi.
========================================================= */

const desaWisataData = ${JSON.stringify(enrichedData, null, 2)};

// Alias untuk kompatibilitas jika ada kode lama yang merujuk destinations
const destinations = desaWisataData;

/* =========================================================
   HELPER DESTINASI
========================================================= */

function getDestName(d) {
  if (!d) return "";
  return typeof d === "object" && d.nama ? d.nama : String(d);
}

function getDestDesc(d, fallback) {
  if (typeof d === "object" && d.deskripsi) return d.deskripsi;
  return fallback || "";
}

function getDestFacilities(d) {
  if (typeof d === "object" && Array.isArray(d.fasilitas)) return d.fasilitas;
  return ["Area Parkir", "Toilet", "Spot Foto", "Warung Kuliner"];
}

/* =========================================================
   ELEMENT HTML
========================================================= */

const destinationContainer = document.getElementById("destinationContainer");
const resultCount = document.getElementById("resultCount");
const totalDestCount = document.getElementById("totalDestCount");
const emptyResult = document.getElementById("emptyResult");
const searchInput = document.getElementById("searchDesaInput");
const desaFilter = document.getElementById("desaFilter") || document.getElementById("kecamatanFilter");
const kecamatanFilter = desaFilter;
const statusFilter = document.getElementById("statusFilter");
const categoryFilter = document.getElementById("categoryFilter");
const viewModeGrid = document.getElementById("viewModeGrid");
const viewModeList = document.getElementById("viewModeList");

let currentViewMode = "grid"; // 'grid' atau 'grouped'
let activeCategory = "Semua";
let activeDesa = "Semua";
let activeKecamatan = "Semua";
let activeStatus = "Semua";
let searchQuery = "";

/* =========================================================
   HELPER RESOLVE ASSET URL
========================================================= */

function resolveAsset(path) {
  if (!path) return (window.appBaseUrl || '/') + 'pictures/LogoDispar.png';
  if (path.startsWith('http://') || path.startsWith('https://')) return path;
  var base = window.appBaseUrl || '/';
  if (!base.endsWith('/')) base += '/';
  return base + path.replace(/^\\/+/, '');
}

/* =========================================================
   ICON KATEGORI
========================================================= */

function getCategoryIcon(category) {
  if (category === "Alam") return "bi-tree-fill";
  if (category === "Buatan") return "bi-building";
  return "bi-bank";
}

/* =========================================================
   BUAT KARTU DESA WISATA (GRID VIEW)
   Menampilkan deskripsi dan fasilitas per destinasi
========================================================= */

function createDesaCard(desaItem) {
  const column = document.createElement("div");
  column.className = "col-lg-6 col-md-12 mb-4";

  const totalDest = desaItem.destinasi.length;
  const isBerkembang = desaItem.status === "Berkembang";

  // Badges status desa wisata (Berkembang / Rintisan)
  const statusBadgeHtml = isBerkembang
    ? \`<span class="desa-status-badge status-berkembang"><i class="bi bi-patch-check-fill me-1"></i>Berkembang</span>\`
    : \`<span class="desa-status-badge status-rintisan"><i class="bi bi-clock-history me-1"></i>Rintisan</span>\`;

  // Render detail per destinasi (Nama, Deskripsi Destinasi, Fasilitas)
  const destinasiBoxesHtml = desaItem.destinasi
    .map((dest, idx) => {
      const dName = getDestName(dest);
      const dDesc = getDestDesc(dest, desaItem.deskripsi);
      const dFacilities = getDestFacilities(dest);

      const fasBadges = dFacilities
        .map(f => \`<span class="badge bg-white text-secondary border fw-normal py-1 px-2 me-1 mb-1" style="font-size: 11.5px;"><i class="bi bi-check-circle-fill text-success me-1"></i>\${f}</span>\`)
        .join("");

      return \`
        <div class="desa-dest-box p-3 mb-2 rounded-3 bg-white border shadow-xs">
          <div class="d-flex align-items-center justify-content-between mb-1 flex-wrap gap-1">
            <span class="fw-bold text-dark dest-item-title" style="font-size: 14.5px;">
              <i class="bi bi-geo-alt-fill text-success me-1"></i>\${dName}
            </span>
            <span class="badge bg-success-subtle text-success small" style="font-size: 11px;">
              Destinasi \${idx + 1}
            </span>
          </div>
          <p class="text-secondary small mb-2 dest-item-desc" style="font-size: 12.5px; line-height: 1.6;">
            \${dDesc}
          </p>
          <div class="dest-facilities-wrap d-flex flex-wrap align-items-center pt-1 border-top border-light">
            <span class="text-muted small me-2" style="font-size: 11px; font-weight: 600;">
              <i class="bi bi-stars text-warning me-1"></i>Fasilitas:
            </span>
            \${fasBadges}
          </div>
        </div>
      \`;
    })
    .join("");

  column.innerHTML = \`
    <div class="destination-card h-100 desa-wisata-card shadow-sm">
      <div class="destination-image position-relative">
        <img
          src="\${resolveAsset(desaItem.gambar)}"
          alt="Desa Wisata \${desaItem.desa}"
          loading="lazy"
          onerror="this.onerror=null; this.src='\${resolveAsset('pictures/LogoDispar.png')}';"
        >

        <span class="destination-category">
          <i class="bi \${getCategoryIcon(desaItem.kategori)}"></i>
          \${desaItem.kategori}
        </span>

        \${statusBadgeHtml}
      </div>

      <div class="destination-card-body">
        <span class="destination-location">
          <i class="bi bi-geo-alt-fill"></i>
          Desa \${desaItem.desa}, Kecamatan \${desaItem.kecamatan}
        </span>

        <h3 class="desa-title">Desa Wisata \${desaItem.desa}</h3>

        <div class="desa-sk-badge mb-2">
          <i class="bi bi-file-earmark-text text-secondary me-1"></i>
          <span>SK: \${desaItem.sk}</span>
        </div>

        <p class="desa-desc">\${desaItem.deskripsi}</p>

        <!-- KELOMPOK DESTINASI DI DESA INI (DETAIL PER DESTINASI + FASILITAS) -->
        <div class="desa-grouped-destinasi">
          <div class="desa-grouped-header d-flex justify-content-between align-items-center mb-2">
            <span>
              <i class="bi bi-collection-fill text-success me-1"></i>
              Destinasi & Fasilitas di Desa Ini:
            </span>
            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
              \${totalDest} Destinasi
            </span>
          </div>
          <div class="desa-destinasi-boxes-wrap">
            \${destinasiBoxesHtml}
          </div>
        </div>

        <div class="destination-card-footer mt-auto pt-3">
          <a href="\${resolveAsset(desaItem.detail)}" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
            <span>Lihat Profil Desa Wisata</span>
            <i class="bi bi-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  \`;

  return column;
}

/* =========================================================
   BUAT TAMPILAN TERKELOMPOK / DAFTAR LENGKAP (GROUPED VIEW)
   Menampilkan deskripsi & fasilitas per destinasi
========================================================= */

function createGroupedDesaRow(desaItem) {
  const column = document.createElement("div");
  column.className = "col-12 mb-4";

  const totalDest = desaItem.destinasi.length;
  const isBerkembang = desaItem.status === "Berkembang";

  const destItemsListHtml = desaItem.destinasi
    .map((dest, idx) => {
      const dName = getDestName(dest);
      const dDesc = getDestDesc(dest, desaItem.deskripsi);
      const dFacilities = getDestFacilities(dest);

      const fasBadges = dFacilities
        .map(f => \`<span class="badge bg-white text-secondary border fw-normal py-1 px-2 me-1 mb-1" style="font-size: 11.5px;"><i class="bi bi-check-circle-fill text-success me-1"></i>\${f}</span>\`)
        .join("");

      return \`
        <div class="grouped-dest-item p-3 mb-2 rounded-3 bg-light border">
          <div class="d-flex align-items-center justify-content-between mb-1 flex-wrap gap-1">
            <div class="d-flex align-items-center">
              <span class="badge bg-success text-white me-2 px-2 py-1 rounded-circle font-monospace">\${idx + 1}</span>
              <strong class="text-dark" style="font-size: 14.5px;">\${dName}</strong>
            </div>
            <span class="badge bg-white text-secondary border">
              <i class="bi bi-pin-map me-1 text-success"></i>Desa \${desaItem.desa}
            </span>
          </div>
          <p class="text-secondary small mb-2" style="font-size: 12.5px; line-height: 1.55;">\${dDesc}</p>
          <div class="d-flex flex-wrap align-items-center pt-1">
            <span class="text-muted small me-2" style="font-size: 11px; font-weight: 600;">
              <i class="bi bi-stars text-warning me-1"></i>Fasilitas:
            </span>
            \${fasBadges}
          </div>
        </div>
      \`;
    })
    .join("");

  column.innerHTML = \`
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden grouped-desa-card">
      <div class="card-body p-4">
        <div class="row align-items-start">
          <div class="col-lg-3 col-md-4 mb-3 mb-md-0">
            <div class="rounded-3 overflow-hidden position-relative" style="height: 220px;">
              <img
                src="\${resolveAsset(desaItem.gambar)}"
                alt="Desa Wisata \${desaItem.desa}"
                class="w-100 h-100 object-fit-cover"
                onerror="this.onerror=null; this.src='\${resolveAsset('pictures/LogoDispar.png')}';"
              >
              <span class="badge bg-dark bg-opacity-75 position-absolute top-0 start-0 m-2">
                <i class="bi \${getCategoryIcon(desaItem.kategori)} me-1"></i>\${desaItem.kategori}
              </span>
              <span class="badge \${isBerkembang ? 'bg-success' : 'bg-info text-dark'} position-absolute top-0 end-0 m-2">
                \${desaItem.status}
              </span>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-8 mb-3 mb-lg-0">
            <span class="text-success small fw-bold text-uppercase d-block mb-1">
              <i class="bi bi-geo-alt-fill me-1"></i>Kecamatan \${desaItem.kecamatan}, Ciamis
            </span>
            <h4 class="fw-bold mb-1 text-dark">Desa Wisata \${desaItem.desa}</h4>
            <div class="text-muted small mb-2">
              <i class="bi bi-file-earmark-check me-1"></i>SK: <strong>\${desaItem.sk}</strong>
              <span class="ms-2 badge \${isBerkembang ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info-emphasis'} rounded-pill">
                \${desaItem.status}
              </span>
            </div>
            <p class="text-muted small mb-3">\${desaItem.deskripsi}</p>
            <a href="\${resolveAsset(desaItem.detail)}" class="btn btn-outline-success btn-sm rounded-pill px-3">
              Kunjungi Profil Desa <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>

          <div class="col-lg-5 col-12">
            <div class="p-3 bg-white rounded-3 border">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="small text-muted fw-bold text-uppercase">Destinasi & Fasilitas:</span>
                <span class="badge bg-success rounded-pill">\${totalDest} Destinasi</span>
              </div>
              <div class="grouped-dest-list-wrap">
                \${destItemsListHtml}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  \`;

  return column;
}

/* =========================================================
   TAMPILKAN DATA
========================================================= */

function renderDesaWisata(data) {
  if (!destinationContainer) return;

  destinationContainer.innerHTML = "";

  if (data.length === 0) {
    if (emptyResult) emptyResult.style.display = "block";
    if (resultCount) resultCount.textContent = "0";
    if (totalDestCount) totalDestCount.textContent = "0";
    return;
  }

  if (emptyResult) emptyResult.style.display = "none";

  const totalDestinasiFound = data.reduce(
    (acc, curr) => acc + (curr.destinasi ? curr.destinasi.length : 1),
    0
  );

  if (resultCount) resultCount.textContent = data.length;
  if (totalDestCount) totalDestCount.textContent = totalDestinasiFound;

  data.forEach((desaItem) => {
    if (currentViewMode === "grid") {
      destinationContainer.appendChild(createDesaCard(desaItem));
    } else {
      destinationContainer.appendChild(createGroupedDesaRow(desaItem));
    }
  });
}

/* =========================================================
   FILTER DAN PENCARIAN
========================================================= */

function filterDesaWisata() {
  const query = searchQuery.trim().toLowerCase();

  const filtered = desaWisataData.filter((item) => {
    // 1. Kategori
    const matchCategory =
      activeCategory === "Semua" || item.kategori === activeCategory;

    // 2. Desa
    const matchDesa =
      activeDesa === "Semua" || item.desa === activeDesa;

    // 3. Status (Berkembang / Rintisan)
    const matchStatus =
      activeStatus === "Semua" || item.status === activeStatus;

    // 4. Pencarian Teks
    let matchSearch = true;
    if (query !== "") {
      const matchNamaDesa = item.desa.toLowerCase().includes(query);
      const matchKecamatan = item.kecamatan.toLowerCase().includes(query);
      const matchKategori = item.kategori.toLowerCase().includes(query);
      const matchSK = item.sk ? item.sk.toLowerCase().includes(query) : false;
      const matchDeskripsi = item.deskripsi.toLowerCase().includes(query);

      const matchDestinasi = item.destinasi.some((d) => {
        const dName = getDestName(d).toLowerCase();
        const dDesc = getDestDesc(d, "").toLowerCase();
        const dFac = getDestFacilities(d).join(" ").toLowerCase();
        return dName.includes(query) || dDesc.includes(query) || dFac.includes(query);
      });

      matchSearch =
        matchNamaDesa ||
        matchKecamatan ||
        matchKategori ||
        matchSK ||
        matchDestinasi ||
        matchDeskripsi;
    }

    return matchCategory && matchDesa && matchStatus && matchSearch;
  });

  renderDesaWisata(filtered);
}

/* =========================================================
   POPULATE DROPDOWN DESA FILTER
========================================================= */

function populateDesaFilter() {
  if (!desaFilter) return;

  const desaSet = new Set();
  desaWisataData.forEach((d) => desaSet.add(d.desa));
  const sortedDesa = Array.from(desaSet).sort((a, b) => a.localeCompare(b));

  sortedDesa.forEach((desaName) => {
    const opt = document.createElement("option");
    opt.value = desaName;
    opt.textContent = \`Desa \${desaName}\`;
    desaFilter.appendChild(opt);
  });
}

/* =========================================================
   EVENT LISTENERS
========================================================= */

document.addEventListener("DOMContentLoaded", function () {
  populateDesaFilter();

  // Cek parameter kategori dari URL
  const urlParams = new URLSearchParams(window.location.search);
  const kategoriParam = urlParams.get("kategori");
  if (kategoriParam && ["Alam", "Buatan", "Sejarah & Budaya"].includes(kategoriParam)) {
    activeCategory = kategoriParam;
  }

  // Tampilkan data awal
  filterDesaWisata();

  // Search input
  if (searchInput) {
    searchInput.addEventListener("input", function (e) {
      searchQuery = e.target.value;
      filterDesaWisata();
    });
  }

  // Desa filter
  if (desaFilter) {
    desaFilter.addEventListener("change", function (e) {
      activeDesa = e.target.value;
      filterDesaWisata();
    });
  }

  // Status filter
  if (statusFilter) {
    statusFilter.addEventListener("change", function (e) {
      activeStatus = e.target.value;
      filterDesaWisata();
    });
  }

  // Category pills
  const categoryPills = document.querySelectorAll("[data-category-filter]");
  categoryPills.forEach((btn) => {
    btn.addEventListener("click", function () {
      categoryPills.forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
      activeCategory = this.getAttribute("data-category-filter");
      filterDesaWisata();
    });
  });

  // Toggle View Mode (Grid vs Grouped)
  if (viewModeGrid && viewModeList) {
    viewModeGrid.addEventListener("click", function () {
      viewModeGrid.classList.add("active");
      viewModeList.classList.remove("active");
      currentViewMode = "grid";
      filterDesaWisata();
    });

    viewModeList.addEventListener("click", function () {
      viewModeList.classList.add("active");
      viewModeGrid.classList.remove("active");
      currentViewMode = "grouped";
      filterDesaWisata();
    });
  }
});
`;

fs.writeFileSync('public/js/destinasi.js', newJs, 'utf8');
console.log('Successfully generated public/js/destinasi.js with enriched destination data!');
