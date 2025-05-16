<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?> - OneAtATime Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color: #2f3542;
            position: fixed;
            height: 100%;
            overflow: hidden;
            transition: width 0.3s ease;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
            cursor: pointer;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #444;
        }

        .sidebar.collapsed .admin-text {
            display: none;
        }

        .logo {
            display: none;
            font-size: 22px;
        }

        .sidebar.collapsed .logo {
            display: inline-block;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
            margin-left: auto;
        }

        .sidebar.collapsed .toggle-btn {
            display: none;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #ccc;
            padding: 15px 20px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background-color: #57606f;
            color: #fff;
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 18px;
            width: 25px;
            text-align: center;
        }

        .sidebar.collapsed a span {
            display: none;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main.collapsed {
            margin-left: 70px;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .main {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar collapsed" id="sidebar" onclick="handleSidebarClick(event)">
        <div class="sidebar-header">
            <span class="logo">🧭</span>
            <span class="admin-text">Admin</span>
            <button class="toggle-btn" id="toggleBtn" onclick="toggleSidebar(event)">☰</button>
        </div>
        
        <a href="<?= site_url('admin/dashboard') ?>">
            <i>📌</i><span>Dashboard</span>
        </a>
        <a href="<?= site_url('admin/posts') ?>">
            <i>📄</i><span>Post Management</span>
        </a>
        <a href="<?= site_url('admin/users') ?>">
            <i>👥</i><span>User Management</span>
        </a>
        <a href="<?= site_url('admin/logout') ?>">
            <i>🚪</i><span>Logout</span>
        </a>
    </div>

    <div class="main collapsed" id="main">
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Use the sidebar to manage posts and users.</p>
    </div>

    <script>
        function toggleSidebar(e) {
            e.stopPropagation(); // Prevent sidebar click from triggering uncollapse again
            const sidebar = document.getElementById("sidebar");
            const main = document.getElementById("main");
            sidebar.classList.toggle("collapsed");
            main.classList.toggle("collapsed");
        }

        function handleSidebarClick(event) {
            const sidebar = document.getElementById("sidebar");
            const main = document.getElementById("main");
            const isCollapsed = sidebar.classList.contains("collapsed");

            // Only expand if it's collapsed and not clicking the toggle button itself
            if (isCollapsed && !event.target.closest(".toggle-btn")) {
                sidebar.classList.remove("collapsed");
                main.classList.remove("collapsed");
            }
        }
    </script>

</body>
</html>
