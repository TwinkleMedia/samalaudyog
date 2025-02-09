<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #87CEEB, #4682B4);
            font-family: Arial, sans-serif;
        }

        /* Center the form */
        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #4682B4;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        .login-form input[type="text"]:focus,
        .login-form input[type="password"]:focus {
            outline: none;
            border: 1px solid #4682B4;
        }

        .login-form button {
            padding: 0.75rem;
            background-color: #4682B4;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-form button:hover {
            background-color: #5A9BD5;
        }

        /* Responsive for Mobile */
        @media (max-width: 576px) {
            .login-container {
                padding: 1.5rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .login-form input[type="text"],
            .login-form input[type="password"] {
                font-size: 0.9rem;
            }

            .login-form button {
                font-size: 0.9rem;
            }
        }

        /* Additional Styling */
        .login-form p {
            text-align: center;
            margin-top: 1rem;
        }

        .login-form p a {
            color: #4682B4;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-form p a:hover {
            color: #5A9BD5;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="../../admin/form/login1.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
a