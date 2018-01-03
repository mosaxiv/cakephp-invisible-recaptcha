<?php
namespace InvisibleReCaptcha\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\TestCase;
use InvisibleReCaptcha\Controller\Component\InvisibleReCaptchaComponent;

class InvisibleReCaptchaComponentTest extends TestCase
{
    public $controller;
    public $registry;

    public function setUp()
    {
        parent::setUp();

        Configure::write('recaptcha', [
            'sitekey' => 'test-key',
            'secretkey' => 'test-key',
        ]);

        $request = new ServerRequest();
        $response = new Response();
        $this->controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();
        $this->registry = new ComponentRegistry($this->controller);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testConfigurationSitekey()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Expected configuration key "recaptcha.sitekey" not found.');

        Configure::delete('recaptcha.sitekey');
        new InvisibleReCaptchaComponent($this->registry);
    }

    public function testConfigurationSecretkey()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Expected configuration key "recaptcha.secretkey" not found.');

        Configure::delete('recaptcha.secretkey');
        new InvisibleReCaptchaComponent($this->registry);
    }

    public function testConfigurationOverWrite()
    {
        $invisibleReCaptcha = new InvisibleReCaptchaComponent($this->registry);
        $this->assertEquals('test-key', $invisibleReCaptcha->getConfig('sitekey'));
        $this->assertEquals('test-key', $invisibleReCaptcha->getConfig('secretkey'));

        $invisibleReCaptcha = new InvisibleReCaptchaComponent($this->registry, [
            'sitekey' => 'OverWriteKey1',
            'secretkey' => 'OverWriteKey2'
        ]);
        $this->assertEquals('OverWriteKey1', $invisibleReCaptcha->getConfig('sitekey'));
        $this->assertEquals('OverWriteKey2', $invisibleReCaptcha->getConfig('secretkey'));
    }

    public function testLoadHelper()
    {
        new InvisibleReCaptchaComponent($this->registry);
        $this->assertArrayHasKey('InvisibleReCaptcha.InvisibleReCaptcha', $this->controller->viewBuilder()->getHelpers());
    }
}
