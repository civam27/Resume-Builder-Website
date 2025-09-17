<?php
$title = "Forgot password ? | Resume Builder";
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
        
        .forgot-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
        }
        
        .forgot-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 7px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .forgot-card:hover {
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
        
        .info-text {
            color: #6c757d;
            margin-bottom: 25px;
            text-align: center;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 25px;
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
        
        .btn-send {
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
        
        .btn-send:hover {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .links-container {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            font-size: 14px;
        }
        
        .links-container a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
            display: flex;
            align-items: center;
        }
        
        .links-container a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
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
        
        /* Animation for the envelope icon */
        @keyframes sendAnimation {
            0% { transform: translateX(0); }
            50% { transform: translateX(5px); }
            100% { transform: translateX(0); }
        }
        
        .btn-send:hover i {
            animation: sendAnimation 0.5s ease-in-out infinite;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .forgot-card {
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
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="card-header">
                <div class="logo-container">
                    <img src="./assets/images/logo.png" alt="Resume Builder Logo" class="logo">
                    <div>
                        <h1 class="app-name">Resume Builder</h1>
                        <p class="app-tagline">Reset your password</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <p class="info-text">
                    Enter your email address below and we'll send you a verification code to reset your password.
                </p>
                
                <form action="actions/sendcode.action.php" method="post">
                    <div class="form-group">
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input type="email" class="form-control" id="email" placeholder=" " name="email_id" required>
                        <label for="email" class="form-label">Email address</label>
                    </div>
                    
                    <div class="d-grid">
                        <button class="btn btn-send btn-lg" type="submit">
                            <i class="bi bi-send me-2"></i> Send Verification Code
                        </button>
                    </div>
                    
                    <div class="links-container">
                        <a href="register.php">
                            <i class="bi bi-person-plus me-1"></i> Create New Account
                        </a>
                        <a href="login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Back to Login
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
            const emailInput = document.getElementById('email');
            
            // Check if input has value on page load (useful if browser autofills)
            if(emailInput.value) {
                emailInput.classList.add('has-value');
            }
            
            emailInput.addEventListener('focus', function() {
                this.classList.add('focused');
            });
            
            emailInput.addEventListener('blur', function() {
                if(!this.value) {
                    this.classList.remove('focused', 'has-value');
                } else {
                    this.classList.add('has-value');
                    this.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>

<?php
require './assets/includes/footer.php';
?>