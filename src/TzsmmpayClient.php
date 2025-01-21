<?php

namespace Tzsmmpay;

use Exception;

class TzsmmpayClient
{
    private $apiKey;
    private $apiBaseUrl;

    /**
     * TzsmmpayClient constructor.
     *
     * @param string $apiKey
     * @param string $apiBaseUrl
     */
    public function __construct(string $apiKey, string $apiBaseUrl = 'https://tzsmmpay.com/api')
    {
        $this->apiKey = $apiKey;
        $this->apiBaseUrl = rtrim($apiBaseUrl, '/');
    }

    /**
     * Create a payment request.
     *
     * @param array $paymentData
     * @return TzsmmpayResponse
     * @throws Exception
     */
    public function createPayment(array $paymentData): TzsmmpayResponse
    {
        $url = "{$this->apiBaseUrl}/payment/create";

        $response = $this->makeRequest($url, $paymentData);

        if (isset($response['trx_id'])) {
            return new TzsmmpayResponse(true, [
                'transaction_id' => $response['trx_id'],
                'payment_url' => "{$this->apiBaseUrl}/payment/{$response['trx_id']}"
            ]);
        }

        return new TzsmmpayResponse(false, [], $response['message'] ?? 'Unknown error occurred.');
    }

    /**
     * Verify a payment.
     *
     * @param string $transactionId
     * @return TzsmmpayResponse
     * @throws Exception
     */
    public function verifyPayment(string $transactionId): TzsmmpayResponse
    {
        $url = "{$this->apiBaseUrl}/payment/verify/{$transactionId}";

        $response = $this->makeRequest($url);

        if (isset($response['status']) && $response['status'] === 'Completed') {
            return new TzsmmpayResponse(true, $response);
        }

        return new TzsmmpayResponse(false, [], $response['messages'] ?? 'Verification failed.');
    }

    /**
     * Make an HTTP request to the API.
     *
     * @param string $url
     * @param array|null $postData
     * @return array
     * @throws Exception
     */
    private function makeRequest(string $url, array $postData = null): array
    {
        $curl = curl_init();

        $headers = ['Authorization: Bearer ' . $this->apiKey];

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ];

        if ($postData) {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = http_build_query($postData);
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new Exception("cURL Error: $error");
        }

        curl_close($curl);

        return json_decode($response, true);
    }
}
