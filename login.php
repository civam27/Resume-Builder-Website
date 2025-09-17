<?php
$title = "Login | Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --accent-color: #36b9cc;
            --light-bg: #f8f9fc;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }
        
        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 7px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        
        .card-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
            padding: 25px 20px;
            border-bottom: none;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .logo {
            width: 70px;
            height: 70px;
            object-fit: contain;
            filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.2));
        }
        
        .app-name {
            font-weight: 700;
            font-size: 24px;
            margin: 0;
            text-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
        }
        
        .app-tagline {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 16px 20px 16px 45px;
            height: calc(3.5rem + 2px);
            border: 1px solid #ddd;
            transition: all 0.3s;
            width: 100%;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6e707e;
            z-index: 5;
        }
        
        .form-label {
            position: absolute;
            top: 20px;
            left: 45px;
            color: #6e707e;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 5px;
        }
        
        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            top: -10px;
            left: 40px;
            font-size: 12px;
            color: var(--primary-color);
        }
        
        .btn-login {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            width: 100%;
            color: white;
        }
        
        .btn-login:hover {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .links-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .links-container a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .links-container a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .divider span {
            padding: 0 10px;
            color: #6e707e;
            font-size: 14px;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }
        
        .footer a {
            color: white;
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                margin: 0 10px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .logo-container {
                flex-direction: column;
                text-align: center;
            }
            
            .links-container {
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <div class="logo-container">
                    <img src="./assets/images/logo.png" alt="Resume Builder Logo" class="logo">
                    <div>
                        <h1 class="app-name">Resume Builder</h1>
                        <p class="app-tagline">Craft your professional story</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <form method="post" action="actions/login.action.php">
                    <div class="form-group">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input type="email" class="form-control" name="email_id" id="email" placeholder=" " required>
                        <label for="email" class="form-label">Email address</label>
                    </div>
                    
                    <div class="form-group">
                        <i class="bi bi-key-fill input-icon"></i>
                        <input type="password" class="form-control" name="password" id="password" placeholder=" " required>
                        <label for="password" class="form-label">Password</label>
                    </div>
                    
                    <div class="d-grid">
                        <button class="btn btn-login btn-lg" type="submit">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login to Account
                        </button>
                    </div>
                    
                    <div class="divider">
                        <span>OR</span>
                    </div>
                    
                    <div class="links-container">
                        <a href="forgot-password.php">
                            <i class="bi bi-question-circle me-1"></i> Forgot Password?
                        </a>
                        <a href="register.php">
                            <i class="bi bi-person-plus me-1"></i> Create Account
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="footer">
            <p>© 2023 Resume Builder. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to ensure labels work correctly
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                // Check if input has value on page load (useful if browser autofills)
                if(input.value) {
                    input.classList.add('has-value');
                }
                
                input.addEventListener('focus', function() {
                    this.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if(!this.value) {
                        this.classList.remove('focused', 'has-value');
                    } else {
                        this.classList.add('has-value');
                        this.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
require './assets/includes/footer.php';
?>