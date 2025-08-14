<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            /* Yellow Theme - Professional & Clean */
            --primary-yellow: #f5d62d;
            --yellow-light: #fef3c7;
            --yellow-dark: #d69e2e;
            --yellow-darker: #b7791f;

            /* Neutral Colors */
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;

            /* Theme Variables */
            --sidebar-bg: var(--primary-yellow);
            --main-bg: var(--gray-50);
            --card-bg: var(--white);
            --text-dark: var(--gray-800);
            --text-muted: var(--gray-500);
            --border-color: var(--gray-200);

            /* Layout */
            --sidebar-width: 260px;
            --header-height: 70px;
            --border-radius: 8px;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--main-bg);
            color: var(--text-dark);
            display: flex;
            font-size: 14px;
            overflow-x: hidden;
        }

        /* Sidebar Overlay for Mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 15;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Clean Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            padding: 25px 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            z-index: 20;
            transform: translateX(0);
            transition: transform 0.3s ease;
            box-shadow: var(--shadow);
            overflow-y: auto;
        }

        .sidebar-header {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 0 25px;
            margin-bottom: 40px;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .sidebar .logo img {
            width: 40px;
            height: 40px;
            margin-right: 12px;
            border-radius: 6px;
        }

        .sidebar .logo span {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text-dark);
        }

        /* Close Button for Mobile */
        .sidebar-close {
            display: none;
            width: 36px;
            height: 36px;
            border: none;
            background: rgba(0, 0, 0, 0.1);
            border-radius: var(--border-radius);
            color: var(--text-dark);
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.2s ease;
            margin-left: 10px;
        }

        .sidebar-close:hover {
            background: rgba(0, 0, 0, 0.15);
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav li {
            margin-bottom: 2px;
        }

        .sidebar nav li a {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            text-decoration: none;
            color: var(--gray-700);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar nav li a:hover {
            background-color: rgba(0, 0, 0, 0.05);
            color: var(--text-dark);
        }

        .sidebar nav li a.active {
            background-color: var(--yellow-dark);
            color: var(--white);
            border-right: 3px solid var(--yellow-darker);
        }

        .sidebar nav li a i {
            margin-right: 12px;
            width: 18px;
            text-align: center;
            font-size: 16px;
        }

        /* Clean Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        /* Professional Header */
        .header {
            height: var(--header-height);
            background: var(--card-bg);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            box-shadow: var(--shadow);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
            min-width: 0;
        }

        .sidebar-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: var(--border-radius);
            background: var(--gray-100);
            border: 1px solid var(--border-color);
            cursor: pointer;
            color: var(--text-dark);
            font-size: 14px;
            transition: background-color 0.2s ease;
            flex-shrink: 0;
        }

        .sidebar-toggle:hover {
            background: var(--yellow-light);
        }

        .breadcrumb {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 400;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .header-right {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        /* Simple User Dropdown */
        .user-dropdown {
            position: relative;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            transition: all 0.2s ease;
            font-weight: 500;
            color: var(--text-dark);
        }

        .user-info:hover {
            background: var(--yellow-light);
            border-color: var(--primary-yellow);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--primary-yellow);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
        }

        .dropdown-arrow {
            font-size: 12px;
            color: var(--text-muted);
            transition: transform 0.2s ease;
        }

        .user-info.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        /* Clean Dropdown Menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 200px;
            z-index: 100;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-header {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            background: var(--gray-50);
        }

        .dropdown-header .user-name {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 2px;
            font-size: 14px;
        }

        .dropdown-header .user-role {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: capitalize;
        }

        .dropdown-menu a {
            color: var(--text-dark);
            padding: 12px 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .dropdown-menu a:hover {
            background: var(--yellow-light);
        }

        .dropdown-menu a i {
            margin-right: 10px;
            width: 16px;
            text-align: center;
            font-size: 14px;
        }

        .dropdown-menu .logout-item {
            border-top: 1px solid var(--border-color);
            color: #dc2626;
        }

        .dropdown-menu .logout-item:hover {
            background: #fef2f2;
        }

        /* Sidebar Toggle States */
        body.sidebar-toggled .sidebar {
            transform: translateX(calc(-1 * var(--sidebar-width)));
        }

        body.sidebar-toggled .main-content {
            margin-left: 0;
            width: 100%;
        }

        /* Simple Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-box {
            background: var(--card-bg);
            color: var(--text-dark);
            padding: 30px;
            border-radius: var(--border-radius);
            text-align: center;
            max-width: 380px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin: 0 15px;
        }

        .modal-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background: var(--yellow-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--yellow-dark);
        }

        .modal-box h3 {
            margin: 0 0 10px;
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .modal-box p {
            margin-bottom: 25px;
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .modal-buttons .btn {
            padding: 10px 24px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-cancel {
            background: var(--gray-100);
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-cancel:hover {
            background: var(--gray-200);
        }

        .btn-confirm {
            background: #dc2626;
            color: white;
        }

        .btn-confirm:hover {
            background: #b91c1c;
        }

        .content {
            padding: 25px 30px;
            background: var(--main-bg);
            min-height: calc(100vh - var(--header-height));
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 280px;
            }

            .header {
                padding: 0 15px;
            }

            .content {
                padding: 20px 15px;
            }

            .header-left {
                gap: 10px;
            }

            .breadcrumb {
                font-size: 13px;
            }

            .user-name {
                display: none;
            }

            .dropdown-menu {
                width: 180px;
                right: -10px;
            }

            .modal-box {
                padding: 25px;
                margin: 0 10px;
            }

            .modal-buttons {
                gap: 8px;
            }

            .modal-buttons .btn {
                flex: 1;
                min-width: 80px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar-close {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            body.sidebar-toggled .sidebar {
                transform: translateX(0);
            }

            body.sidebar-toggled .main-content {
                margin-left: 0;
                width: 100%;
            }

            .header {
                padding: 0 10px;
            }

            .content {
                padding: 15px 10px;
            }

            .breadcrumb {
                font-size: 12px;
            }

            .modal-box {
                padding: 20px 15px;
            }

            .modal-box h3 {
                font-size: 16px;
            }

            .modal-box p {
                font-size: 13px;
            }
        }

        /* Additional Mobile Improvements */
        @media (max-width: 375px) {
            .sidebar nav li a {
                padding: 12px 20px;
                font-size: 14px;
            }

            .sidebar nav li a i {
                width: 16px;
                font-size: 14px;
            }

            .user-info {
                padding: 6px 12px;
            }

            .user-avatar {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo">
                <span>Decaa.id</span>
            </div>
            <button class="sidebar-close" id="sidebarClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav>
            <ul>
                <li><a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->is('home') ? 'active' : ''); ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="<?php echo e(route('karyawan.index')); ?>" class="<?php echo e(request()->is('karyawan*') ? 'active' : ''); ?>">
                    <i class="fas fa-users"></i> Karyawan</a></li>
                <li><a href="<?php echo e(route('laporan.index')); ?>" class="<?php echo e(request()->is('laporan*') ? 'active' : ''); ?>">
                    <i class="fas fa-chart-line"></i> Laporan</a></li>

                
                <?php if(Auth::user()->role == 'superadmin'): ?>
                    <li><a href="<?php echo e(route('kelola-admin.index')); ?>"
                            class="<?php echo e(request()->is('kelola-admin*') ? 'active' : ''); ?>">
                        <i class="fas fa-user-shield"></i> Kelola Admin</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <div class="header-left">
                <div class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="breadcrumb">
                    Sistem Penilaian Kinerja Karyawan
                </div>
            </div>

            <div class="header-right">
                <div class="user-dropdown">
                    <div class="user-info" id="userDropdownToggle">
                        <div class="user-avatar">
                            <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                        </div>
                        <div class="user-name"><?php echo e(Auth::user()->name); ?></div>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>

                    <div class="dropdown-menu" id="userDropdownMenu">
                        <div class="dropdown-header">
                            <div class="user-name"><?php echo e(Auth::user()->name); ?></div>
                            <div class="user-role"><?php echo e(Auth::user()->role); ?></div>
                        </div>
                        
                        <a href="#" id="logoutButton" class="logout-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>

            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
        </header>

        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <div class="modal-overlay" id="logoutModal">
        <div class="modal-box">
            <div class="modal-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <h3>Konfirmasi Logout</h3>
            <p>Apakah Anda yakin ingin keluar dari sistem?</p>
            <div class="modal-buttons">
                <button class="btn btn-cancel" id="cancelLogout">Batal</button>
                <button class="btn btn-confirm" id="confirmLogout">Ya, Logout</button>
            </div>
        </div>
    </div>

    <script>
        // Sidebar functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const body = document.body;

        function toggleSidebar() {
            const isMobile = window.innerWidth <= 480;

            if (isMobile) {
                // Mobile: toggle sidebar dengan overlay
                body.classList.toggle('sidebar-toggled');
                sidebarOverlay.classList.toggle('show');
            } else {
                // Desktop: hanya toggle sidebar tanpa overlay
                body.classList.toggle('sidebar-toggled');
            }
        }

        function closeSidebar() {
            body.classList.remove('sidebar-toggled');
            sidebarOverlay.classList.remove('show');
        }

        function openSidebar() {
            const isMobile = window.innerWidth <= 480;

            body.classList.remove('sidebar-toggled');
            if (isMobile) {
                sidebarOverlay.classList.add('show');
            }
        }

        // Event listeners for sidebar
        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarClose.addEventListener('click', closeSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        // Close sidebar when clicking on a nav link in mobile
        const navLinks = document.querySelectorAll('.sidebar nav a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 480) {
                    closeSidebar();
                }
            });
        });

        // Dropdown functionality
        const dropdownToggle = document.getElementById('userDropdownToggle');
        const dropdownMenu = document.getElementById('userDropdownMenu');

        dropdownToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
            dropdownToggle.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
                dropdownToggle.classList.remove('active');
            }
        });

        // Modal functionality
        const logoutButton = document.getElementById('logoutButton');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogout = document.getElementById('cancelLogout');
        const confirmLogout = document.getElementById('confirmLogout');
        const logoutForm = document.getElementById('logout-form');

        logoutButton.addEventListener('click', (event) => {
            event.preventDefault();
            dropdownMenu.classList.remove('show');
            dropdownToggle.classList.remove('active');
            logoutModal.classList.add('show');
        });

        cancelLogout.addEventListener('click', () => {
            logoutModal.classList.remove('show');
        });

        // Close modal when clicking overlay
        logoutModal.addEventListener('click', (event) => {
            if (event.target === logoutModal) {
                logoutModal.classList.remove('show');
            }
        });

        confirmLogout.addEventListener('click', () => {
            logoutForm.submit();
        });

        // ESC key to close modal/dropdown/sidebar
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                logoutModal.classList.remove('show');
                dropdownMenu.classList.remove('show');
                dropdownToggle.classList.remove('active');
                closeSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            const isMobile = window.innerWidth <= 480;

            if (!isMobile) {
                // Desktop: hapus overlay dan reset state jika perlu
                sidebarOverlay.classList.remove('show');
            } else {
                // Mobile: jika sidebar terbuka, tampilkan overlay
                if (!body.classList.contains('sidebar-toggled')) {
                    sidebarOverlay.classList.remove('show');
                }
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH D:\Tugas Kuliah\Magang\Projek Karyawan\PenilaianKaryawan\resources\views/layouts/admin.blade.php ENDPATH**/ ?>