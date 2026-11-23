
/* =========================================================
   JAVASCRIPT UTAMA
   DESA WISATA KABUPATEN CIAMIS
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    // Navbar berubah ketika halaman digulir
    const navbar = document.getElementById("navbar");

    function handleNavbar() {
        if (!navbar) return;

        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    }

    window.addEventListener("scroll", handleNavbar);
    handleNavbar();

    // Menutup menu navigasi mobile setelah menu diklik (abaikan dropdown toggle)
    const navLinks = document.querySelectorAll(
        ".navbar-collapse .nav-link, .navbar-collapse .dropdown-item"
    );

    const navbarCollapse = document.getElementById("navbarNav");

    navLinks.forEach(function (link) {
        link.addEventListener("click", function () {
            // JANGAN tutup jika yang diklik adalah dropdown toggle (misal: menu Akun atau Desa Wisata)
            if (
                link.classList.contains("dropdown-toggle") ||
                link.getAttribute("data-bs-toggle") === "dropdown" ||
                link.closest(".dropdown-toggle")
            ) {
                return;
            }

            if (
                !navbarCollapse ||
                !navbarCollapse.classList.contains("show")
            ) {
                return;
            }

            // Pastikan Bootstrap tersedia sebelum menggunakannya
            if (
                typeof bootstrap !== "undefined" &&
                bootstrap.Collapse
            ) {
                const bsCollapse =
                    bootstrap.Collapse.getInstance(navbarCollapse);

                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });
    });
});
