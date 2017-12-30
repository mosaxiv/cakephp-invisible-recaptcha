<?php
namespace InvisibleReCaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * InvisibleReCaptcha helper
 * @property \Cake\View\Helper\FormHelper Form
 */
class InvisibleReCaptchaHelper extends Helper
{
    protected $_defaultConfig = [
        'hl' => null,
        'sitekey' => null,
        'badge' => 'bottomright',
        'type' => 'image',
    ];

    public $helpers = ['Form'];

    /**
     * {@inheritdoc}
     */
    public function initialize(array $config)
    {
        if ($this->getConfig('sitekey') === null) {
            $this->setConfig('sitekey', Configure::readOrFail('recaptcha.sitekey'));
        }
    }

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
