<?php

$action = $_GET["action"] ?? "display";

switch ($action) {

    case 'register':
        include "../models/UserManager.php";
        if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['passwordRetype'])) {
            $errorMsg = NULL;
            if (IsNickNameFree($_POST['pseudo']) == 1) {
                $errorMsg = "Le pseudo est déja utilisé";
            } else if ($_POST['password'] != $_POST['passwordRetype']) {
                $errorMsg = "Les mot de passes ne sont pas identiques";
            } else if (strlen(trim($_POST['password'])) < 8) {
                $errorMsg = "Le mot de passe doit contenir au minimum 8 caractéres";
            }
            if ($errorMsg) {
                include "../views/RegisterForm.php";
            } else {
                $userId = CreateNewUser($_POST['pseudo'], $_POST['password']);
                header('Location: ?action=login');
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
                $_SESSION['userId'] = $userId['id_user'];
                $_SESSION['is_admin'] = $userId['is_admin'];
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

    case 'deleteMsg':

        include "../models/PostManager.php";
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && isset($_GET['id_post'])) {
            $supressCommentaries = SuppresCommentaryByAdmin($_GET['id_post']);
            if ($supressCommentaries) {
                header('Location: ?action=display'); // Redirection après la modification
                exit;
            } else {
                $errorMsg = "Échec de la suppression du commentaire.";
                include "../views/ActivityForm.php";
            }
        } else {
            $errorMsg = "Id manquant";
            include "../views/ActivityForm.php";
        }

        break;

    case 'modifyMsg':
        include "../models/PostManager.php";
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && isset($_POST['content']) && isset($_POST['id_post'])) {
            $modifyCommentaries = ModifyCommentaryByAdmin($_POST['content'], $_POST['id_post']);
            if ($modifyCommentaries) {
                header('Location: ?action=display');
                exit;
            } else {
                $errorMsg = "Échec de la modification du commentaire.";
                include "../views/ActivityModify.php";
            }
        } else {
            if (isset($_GET['id_post'])) {
                include "../views/ActivityModify.php";
            } else {
                $errorMsg = "Erreur : ID du commentaire manquant.";
            }
        }
        break;

    case 'display':
    default:
        include "../models/PostManager.php";
        $commentaries = GetAllCommentary();

        include "../views/DisplayForum.php";

        break;
}
