<?php
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if ($_POST) {
    $post = $_POST;

    // Check required fields
    if (
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

        // Escape and build query
        foreach ($post as $index => $value) {
            $value=$db->real_escape_string($value);
            $columns .= $index . ',';
            $values  .= "'$value',";
        }

        // Logged in user id
        $authid = $fn->Auth()['id'];

        // Extra fields
        $columns .= 'slug,updated_at,user_id';
        $values  .= "'" . $fn->randomstring() . "'," . time() . ",'" . $authid . "'";

        try {
            $query = "INSERT INTO resumes ($columns) VALUES ($values)";
            $db->query($query);

            $fn->setAlert('Resume Added Successfully!');
            $fn->redirect('../myresumes.php');

        } catch (Exception $error) {
            $fn->setError($error->getMessage());
            $fn->redirect('../createresume.php');
        }

    } else {
        $fn->setError('Please fill the form completely!');
        $fn->redirect('../createresume.php');
    }

} else {
    $fn->redirect('../createresume.php');
}
