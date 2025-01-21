
# TZSMM Pay PHP Library

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Version](https://img.shields.io/packagist/v/tzsmm/tzsmmpay.svg)](https://packagist.org/packages/tzsmm/tzsmmpay)

### PHP Library for TZSMM PAY Gateway

The **TZSMM Pay** PHP library allows you to integrate the TZSMM Pay payment gateway into your applications. It provides easy-to-use methods to interact with the TZSMM Pay API for creating and verifying payments, managing payment statuses, and more.

---

## Features

- **Simple Integration**: Effortlessly integrate TZSMM Pay payment gateway into your PHP-based projects.
- **Create Payments**: Easily create payments via the API.
- **Verify Payments**: Check payment status in real-time.
- **Secure**: Built with security best practices in mind.
- **Supports PHP 7.2 and above**.

---

## Installation

You can install the library via Composer.

### Step 1: Install the Package
Run the following command in your terminal:

```bash
composer require tzsmm/tzsmmpay
```

### Step 2: Autoload the Package
Once installed, Composer will automatically load the library. If you're using a custom autoloader, make sure to include the package via `autoload`.

---

## Usage

### Create a Payment
Use the `createPayment` method to create a new payment via TZSMM Pay:

```php
use Tzsmmpay\Tzsmmpay;

$tzsmm = new Tzsmmpay([
    'api_key' => 'YOUR_API_KEY',  // Replace with your TZSMM Pay API key
    'api_secret' => 'YOUR_API_SECRET'  // Replace with your API secret
]);

$response = $tzsmm->createPayment([
    'amount' => 100,  // The payment amount
    'currency' => 'USD',  // Currency code
    'payment_method' => 'credit_card',  // Payment method
    'callback_url' => 'https://yourwebsite.com/callback'  // URL for payment status callback
]);

echo $response;
```

### Verify a Payment
Use the `verifyPayment` method to verify the status of a payment:

```php
$response = $tzsmm->verifyPayment('payment_id');

echo $response;
```

---

## Configuration

You can configure the library by passing an array of settings when instantiating the `Tzsmmpay` class:

```php
$tzsmm = new Tzsmmpay([
    'api_key' => 'YOUR_API_KEY',
    'api_secret' => 'YOUR_API_SECRET'
]);
```

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Contributing

Contributions are welcome! Please fork the repository, create a branch, and submit a pull request.

### Steps to Contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature-name`).
5. Open a pull request.

---

## Support

For support or questions, please visit [TZSMM Pay Support](https://tzsmmpay.com/support).

---

## Authors

- **TZSMM** - [Website](https://tzsmmpay.com)  
  Email: [info@tzsmmpay.com](mailto:info@tzsmmpay.com)

---

## Changelog

### v1.0.0
- Initial release with core functionality to create and verify payments.

---

## Acknowledgements

- TZSMM Pay for providing the API and gateway.
- Composer for managing PHP dependencies.

---

**Happy coding!** 🚀
```

### Key Sections Explained:
- **Badges**: These show the license and version of the package.
- **Features**: Highlights the capabilities of the package.
- **Installation**: Instructions on how to install and integrate the package using Composer.
- **Usage**: Provides examples for common use cases like creating and verifying payments.
- **Configuration**: Instructions for setting up your API credentials.
- **License**: Information about the licensing of the project (MIT in this case).
- **Contributing**: Guidance on how others can contribute to the project.
- **Support**: Details on how to get help and contact support.
- **Authors**: Details of the author and contributors.
- **Changelog**: Keeps track of changes in each version.
- **Acknowledgements**: Credits to services or people who helped or inspired the project.
