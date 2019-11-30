<?php

include 'class/client.class.php';

if(!empty($_POST)){
$nom=$_POST['nom'];
$email=$_POST['email'];
$adresse=$_POST['adresse'];
$tel=$_POST['tel'];
$mdp=$_POST['mdp'];
$mdp2=$_POST['mdp2'];


         

if (!preg_match("/^[a-zA-Z0-9 ]+$/",$nom)) {
    $name_error = "Name must contain only letters, numbers and space.";
    header('location:register.php?name_error='.$name_error.'');
    exit();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_error = "You must enter a valid email.";
    header('location:register.php?email_error='.$email_error.'');
    exit();
}

if(strlen($mdp)<6){
    $mdp1_error = "Password must be more than 6 caracters.";
    header('location:register.php?mdp1_error='.$mdp1_error.'');
    exit();
}

if($mdp!=$mdp2){
    $mdp2_error = "Password and Confirm password not much.";
    header('location:register.php?mdp2_error='.$mdp2_error.'');
    exit();
}

$test = new Client;
$x = $test->verifExist($email);
$data = $x->fetchAll();
if ($data!=null){
    header('location:register.php?email_error=Email has already been taken.');
    exit();
}
else{
$client = new Client;
$hashed_password = password_hash($mdp, PASSWORD_DEFAULT);
$client->addNewClient($nom, $tel, $adresse, $email,$mdp);
header('location:loginc.php?success=create');
}
}


?>