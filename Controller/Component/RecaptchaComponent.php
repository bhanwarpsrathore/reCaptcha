<?php

App::import('Vendor', 'Recaptcha.ReCaptcha', array('file' => 'ReCaptcha/autoload.php'));

/**
 * CakePHP Recaptcha component
 *
 * @package recaptcha
 * @subpackage recaptcha.controllers.components
 */
class RecaptchaComponent extends Component {

    /**
     * Name
     *
     * @var string
     */
    public $Controller = null;

    /**
     * Private API Key
     *
     * @var string
     */
    public $privateKey = '';

    /**
     * Callback
     *
     * @param Controller $controller Controller with components to initialize
     * @param array $settings Array of configuration settings
     * @throws Exception Throws an exception if Recaptchas config is not present
     * @return void
     */
    public function initialize(Controller $controller, $settings = array()) {
        if ($controller->name === 'CakeError') {
            return;
        }
        $this->privateKey = Configure::read('Recaptcha.privateKey');
        $this->Controller = $controller;

        if (!isset($this->Controller->helpers['Recaptcha.Recaptcha'])) {
            $this->Controller->helpers[] = 'Recaptcha.Recaptcha';
        }

        if (empty($this->privateKey)) {
            throw new Exception(__d('recaptcha', "You must set your private Recaptcha key using Configure::write('Recaptcha.privateKey', 'your-key');!", true));
        }
    }

    public function verify() {
        $gRecaptchaResponse = $this->Controller->request->data['g-recaptcha-response'];

        $recaptcha = new \ReCaptcha\ReCaptcha($this->privateKey);
        $resp = $recaptcha->verify($gRecaptchaResponse);
        if (!empty($gRecaptchaResponse)) {
            if ($resp->isSuccess()) {
                return true;
            } else {
                $errors = $resp->getErrorCodes();
                return false;
            }
        }
        return false;
    }

}
