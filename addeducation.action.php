
<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

// echo "<pre>";
// print_r($post);



    // Check required fields
    if (
        !empty($post['resume_id']) && 
        !empty($post['course']) && 
        !empty($post['institute']) && 
        !empty($post['started']) && 
        !empty($post['ended']) 
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
            $query = "INSERT INTO educations ($columns) VALUES ($values)";


         
          
            $db->query($query);

            $fn->setAlert('Education Added !');
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
