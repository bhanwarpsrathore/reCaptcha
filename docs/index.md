---
layout: default
---

## [](#header-2)reCaptcha Plugin for cakephp 2

* * *

# [](#header-1)Description

* * *

reCAPTCHA is a free CAPTCHA service that protect websites from spam and abuse.

#Usage First, register keys for your site at [here](https://www.google.com/recaptcha/admin)

Then,To use the recaptcha plugin its required to include the following two lines in your `/app/Config/bootstrap.php` file.

```php
Configure::write('Recaptcha.publicKey', 'public-api-key');
Configure::write('Recaptcha.privateKey', 'private-api-key');
```

Controllers that will be using recaptcha require the Recaptcha Component to be included. Through inclusion of the component, the helper is automatically made available to your views.

```php
public $components = array('Recaptcha.Recaptcha');
```

In the view simply call the helpers display() method to render the recaptcha input:

```php
echo $this->Recaptcha->display();
```

To check the result simply do something like this in your controller:

```php
if ($this->request->is('post')) {
    if ($this->Recaptcha->verify()) {
        // verified
    } else {
        // display the error
    }
}
```
