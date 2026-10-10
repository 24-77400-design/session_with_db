<?php
require_once __DIR__ . '/db.php';
require_role('admin');

$name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
$users = $db->query('SELECT full_name, username, role FROM users ORDER BY id')->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #fff5f5;
            color: #1e293b;
            font-family: Arial, sans-serif;
        }

        header {
            background: #fff;
            box-shadow: 0 2px 12px #0001;
            padding: 20px max(20px, 7%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-bottom: 3px solid #a50917;
        }

        header strong {
            font-size: 21px;
            color: #990c19;
        }

        button {
            border: 0;
            border-radius: 9px;
            background: #a50917;
            color: white;
            padding: 11px 20px;
            cursor: pointer;
            font-weight: 700;
        }

        button:hover {
            background: #7d0812;
        }

        main {
            max-width: 980px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 17px;
            padding: 30px;
            margin-bottom: 24px;
            box-shadow: 0 8px 30px #0000000a;
        }

        .tag {
            display: inline-block;
            background: #ffe1e5;
            color: #8f0a17;
            border-radius: 20px;
            padding: 8px 13px;
            font-weight: 700;
            font-size: 13px;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            color: #64748b;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 18px;
        }

        th,
        td {
            padding: 13px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #fff0f1;
        }

        .scroll {
            overflow-x: auto;
        }

        header .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        header .brand img {
            width: 47px;
            height: 47px;
            border-radius: 50%;
            object-fit: contain;
        }

        @media (max-width: 480px) {
            header strong {
                font-size: 15px;
            }

            header .brand img {
                width: 38px;
                height: 38px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <img src="images/bsu-seal-illustration.png" alt="Batangas State University seal">
            <strong>BatStateU Portal · Admin</strong>
        </div>

        <form action="logout.php" method="post">
            <button>Logout</button>
        </form>
    </header>

    <main>
        <section class="card">
            <span class="tag">ADMIN ACCOUNT</span>
            <h1>Welcome, <?= $name ?>!</h1>
            <p>You are logged in as an administrator. Your session is active.</p>
        </section>

        <section class="card">
            <h2>Registered Users</h2>
            <p>Admin-only account list.</p>

            <div class="scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars(ucfirst($user['role']), ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script>
        window.addEventListener('pageshow', (e) => {
            if (e.persisted) {
                location.reload();
            }
        });
    </script>
</body>
</html>
