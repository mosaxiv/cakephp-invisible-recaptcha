<?php
namespace InvisibleReCaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;

/**
 * InvisibleReCaptcha component
 */
class InvisibleReCaptchaComponent extends Component
{
    const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    protected $_defaultConfig = [
        'secretkey' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'
    ];

    /**
     * {@inheritdoc}
     */
    public function initialize(array $config)
    {
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

        $http = new Client();
        $response = $http->post(self::VERIFY_URL, [
            'secret' => $this->getConfig('secretkey'),
            'response' => $request->getData('g-recaptcha-response'),
            'remoteip' => $request->clientIp(),
        ]);

        return $response->json;
    }
}
