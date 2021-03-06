<?php
/**
 * My own blog.
 *
 * Log Controller
 *
 * PHP Version 7
 * 
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development.
 * @link     http://projet5.philippetraon.com
 */

namespace Philippe\Blog\Src\Controller;

use \Philippe\Blog\Src\Model\UserManager;
use \Philippe\Blog\Src\Model\SecurityManager;
use \Philippe\Blog\Src\Core\Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 *  Class LogController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class LogController
{
    private $_userManager;
    private $_securityManager;
    private $_session;

    /**
     * Function construct
     */
    public function __construct() 
    {
        $this->_userManager = new UserManager();
        $this->_securityManager = new SecurityManager();
        $this->_session = new Session();
    }
    /**
     * Function loginPage
     * 
     * @return mixed
     */
    public function loginPage()
    {
        $csrfLoginToken = md5(time()*rand(1, 1000));
        if (isset($_COOKIE['pseudo']) && !isset($_SESSION['pseudo'])) {
            $rememberOK = $_COOKIE['remember'];
            $parts = explode('==', $rememberOK);
            $user_id = $parts[0];
            $this->_userManager->userCookie($user_id);
            if ($user) {
                $expected = $user_id . '==' . $rememberOK . sha1($pseudo . 'philippe');
                if ($expected == $rememberOK) {
                    session_start();
                    $this->_session->launchSession($user);
                    setcookie('remember', $rememberOK, time() + 60 * 60 * 24 * 7);
                } else {
                    setcookie('remember', null, -1);
                }
            } else {
                setcookie('remember', null, -1);
            }
        }
        include 'views/frontend/modules/blog/login/login.php';
    }
    /**
     * Function login
     * 
     * @param string $pseudo         pseudo
     * @param string $passe          password
     * @param string $ip             IP address
     * @param string $csrfLoginToken token to avoid csrf
     * 
     * @return mixed
     */
    public function login($pseudo,$passe, $ip, $csrfLoginToken)
    {
        $_SESSION['csrfLoginToken'] = $csrfLoginToken;  
        if (isset($_SESSION['csrfLoginToken']) AND isset($csrfLoginToken) AND !empty($_SESSION['csrfLoginToken']) AND !empty($csrfLoginToken)) {
            if ($_SESSION['csrfLoginToken'] == $csrfLoginToken) {
                if (!empty($pseudo) && !empty($passe)) {
                    $user = $this->_userManager->loginRequest($pseudo, $passe);
                    $count = $this->_securityManager->checkBruteForce($ip);
                    if ($count < 3) {
                        if (password_verify($passe, $user->getPassword())) {
                            if ($user->getIs_active() == 1) {
                                if (isset($_POST['remember'])) {
                                    $this->_userManager->rememberToken($pseudo);
                                    setcookie('remember', $pseudo . '==' . $rememberOK . sha1($pseudo . 'philippe'), time() + 60 * 60 * 24 * 7);
                                    $this->_session->launchSession($user);
                                } else {
                                    $this->_session->launchSession($user);
                                }
                                
                            } else {
                                $_SESSION['flash']['success'] = 'Vous devez activer votre compte via le lien de confirmation dans le mail envoy?? !';
                                LogController::loginPage();
                            }
                        } else {
                            sleep(1);
                            $this->_securityManager->registerAttempt($ip);
                            $_SESSION['flash']['danger'] = 'Mauvais identifiant ou mot de passe !';
                            LogController::loginPage();
                        }
                    } else {
                        $_SESSION['flash']['danger'] = '4 tentatives ont ??t?? effectu??es : veuillez contacter l\'administrateur pour vous reconnecter !';
                        LogController::loginPage();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
                    LogController::loginPage();
                }
            } else {
                $_SESSION['flash']['danger'] = 'Erreur de v??rification !';
                LogController::loginPage();
            }
        }
    }
    /**
     * Function logout
     * 
     * @return mixed
     */
    public function logout()
    {
        $this->_session->stopSession();
    }
    /**
     * Function forgetPasswordPage
     * 
     * @return mixed
     */
    public function forgetPasswordPage()
    {
        $csrfForgetToken = md5(time()*rand(1, 1000));
        include 'views/frontend/modules/blog/forgetPassword/forgetPasswordPage.php'; 
    }
    /**
     * Function forgetPassword
     * 
     * @param string $email           email
     * @param string $csrfForgetToken token to avoid csrf
     * 
     * @return mixed
     */
    public function forgetPassword($email, $csrfForgetToken)
    {
        $_SESSION['forgetToken'] = $csrfForgetToken;  
        if (empty($email)) {
            $_SESSION['flash']['danger'] = 'Veuillez renseigner un email !';
            LogController::forgetPasswordPage();
        } else {
            if (isset($_SESSION['forgetToken']) AND isset($csrfForgetToken) AND !empty($_SESSION['forgetToken']) AND !empty($csrfForgetToken)) {
                if ($_SESSION['forgetToken'] == $csrfForgetToken) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $users = $this->_userManager->forgetPasswordRequest($email);
                        if ($users === false) {
                            $_SESSION['flash']['danger'] = 'Une erreur est survenue !';
                            LogController::loginPage();
                        } else {
                            $mail = new PHPMailer(true);                             
                            try {
                                $mail->setFrom('contact@philippetraon.com', 'Philippe Traon');
                                $mail->addAddress($email, $pseudo);
                                $mail->addReplyTo('contact@philippetraon.com', 'Information');
                                $mail->isHTML(true);                                  
                                $mail->Subject = 'Message';
                                $mail->Body = '<b>Blog de Philippe Traon : </b>' . '<br />' . 'Afin de changer votre mot de passe, merci de cliquer sur ce lien : ' . '<br />' . '<a href="http://www.projet5.philippetraon.com/index.php?action=changePasswordPage&id='.$users->getId().'&token='.$users->getReset_token().'">'.'Lien de modification du mot de passe</a>';
                                $mail->send();
                                $_SESSION['flash']['success'] = 'Vous allez recevoir un email pour r??initialiser votre mot de passe !';
                                LogController::loginPage();
                            } 
                            catch (Exception $e) {
                            echo 'Un probl??me est survenu ! Le message n\'a pas pu ??tre envoy?? : ', $mail->ErrorInfo;
                            }
                            
                        } 
                    } else {
                        $_SESSION['flash']['danger'] = 'Cet email n\'est pas valide !';
                        LogController::loginPage();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Erreur de v??rification !';
                    LogController::forgetPasswordPage();
                }
            }
        }
    }
    /**
     * Function changePasswordPage
     * 
     * @param int    $userId     user's id
     * @param string $resetToken token to reset the password
     * 
     * @return mixed
     */
    public function changePasswordPage($userId, $resetToken)
    {
        if ((isset($_GET['id']) && $_GET['id'] > 0) && isset($_GET['token'])) {
            $user = $this->_userManager->checkResetTokenRequest($userId, $resetToken);
            if ($user &&  $user['reset_token'] == $resetToken) {
                $csrfChangePasswordToken = md5(time()*rand(1, 1000));
                include 'views/frontend/modules/blog/forgetPassword/changePasswordPage.php';
            } else {
                $_SESSION['flash']['danger'] = 'Ce token n\' est plus valide ! Veuillez r??essayer !';
                LogController::forgetPasswordPage();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Aucun id ou token ne correspond ?? cet email, veuillez r??essayer !';
            LogController::forgetPasswordPage();
        }
    }
    /**
     * Function changePassword
     * 
     * @param int    $userId                  the user's id
     * @param string $passe                   password
     * @param string $csrfChangePasswordToken the token to avoid csrf
     * 
     * @return mixed
     */
    public function changePassword($userId, $passe, $csrfChangePasswordToken)
    { 
        $_SESSION['csrfChangePasswordToken'] = $csrfChangePasswordToken; 
        if (!empty($_POST['passe']) && $_POST['passe'] == $_POST['passe2']) {
            if (isset($_SESSION['csrfChangePasswordToken']) AND isset($csrfChangePasswordToken) AND !empty($_SESSION['csrfChangePasswordToken']) AND !empty($csrfChangePasswordToken)) {
                if ($_SESSION['csrfChangePasswordToken'] == $csrfChangePasswordToken) {
                    $this->_userManager->changePasswordRequest($userId, $passe);
                    $_SESSION['flash']['success'] = 'Le mot de passe a bien ??t?? r??initialis?? !';
                    LogController::loginPage();
                } else {
                    $_SESSION['flash']['danger'] = 'Erreur de v??rification !';
                    LogController::loginPage();
                }
            }
        } else {
            $_SESSION['flash']['danger'] = 'Veuillez entrer un mot de passe !';
            LogController::forgetPasswordPage();
        }
    }
}