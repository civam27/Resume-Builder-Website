<?php
$title = "Account | Resume Builder";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->authPage();

$user = $db->query("SELECT full_name,email_id FROM users WHERE id='".$fn->Auth()['id']."'");
$user = $user->fetch_assoc();
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #4361ee;
    --primary-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    --secondary: #7209b7;
    --accent: #f72585;
    --light: #f8f9fa;
    --dark: #212529;
    --success: #4cc9f0;
    --card-bg: rgba(255, 255, 255, 0.95);
    --text-primary: #2b2d42;
    --text-secondary: #6c757d;
    --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 8px 24px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(-45deg, #f72585, #7209b7, #4361ee, #4cc9f0);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    color: var(--text-primary);
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.container {
    max-width: 1000px;
    z-index: 2;
    position: relative;
}

.account-container {
    background: var(--card-bg);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin: 2rem 0;
    padding: 2rem;
    min-height: 80vh;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1.5rem;
    margin-bottom: 2rem;
    border-bottom: 1px solid rgba(0,0,0,0.06);
    animation: fadeInDown 0.6s ease forwards;
}

.page-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 2rem;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.2rem;
    background: rgba(255, 255, 255, 0.9);
    color: var(--primary);
    border-radius: 50px;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    border: 1px solid rgba(67, 97, 238, 0.1);
}

.back-btn:hover {
    background: white;
    box-shadow: var(--shadow-md);
    color: var(--primary);
    transform: translateX(-3px);
}

.profile-sidebar {
    background: white;
    border-radius: 16px;
    padding: 2rem 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid rgba(255, 255, 255, 0.8);
    transition: var(--transition);
    animation: slideInLeft 0.6s ease forwards;
    opacity: 0;
    transform: translateX(-20px);
}

.profile-sidebar:hover {
    box-shadow: var(--shadow-md);
}

.avatar-circle {
    width: 100px;
    height: 100px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
    transition: var(--transition);
}

.avatar-circle:hover {
    transform: scale(1.05);
}

.initials {
    color: white;
    font-size: 2.5rem;
    font-weight: bold;
    font-family: 'Montserrat', sans-serif;
}

.profile-name {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.profile-email {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
}

.guideline-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.2rem;
    background: rgba(67, 97, 238, 0.1);
    color: var(--primary);
    border-radius: 50px;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid rgba(67, 97, 238, 0.2);
    width: 100%;
    justify-content: center;
}

.guideline-btn:hover {
    background: rgba(67, 97, 238, 0.2);
    color: var(--primary);
}

.form-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid rgba(255, 255, 255, 0.8);
    transition: var(--transition);
    animation: slideInRight 0.6s ease forwards;
    opacity: 0;
    transform: translateX(20px);
}

.form-card:hover {
    box-shadow: var(--shadow-md);
}

.form-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-family: 'Montserrat', sans-serif;
}

.form-control {
    padding: 0.75rem 1rem;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    transition: var(--transition);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    transform: translateY(-2px);
}

.input-group-text {
    background: rgba(67, 97, 238, 0.1);
    border: 1px solid #e2e8f0;
    border-right: none;
    color: var(--primary);
    transition: var(--transition);
}

.toggle-password {
    background: rgba(108, 117, 125, 0.1);
    border: 1px solid #e2e8f0;
    border-left: none;
    color: var(--text-secondary);
    transition: var(--transition);
}

.toggle-password:hover {
    background: rgba(108, 117, 125, 0.2);
}

.form-text {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.9rem 2rem;
    background: var(--primary-gradient);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    border: none;
    cursor: pointer;
    margin-top: 1rem;
    font-size: 1.1rem;
    width: 100%;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
}

.floating-icons {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.floating-icon {
    position: absolute;
    font-size: 24px;
    opacity: 0.5;
    color: white;
    animation: float 6s ease-in-out infinite;
}

.floating-icon:nth-child(1) { top: 10%; left: 5%; animation-delay: 0s; }
.floating-icon:nth-child(2) { top: 20%; right: 15%; animation-delay: 1s; }
.floating-icon:nth-child(3) { bottom: 30%; left: 10%; animation-delay: 2s; }
.floating-icon:nth-child(4) { bottom: 20%; right: 5%; animation-delay: 3s; }
.floating-icon:nth-child(5) { top: 40%; left: 20%; animation-delay: 4s; }
.floating-icon:nth-child(6) { top: 60%; right: 10%; animation-delay: 5s; }

@keyframes float {
    0% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
    100% { transform: translateY(0) rotate(0deg); }
}

@keyframes fadeInDown {
    from { 
        opacity: 0;
        transform: translateY(-20px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from { 
        opacity: 0;
        transform: translateX(-20px);
    }
    to { 
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from { 
        opacity: 0;
        transform: translateX(20px);
    }
    to { 
        opacity: 1;
        transform: translateX(0);
    }
}

.modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: var(--shadow-md);
}

.modal-header {
    background: var(--primary-gradient);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1.2rem 1.5rem;
}

.modal-title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modal-body {
    padding: 1.5rem;
}

.list-group-item {
    border: none;
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modal-footer {
    border-top: 1px solid #e2e8f0;
    padding: 1rem 1.5rem;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
    
    .account-container {
        padding: 1.5rem;
    }
    
    .profile-sidebar, .form-card {
        padding: 1.5rem;
    }
}
</style>

<!-- Floating background icons -->
<div class="floating-icons">
    <div class="floating-icon">👤</div>
    <div class="floating-icon">🔒</div>
    <div class="floating-icon">⚙️</div>
    <div class="floating-icon">📝</div>
    <div class="floating-icon">🔑</div>
    <div class="floating-icon">💼</div>
</div>

<div class="container py-4">
    <div class="account-container">
        <div class="page-header">
            <h1 class="page-title"><i class="bi bi-person-circle"></i> Account Settings</h1>
            <a href="javascript:void(0)" class="back-btn" onclick="history.back()">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="profile-sidebar">
                    <div class="profile-avatar mb-3">
                        <div class="avatar-circle">
                            <span class="initials"><?= strtoupper(substr($user['full_name'], 0, 1)) ?></span>
                        </div>
                    </div>
                    <h5 class="profile-name"><?= $user['full_name'] ?></h5>
                    <p class="profile-email"><?= $user['email_id'] ?></p>
                    <div class="d-grid">
                        <button type="button" class="guideline-btn" data-bs-toggle="modal" data-bs-target="#passwordHelp">
                            <i class="bi bi-info-circle"></i> Password Guidelines
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <form action="actions/updateprofile.action.php" method="post" class="needs-validation" novalidate>
                    <div class="form-card">
                        <h5 class="form-title"><i class="bi bi-pencil-square"></i> Edit Profile Information</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="fullName" class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="fullName" name="full_name" 
                                           placeholder="e.g. John Smith" value="<?= @$user['full_name'] ?>" required>
                                    <div class="invalid-feedback">
                                        Please provide your full name.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email_id" 
                                           placeholder="your.email@example.com" value="<?= @$user['email_id'] ?>" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email address.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="password" class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Leave blank to keep current password">
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">Minimum 8 characters with letters and numbers</div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="submit-btn">
                                    <i class="bi bi-check-circle me-2"></i> Update Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Password Guidelines Modal -->
<div class="modal fade" id="passwordHelp" tabindex="-1" aria-labelledby="passwordHelpLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordHelpLabel"><i class="bi bi-shield-lock me-2"></i>Password Guidelines</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>For security, please follow these password guidelines:</p>
                <ul class="list-group">
                    <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i>Minimum 8 characters</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i>Include both letters and numbers</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i>Use uppercase and lowercase letters</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i>Special characters are optional but recommended</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to elements on scroll
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                if (entry.target.classList.contains('profile-sidebar')) {
                    entry.target.style.transform = 'translateX(0)';
                } else if (entry.target.classList.contains('form-card')) {
                    entry.target.style.transform = 'translateX(0)';
                }
            }
        });
    }, observerOptions);
    
    // Observe profile sidebar and form card
    const profileSidebar = document.querySelector('.profile-sidebar');
    const formCard = document.querySelector('.form-card');
    
    if (profileSidebar) observer.observe(profileSidebar);
    if (formCard) observer.observe(formCard);
    
    // Form validation
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
    
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordInput = document.querySelector('#password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            const eyeIcon = this.querySelector('i');
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    }
    
    // Add subtle animations to form elements on focus
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach(control => {
        control.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        control.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
});
</script>

<?php
require './assets/includes/footer.php';
?>