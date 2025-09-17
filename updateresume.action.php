<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    echo "<pre>";
    print_r($post);

    // Check required fields
    if (

        !empty($post['id']) &&
        !empty($post['slug']) &&
        !empty($post['full_name']) && 
        !empty($post['email_id']) && 
        !empty($post['objective']) && 
        !empty($post['mobile_no']) && 
        !empty($post['dob']) && 
        !empty($post['gender']) && 
        !empty($post['religion']) && 
        !empty($post['nationality']) && 
        !empty($post['marital_status']) && 
        !empty($post['hobbies']) && 
        !empty($post['languages']) && 
        !empty($post['address'])
    ) {

        $columns = '';
        $values  = '';

        $post2 = $post;

        unset($post2['id']);
                unset($post2['slug']);


        // Escape and build query
        foreach ($post2 as $index => $value) {
            $value=$db->real_escape_string($value);
            $columns .= $index . "='$value',";

        }

    

        $columns.='updated_at='.time();



       
        try {
            $query = "UPDATE resumes SET $columns WHERE id={$post['id']} AND slug='{$post['slug']}'";


   



            $db->query($query);

            $fn->setAlert('Resume  Successfully Updated !');
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
