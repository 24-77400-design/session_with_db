<?php
require_once __DIR__ . '/db.php';
start_secure_session();

if (!empty($_SESSION['user_id'])) {
    header('Location: ' . destination());
    exit;
}

$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BatStateU Portal | Sign In</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(130deg, #65060dc9, #a5091799), url("images/campus-background.jpg") center/cover fixed;
            font-family: Arial, sans-serif;
            color: #2a1720;
            padding: 22px;
        }

        .card {
            background: #fff;
            border-radius: 22px;
            max-width: 440px;
            width: 100%;
            padding: 40px 38px;
            box-shadow: 0 25px 70px #25000870;
            border-top: 6px solid #b20e1c;
        }

        .logo {
            display: block;
            width: 105px;
            height: 105px;
            object-fit: contain;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 0 0 5px #fff1f2;
        }

        h1 {
            text-align: center;
            margin: 0 0 9px;
            font-size: 27px;
            color: #850d1b;
        }

        p {
            text-align: center;
            color: #6b6470;
            margin: 0 0 25px;
        }

        .university {
            text-align: center;
            color: #97101c;
            font-weight: 800;
            letter-spacing: .5px;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .sub {
            text-align: center;
            font-size: 11px;
            color: #76636a;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 17px 0 8px;
            font-weight: 700;
            font-size: 14px;
        }

        input {
            width: 100%;
            border: 1px solid #d9c8cc;
            border-radius: 10px;
            padding: 14px;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #b20e1c;
            box-shadow: 0 0 0 3px #ffe1e4;
        }

        button {
            width: 100%;
            margin-top: 24px;
            padding: 14px;
            background: #a50917;
            border: 0;
            color: white;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: #7d0812;
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 54px;
        }

        .eye-toggle {
            position: absolute;
            right: 7px;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            margin: 0;
            padding: 9px;
            background: transparent;
            color: #7b5360;
            border-radius: 8px;
            display: grid;
            place-items: center;
        }

        .eye-toggle:hover {
            background: #fff1f2;
            color: #9b101d;
        }

        .eye-toggle:focus-visible {
            outline: 2px solid #b20e1c;
            outline-offset: 1px;
        }

        .eye-toggle svg {
            width: 21px;
            height: 21px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .error {
            padding: 12px;
            border-radius: 9px;
            background: #fee2e2;
            color: #991b1b;
            text-align: center;
            font-size: 14px;
        }

        .note {
            text-align: center;
            color: #806c72;
            font-size: 12px;
            margin-top: 24px;
        }

        @media (max-width: 480px) {
            .card {
                padding: 30px 24px;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <img class="logo" src="images/bsu-seal-illustration.png" alt="Batangas State University seal">
        <div class="university">BATANGAS STATE UNIVERSITY</div>
        <div class="sub">The National Engineering University</div>
        <h1>Welcome Back</h1>
        <p>Sign in to your school account</p>

        <?php if ($error): ?>
            <div class="error">Incorrect username or password.</div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label for="username">Username</label>
            <input id="username" name="username" autocomplete="username" required maxlength="50" placeholder="Enter your username">

            <label for="password">Password</label>
            <div class="password-wrap">
                <input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Enter your password">
                <button class="eye-toggle" type="button" id="togglePassword" aria-label="Show password" aria-pressed="false" title="Show password">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                        <circle cx="12" cy="12" r="3"/>
                        <path id="eyeSlash" d="M3 3l18 18"/>
                    </svg>
                </button>
            </div>

            <button type="submit">Sign In</button>
        </form>

        <div class="note">BatStateU-inspired Demo Portal · Admin &amp; Student Access</div>
    </div>

    <script>
        const eyeButton = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        eyeButton.addEventListener('click', () => {
            const show = passwordField.type === 'password';
            passwordField.type = show ? 'text' : 'password';
            eyeButton.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            eyeButton.setAttribute('title', show ? 'Hide password' : 'Show password');
            eyeButton.setAttribute('aria-pressed', String(show));
            document.getElementById('eyeSlash').style.display = show ? 'none' : '';
        });

        window.addEventListener('pageshow', (e) => {
            if (e.persisted) {
                location.reload();
            }
        });
    </script>
</body>
</html>
