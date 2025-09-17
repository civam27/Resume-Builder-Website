<?php
$title = "Create Resume | Resume Builder";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->AuthPage();
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

.create-resume-container {
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

.form-container {
    animation: fadeInUp 0.8s ease forwards;
}

.form-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    border: 1px solid rgba(255, 255, 255, 0.8);
    margin-bottom: 1.5rem;
}

.form-card:hover {
    box-shadow: var(--shadow-md);
}

.card-header {
    background: var(--primary-gradient);
    color: white;
    padding: 1.2rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-header h5 {
    margin: 0;
    font-weight: 600;
    font-family: 'Montserrat', sans-serif;
}

.card-body {
    padding: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-family: 'Montserrat', sans-serif;
}

.form-control, .form-select {
    padding: 0.75rem 1rem;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    transition: var(--transition);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
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

@keyframes fadeInUp {
    from { 
        opacity: 0;
        transform: translateY(20px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

.form-row {
    margin-bottom: 1rem;
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
    
    .create-resume-container {
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 1.2rem;
    }
}
</style>

<!-- Floating background icons -->
<div class="floating-icons">
    <div class="floating-icon">📄</div>
    <div class="floating-icon">📝</div>
    <div class="floating-icon">👨‍💼</div>
    <div class="floating-icon">🎓</div>
    <div class="floating-icon">📁</div>
    <div class="floating-icon">🔍</div>
</div>

<div class="container py-4">
    <div class="create-resume-container">
        <div class="page-header">
            <h1 class="page-title"><i class="bi bi-file-earmark-plus"></i> Create Professional Resume</h1>
            <a href="javascript:void(0)" class="back-btn" onclick="history.back()">
                <i class="bi bi-arrow-left-circle"></i> Back
            </a>
        </div>

        <div class="form-container">
            <form action="actions/createresume.action.php" method="post">
                <!-- Resume Title -->
                <div class="form-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Resume Title</label>
                                <input type="text" name="resume_title" placeholder="e.g. Senior Web Developer" value="resume<?=time()?>" class="form-control" required>
                                <div class="form-text">Give your resume a descriptive title</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="form-card">
                    <div class="card-header">
                        <i class="bi bi-person-badge"></i>
                        <h5 class="mb-0">Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="full_name" placeholder="e.g. John Smith" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email_id" placeholder="e.g. john@example.com" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Professional Objective</label>
                                <textarea class="form-control" name="objective" rows="3" placeholder="Describe your career goals and objectives" required></textarea>
                            </div> 
                            <div class="col-md-6">
                                <label class="form-label">Mobile No</label>
                                <input type="number" min="1111111111" name="mobile_no" placeholder="e.g. 9569569569" max="9999999999"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" name="dob" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Transgender</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Religion</label>
                                <select class="form-select" name="religion">
                                    <option>Hindu</option>
                                    <option>Muslim</option>
                                    <option>Sikh</option>
                                    <option>Christian</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nationality</label>
                                <select class="form-select" name="nationality">
                                    <option>Indian</option>
                                    <option>Non Indian</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Marital Status</label>
                                <select class="form-select" name="marital_status">
                                    <option>Married</option>
                                    <option>Single</option>
                                    <option>Divorced</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hobbies</label>
                                <input type="text" name="hobbies" placeholder="e.g. Reading Books, Watching Movies" class="form-control" required>
                                <div class="form-text">Separate hobbies with commas</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Languages Known</label>
                                <input type="text" placeholder="e.g. Hindi, English" name="languages" class="form-control" required>
                                <div class="form-text">Separate languages with commas</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter your complete address" rows="2" required></textarea>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="submit-btn">
                        <i class="bi bi-floppy me-2"></i> Create Resume
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add focus effects to form elements
    const formControls = document.querySelectorAll('.form-control, .form-select');
    
    formControls.forEach(control => {
        control.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        control.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
    
    // Add animation to form cards on scroll
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe all form cards
    document.querySelectorAll('.form-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>

<?php
require './assets/includes/footer.php';
?>