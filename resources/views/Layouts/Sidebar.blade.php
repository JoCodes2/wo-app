<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo py-3 px-4">
        <a href="/" class="app-brand-link d-flex align-items-center text-decoration-none">
            <span class="app-brand-logo demo d-flex align-items-center justify-content-center position-relative"
                style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.9);
                 border-radius: 12px; box-shadow: 0 8px 15px rgba(239, 91, 220, 0.1);">
                <div class="position-absolute top-0 start-0 w-100 h-100 border border-primary opacity-25 rounded-3">
                </div>
                <img src="{{ asset('assets/assets/img/woo.png') }}" alt="Logo" class="img-fluid position-relative z-1"
                    style="width: 32px; height: 32px; object-fit: contain;">
            </span>

            <span class="app-brand-text ms-3">
                <div class="lh-1">
                    <span class="brand-name fw-bolder text-uppercase"
                        style="font-size: 1.4rem; letter-spacing: -0.5px;
                         background: linear-gradient(45deg, #fc00b5, #f5cef2);
                         -webkit-background-clip: text;
                         -webkit-text-fill-color: transparent;">
                        WO<span style="font-weight: 300; -webkit-text-fill-color: #444;">-PLW</span>
                    </span>
                    <div class="d-flex align-items-center mt-1">
                        <span class="badge bg-primary-subtle text-primary border-0 rounded-pill px-2"
                            style="font-size: 0.6rem; letter-spacing: 1px; font-weight: 700; background: #e0e7ff;">
                            organizer
                        </span>
                    </div>
                </div>
            </span>
        </a>
    </div>

    <div class="menu-inner-shadow mt-3"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Utama</span>
        </li>
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon fa-solid fa-house"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>
        <li class="menu-item {{ request()->is('user*') ? 'active' : '' }}">
            <a href="/user" class="menu-link">
                <i class="menu-icon fa-solid fa-users"></i>
                <div data-i18n="User">Pengguna</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('kategori*') ? 'active' : '' }}">
            <a href="/kategori" class="menu-link">
                <i class="menu-icon fa-solid fa-tags"></i>
                <div data-i18n="Kategori">Kategori Layanan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('layanan*') ? 'active' : '' }}">
            <a href="/layanan" class="menu-link">
                <i class="menu-icon fa-solid fa-concierge-bell"></i>
                <div data-i18n="Layanan">Layanan</div>
            </a>
        </li>

    </ul>
</aside>
