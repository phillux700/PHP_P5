<?php
/**
 * My own blog.
 *
 * Contact Controller
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 *  Class ContactController
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @link     http://projet5.philippetraon.com
 */
class ContactController
{
    /**
     * Function contact
     * 
     * @param string $name     mailer's name
     * @param string $email    mailer's email
     * @param string $subject  mailer's subject
     * @param string $message  mailer's message
     * @param string $response captcha
     * @param string $remoteip mailer's IP address
     * 
     * @return mixed
     */
    public function contact($name, $email, $subject, $message, $response, $remoteip)
    {
        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
            
            $secret = "6LeS_lwUAAAAABD6EBW4fo0y2jVBfLr_ho0IGZ2j";
            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;

            $decode = json_decode(file_get_contents($api_url), true);
        
            if ($decode['success'] == true) {
                $mail = new PHPMailer(true);                             
                try 
                {
                    $mail->setFrom($email, 'Expediteur');
                    $mail->addAddress('contact@philippetraon.com', 'Philippe Traon');
                    $mail->addReplyTo($email, 'Information');
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Message';
                    $mail->Body    = '<b>Auteur : </b>' . $name . '<br />' . '<b>IP : </b>' . $ip . '<br />' . '<b>Message : </b>' . $message;
                    $mail->AltBody = 'Message non-HTML : '.$message;
                    $mail->send();
                    echo '<p style="font-weight: bold;text-align: center;">Le message a bien ??t?? envoy??</p>';
                } 
                catch (Exception $e) 
                {
                    echo '<p style="color:red; font-weight: bold;text-align: center;">Un probl??me est survenu ! Le message n\'a pas pu ??tre envoy?? : </p>';
                }
            } else {
                echo '<p style="color:red; font-weight: bold;text-align: center;">Veuillez confirmer le captcha !</p>';
            }
        }
    }
}