<?php
namespace InvisibleReCaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * InvisibleReCaptcha helper
 */
class InvisibleReCaptchaHelper extends Helper
{
    protected $_defaultConfig = [
        'lang' => null,
        'sitekey' => null,
        'badge' => 'bottomright',
        'type' => 'image',
    ];

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
        return $this->_View->element('InvisibleReCaptcha.recaptcha', $this->getConfig());
    }
}
