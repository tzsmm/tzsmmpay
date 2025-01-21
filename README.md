
# TZSMM Pay PHP Library

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Version](https://img.shields.io/packagist/v/tzsmm/tzsmmpay.svg)](https://packagist.org/packages/tzsmm/tzsmmpay)

### PHP Library for TZSMM PAY Gateway

The **TZSMM Pay** PHP library allows you to integrate the TZSMM Pay payment gateway into your PHP-based applications. It provides easy-to-use methods for creating and verifying payments with the TZSMM Pay API.

---

## Features

- **Create Payments**: Create payments directly via the TZSMM Pay API.
- **Verify Payments**: Check payment status in real-time.
- **Supports PHP 7.2 and above**.
- **Secure and Easy Integration**.

---

## Installation

You can install the TZSMM Pay library via Composer.

### Step 1: Install the Package

Run the following command in your terminal:

```bash
composer require tzsmm/tzsmmpay
```

### Step 2: Autoload the Package

Once installed, Composer will automatically load the library. If you're using a custom autoloader, ensure that the `Tzsmmpay` class is included properly.

---

## API Documentation

This section explains how to use the API to create a payment via the TZSMM Pay gateway.

### API Endpoint: `/api/payment/create`

**URL**: `https://tzsmmpay.com/api/payment/create`

**Method**: `GET`

### Required Parameters

To create a payment, send the following parameters in the API request:

- `api_key`: Your TZSMM Pay API key.
- `cus_name`: The name of the customer (e.g., "Demo User").
- `cus_email`: The email of the customer (e.g., "demo@demo.com").
- `cus_number`: The phone number of the customer (e.g., "01700000000").
- `amount`: The payment amount (e.g., "1" for 1 unit of currency).
- `success_url`: The URL to redirect the user to after a successful payment (e.g., `https://domain.com/success-url`).
- `cancel_url`: The URL to redirect the user to if they cancel the payment (e.g., `https://domain.com/cancel-url/dashboard`).
- `callback_url`: The URL where payment status will be sent (e.g., `https://domain.com/callback-url`).

### Example Request

```php
use Tzsmmpay\TzsmmpayClient;
use Tzsmmpay\TzsmmpayResponse;

$apiKey = 'xOevYGbzFmJCm1rkzDrf';  // Your API key

$tzsmm = new TzsmmpayClient($apiKey);

$paymentData = [
    'cus_name' => 'Demo User',
    'cus_email' => 'demo@demo.com',
    'cus_number' => '01700000000',
    'amount' => 1,
    'success_url' => 'https://domain.com/success-url',
    'cancel_url' => 'https://domain.com/cancel-url/dashboard',
    'callback_url' => 'https://domain.com/callback-url',
];

$response = $tzsmm->createPayment($paymentData);

if ($response->isSuccess()) {
    echo "Payment created successfully!";
    echo "Transaction ID: " . $response->getData()['transaction_id'];
    echo "Payment URL: " . $response->getData()['payment_url'];
} else {
    echo "Error: " . $response->getMessage();
}
```

### Example Response

```json
{
    "success": true,
    "data": {
        "transaction_id": "trx_123456",
        "payment_url": "https://tzsmmpay.com/payment/trx_123456"
    },
    "message": null
}
```

---

## Verify Payment

After a customer has completed their payment, you can verify the payment using the `verifyPayment` method.

### API Endpoint: `/api/payment/verify/{transaction_id}`

**URL**: `https://tzsmmpay.com/api/payment/verify/{transaction_id}`

**Method**: `GET`

### Example Verification Request

```php
$transactionId = 'trx_123456';  // Replace with actual transaction ID

$response = $tzsmm->verifyPayment($transactionId);

if ($response->isSuccess()) {
    echo "Payment verified successfully!";
    print_r($response->getData());  // Shows payment status and details
} else {
    echo "Verification failed: " . $response->getMessage();
}
```

### Example Verification Response

```json
{
    "success": true,
    "data": {
        "status": "Completed",
        "amount": 1,
        "cus_name": "Demo User",
        "cus_email": "demo@demo.com",
        "cus_number": "01700000000"
    },
    "message": null
}
```

---

## Error Handling

In case of an error, the API will return an error message in the `message` field of the response. Handle errors accordingly in your application:

```php
if (!$response->isSuccess()) {
    echo "Error: " . $response->getMessage();
}
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

### Key Sections in the Documentation:

- **Installation**: Explains how to install the TZSMM Pay PHP library using Composer.
- **API Documentation**: Details the endpoint to create payments, including the required parameters and example request/response.
- **Verify Payment**: Guides users on how to verify the status of a payment after a transaction.
- **Error Handling**: Provides guidance on handling errors returned by the API.
