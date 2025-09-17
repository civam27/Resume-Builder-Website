
<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_GET) {
    $post = $_GET;

    // Check required fields
    if (
        !empty($post['id']) 
    ) {


            $authid = $fn->Auth()['id'];


        try {
            $query = "DELETE resumes,skills,educations,experiences FROM resumes ";
            $query.="LEFT JOIN skills ON resumes.id=skills.resume_id ";
             $query.="LEFT JOIN educations ON resumes.id=educations.resume_id ";
             $query.="LEFT JOIN experiences ON resumes.id=experiences.resume_id ";
             $query.="WHERE resumes.id={$post['id']} AND resumes.user_id=$authid";



          
            $db->query($query);

            $fn->setAlert('Resume deleted !');
            $fn->redirect('../myresumes.php');

        } catch (Exception $error) {
            $fn->setError($error->getMessage());
            $fn->redirect('../myresumes.php');
        }

    } else {
        $fn->setError('Please fill the form completely!');
            $fn->redirect('../myresumes.php');
    }

} else {
            $fn->redirect('../myresumes.php');
}
