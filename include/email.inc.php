<?php
/**
 * Email Functions - Email me maybe.
 *
 * @package ChristopherL.com
 * @copyright 2016 ChristopherL (https://github.com/chrislarrycarl)
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */


/**
 * Validate contact form submission and send email
 *
 * @param array $form       submitted form data ($key = form input id, $value = submitted value)
 * @param $response         reference to ajax.php $response array
 */
function send_contact_email($form=array(), &$response) {
    global $config;

    if (!$config['send_to_address']) {
        set_response_error("This site owner hasn't configured a contact email address. Sorry, I can't email them.", null, $response);
        return;
    }

    // if captcha value is missing end with updated error message
    if ($config['recaptcha_active'] && !$form['g-recaptcha-response']){
        set_response_error('CAPTCHA Response Missing', 'g-recaptcha', $response);
    }
    // begin processing submission
    else {
        // if captcha is enabled validate response
        if ($config['recaptcha_active']) {
            $captcha_validation_result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$config['recaptcha_secret_key']."&response=".$form['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
            $responseKeys = json_decode($captcha_validation_result,true);

            // captcha validation failed, end with updated error message
            if(intval($responseKeys["success"]) !== 1) {
                set_response_error('CAPTCHA Response Failed', 'g-recaptcha', $response);
                return;
            }
        }

        // if we don't have a name, ask for it
        if (!$form['fullname']) {
            set_response_error('We need to know your name to reply to you.', 'fullname', $response);
        }
        // if we don't have an email address, or it's the wrong format, ask for it
        else if (!$form['email'] || !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            set_response_error('We need your email address to reply to you.', 'email', $response);
        }
        // if we don't have a message ask for it
        else if (!$form['message']) {
            set_response_error("How can we reply if you don't say anything?", 'message', $response);
        }
        // looks good, send that email
        else {
            $send_result = mail("{$config['send_to_address']}",
                                "Greetings from ChristopherL",
                                "{$form['message']}\n\n--------------\n{$form['fullname']}\n{$form['email']}",
                                "From: {$config['send_to_address']}\r\nReply-To: {$config['send_to_address']}");

            // didn't work, have them try again
            if (!$send_result) {
                set_response_error("You better try that again. It looks like something went wrong.", null, $response);
            }
            // it all worked, update response
            else {
                set_response_feedback("Thanks! We'll be in touch soon.", $response);
            }
        }
    }
}