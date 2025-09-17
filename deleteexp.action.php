
<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_GET) {
    $post = $_GET;

    // Check required fields
    if (
        !empty($post['id']) && 
        !empty($post['resume_id']) 
    ) {


        try {
            $query = "DELETE FROM experiences WHERE id={$post['id']} AND resume_id={$post['resume_id']}";



          
            $db->query($query);

            $fn->setAlert('Experience deleted !');
            $fn->redirect('../updateresume.php?resume='.$post['slug']);

        } catch (Exception $error) {
            $fn->setError($error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$post['slug']);
        }

    } else {
        $fn->setError('Please fill the form completely!');
            $fn->redirect('../updateresume.php?resume='.$post['slug']);
    }

} else {
            $fn->redirect('../updateresume.php?resume='.$post['slug']);
}
