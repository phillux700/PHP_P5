<?php

use \Philippe\Blog\Model\Entities\UserEntity;
use \Philippe\Blog\Model\UserManager;
use \Philippe\Blog\Core\Session;

/* ***************** PROFILE PAGE *****************/
function profilePage($userId)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $post = $userManager->getUser($userId);
    include 'view/frontend/pages/profile.php';
}
/* ***************** MODIFY PROFILE ***************/
function modifyProfile($userId, $avatar, $first_name, $name, $email, $description, $csrfProfileToken)
{

    $userManager = new \Philippe\Blog\Model\UserManager();

    if (!empty($_POST['email'])) 
    {
        if (isset($_SESSION['csrfProfileToken']) AND isset($csrfProfileToken) AND !empty($_SESSION['csrfProfileToken']) AND !empty($csrfProfileToken)) 
        {
            if ($_SESSION['csrfProfileToken'] == $csrfProfileToken) 
            {
                if (isset($_FILES['avatar']) AND $_FILES['avatar']['error'] == 0) 
                {
            
                    if ($_FILES['avatar']['size'] <= 1000000) { 
                
                        $infosfichier = pathinfo($_FILES['avatar']['name']); 
                        $extension_upload = $infosfichier['extension']; 
                        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                        
                        if (in_array($extension_upload, $extensions_autorisees)) {
                            
                            move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/images/avatar/' . basename($_FILES['avatar']['name'])); 
                            echo "L'envoi a bien été effectué !";
                        }
                    }
                }
                $modifiedProfile = $userManager->modifyProfileRequest($userId, $avatar, $first_name, $name, $email, $description);
                if ($modifiedProfile === false) 
                {
                    throw new Exception('Impossible de modifier le profil');
                }
                else 
                {
                    $_SESSION['flash']['success'] = 'Modification effectuée !';
                    profilePage($_SESSION['id']);
                    exit();
                    unset($_SESSION['avatar']);
                    $_SESSION['avatar'] = $avatar;
                }
            }
            else
            {
                echo "Erreur de vérification";
            }
        }
    }
    else 
    {
        $_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis !';
        profilePage($_SESSION['id']);
        exit();
    }
}
/* ***************** DELETE ACCOUNT ***************/
function deleteAccount($userId, $csrfDeleteAccountToken)
{
    $userManager = new \Philippe\Blog\Model\UserManager();
    $session = new Session();
    
    if (isset($userId)) 
    {
        if (isset($_SESSION['csrfDeleteAccountToken']) AND isset($csrfDeleteAccountToken) AND !empty($_SESSION['csrfDeleteAccountToken']) AND !empty($csrfDeleteAccountToken)) 
        {
            if ($_SESSION['csrfDeleteAccountToken'] == $csrfDeleteAccountToken) 
            {
                $deleteAccount = $userManager->deleteAccountRequest($userId);
                $session->stopSession();

                if ($deleteAccount === false) 
                {
                    throw new Exception('Impossible de supprimer le profil');
                }
                else 
                {
                    //header('Location: index.php?action=blog');
                    home();
                    exit();
                }
            }
            else
            {
                echo "Erreur de vérification";
            }
        }
    }
    else 
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet utilisateur !';
        profilePage();
        exit();
    }
}
/* ***************** PUBLIC PROFILE ***************/
function publicProfile($commentAuthor)
{
    $commentManager = new \Philippe\Blog\Model\CommentManager();
    $user = $commentManager->getUserByCommentRequest($commentAuthor);
    include 'view/frontend/pages/publicProfile.php';
}