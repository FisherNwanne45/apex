<?php
session_start();
function feedback($type, $mood, $feedback, $title){
    if($type == "toast"){
        echo "<script>toastr.$mood('$feedback', '$title');</script>";
    }
    if ($type == "sweet"){
      echo "<script>
      Swal.fire({
      icon: '$mood',
      title: '$title',
      text: '$feedback',
      showConfirmButton: true,
      });
    </script>";
    }
}

//redirect after delay
function redirect($delay, $url){
    return "<meta http-equiv='refresh' content='$delay; url=$url' >";
}
function borderError($color, $id){
    echo"<script>document.getElementById('$id').style.borderColor='$color';</script>";
}

function randomNumber($length = 25) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//END OF RANDOM NUMBER GENERATor/*
//Generate Random STRING


function randomString($length = 25) {
    $characters = '0123456789ABCDEFGHIJKLNMOPQRSTUVWXYZabcdefghijklnmopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//Check Bankend Access
function checkAccess(){
    if(!isset($_SESSION['accessBanking'])){
    echo "<script>window.location.href='../';</script>";  
    }
}


?>