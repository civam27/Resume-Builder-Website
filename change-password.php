<?php
$title = "Change Password | Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-color: #2ecc71;
        --warning-color: #f39c12;
        --error-color: #e74c3c;
    }
    
    body {
        background: var(--primary-gradient);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow-x: hidden;
    }
    
    /* Animated background elements */
    .bg-bubbles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
    }
    
    .bg-bubbles li {
        position: absolute;
        list-style: none;
        display: block;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.15);
        bottom: -160px;
        border-radius: 50%;
        animation: square 25s infinite;
        transition-timing-function: linear;
    }
    
    .bg-bubbles li:nth-child(1) {
        left: 10%;
        animation-delay: 0s;
        width: 80px;
        height: 80px;
    }
    
    .bg-bubbles li:nth-child(2) {
        left: 20%;
        animation-delay: 2s;
        animation-duration: 17s;
        width: 60px;
        height: 60px;
    }
    
    .bg-bubbles li:nth-child(3) {
        left: 25%;
        animation-delay: 4s;
        width: 70px;
        height: 70px;
    }
    
    .bg-bubbles li:nth-child(4) {
        left: 40%;
        animation-delay: 0s;
        animation-duration: 22s;
        width: 90px;
        height: 90px;
    }
    
    .bg-bubbles li:nth-child(5) {
        left: 70%;
        width: 50px;
        height: 50px;
    }
    
    .bg-bubbles li:nth-child(6) {
        left: 80%;
        animation-delay: 3s;
        width: 60px;
        height: 60px;
    }
    
    .bg-bubbles li:nth-child(7) {
        left: 32%;
        animation-delay: 6s;
        width: 75px;
        height: 75px;
    }
    
    .bg-bubbles li:nth-child(8) {
        left: 55%;
        animation-delay: 8s;
        animation-duration: 18s;
        width: 45px;
        height: 45px;
    }
    
    .bg-bubbles li:nth-child(9) {
        left: 25%;
        animation-delay: 2s;
        animation-duration: 20s;
        width: 35px;
        height: 35px;
    }
    
    .bg-bubbles li:nth-child(10) {
        left: 85%;
        animation-delay: 11s;
        width: 55px;
        height: 55px;
    }
    
    @keyframes square {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 50%;
        }
        100% {
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }
    }
    
    .password-card {
        max-width: 500px;
        width: 100%;
        padding: 2.5rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        transition: all 0.4s ease;
        animation: slideUp 0.8s ease-out;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        z-index: 1;
    }
    
    .password-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: var(--primary-gradient);
    }
    
    .password-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25);
    }
    
    .logo-container {
        display: flex;
        gap: 12px;
        justify-content: center;
        align-items: center;
        margin-bottom: 1.5rem;
        animation: fadeIn 1s ease-out;
    }
    
    .brand-text {
        font-weight: 700;
        font-size: 1.8rem;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .email-display {
        background-color: rgba(248, 249, 250, 0.8);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 1.5rem;
        border-left: 4px solid #667eea;
        animation: fadeIn 0.8s ease-out 0.3s both;
        text-align: center;
        backdrop-filter: blur(5px);
    }
    
    .password-input-container {
        position: relative;
        margin-bottom: 1.5rem;
        animation: fadeIn 0.8s ease-out 0.5s both;
    }
    
    .password-input {
        padding-right: 45px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        height: 55px;
        font-family: 'Poppins', sans-serif;
    }
    
    .password-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
    
    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        transition: color 0.3s ease;
        z-index: 5;
    }
    
    .toggle-password:hover {
        color: #667eea;
    }
    
    .password-strength {
        height: 6px;
        border-radius: 5px;
        margin-top: 8px;
        background: #e9ecef;
        overflow: hidden;
        position: relative;
    }
    
    .password-strength-bar {
        height: 100%;
        width: 0%;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    
    .password-requirements {
        margin-top: 15px;
        font-size: 0.85rem;
        color: #6c757d;
        animation: fadeIn 0.8s ease-out 0.7s both;
    }
    
    .requirement {
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .requirement i {
        font-size: 0.7rem;
    }
    
    .btn-change-password {
        background: var(--primary-gradient);
        border: none;
        padding: 15px;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        animation: fadeIn 0.8s ease-out 0.9s both;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
    }
    
    .btn-change-password:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        background: var(--secondary-gradient);
    }
    
    .btn-change-password:active {
        transform: translateY(0);
    }
    
    .links-container {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(234, 234, 234, 0.8);
        animation: fadeIn 0.8s ease-out 1.1s both;
    }
    
    .links-container a {
        color: #667eea;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
        font-family: 'Poppins', sans-serif;
    }
    
    .links-container a:hover {
        color: #764ba2;
        transform: translateX(3px);
    }
    
    /* Animations */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
        }
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    /* Responsive adjustments */
    @media (max-width: 576px) {
        .password-card {
            padding: 2rem 1.5rem;
        }
        
        .logo-container {
            flex-direction: column;
            gap: 8px;
        }
        
        .links-container {
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }
        
        .brand-text {
            font-size: 1.5rem;
        }
    }
</style>

<!-- Animated background bubbles -->
<ul class="bg-bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>

<div class="password-card">
    <form action="actions/changepassword.action.php" method="post" id="passwordForm">
        <div class="logo-container">
            <img src="./assets/images/logo.png" alt="Resume Builder Logo" height="70">
            <div>
                <h1 class="h3 fw-normal my-1 brand-text">Resume Builder</h1>
                <p class="m-0 text-muted text-center">Change Password</p>
            </div>
        </div>

        <div class="email-display">
            <p class="m-0">Changing password for:</p>
            <p class="m-0 fw-bold"><?=$fn->getSession('email')==''?$fn->redirect('forgot-password.php'):$fn->getSession('email')?></p>
        </div>
        
        <div class="password-input-container">
            <label for="passwordInput" class="form-label">New Password</label>
            <input type="password" class="form-control password-input" id="passwordInput" name="password" 
                   placeholder="Enter your new password" required autocomplete="new-password">
            <button type="button" class="toggle-password" id="togglePassword">
                <i class="bi bi-eye"></i>
            </button>
            <div class="password-strength">
                <div class="password-strength-bar" id="passwordStrengthBar"></div>
            </div>
        </div>

        <div class="password-requirements">
            <p class="mb-2"><strong>Password must include:</strong></p>
            <div class="requirement" id="reqLength">
                <i class="bi bi-circle"></i>
                <span>At least 8 characters</span>
            </div>
            <div class="requirement" id="reqUpperCase">
                <i class="bi bi-circle"></i>
                <span>One uppercase letter</span>
            </div>
            <div class="requirement" id="reqNumber">
                <i class="bi bi-circle"></i>
                <span>One number</span>
            </div>
            <div class="requirement" id="reqSpecial">
                <i class="bi bi-circle"></i>
                <span>One special character</span>
            </div>
        </div>

        <button class="btn btn-change-password w-100 mb-4" type="submit" id="submitButton">
            <i class="bi bi-shield-lock"></i>Change Password
        </button>
        
        <div class="links-container">
            <a href="register.php">
                <i class="bi bi-person-plus"></i>Create New Account
            </a>
            <a href="login.php">
                <i class="bi bi-box-arrow-in-right"></i>Back to Login
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');
        const strengthBar = document.getElementById('passwordStrengthBar');
        const submitButton = document.getElementById('submitButton');
        
        // Focus on password input automatically
        setTimeout(() => {
            passwordInput.focus();
        }, 500);
        
        // Toggle password visibility
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            const eyeIcon = this.querySelector('i');
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
        
        // Check password strength
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let message = '';
            
            // Check length
            if (password.length >= 8) {
                strength += 25;
                document.getElementById('reqLength').innerHTML = '<i class="bi bi-check-circle-fill text-success"></i><span>At least 8 characters</span>';
            } else {
                document.getElementById('reqLength').innerHTML = '<i class="bi bi-circle"></i><span>At least 8 characters</span>';
            }
            
            // Check uppercase letters
            if (/[A-Z]/.test(password)) {
                strength += 25;
                document.getElementById('reqUpperCase').innerHTML = '<i class="bi bi-check-circle-fill text-success"></i><span>One uppercase letter</span>';
            } else {
                document.getElementById('reqUpperCase').innerHTML = '<i class="bi bi-circle"></i><span>One uppercase letter</span>';
            }
            
            // Check numbers
            if (/[0-9]/.test(password)) {
                strength += 25;
                document.getElementById('reqNumber').innerHTML = '<i class="bi bi-check-circle-fill text-success"></i><span>One number</span>';
            } else {
                document.getElementById('reqNumber').innerHTML = '<i class="bi bi-circle"></i><span>One number</span>';
            }
            
            // Check special characters
            if (/[^A-Za-z0-9]/.test(password)) {
                strength += 25;
                document.getElementById('reqSpecial').innerHTML = '<i class="bi bi-check-circle-fill text-success"></i><span>One special character</span>';
            } else {
                document.getElementById('reqSpecial').innerHTML = '<i class="bi bi-circle"></i><span>One special character</span>';
            }
            
            // Update strength bar
            strengthBar.style.width = strength + '%';
            
            // Update color based on strength
            if (strength < 50) {
                strengthBar.style.background = '#e74c3c';
            } else if (strength < 75) {
                strengthBar.style.background = '#f39c12';
            } else {
                strengthBar.style.background = '#2ecc71';
            }
        });
        
        // Add pulse animation to submit button
        submitButton.classList.add('pulse-animation');
        
        // Remove animation when button is hovered
        submitButton.addEventListener('mouseenter', function() {
            this.classList.remove('pulse-animation');
        });
        
        submitButton.addEventListener('mouseleave', function() {
            this.classList.add('pulse-animation');
        });
        
        // Form validation
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const password = document.getElementById('passwordInput').value;
            let isValid = true;
            let message = '';
            
            if (password.length < 8) {
                isValid = false;
                message = 'Password must be at least 8 characters long';
            } else if (!/[A-Z]/.test(password)) {
                isValid = false;
                message = 'Password must contain at least one uppercase letter';
            } else if (!/[0-9]/.test(password)) {
                isValid = false;
                message = 'Password must contain at least one number';
            } else if (!/[^A-Za-z0-9]/.test(password)) {
                isValid = false;
                message = 'Password must contain at least one special character';
            }
            
            if (!isValid) {
                e.preventDefault();
                // Create and show error message
                let errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger mt-3';
                errorDiv.innerHTML = `<i class="bi bi-exclamation-circle"></i> ${message}`;
                
                // Remove any existing alerts
                const existingAlert = document.querySelector('.alert');
                if (existingAlert) {
                    existingAlert.remove();
                }
                
                this.appendChild(errorDiv);
                
                // Remove error after 3 seconds
                setTimeout(() => {
                    errorDiv.remove();
                }, 3000);
            }
        });
    });
</script>

<?php
require './assets/includes/footer.php';
?>