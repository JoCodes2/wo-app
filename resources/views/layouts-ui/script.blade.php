 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- Baris di bawah ini wajib ada untuk validasi extension file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('helpers/alert.js') }}"></script>
<script>
    // 1. Mobile menu - Tetap aman karena ID ini biasanya ada di setiap halaman
    const hamburger = document.getElementById('hamburger');
    const closeMenu = document.getElementById('closeMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');

    if (hamburger && closeMenu && mobileMenu && menuOverlay) {
        function openMenu() {
            mobileMenu.classList.add('open');
            menuOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function closeMobileMenu() {
            mobileMenu.classList.remove('open');
            menuOverlay.style.display = 'none';
            document.body.style.overflow = '';
        }

        hamburger.addEventListener('click', openMenu);
        closeMenu.addEventListener('click', closeMobileMenu);
        menuOverlay.addEventListener('click', closeMobileMenu);

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    }

    // 2. Scroll reveal - Hanya jalan jika ada elemen .section-fade
    const fadeElements = document.querySelectorAll('.section-fade');
    if (fadeElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12 });

        fadeElements.forEach(el => observer.observe(el));
    }

    // 3. Scroll to top - PERBAIKAN UTAMA
    const scrollTopBtn = document.getElementById('scrollTop');
    if (scrollTopBtn) { // Cek apakah tombol ada sebelum memasang event listener
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
</script>
