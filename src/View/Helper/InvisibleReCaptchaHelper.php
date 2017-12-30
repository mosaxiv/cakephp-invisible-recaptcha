<?php
namespace InvisibleReCaptcha\View\Helper;

use Cake\View\Helper;

/**
 * InvisibleReCaptcha helper
 * @property \Cake\View\Helper\FormHelper Form
 */
class InvisibleReCaptchaHelper extends Helper
{
    public $helpers = ['Form'];

    /**
     * render method.
     *
     * @return string
     */
    public function render()
    {
        $this->Form->unlockField('g-recaptcha-response');

        return $this->_View->element('InvisibleReCaptcha.recaptcha', $this->getConfig());
    }
}
