<?php
$title = "Verification | Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    :root {
        --primary-gradient: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
        --secondary-gradient: linear-gradient(135deg, #5D4157 0%, #A8CABA 100%);
        --accent-color: #4b6cb7;
        --success-color: #2ecc71;
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
    .bg-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
    }
    
    .particle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 15s infinite ease-in-out;
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
            opacity: 0.5;
        }
        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 0.8;
        }
    }
    
    .verification-card {
        max-width: 500px;
        width: 100%;
        padding: 2.5rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        transition: all 0.4s ease;
        animation: cardEntrance 0.8s ease-out;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        z-index: 1;
    }
    
    .verification-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: var(--primary-gradient);
    }
    
    .verification-card:hover {
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
    
    .otp-input {
        letter-spacing: 15px;
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        padding: 0.75rem 1rem;
        height: auto;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        font-family: 'Poppins', monospace;
        background: rgba(255, 255, 255, 0.9);
    }
    
    .otp-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(75, 108, 183, 0.25);
        border-color: #4b6cb7;
        transform: scale(1.02);
    }
    
    .email-display {
        background-color: rgba(248, 249, 250, 0.8);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 1.5rem;
        border-left: 4px solid #4b6cb7;
        animation: fadeIn 0.8s ease-out 0.3s both;
        text-align: center;
        backdrop-filter: blur(5px);
    }
    
    .btn-verify {
        background: var(--primary-gradient);
        border: none;
        padding: 15px;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
        animation: fadeIn 0.8s ease-out 0.5s both;
    }
    
    .btn-verify:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(75, 108, 183, 0.3);
        background: var(--secondary-gradient);
    }
    
    .btn-verify:active {
        transform: translateY(0);
    }
    
    .links-container {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(234, 234, 234, 0.8);
        animation: fadeIn 0.8s ease-out 0.7s both;
    }
    
    .links-container a {
        color: #4b6cb7;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
        font-family: 'Poppins', sans-serif;
    }
    
    .links-container a:hover {
        color: #182848;
        transform: translateX(3px);
    }
    
    .resend-link {
        text-align: center;
        margin-top: 1rem;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.3s ease;
        animation: fadeIn 0.8s ease-out 0.9s both;
        font-family: 'Poppins', sans-serif;
    }
    
    .resend-link:hover {
        color: #4b6cb7;
        transform: scale(1.05);
    }
    
    .countdown {
        color: var(--accent-color);
        font-weight: 600;
    }
    
    /* Animations */
    @keyframes cardEntrance {
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
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(75, 108, 183, 0.4);
        }
        50% {
            transform: scale(1.05);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(75, 108, 183, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(75, 108, 183, 0);
        }
    }
    
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    .shake {
        animation: shake 0.5s;
    }
    
    /* Responsive adjustments */
    @media (max-width: 576px) {
        .verification-card {
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
        
        .otp-input {
            letter-spacing: 10px;
            font-size: 1.5rem;
        }
    }
</style>

<!-- Animated background particles -->
<div class="bg-particles" id="particles"></div>

<div class="verification-card">
    <form method="post" action='actions/verifyotp.action.php' id="verificationForm">
        <div class="logo-container">
            <img src="./assets/images/logo.png" alt="Resume Builder Logo" height="70">
            <div>
                <h1 class="h3 fw-normal my-1 brand-text">Resume Builder</h1>
                <p class="m-0 text-muted text-center">Verify your email</p>
            </div>
        </div>

        <div class="email-display">
            <p class="m-0 text-center">A 6-digit verification code has been sent to</p>
            <p class="m-0 text-center fw-bold"><?=$fn->getSession('email')==''?$fn->redirect('forgot-password.php'):$fn->getSession('email')?></p>
        </div>
        
        <div class="mb-4">
            <label for="otpInput" class="form-label">Enter Verification Code</label>
            <input type="text" class="form-control otp-input" id="otpInput" name="otp" 
                   placeholder="------" required maxlength="6" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
            <div class="form-text text-center mt-2">Please check your inbox and enter the 6-digit code we sent you</div>
        </div>

        <button class="btn btn-verify w-100 mb-3 pulse-animation" type="submit" id="verifyButton">
            <i class="bi bi-envelope-check-fill me-2"></i>Verify Email
        </button>
        
        <div class="resend-link" id="resendTrigger">
            <span>Didn't receive the code? <span class="text-primary fw-semibold">Resend</span> <span class="countdown" id="countdown">(60s)</span></span>
        </div>

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
        // Create background particles
        createParticles();
        
        // Focus on OTP input automatically
        setTimeout(() => {
            document.getElementById('otpInput').focus();
        }, 500);
        
        // Add animation to the verify button
        const verifyBtn = document.getElementById('verifyButton');
        
        // Remove animation when button is hovered
        verifyBtn.addEventListener('mouseenter', function() {
            this.classList.remove('pulse-animation');
        });
        
        verifyBtn.addEventListener('mouseleave', function() {
            this.classList.add('pulse-animation');
        });
        
        // Improve OTP input experience
        const otpInput = document.getElementById('otpInput');
        
        otpInput.addEventListener('input', function() {
            // Allow only numbers
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Auto-submit when 6 digits are entered
            if (this.value.length === 6) {
                document.getElementById('verificationForm').submit();
            }
        });
        
        otpInput.addEventListener('keydown', function(e) {
            // Prevent non-numeric input
            if (e.key.length === 1 && !/[0-9]/.test(e.key) && e.key !== 'Backspace') {
                e.preventDefault();
                this.classList.add('shake');
                setTimeout(() => {
                    this.classList.remove('shake');
                }, 500);
            }
        });
        
        // Resend functionality with countdown
        const resendTrigger = document.getElementById('resendTrigger');
        const countdownEl = document.getElementById('countdown');
        let countdown = 60;
        let countdownInterval;
        
        function startCountdown() {
            countdown = 60;
            countdownEl.textContent = `(${countdown}s)`;
            resendTrigger.style.pointerEvents = 'none';
            resendTrigger.style.opacity = '0.7';
            
            countdownInterval = setInterval(() => {
                countdown--;
                countdownEl.textContent = `(${countdown}s)`;
                
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    countdownEl.textContent = '';
                    resendTrigger.style.pointerEvents = 'auto';
                    resendTrigger.style.opacity = '1';
                }
            }, 1000);
        }
        
        startCountdown();
        
        resendTrigger.addEventListener('click', function() {
            if (countdown > 0) return;
            
            // Show sending feedback
            const originalHtml = this.innerHTML;
            this.innerHTML = '<span class="text-muted"><i class="bi bi-arrow-repeat spin"></i> Sending code...</span>';
            
            // Simulate API call (replace with actual resend logic)
            setTimeout(() => {
                this.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill"></i> Code sent! Check your email.</span>';
                
                // Reset after 3 seconds
                setTimeout(() => {
                    this.innerHTML = originalHtml;
                    startCountdown();
                }, 3000);
            }, 1500);
        });
        
        // Form validation
        document.getElementById('verificationForm').addEventListener('submit', function(e) {
            const otp = document.getElementById('otpInput').value;
            
            if (otp.length !== 6 || !/^\d+$/.test(otp)) {
                e.preventDefault();
                otpInput.classList.add('shake');
                setTimeout(() => {
                    otpInput.classList.remove('shake');
                }, 500);
            }
        });
    });
    
    function createParticles() {
        const container = document.getElementById('particles');
        const particleCount = 15;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random size between 5 and 15px
            const size = Math.random() * 10 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Random position
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            
            // Random animation delay
            particle.style.animationDelay = `${Math.random() * 15}s`;
            
            // Random animation duration
            particle.style.animationDuration = `${15 + Math.random() * 10}s`;
            
            container.appendChild(particle);
        }
    }
</script>

<style>
    .spin {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<?php
require './assets/includes/footer.php';
?>