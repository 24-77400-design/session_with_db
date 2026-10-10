<?php
require_once __DIR__ . '/db.php';
require_role('student');

$name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
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
            max-width: 850px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 45px;
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
            margin: 25px 0 12px;
        }

        p {
            color: #64748b;
            line-height: 1.7;
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
            <strong>BatStateU Portal · Student</strong>
        </div>

        <form action="logout.php" method="post">
            <button>Logout</button>
        </form>
    </header>

    <main>
        <section class="card">
            <span class="tag">STUDENT ACCOUNT</span>
            <h1>Welcome, <?= $name ?>!</h1>
            <p>You have successfully signed in to your Student Dashboard.</p>
            <p>Your session remains active until you log out or it expires.</p>
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
