# EmailFakeFilter

EmailFakeFilter is a PHP library that allows you to check if an email address is a disposable/one-time email address. This library is useful for preventing spam and fraudulent activity on your website or application.

## Requirements

- PHP 8.0 or later
- Composer

## Installation

You can install EmailFakeFilter using Composer. Just run the following command:

```
composer require leo108/email-fake-filter
```

This project gets its fake email addresses from [7c/fakefilter](https://github.com/7c/fakefilter). The database is updated weekly, it's recommended to always use the latest version of this library:

```
composer update leo108/email-fake-filter
```

## Usage

You can call the static methods of the `EmailFakeFilter` class:

```php
use EmailFakeFilter\EmailFakeFilter;

if (EmailFakeFilter::isFakeDomain('mailinator.com')) {
    // This is a disposable/one-time domain
} else {
    // This is not a disposable/one-time domain
}

// Check if an email address is a disposable/one-time email address
if (EmailFakeFilter::isFakeEmail('example@mailinator.com')) {
    // This is a disposable/one-time email address
} else {
    // This is not a disposable/one-time email address
}

// Get information about a domain
$info = EmailFakeFilter::getDomainInfo('mailinator.com');
if ($info !== null) {
    // This is a disposable/one-time domain, and $info contains additional information about it
} else {
    // This is not a disposable/one-time domain
}
```

## License

EmailFakeFilter is open source software licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.
