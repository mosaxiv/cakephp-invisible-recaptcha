# cakephp-invisible-recaptcha plugin for CakePHP

[![MIT License](http://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)
[![Build Status](https://travis-ci.org/mosaxiv/cakephp-invisible-recaptcha.svg?branch=master)](https://travis-ci.org/mosaxiv/cakephp-invisible-recaptcha)

## Requirements

* CakePHP 3.4.0+

## Installation

```
composer require mosaxiv/cakephp-invisible-recaptcha
```

[obtain a invisible reCAPTCHA API key.](https://www.google.com/recaptcha/admin#list)

## SetUp

### Configure

With the following test keys, you will always get No CAPTCHA and all verification requests will pass.  
Please do not use these keys for your production traffic.

```php
Configure::write('recaptcha', [
    'sitekey' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
    'secretkey' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
]);
```

### loadComponent

```php
$this->loadComponent('InvisibleReCaptcha.InvisibleReCaptcha',
    [
        // options
    ]);
```

Some of the options available:

| Option      | Description | Default     | Value |
|-------------|-------------|-------------|-------------|
| secretkey   | Override secret API key  | null | |
| sitekey   | Override site API key  | null | |
| hl   | Optional. Forces the widget to render in a specific language. Auto-detects the user's language if unspecified. (See [language codes](https://developers.google.com/recaptcha/docs/language)) | null | |
| badge   | Optional. Reposition the reCAPTCHA badge.`inline` allows you to control the CSS.  | bottomright | bottomright <br> bottomleft <br> inline |
| type   | 	Optional. The type of CAPTCHA to serve. | image | audio <br> image |
| timeout   | The number of seconds to wait for reCAPTCHA servers before give up. | 3 | `integer` |
| noscript   | Include `<noscript>` content | true | `boolean` |

docs https://developers.google.com/recaptcha/docs/invisible#config

# Used

### Display recaptcha in your view

```php
<?php
echo $this->Form->create();
echo $this->Form->control('email');
echo $this->Form->submit();
echo $this->InvisibleReCaptcha->render();
echo $this->Form->end();
?>
```

### Verify in your controller

```php
if ($this->InvisibleReCaptcha->verify()) {
    //do something
}
```

use [ServerRequest::clientIp](https://book.cakephp.org/3.0/en/controllers/request-response.html#Cake\Http\ServerRequest::clientIp) to get the IP address.  
See https://book.cakephp.org/3.0/en/controllers/request-response.html#trusting-proxy-headers
