<?php 
session_start();
include "../conn_db.php";

if(isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST["pass22"])){

    function validate($data){
        $data=trim($data);
        $data=stripcslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    

    $pass1=validate($_POST['pass']);
    $repass2=validate($_POST['pass2']); 
    $pass2=validate($_POST['pass22']);
    
    
    if(empty($pass1)){
        $_SESSION['error_message'] = "Vérifier l'ancien mot de passe .";
        header("Location: changer_password.php");
        exit();
    }
    else if(empty($pass2)){
        $_SESSION['error_message'] = "Vérifier le nouveaux mot de passe .";
        header("Location: changer_password.php");
        exit();

    }

    else if (strlen($pass2) < 8) {
        $_SESSION['error_message'] = "Le nouveau mot de passe doit contenir au moins 8 caractères.";
        header("Location: changer_password.php");
        exit();
    }

    else if (!preg_match('/[A-Z]/', $pass2) || !preg_match('/[a-z]/', $pass2) ) {
        $_SESSION['error_message'] = "Le nouveau mot de passe doit contenir au moins une lettre majuscule et une lettre minuscule.";
        header("Location: changer_password.php");
        exit();
    }
    else if(!preg_match('/[0-9]/', $pass2) ){
        $_SESSION['error_message'] = "Le nouveau mot de passe doit contenir au moins un chiffre .";
        header("Location: changer_password.php");
        exit();
    }

    else if(!preg_match('/[!@#$%^&*]/', $pass2)){
        $_SESSION['error_message'] = "Le nouveau mot de passe doit contenir au moins un caractére spécial .";
        header("Location: changer_password.php");
        exit();
    }
    else if($pass1!==$repass2){
        $_SESSION['error_message'] = "Vérifier la confirmation du nouveaux mot de passe ";
        header("Location: changer_password.php");
        exit();

    }

    else{
       $old=$_POST['pass'];
       $password= $pass2;
       $idAdmin=$_SESSION['id'];
       $sql="SELECT password  FROM users WHERE id='$idAdmin' and password='$old' ";
       $res=mysqli_query($conn,$sql);
       if(mysqli_num_rows($res)===1){      
        $sql2="UPDATE users SET password='$password' WHERE id='$idAdmin'  ";
        $res2=mysqli_query($conn,$sql2);
        header("Location: confirmation.php");
       }
       else{
        $_SESSION['error_message'] = "mot de passe incorrect .";
        header("Location: changer_password.php");
        exit();
       }
     
    }
  
}
else{
    header("Location:changer_password.php");
    exit();
}


?>