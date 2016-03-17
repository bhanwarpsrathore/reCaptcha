<?php

/**
 * CakePHP Recaptcha helper
 *
 * @package recaptcha
 * @subpackage recaptcha.views.helpers
 */
class RecaptchaHelper extends AppHelper {

    /**
     * Public API Key
     *
     * @var string
     */
    public $publicKey = '';

    public function display() {
        $publicKey = Configure::read('Recaptcha.publicKey');
        $script = '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
        $script .= '<div class="g-recaptcha" data-sitekey=' . $publicKey . '></div>';
        return $script;
    }

}
