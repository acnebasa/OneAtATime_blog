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
            overflow: auto;
            transition: width 0.3s ease;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin: 0;
            font-size: 20px;
        }

        .sidebar a {
            display: block;
            color: #ccc;
            padding: 15px 20px;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #57606f;
            color: #fff;
        }

        .main {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main.collapsed {
            margin-left: 60px;
        }

        .toggle-btn {
            position: absolute;
            top: 15px;
            left: 260px;
            font-size: 20px;
            background: #2f3542;
            color: #fff;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            transition: left 0.3s;
        }

        .collapsed + .toggle-btn {
            left: 70px;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .main {
                margin-left: 60px;
            }

            .toggle-btn {
                left: 70px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <h2 id="sidebar-title">Admin</h2>
        <a href="<?= site_url('admin/posts') ?>">📄 Post Management</a>
        <a href="<?= site_url('admin/users') ?>">👥 User Management</a>
        <a href="<?= site_url('admin/logout') ?>">🚪 Logout</a>
    </div>

    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <div class="main" id="main">
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Use the sidebar to navigate between sections.</p>
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            var main = document.getElementById("main");
            sidebar.classList.toggle("collapsed");
            main.classList.toggle("collapsed");
        }
    </script>
</body>
</html>
