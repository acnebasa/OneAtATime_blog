<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management - OneAtATime Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_styles.css') ?>">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f5f6fa;
            color: #333;
        }

        .main {
            padding: 30px;
            transition: margin-left 0.3s;
        }

        .main.collapsed {
            margin-left: 80px;
        }

        .main h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .admin-table {
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .admin-table thead {
            background-color: #f0f2f5;
        }

        .admin-table th, .admin-table td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        .admin-table th {
            font-weight: 600;
            color: #555;
        }

        .admin-table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }

        .admin-table tbody tr:hover {
            background-color: #f1f9ff;
        }

        .emoji {
            font-size: 16px;
        }

        .admin-table th.reactions-column,
        .admin-table td.reactions-column {
            text-align: center;
        }

        .admin-table th.actions-column,
        .admin-table td.actions-column {
            text-align: center;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        @media (max-width: 768px) {
            .admin-table, .admin-table thead, .admin-table tbody, .admin-table th, .admin-table td, .admin-table tr {
                display: block;
            }

            .admin-table thead tr {
                display: none;
            }

            .admin-table td {
                position: relative;
                padding-left: 50%;
                border-bottom: 1px solid #eee;
            }

            .admin-table td::before {
                position: absolute;
                top: 15px;
                left: 15px;
                width: 45%;
                font-weight: bold;
                color: #888;
                white-space: nowrap;
            }

            .admin-table td:nth-of-type(1)::before { content: "ID"; }
            .admin-table td:nth-of-type(2)::before { content: "Username"; }
            .admin-table td:nth-of-type(3)::before { content: "Email"; }
            .admin-table td:nth-of-type(4)::before { content: "Registered At"; }
            .admin-table td:nth-of-type(5)::before { content: "Status"; }
        }
    </style>
</head>
<body>

<?php include(APPPATH . 'views/admin/partial_sidebar.php'); ?>

<div class="main collapsed" id="main">
    <h2>👤 User Management</h2>

    <?php if (!empty($users)): ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registered At</th>
                    <th>Status</th>
                    <th class="actions-column">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= date('M j, Y', strtotime($user['created_at'])) ?></td>
                        <td><?= $user['is_active'] ? 'Active' : 'Inactive' ?></td>
                        <td class="actions-column">
                            <form method="POST" action="<?= site_url('admin/delete_user/' . $user['id']) ?>" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<?php if (!empty($success)): ?>
    <script>
        alert("<?= $success ?>");
        window.location.href = "<?= site_url('admin/users') ?>";
    </script>
<?php elseif (!empty($error)): ?>
    <script>
        alert("<?= $error ?>");
        window.location.href = "<?= site_url('admin/users') ?>";
    </script>
<?php endif; ?>

<script>
    function toggleSidebar(e) {
        e.stopPropagation();
        document.getElementById("sidebar").classList.toggle("collapsed");
        document.getElementById("main").classList.toggle("collapsed");
    }

    function handleSidebarClick(event) {
        const sidebar = document.getElementById("sidebar");
        if (sidebar.classList.contains("collapsed") && !event.target.closest(".toggle-btn")) {
            sidebar.classList.remove("collapsed");
            document.getElementById("main").classList.remove("collapsed");
        }
    }
</script>

</body>
</html>
