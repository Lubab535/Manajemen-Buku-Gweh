/* Catatan: JavaScript template Clean Blog disederhanakan agar tidak menambahkan perilaku scroll yang tidak dipakai. */
window.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('mainNav');
    if (!navbar) return;

    // Navbar Bootstrap tetap responsif tanpa manipulasi posisi saat pengguna menggulir halaman.
    navbar.classList.remove('is-fixed', 'is-visible');
});
