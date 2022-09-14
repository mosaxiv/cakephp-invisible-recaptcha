<?php
namespace InvisibleReCaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Http\Client;

/**
 * InvisibleReCaptcha component
 */
class InvisibleReCaptchaComponent extends Component
{
    const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    protected $_defaultConfig = [
        'secretkey' => null,
        'sitekey' => null,
        'timeout' => 3,
        'hl' => null,
        'badge' => 'bottomright',
        'type' => 'image',
        'noscript' => true,
    ];

    /**
     * {@inheritdoc}
     */
    public function initialize(array $config)
    {
        if ($this->getConfig('secretkey') === null) {
            $this->setConfig('secretkey', Configure::readOrFail('recaptcha.secretkey'));
        }

        if ($this->getConfig('sitekey') === null) {
            $this->setConfig('sitekey', Configure::readOrFail('recaptcha.sitekey'));
        }

        $this->getController()->viewBuilder()->setHelpers([
            'InvisibleReCaptcha.InvisibleReCaptcha' => $this->getConfig()
        ]);
    }

    /**
     * @return bool
     */
    public function verify()
    {
        $response = $this->_sendRequest();

        return isset($response['success']) && $response['success'] === true;
    }

    /**
     * @return array
     */
    protected function _sendRequest()
    {
        $request = $this->getController()->request;

        $http = new Client([
            'timeout' => $this->getConfig('timeout')
        ]);
        $response = $http->post(self::VERIFY_URL, [
            'secret' => $this->getConfig('secretkey'),
            'response' => $request->getData('g-recaptcha-response'),
            'remoteip' => $request->clientIp(),
        ]);

        return $response->getJson();
    }
}
