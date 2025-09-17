<?php
require 'assets/class/database.class.php';
require 'assets/class/function.class.php';

$slug = $_GET['resume'] ?? '';
$resumes = $db->query("SELECT * FROM resumes WHERE (slug='$slug') ");
$resume = $resumes->fetch_assoc();
if (!$resume) {
    $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=" . $resume['id'] . " ) ");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM educations WHERE (resume_id=" . $resume['id'] . " ) ");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM skills WHERE (resume_id=" . $resume['id'] . " ) ");
$skills = $skills->fetch_all(1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+VIC+WA+NT+Hand:wght@400..700&family=Englebert&family=Patrick+Hand&family=Roboto+Flex:opsz,wght@8..144,100..1000&family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Added more Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Dancing+Script:wght@400..700&family=Quicksand:wght@300..700&family=Pacifico&family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="./assets/images/logo.png">
    <title><?= $resume['full_name'] . '  ' . $resume['resume_title'] ?></title>
</head>

<body>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: 'Poppins', sans-serif;
            font-size: 12pt;
            background: rgb(249, 249, 249);
            background: radial-gradient(circle, rgba(249, 249, 249, 1) 0%, rgba(240, 232, 127, 1) 49%, rgba(246, 243, 132, 1) 100%);
            background-attachment: fixed;
        }

        * {
            margin: 0px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 21cm;
            min-height: 29.7cm;
            padding: 1.5cm;
            margin: 0.5cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .subpage {
            height: 100%;
            position: relative;
            z-index: 2;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            
            .extra, .offcanvas {
                display: none !important;
            }
            
            .bg-pattern {
                opacity: 0.05 !important;
            }
        }

        * {
            transition: all .2s;
        }

        table {
            border-collapse: collapse;
        }

        .pr {
            padding-right: 30px;
        }

        .pd-table td {
            padding-right: 10px;
            padding-bottom: 3px;
            padding-top: 3px;
        }
        
        .extra {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            opacity: 0.03;
        }
        
        .pattern-option {
            width: 60px;
            height: 60px;
            display: inline-block;
            margin: 5px;
            cursor: pointer;
            border: 2px solid transparent;
            background-size: cover;
        }
        
        .pattern-option.active {
            border-color: #007bff;
        }
        
        .font-option {
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }
        
        .font-option.active {
            border-color: #007bff;
            background-color: #f0f8ff;
        }
        
        .section-title {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-bottom: 10px;
            margin-top: 20px;
        }
        
        .experience, .education {
            margin-bottom: 15px;
            padding-left: 10px;
            border-left: 3px solid #e74c3c;
        }
        
        .skill-badge {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 3px 8px;
            margin: 3px;
            display: inline-block;
        }
        
        .declaration-box {
            background-color: #f8f9fa;
            border-left: 4px solid #2c3e50;
            padding: 10px 15px;
            font-style: italic;
        }
        
        .contact-info div {
            margin-bottom: 5px;
        }
        
        .contact-info i {
            width: 20px;
            margin-right: 10px;
            color: #3498db;
        }
    </style>
    <?php
if ($fn->Auth()!=false && $fn->Auth()['id']==$resume['user_id']) {
    ?>
    

    <div class="extra w-100 py-2 bg-dark d-flex justify-content-center gap-3">
        <button class="btn btn-light btn-sm" onclick="shareResume()"><i class="bi bi-whatsapp"></i> Share</button>
        <button class="btn btn-light btn-sm" onclick="printResume()"><i class="bi bi-printer"></i> Print</button>
        <button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#font"><i class="bi bi-file-earmark-font"></i> Font</button>
    </div>

    <?php
}
?>



    <div class="page" id="resume-page">
        <div id="bg-pattern" class="bg-pattern"></div>
        <div class="subpage">
            <div class="text-center mb-4">
                <h1 class="fw-bold mb-1" style="color: #2c3e50;"><?= $resume['full_name'] ?></h1>
                <div class="text-muted"><?= $resume['resume_title'] ?></div>
            </div>
            
            <div class="row mb-4 contact-info">
                <div class="col-md-6">
                    <div><i class="bi bi-telephone-fill"></i> +91-<?= $resume['mobile_no'] ?></div>
                    <div><i class="bi bi-envelope-fill"></i> <?= $resume['email_id'] ?></div>
                </div>
                <div class="col-md-6">
                    <div><i class="bi bi-geo-alt-fill"></i> <?= $resume['address'] ?></div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="mb-4">
                <h4 class="section-title">Objective</h4>
                <p class="objective"><?= $resume['objective'] ?></p>
            </div>
            
            <div class="mb-4">
                <h4 class="section-title">Experience</h4>
                <div class="experiences">
                    <?php if ($exps) : ?>
                        <?php foreach ($exps as $exp) : ?>
                            <div class="experience mb-3">
                                <h5 class="fw-bold mb-1"><?= $exp['position'] ?></h5>
                                <div class="text-primary mb-1"><?= $exp['company'] ?></div>
                                <div class="text-muted small mb-1"><?= $exp['started'] ?> – <?= $exp['ended'] ?></div>
                                <div class="work-description"><?= $exp['job_desc'] ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="experience mb-2">
                            <div class="text-muted">I am a Fresher.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-4">
                <h4 class="section-title">Education</h4>
                <div class="educations">
                    <?php if ($edus) : ?>
                        <?php foreach ($edus as $edu) : ?>
                            <div class="education mb-3">
                                <h5 class="fw-bold mb-1"><?= $edu['course'] ?></h5>
                                <div class="text-primary mb-1"><?= $edu['institute'] ?></div>
                                <div class="text-muted small"><?= $edu['started'] ?> – <?= $edu['ended'] ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="education mb-2">
                            <div class="text-muted">I don't have any Education.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-4">
                <h4 class="section-title">Skills</h4>
                <div class="skills">
                    <?php if ($skills) : ?>
                        <?php foreach ($skills as $skill) : ?>
                            <span class="skill-badge"><?= $skill['skill'] ?></span>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="text-muted">I don't have any Skills.</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-4">
                <h4 class="section-title">Personal Details</h4>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="fw-bold" width="40%">Date of Birth</td>
                                <td><?= date('d F Y', strtotime($resume['dob'])) ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Gender</td>
                                <td><?= $resume['gender'] ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Religion</td>
                                <td><?= $resume['religion'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td class="fw-bold" width="40%">Nationality</td>
                                <td><?= $resume['nationality'] ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Marital Status</td>
                                <td><?= $resume['marital_status'] ?></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Hobbies</td>
                                <td><?= $resume['hobbies'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <h4 class="section-title">Languages Known</h4>
                <div class="languages">
                    <?= $resume['languages'] ?>
                </div>
            </div>
            
            <div class="mb-4">
                <h4 class="section-title">Declaration</h4>
                <div class="declaration-box">
                    I hereby declare that above information is correct to the best of my
                    knowledge and can be supported by relevant documents as and when
                    required.
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-5">
                <div>Date: <?= date('d F, Y', $resume['updated_at']) ?></div>
                <div class="text-end">
                    <div class="fw-bold"><?= $resume['full_name'] ?></div>
                    <div class="text-muted small">Signature</div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="font" aria-labelledby="fontLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="fontLabel">Choose Font Style</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="font-option active" style="font-family: 'Poppins', sans-serif" onclick="changeFont('Poppins, sans-serif')">Poppins (Default)</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Montserrat', sans-serif" onclick="changeFont('Montserrat, sans-serif')">Montserrat</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Raleway', sans-serif" onclick="changeFont('Raleway, sans-serif')">Raleway</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Playfair Display', serif" onclick="changeFont('Playfair Display, serif')">Playfair Display</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Roboto Flex', sans-serif" onclick="changeFont('Roboto Flex, sans-serif')">Roboto Flex</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Quicksand', sans-serif" onclick="changeFont('Quicksand, sans-serif')">Quicksand</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Dancing Script', cursive" onclick="changeFont('Dancing Script, cursive')">Dancing Script</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Pacifico', cursive" onclick="changeFont('Pacifico, cursive')">Pacifico</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Comfortaa', sans-serif" onclick="changeFont('Comfortaa, sans-serif')">Comfortaa</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'STIX Two Text', serif" onclick="changeFont('STIX Two Text, serif')">STIX Two Text</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Englebert', sans-serif" onclick="changeFont('Englebert, sans-serif')">Englebert</div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="font-option" style="font-family: 'Patrick Hand', cursive" onclick="changeFont('Patrick Hand, cursive')">Patrick Hand</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
        // Print functionality
        function printResume() {
            window.print();
        }
        
        // Share functionality
        function shareResume() {
            const resumeUrl = window.location.href;
            const shareText = "Check out my resume: " + resumeUrl;
            
            if (navigator.share) {
                navigator.share({
                    title: 'My Resume',
                    text: shareText,
                    url: resumeUrl
                })
                .catch(error => {
                    console.log('Error sharing:', error);
                    copyToClipboard(resumeUrl);
                });
            } else if (navigator.clipboard) {
                copyToClipboard(resumeUrl);
            } else {
                // Fallback for browsers that don't support sharing API
                prompt("Copy this URL to share:", resumeUrl);
            }
        }
        
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Resume link copied to clipboard!');
            }).catch(err => {
                console.error('Could not copy text: ', err);
                prompt("Copy this URL to share:", text);
            });
        }
        
        // Background pattern functionality
        function changeBackground(pattern) {
            const bgElement = document.getElementById('bg-pattern');
            const patternOptions = document.querySelectorAll('.pattern-option');
            
            patternOptions.forEach(option => option.classList.remove('active'));
            event.target.classList.add('active');
            
            switch(pattern) {
                case 'dots':
                    bgElement.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 40 40\"><circle cx=\"20\" cy=\"20\" r=\"2\" fill=\"%23e0e0e0\"/></svg>')";
                    break;
                case 'lines':
                    bgElement.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 40 40\"><line x1=\"0\" y1=\"0\" x2=\"40\" y2=\"40\" stroke=\"%23e0e0e0\" stroke-width=\"1\"/></svg>')";
                    break;
                case 'grid':
                    bgElement.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 40 40\"><rect width=\"20\" height=\"20\" fill=\"%23f0f0f0\"/></svg>')";
                    break;
                case 'squares':
                    bgElement.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"60\" height=\"60\" viewBox=\"0 0 60 60\"><path d=\"M0 0h30v30H0z\" fill=\"%23f5f5f5\" /><path d=\"M30 30h30v30H30z\" fill=\"%23f5f5f5\" /><path d=\"M30 0h30v30H30z\" fill=\"%23fafafa\" /><path d=\"M0 30h30v30H0z\" fill=\"%23fafafa\" /></svg>')";
                    break;
                case 'circles':
                    bgElement.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 40 40\"><circle cx=\"10\" cy=\"10\" r=\"2\" fill=\"%23e0e0e0\" /><circle cx=\"30\" cy=\"30\" r=\"2\" fill=\"%23e0e0e0\" /></svg>')";
                    break;
                case 'cross':
                    bgElement.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"100\" height=\"100\" viewBox=\"0 0 100 100\"><path d=\"M0 0 L100 100\" stroke=\"%23f0f0f0\" stroke-width=\"2\" /><path d=\"M100 0 L0 100\" stroke=\"%23f0f0f0\" stroke-width=\"2\" /></svg>')";
                    break;
                case 'triangles':
                    bgElement.style.backgroundImage = "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"60\" height=\"60\" viewBox=\"0 0 60 60\"><polygon points=\"0,0 30,0 0,30\" fill=\"%23f5f5f5\" /><polygon points=\"60,0 30,0 60,30\" fill=\"%23f5f5f5\" /><polygon points=\"0,60 30,60 0,30\" fill=\"%23f5f5f5\" /><polygon points=\"60,60 30,60 60,30\" fill=\"%23f5f5f5\" /></svg>')";
                    break;
                default:
                    bgElement.style.backgroundImage = "none";
            }
        }
        
        // Font change functionality
        function changeFont(font) {
            document.querySelectorAll('.subpage *').forEach(el => {
                el.style.fontFamily = font;
            });
            
            const fontOptions = document.querySelectorAll('.font-option');
            fontOptions.forEach(option => option.classList.remove('active'));
            event.target.classList.add('active');
            
            // Special handling for script fonts to increase size slightly
            if (font.includes('Dancing Script') || font.includes('Pacifico')) {
                document.querySelectorAll('.subpage').forEach(el => {
                    el.style.fontSize = '13pt';
                });
            } else {
                document.querySelectorAll('.subpage').forEach(el => {
                    el.style.fontSize = '12pt';
                });
            }
        }
        
        // Initialize with no background pattern
        document.addEventListener('DOMContentLoaded', function() {
            changeBackground('none');
        });
    </script>
</body>
</html>