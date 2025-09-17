<?php
$title = "Update Resume | Resume Builder";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->AuthPage();
$slug=$_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE ( slug='$slug' AND user_id=".$fn->Auth()['id'].") ");
$resume = $resumes->fetch_assoc();
if(!$resume){
    $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=".$resume['id']." ) ");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM educations WHERE (resume_id=".$resume['id']." ) ");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM skills WHERE (resume_id=".$resume['id']." ) ");
$skills = $skills->fetch_all(1);

?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #4361ee;
    --primary-gradient: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    --secondary: #7209b7;
    --accent: #f72585;
    --success: #4cc9f0;
    --warning: #ff9e00;
    --info: #4895ef;
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
    max-width: 1200px;
    z-index: 2;
    position: relative;
}

.update-resume-container {
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
    margin-bottom: 2rem;
    animation: slideIn 0.5s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

.form-card:hover {
    box-shadow: var(--shadow-md);
}

.card-header {
    padding: 1.2rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    color: white;
    background: var(--primary-gradient);
}

.card-header h5 {
    margin: 0;
    font-weight: 600;
    font-family: 'Montserrat', sans-serif;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.add-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.4rem 0.9rem;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border-radius: 50px;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.3);
    font-size: 0.9rem;
}

.add-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
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

/* Experience, Education & Skills Cards */
.exp-card, .edu-card, .skill-card {
    background: white;
    border-radius: 12px;
    padding: 1.2rem;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid #f1f3f4;
    transition: var(--transition);
    position: relative;
}

.exp-card:hover, .edu-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.exp-title, .edu-title {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-family: 'Montserrat', sans-serif;
}

.exp-company, .edu-institute {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.exp-date, .edu-date {
    font-size: 0.85rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.4rem;
    margin-bottom: 0.75rem;
}

.exp-desc {
    font-size: 0.9rem;
    color: var(--text-primary);
    line-height: 1.5;
}

.delete-btn {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    padding: 0.35rem 0.5rem;
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
    border-radius: 6px;
    text-decoration: none;
    transition: var(--transition);
    font-size: 0.8rem;
}

.delete-btn:hover {
    background: #dc3545;
    color: white;
}

/* Skills styling */
.skills-container {
    display: flex;
    flex-wrap: wrap;
    gap: 0.7rem;
}

.skill-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 0.9rem;
    background: rgba(255, 158, 0, 0.1);
    color: var(--warning);
    border-radius: 50px;
    font-weight: 500;
    transition: var(--transition);
}

.skill-badge:hover {
    background: var(--warning);
    color: white;
    transform: translateY(-2px);
}

.skill-delete {
    color: inherit;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-state {
    padding: 1.5rem;
    text-align: center;
    background: #f8f9fa;
    border-radius: 12px;
    margin: 1rem 0;
}

.empty-state p {
    margin: 0;
    color: var(--text-secondary);
    font-style: italic;
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

@keyframes slideIn {
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
    
    .update-resume-container {
        padding: 1.5rem;
    }
    
    .card-body {
        padding: 1.2rem;
    }
    
    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
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
    <div class="update-resume-container">
        <div class="page-header">
            <h1 class="page-title"><i class="bi bi-pencil-square"></i> Update Resume</h1>
            <a href="myresumes.php" class="back-btn">
                <i class="bi bi-arrow-left-circle"></i> Back to Resumes
            </a>
        </div>

        <div class="form-container">
            <form action="actions/updateresume.action.php" method="post">
                <input type="hidden" name="id" value="<?=$resume['id']?>" />
                <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
                
                <!-- Resume Title -->
                <div class="form-card" style="animation-delay: 0.1s">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Resume Title</label>
                                <input type="text" name="resume_title" placeholder="e.g. Senior Web Developer" value="<?=@$resume['resume_title']?>" class="form-control" required>
                                <div class="form-text">Give your resume a descriptive title</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="form-card" style="animation-delay: 0.2s">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-person-badge"></i> Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" value="<?=@$resume['full_name']?>" name="full_name" placeholder="e.g. John Smith" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" value="<?=@$resume['email_id']?>" name="email_id" placeholder="e.g. john@example.com" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Professional Objective</label>
                                <textarea class="form-control" name="objective" rows="3" placeholder="Describe your career goals and objectives" required><?=@$resume['objective']?></textarea>
                            </div> 
                            <div class="col-md-6">
                                <label class="form-label">Mobile No</label>
                                <input type="number" value="<?=@$resume['mobile_no']?>" min="1111111111" name="mobile_no" placeholder="e.g. 9569569569" max="9999999999"
                                    class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" value="<?=@$resume['dob']?>" name="dob" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option <?=($resume['gender']=='Male')?'selected':''?>>Male</option>
                                    <option <?=($resume['gender']=='Female')?'selected':''?>>Female</option>
                                    <option <?=($resume['gender']=='Transgender')?'selected':''?>>Transgender</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Religion</label>
                                <select class="form-select" name="religion">
                                    <option <?=($resume['religion']=='Hindu')?'selected':''?>>Hindu</option>
                                    <option <?=($resume['religion']=='Muslim')?'selected':''?>>Muslim</option>
                                    <option <?=($resume['religion']=='Sikh')?'selected':''?>>Sikh</option>
                                    <option <?=($resume['religion']=='Christian')?'selected':''?>>Christian</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nationality</label>
                                <select class="form-select" name="nationality">
                                    <option <?=($resume['nationality']=='Indian')?'selected':''?>>Indian</option>
                                    <option <?=($resume['nationality']=='Non Indian')?'selected':''?>>Non Indian</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Marital Status</label>
                                <select class="form-select" name="marital_status">
                                    <option <?=($resume['marital_status']=='Married')?'selected':''?>>Married</option>
                                    <option <?=($resume['marital_status']=='Single')?'selected':''?>>Single</option>
                                    <option <?=($resume['marital_status']=='Divorced')?'selected':''?>>Divorced</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hobbies</label>
                                <input type="text" value="<?=@$resume['hobbies']?>" name="hobbies" placeholder="e.g. Reading Books, Watching Movies" class="form-control" required>
                                <div class="form-text">Separate hobbies with commas</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Languages Known</label>
                                <input type="text" value="<?=@$resume['languages']?>" placeholder="e.g. Hindi, English" name="languages" class="form-control" required>
                                <div class="form-text">Separate languages with commas</div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" placeholder="Enter your complete address" rows="2" required><?=@$resume['address']?></textarea>
                            </div> 
                        </div>
                    </div>
                </div>
                
                <!-- Experience Section -->
                <div class="form-card" style="animation-delay: 0.3s">
                    <div class="card-header" style="background: linear-gradient(135deg, #4cc9f0 0%, #4895ef 100%);">
                        <h5 class="mb-0"><i class="bi bi-briefcase"></i> Work Experience</h5>
                        <a class="add-btn" data-bs-toggle="modal" data-bs-target="#addexp">
                            <i class="bi bi-plus-circle"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if($exps && count($exps) > 0): ?>
                            <div class="row">
                                <?php foreach($exps as $exp): ?>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="exp-card">
                                        <a href="actions/deleteexp.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>" class="delete-btn">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <h6 class="exp-title"><?=$exp['position']?></h6>
                                        <p class="exp-company">
                                            <i class="bi bi-buildings"></i> <?=$exp['company']?>
                                        </p>
                                        <p class="exp-date">
                                            <i class="bi bi-calendar"></i> <?=$exp['started'].' - '. $exp['ended']?>
                                        </p>
                                        <p class="exp-desc">
                                            <?=$exp['job_desc']?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <p><i class="bi bi-info-circle"></i> No experience added yet. Click "Add New" to add your work experience.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Education Section -->
                <div class="form-card" style="animation-delay: 0.4s">
                    <div class="card-header" style="background: linear-gradient(135deg, #4895ef 0%, #4361ee 100%);">
                        <h5 class="mb-0"><i class="bi bi-journal-bookmark"></i> Education</h5>
                        <a href="" class="add-btn" data-bs-toggle="modal" data-bs-target="#addedu">
                            <i class="bi bi-plus-circle"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if($edus && count($edus) > 0): ?>
                            <div class="row">
                                <?php foreach($edus as $edu): ?>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="edu-card">
                                        <a href="actions/deleteedu.action.php?id=<?=$edu['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>" class="delete-btn">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <h6 class="edu-title"><?=$edu['course']?></h6>
                                        <p class="edu-institute">
                                            <i class="bi bi-book"></i> <?=$edu['institute']?>
                                        </p>
                                        <p class="edu-date">
                                            <i class="bi bi-calendar"></i> <?=$edu['started'].' - '. $edu['ended']?>
                                        </p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <p><i class="bi bi-info-circle"></i> No education added yet. Click "Add New" to add your education.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Skills Section -->
                <div class="form-card" style="animation-delay: 0.5s">
                    <div class="card-header" style="background: linear-gradient(135deg, #ff9e00 0%, #ffaa33 100%); color: #333;">
                        <h5 class="mb-0"><i class="bi bi-boxes"></i> Skills</h5>
                        <a href="" class="add-btn" style="color: #333; background: rgba(255, 255, 255, 0.3);" data-bs-toggle="modal" data-bs-target="#addskill">
                            <i class="bi bi-plus-circle"></i> Add New
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if($skills && count($skills) > 0): ?>
                            <div class="skills-container">
                                <?php foreach($skills as $skill): ?>
                                <div class="skill-badge">
                                    <?=$skill['skill']?>
                                    <a href="actions/deleteskill.action.php?id=<?=$skill['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>" class="skill-delete">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <p><i class="bi bi-info-circle"></i> No skills added yet. Click "Add New" to add your skills.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="submit-btn">
                        <i class="bi bi-floppy me-2"></i> Update Resume
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals (unchanged from your original code) -->
<!-- Experience Modal -->
<div class="modal fade" id="addexp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="actions/addexperience.action.php" class="row g-3">
            <input type="hidden" name="resume_id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />

            <div class="col-12">
                <label for="inputEmail4" class="form-label">Position / Job Role</label>
                <input type="text" class="form-control" name="position" placeholder="Web Developer Consultant (2+ Years)" id="inputEmail4" required>
            </div>
            <div class="col-12">
                <label for="inputPassword4" class="form-label">Company</label>
                <input type="text" class="form-control" name="company" placeholder="Dominos, New Delhi" id="inputPassword4" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Joined</label>
                <input type="text" name="started" placeholder="october 2021" class="form-control" id="inputPassword4" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Regined</label>
                <input type="text" name="ended" class="form-control" placeholder="Currently pursuing in" id="inputPassword4" required>
            </div>
            <div class="col-12">
                <label for="inputPassword4" class="form-label">Job Description</label>
                <textarea class="form-control" name="job_desc" required></textarea>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Add Experience</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Education Modal -->
<div class="modal fade" id="addedu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Education</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="actions/addeducation.action.php" class="row g-3">
            <input type="hidden" name="resume_id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Course / Degree</label>
                <input type="text" class="form-control" name="course" placeholder="Bachelor of Computer Applications" id="inputEmail4" required>
            </div>
            <div class="col-12">
                <label for="inputPassword4" class="form-label">Institute / Board</label>
                <input type="text" class="form-control" name="institute" placeholder="University of Delhi, New Delhi" id="inputPassword4" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Started</label>
                <input type="text" name="started" placeholder="May 2020" class="form-control" id="inputPassword4" required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Ended</label>
                <input type="text" name="ended" class="form-control" placeholder="Currently pursuing in" id="inputPassword4" required>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Add Education</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Skills Modal -->
<div class="modal fade" id="addskill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Skill</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="actions/addskill.action.php" class="row g-3">
            <input type="hidden" name="resume_id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Skill</label>
                <input type="text" class="form-control" name="skill" placeholder="React.js, UI/UX Design, PHP & MySQL" id="inputEmail4" required>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Add Skill</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
        observer.observe(card);
    });
    
    // Add hover effects to cards
    const cards = document.querySelectorAll('.exp-card, .edu-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>

<?php
require './assets/includes/footer.php';
?>