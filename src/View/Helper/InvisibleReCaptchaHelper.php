<?php
namespace InvisibleReCaptcha\View\Helper;

use Cake\View\Helper;

/**
 * InvisibleReCaptcha helper
 */
class InvisibleReCaptchaHelper extends Helper
{
    protected $_defaultConfig = [
        'lang' => null,
        'data' => [
            'sitekey' => null,
            'badge' => 'bottomright',
            'type' => 'image',
        ],
    ];

    /**
     * render method.
     *
     * @return string
     */
    public function render()
    {
        $config = $this->getConfig();

        if ($config('data.sitekey') === null) {
            throw new \RuntimeException();
        }

        return $this->_View->element('recaptcha', $config);
    }
}
