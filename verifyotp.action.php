<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

if($_POST){
$post=$_POST;

if($post['otp']){

 $otp=$post['otp'];

if($fn->getSession('otp')==$otp){
     $fn->setalert('Email is verified !');
     $fn->redirect('../change-password.php'); 

}else{
       $fn->setError('Incorrect otp entered !');
   $fn->redirect('../verification.php');  
}




}else{
    $fn->setError('please Enter 6 Digit Code Sended to Your Email id');
   $fn->redirect('../verification.php'); 
} 

}else{
$fn->redirect('../verification.php');
}