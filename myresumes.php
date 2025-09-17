<?php
$title = "My Resume | Resume Builder";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->AuthPage();
$resumes = $db->query('SELECT * FROM resumes WHERE user_id='.$fn->Auth()['id'].' ORDER BY id DESC');
$resume = $resumes->fetch_all(1);
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
    --card-bg: rgba(255, 255, 255, 0.92);
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
    max-width: 1200px;
    z-index: 2;
    position: relative;
}

.dashboard-container {
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
}

.add-new-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: var(--primary-gradient);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    border: none;
    cursor: pointer;
}

.add-new-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
    color: white;
}

.resume-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.resume-card {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
    border: 1px solid rgba(255, 255, 255, 0.6);
    animation: fadeIn 0.6s ease forwards;
    opacity: 0;
    transform: translateY(20px);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.resume-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

.resume-card__header {
    padding: 1.5rem 1.5rem 0.5rem;
    position: relative;
}

.resume-card__title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    font-size: 1.25rem;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.resume-card__body {
    padding: 0 1.5rem;
    flex-grow: 1;
}

.resume-date {
    font-size: 0.8rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.resume-card__footer {
    padding: 1rem 1.5rem 1.5rem;
    background: transparent;
    border-top: none;
}

.resume-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.5rem 0.9rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    transition: var(--transition);
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.action-btn i {
    font-size: 0.8rem;
}

.btn-open {
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary);
}

.btn-open:hover {
    background-color: var(--primary);
    color: white;
}

.btn-edit {
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success);
}

.btn-edit:hover {
    background-color: var(--success);
    color: white;
}

.btn-delete {
    background-color: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

.btn-delete:hover {
    background-color: #dc3545;
    color: white;
}

.btn-clone {
    background-color: rgba(114, 9, 183, 0.1);
    color: var(--secondary);
}

.btn-clone:hover {
    background-color: var(--secondary);
    color: white;
}

.empty-state {
    padding: 4rem 2rem;
    text-align: center;
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    grid-column: 1 / -1;
    margin: 2rem 0;
}

.empty-state i {
    font-size: 4rem;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 1.5rem;
}

.empty-state h4 {
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

@keyframes fadeIn {
    from { 
        opacity: 0;
        transform: translateY(20px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
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

@media (max-width: 768px) {
    .resume-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .page-title {
        font-size: 1.75rem;
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
    <div class="dashboard-container">
        <div class="page-header">
            <h1 class="page-title">My Resumes</h1>
            <a href="createresume.php" class="add-new-btn">
                <i class="bi bi-file-earmark-plus"></i> Create New Resume
            </a>
        </div>

        <?php if($resumes && count($resume) > 0): ?>
        <div class="resume-grid">
            <?php foreach($resume as $index => $resumeItem): ?>
            <div class="resume-card" style="animation-delay: <?= $index * 0.1 ?>s">
                <div class="resume-card__header">
                    <h3 class="resume-card__title" title="<?= htmlspecialchars($resumeItem['resume_title']) ?>">
                        <?= htmlspecialchars($resumeItem['resume_title']) ?>
                    </h3>
                </div>
                <div class="resume-card__body">
                    <p class="resume-date">
                        <i class="bi bi-clock-history me-1"></i>
                        Last updated <?= date('M j, Y \a\t g:i A', $resumeItem['updated_at']) ?>
                    </p>
                </div>
                <div class="resume-card__footer">
                    <div class="resume-actions">
                        <a href="resume.php?resume=<?= $resumeItem['slug'] ?>" target="_blank" class="action-btn btn-open">
                            <i class="bi bi-file-text"></i> Open
                        </a>
                        <a href="updateresume.php?resume=<?= $resumeItem['slug'] ?>" class="action-btn btn-edit">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <a href="actions/deleteresume.action.php?id=<?= $resumeItem['id'] ?>" class="action-btn btn-delete" onclick="return confirm('Are you sure you want to delete this resume?');">
                            <i class="bi bi-trash2"></i> Delete
                        </a>
                        <a href="actions/clonecv.action.php?resume=<?= $resumeItem['slug'] ?>" class="action-btn btn-clone">
                            <i class="bi bi-copy"></i> Clone
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <i class="bi bi-file-text"></i>
            <h4>No Resumes Yet</h4>
            <p>Get started by creating your first professional resume. Our builder makes it easy to create a standout resume in minutes.</p>
            <a href="createresume.php" class="add-new-btn">
                <i class="bi bi-file-earmark-plus"></i> Create Your First Resume
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add hover animations to cards
    const cards = document.querySelectorAll('.resume-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Animate elements on scroll
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
    
    // Observe all resume cards
    document.querySelectorAll('.resume-card').forEach(card => {
        observer.observe(card);
    });
});
</script>

<?php
require './assets/includes/footer.php';
?>