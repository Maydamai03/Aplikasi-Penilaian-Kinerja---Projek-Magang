<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        * {
        box-sizing: border-box;
    }
        :root {
            --sidebar-bg: #fdfbf1;
            --main-bg: #242424;
            --card-bg: #fdfbf1;
            --text-light: #f0f0f0;
            --text-dark: #1e1e1e;
            --accent-color: #8B0000;
            --sidebar-width: 250px; /* Variabel untuk lebar sidebar */
        }
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--main-bg);
            color: var(--text-light);
            display: flex;
        }
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            padding: 20px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-dark);
            position: fixed;
            z-index: 20;
            /* Transisi untuk animasi hide/show */
            transform: translateX(0);
            transition: transform 0.3s ease-in-out;
        }
        .sidebar .logo {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }
        .sidebar .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .sidebar .logo span {
            font-weight: 700;
            font-size: 1.2rem;
        }
        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }
        .sidebar nav li a {
            display: flex;
            align-items: center;
            padding: 15px;
            text-decoration: none;
            color: var(--text-dark);
            border-radius: 8px;
            margin-bottom: 10px;
            font-weight: 500;
        }
        .sidebar nav li a.active, .sidebar nav li a:hover {
            background-color: var(--accent-color);
            color: var(--text-light);
        }
        .sidebar nav li a i {
            margin-right: 15px;
            width: 20px;
        }
        .main-content {
            flex: 1;
            padding: 30px 60px;
            margin-left: var(--sidebar-width); /* Memberi ruang untuk sidebar */
            /* Transisi untuk animasi geser konten */
            transition: margin-left 0.3s ease-in-out;
        }
        .header {
            display: flex;
            justify-content: space-between; /* Ubah dari flex-end */
            align-items: center;
            margin-bottom: 30px;
        }

        /* CSS BARU UNTUK TOGGLE SIDEBAR */
        .header .sidebar-toggle {
            font-size: 1.5rem;
            cursor: pointer;
        }
        /* Style saat sidebar disembunyikan */
        body.sidebar-toggled .sidebar {
            transform: translateX(calc(-1 * var(--sidebar-width)));
        }
        body.sidebar-toggled .main-content {
            margin-left: 0;
        }
        /* AKHIR CSS TOGGLE SIDEBAR */

        /* CSS DROPDOWN (Sama seperti sebelumnya) */
        .user-dropdown {
            position: relative;
        }
        .user-info {
            display: flex;
            align-items: center;
            font-weight: 500;
            cursor: pointer;
            padding: 5px;
            border-radius: 8px;
        }
        .user-info:hover {
            background-color: #333;
        }
        .user-info i {
            font-size: 1.5rem;
            margin-left: 15px;
            background-color: var(--sidebar-bg);
            color: var(--text-dark);
            padding: 8px;
            border-radius: 50%;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: var(--sidebar-bg);
            color: var(--text-dark);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 150px;
            z-index: 10;
        }
        .dropdown-menu.show { display: block; }
        .dropdown-menu a {
            color: var(--text-dark); padding: 12px 15px; text-decoration: none;
            display: flex; align-items: center; font-size: 14px;
        }
        .dropdown-menu a:hover { background-color: #f0f0f0; }
        .dropdown-menu a i { margin-right: 10px; }

        /* CSS MODAL (Sama seperti sebelumnya) */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.7); justify-content: center; align-items: center; z-index: 100;
        }
        .modal-overlay.show { display: flex; }
        .modal-box { background: var(--sidebar-bg); color: var(--text-dark); padding: 30px;
            border-radius: 15px; text-align: center; max-width: 350px;
        }
        .modal-box h3 { margin-top: 0; margin-bottom: 15px; }
        .modal-box .modal-buttons { margin-top: 25px; }
        .modal-box .btn { padding: 10px 25px; border: none; border-radius: 8px;
            cursor: pointer; font-weight: 600; margin: 0 10px;
        }
        .btn-cancel { background-color: #ddd; color: #333; }
        .btn-confirm { background-color: var(--accent-color); color: var(--text-light); }

        .content { background-color: var(--main-bg); }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <span>Decaa.id</span>
        </div>
        <nav>
    <ul>
        <li><a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        {{-- Mengubah href="#" menjadi route ke halaman index karyawan --}}
        <li><a href="{{ route('karyawan.index') }}" class="{{ request()->is('karyawan*') ? 'active' : '' }}"><i class="fas fa-users"></i> Karyawan</a></li>
        <li><a href="#" class="{{ request()->is('penilaian*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Penilaian</a></li>
    </ul>
</nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <div class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </div>

            <div class="user-dropdown">
                <div class="user-info" id="userDropdownToggle">
                    Welcome, {{ Auth::user()->name }}
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="dropdown-menu" id="userDropdownMenu">
                    <a href="#" id="logoutButton">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </main>

    <div class="modal-overlay" id="logoutModal">
        <div class="modal-box">
            <h3>Konfirmasi Logout</h3>
            <p>Apakah Anda yakin ingin keluar?</p>
            <div class="modal-buttons">
                <button class="btn btn-cancel" id="cancelLogout">Batal</button>
                <button class="btn btn-confirm" id="confirmLogout">Ya, Logout</button>
            </div>
        </div>
    </div>

    <script>
        // SCRIPT BARU: LOGIKA UNTUK TOGGLE SIDEBAR
        const sidebarToggle = document.getElementById('sidebarToggle');
        sidebarToggle.addEventListener('click', () => {
            document.body.classList.toggle('sidebar-toggled');
        });

        // --- Logika untuk Dropdown dan Modal (sama seperti sebelumnya) ---
        const dropdownToggle = document.getElementById('userDropdownToggle');
        const dropdownMenu = document.getElementById('userDropdownMenu');
        dropdownToggle.addEventListener('click', () => { dropdownMenu.classList.toggle('show'); });
        window.addEventListener('click', (event) => {
            if (!dropdownToggle.contains(event.target)) { dropdownMenu.classList.remove('show'); }
        });
        const logoutButton = document.getElementById('logoutButton');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogout = document.getElementById('cancelLogout');
        const confirmLogout = document.getElementById('confirmLogout');
        const logoutForm = document.getElementById('logout-form');
        logoutButton.addEventListener('click', (event) => {
            event.preventDefault();
            dropdownMenu.classList.remove('show');
            logoutModal.classList.add('show');
        });
        cancelLogout.addEventListener('click', () => { logoutModal.classList.remove('show'); });
        logoutModal.addEventListener('click', (event) => {
            if (event.target === logoutModal) { logoutModal.classList.remove('show'); }
        });
        confirmLogout.addEventListener('click', () => { logoutForm.submit(); });
    </script>
    @stack('scripts')
</body>
</html>
