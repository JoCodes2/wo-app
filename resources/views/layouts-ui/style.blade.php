  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['"Playfair Display"', 'serif'],
            body: ['"DM Sans"', 'sans-serif'],
          },
          colors: {
            blush: {
              50:  '#fdf5f5',
              100: '#fce8e8',
              200: '#f8d0d0',
              300: '#f2aaaa',
              400: '#e87b7b',
              500: '#d95555',
              600: '#c23d3d',
              700: '#a32f2f',
              800: '#7c2323',
            },
            rose: {
              warm: '#b56b5e',
              deep: '#8b4a3e',
            },
            cream: '#fdf8f5',
            parchment: '#f5ede6',
          },
          backgroundImage: {
            'hero-gradient': 'linear-gradient(135deg, #fce8e8 0%, #fdf5f5 50%, #fce4d6 100%)',
            'card-gradient': 'linear-gradient(145deg, #ffffff 0%, #fdf5f5 100%)',
          },
          animation: {
            'fade-up': 'fadeUp 0.7s ease-out forwards',
            'fade-in': 'fadeIn 0.5s ease-out forwards',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-10px)' },
            },
          },
        }
      }
    }
  </script>
  <style>
    body { font-family: 'DM Sans', sans-serif; background-color: #fdf8f5; }
    .font-display { font-family: 'Playfair Display', serif; }
    .hero-bg {
      background: linear-gradient(135deg, #fce8e8 0%, #fdf5f5 55%, #fce4d6 100%);
    }
    .petal-dot {
      width: 6px; height: 6px;
      border-radius: 50%;
      background: #d95555;
      display: inline-block;
    }
    .card-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(185, 90, 80, 0.12);
    }
    .btn-primary {
      background: #a03d32;
      color: white;
      transition: background 0.2s, transform 0.15s;
    }
    .btn-primary:hover {
      background: #7c2e24;
      transform: translateY(-1px);
    }
    .section-fade {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    .section-fade.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .nav-link { position: relative; }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px; left: 0;
      width: 0; height: 1.5px;
      background: #a03d32;
      transition: width 0.25s ease;
    }
    .nav-link:hover::after, .nav-link.active::after { width: 100%; }
    .hero-img-frame {
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 24px 60px rgba(160, 61, 50, 0.18);
    }
    .badge-pill {
      background: rgba(160, 61, 50, 0.1);
      border: 1px solid rgba(160, 61, 50, 0.2);
      color: #a03d32;
      font-size: 0.78rem;
      font-weight: 500;
      padding: 4px 14px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .stat-card {
      text-align: center;
    }
    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      font-weight: 700;
      color: #a03d32;
      line-height: 1.1;
    }
    .wo-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .wo-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 48px rgba(160, 61, 50, 0.14);
    }
    .rating-stars { color: #d97706; }
    .tag {
      background: #fce8e8;
      color: #a03d32;
      font-size: 0.7rem;
      font-weight: 600;
      padding: 2px 10px;
      border-radius: 999px;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
    .mobile-menu-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.4);
      z-index: 40;
    }
    .mobile-menu {
      position: fixed;
      top: 0; right: -100%;
      width: 280px; height: 100%;
      background: white;
      z-index: 50;
      transition: right 0.35s ease;
      padding: 2rem 1.5rem;
      box-shadow: -4px 0 30px rgba(0,0,0,0.1);
    }
    .mobile-menu.open { right: 0; }
    .divider-rose {
      height: 1px;
      background: linear-gradient(to right, transparent, #e8c4bc, transparent);
    }
    .testimonial-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.06);
      position: relative;
    }
    .testimonial-card::before {
      content: '"';
      font-family: 'Playfair Display', serif;
      font-size: 5rem;
      color: #f2aaaa;
      position: absolute;
      top: -10px; left: 20px;
      line-height: 1;
    }
    .scroll-top {
      position: fixed;
      bottom: 24px; right: 24px;
      width: 44px; height: 44px;
      background: #a03d32;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(160,61,50,0.4);
      opacity: 0;
      transform: translateY(10px);
      transition: opacity 0.3s, transform 0.3s;
      z-index: 99;
    }
    .scroll-top.show { opacity: 1; transform: translateY(0); }
  </style>
