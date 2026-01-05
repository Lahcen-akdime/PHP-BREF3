<?php
class checkuser{
    public function checkSelect($user){
        if($user == "admin"){
            session_start();
            $_SESSION['user']="admin";
            header("location: admindashboard.php");
       }
        elseif($user == "journaliste"){
            session_start();
        $_SESSION['user']="journaliste";
        header("location: journalistedashboard.php");
       }
       elseif($user == "visitor"){
            session_start();
        $_SESSION['user']="visitor";
        header("location: visitorDashboard.php");
       }

    }
}
$chekclass = new checkuser();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user = $_POST["role"] ;
   $chekclass -> checkSelect($user) ;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
                'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica',
                'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 420px;
            width: 100%;
            padding: 50px 40px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            font-weight: bold;
        }

        h1 {
            font-size: 28px;
            color: #1a1a1a;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            color: #333;
            background-color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23667eea' stroke-width='2'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 20px;
            padding-right: 40px;
        }

        select:hover {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
        }

        option {
            padding: 10px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: #999;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e0e0e0;
        }

        .divider::before {
            margin-right: 12px;
        }

        .divider::after {
            margin-left: 12px;
        }

        .guest-button {
            width: 100%;
            padding: 14px;
            background: #f5f5f5;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .guest-button:hover {
            background: #ebebeb;
            border-color: #d0d0d0;
        }

        .guest-button:active {
            transform: scale(0.98);
        }

        .guest-icon {
            font-size: 18px;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .footer-text {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 35px 25px;
            }

            h1 {
                font-size: 24px;
            }

            select,
            .guest-button,
            .login-button {
                font-size: 14px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">📰</div>
            <h1>Access Portal</h1>
            <p class="subtitle">Select your role to continue</p>
        </div>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="role">Select Your Role</label>
                <select id="role" name="role" required>
                    <option value="">-- Choose a role --</option>
                    <option value="journaliste" name="journaliste">Journaliste</option>
                    <option value="admin" name = "admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="login-button">Login</button>
        </form>

        <div class="divider">OR</div>
        <form action="login.php" method="POST">
            <button class="guest-button" type="submit" name="role" value="visitor">
                <span class="guest-icon">👤</span>
                Continue as Visiteur
            </button>
        </form>

        <p class="footer-text">Secure access • No account required for guests</p>
    </div>

    <script>
        // fetch("http://localhost/phpmyadmin/index.php?route=/sql&db=apex&table=joueur&pos=0")
        // .then(json => console.log(json));

        
        // function handleLogin(event) {
        //     event.preventDefault();
        //     const role = document.getElementById('role').value;
        //     if (role) {
        //         alert(`Logging in as ${role.charAt(0).toUpperCase() + role.slice(1)}...`);
        //         // Add your login logic here
        //     }
        // }

        // function handleGuest() {
        //     alert('Continuing as Guest (Visiteur)...');
        //     // Add your guest access logic here
        // }
    </script>
</body>
</html>
