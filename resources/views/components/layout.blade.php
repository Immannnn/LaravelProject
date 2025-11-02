<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Compact Sidebar' }}</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

  <style>
    body {
      background-color: #f6f7fb;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      margin: 0;
    }

    /* ===== SIDEBAR ===== */
    #sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 80px;
      background-color: #111;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
      transition: width 0.3s ease, left 0.3s ease;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      overflow: hidden;
    }

    /* Expand on hover (desktop only) */
    #sidebar:hover {
      width: 230px;
    }

    /* ===== LOGO ===== */
    .sidebar-logo {
      text-align: center;
      padding: 20px 0;
    }

    .sidebar-logo img {
      width: 35px;
      transition: transform 0.6s ease;
      filter: brightness(0) invert(1);
    }

    #sidebar:hover .sidebar-logo img {
      transform: rotate(360deg);
    }

    /* ===== MENU ===== */
    .menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .menu a {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #ccc;
      padding: 15px 20px;
      border-left: 3px solid transparent;
      transition: all 0.3s ease;
      font-weight: 500;
      white-space: nowrap;
    }

    .menu a:hover {
      background-color: #222;
      color: #fff;
      border-left: 3px solid #e91e63;
    }

    .menu a i {
      font-size: 1.3rem;
      width: 40px;
      text-align: center;
      color: #bbb;
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .menu a:hover i {
      transform: scale(1.2);
      color: #e91e63;
    }

    .menu a span {
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease;
    }

    #sidebar:hover .menu a span {
      opacity: 1;
      visibility: visible;
    }

    /* ===== LOGOUT ===== */
    .logout {
      border-top: 1px solid #333;
      padding: 15px 20px;
    }

    .logout a {
      color: #e91e63;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
    }

    .logout a span {
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease;
    }

    #sidebar:hover .logout a span {
      opacity: 1;
      visibility: visible;
    }

    /* ===== FIXED HEADER ===== */
    #header {
      position: fixed;
      top: 0;
      left: 80px;
      right: 0;
      height: 70px;
      background-color: #fff;
      border-bottom: 1px solid #ddd;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      z-index: 900;
      transition: left 0.3s ease;
    }

    #sidebar:hover ~ #header {
      left: 230px;
    }

    /* ===== MAIN CONTENT ===== */
    #content {
      margin-top: 70px;
      margin-left: 80px;
      transition: margin-left 0.3s ease;
      padding: 20px;
    }

    #sidebar:hover ~ #content {
      margin-left: 230px;
    }

    /* ===== MOBILE ===== */
    @media (max-width: 768px) {
      #sidebar {
        left: -230px;
        width: 230px;
      }

      #sidebar.active {
        left: 0;
      }

      /* HEADER stays fixed and never shifts */
      #header {
        left: 0 !important;
        right: 0;
        height: 60px;
        transition: none !important;
      }

      #content {
        margin-left: 0 !important;
        margin-top: 60px;
        transition: none !important;
      }

      /* TOGGLE BUTTON */
      #menu-toggle {
        position: fixed;
        top: 10px;
        left: 10px;
        font-size: 1.3rem;
        color: #000;
        background: #fff;
        border: none;
        border-radius: 6px;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
        z-index: 1100;
        cursor: pointer;
        padding: 6px 10px;
        transition: all 0.3s ease;
      }

      #menu-toggle.active {
        background: #000;
        color: #fff;
      }

      #menu-toggle:active {
        opacity: 0.8;
      }

      /* Always show text when sidebar active */
      #sidebar.active .menu a span,
      #sidebar.active .logout a span {
        opacity: 1;
        visibility: visible;
      }

      /* Disable hover expand on mobile */
      #sidebar:hover {
        width: 230px;
      }

      .sidebar-logo img {
        transform: none !important;
      }
    }
    @media (max-width: 768px) {
  /* existing mobile styles... */

  /* ===== FIX FOR HEADER LOGO IN MOBILE ===== */
  #header img {
    width: 150px !important;   /* mas maliit para kasya sa mobile */
    height: auto !important;   /* para proportionate */
    object-fit: contain;       /* para di ma-distort */
  }

  #header {
    justify-content: center !important;  /* para nasa gitna */
    padding: 5px 10px !important;
  }
}

  </style>
</head>
<body>

  <button id="menu-toggle" class="d-md-none"><i class="fa-solid fa-bars"></i></button>

  <!-- SIDEBAR -->
  <div id="sidebar">
    <div>
      <div class="sidebar-logo">
        <img src="https://cdn-icons-png.flaticon.com/512/857/857681.png" alt="Logo">
      </div>

      <ul class="menu mt-3">
        <li><a href="#"><i class="fa-solid fa-house me-2"></i><span> Home</span></a></li>
        <li><a href="#"><i class="fa-solid fa-chart-line me-2"></i><span> Dashboard</span></a></li>
        <li><a href="#"><i class="fa-solid fa-envelope me-2"></i><span> Messages</span></a></li>
        <li><a href="#"><i class="fa-solid fa-file-invoice-dollar me-2"></i><span> Bills</span></a></li>
        <li><a href="#"><i class="fa-solid fa-gear me-2"></i><span> Settings</span></a></li>
      </ul>
    </div>

    <div class="logout">
      <a href="#"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a>
    </div>
  </div>

  <!-- FIXED HEADER -->
  <div id="header" class="d-flex align-items-center justify-content-between px-3">
  <div class="d-flex align-items-center gap-2">
  <img src="{{asset("storage/Logo.png")}}" class="img-fluid" style="width: 230px; height:70px;" alt="Logo" id="header-logo">
  </div>
</div>

  <!-- CONTENT AREA -->
  <div id="content">
    {{ $slot }}
  </div>

  <script>
    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const menuLinks = sidebar.querySelectorAll('a');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      toggleBtn.classList.toggle('active');
    });

    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        sidebar.classList.remove('active');
        toggleBtn.classList.remove('active');
      });
    });
  </script>

</body>
</html>
