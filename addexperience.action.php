
<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    // Check required fields
    if (
        !empty($post['resume_id']) && 
        !empty($post['position']) && 
        !empty($post['company']) && 
        !empty($post['started']) && 
        !empty($post['ended']) &&
        !empty($post['job_desc'])
    ) {
$resumeid = array_shift($post);
$post2 = $post;
unset($post['slug']);


        $columns = '';
        $values  = '';

        // Escape and build query
        foreach ($post as $index => $value) {
            $value=$db->real_escape_string($value);
            $columns .= $index . ',';
            $values  .= "'$value',";
        }

   

$columns.='resume_id';
$values.=$resumeid;






        try {
            $query = "INSERT INTO experiences ($columns) VALUES ($values)";



          
            $db->query($query);

            $fn->setAlert('Experience Added !');
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);

        } catch (Exception $error) {
            $fn->setError($error->getMessage());
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);
        }

    } else {
        $fn->setError('Please fill the form completely!');
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);
    }

} else {
            $fn->redirect('../updateresume.php?resume='.$post2['slug']);
}
