 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
    integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <script>
    // Mobile menu
    const hamburger = document.getElementById('hamburger');
    const closeMenu = document.getElementById('closeMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');

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

    // Close menu on nav link click
    mobileMenu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMobileMenu));

    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));

    // Scroll to top
    const scrollTopBtn = document.getElementById('scrollTop');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 400) scrollTopBtn.classList.add('show');
      else scrollTopBtn.classList.remove('show');
    });
  </script>
