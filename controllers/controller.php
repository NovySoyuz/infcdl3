<?php

$action = $_GET["action"] ?? "display";

switch ($action) {

  case 'register':
    include "../models/UserManager.php";
    if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['passwordRetype'])) {
        $errorMsg = NULL;
        if(IsNickNameFree($_POST['pseudo']) == 1) {
            $errorMsg = "Le pseudo est déja utilisé";
        } else if ($_POST['password'] != $_POST['passwordRetype']) {
            $errorMsg = "Les mot de passes ne sont pas identiques";
        } else if (strlen(trim($_POST['password'])) < 8) {
            $errorMsg = "Le mot de passe doit contenir au minimum 8 caractéres";
        }
        if($errorMsg) {
            include "../views/RegisterForm.php";
        } else {
            $userId = CreateNewUser($_POST['pseudo'], $_POST['password']);
            header('Location: ../views/LoginForm.php');
        }
    } else {
        include "../views/RegisterForm.php";
    }
    break;

  case 'logout':
    if (isset($_SESSION['userId'])) {
        session_unset();
        session_destroy();
      }
      header('Location: ?action=display');
    break;

  case 'login':
    include "../models/UserManager.php";
    if (isset($_POST['pseudo']) && isset($_POST['password'])) {
        $userId = Login($_POST['pseudo'], $_POST['password']);
        
        if ($userId > 0) {
            $_SESSION['userId'] = $userId;
            header('Location: ?action=display');
            exit;
        } else {
            $errorMsg = "Le pseudo et mail ne correspondent pas";
            include "../views/LoginForm.php";
        }

    } else {
        include "../views/LoginForm.php";
    }
    break;

  case 'newMsg':
    include "../models/PostManager.php";
    if (isset($_SESSION['userId']) && isset($_POST['content'])) {
        PostCommentary($_SESSION['userId'], $_POST['content']);
        header('Location: ?action=display');
    } else {
        include "../views/ActivityForm.php";
    }
    break;


  case 'display':
    default:
    include "../models/PostManager.php";
    $commentaries = GetAllCommentary();



    include "../views/DisplayForum.php";



    break;



}