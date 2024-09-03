<?php

namespace App\Helpers;

class HitApi
{
    protected string $url;
    protected array $headers = [];
    protected array $payload = [];
    protected string $method = 'GET';

    public static function to(string $subUrl): self
    {
        $instance = new self();
        $instance->url = env('BASE_API_URL') . $subUrl;
        return $instance;
    }

    public function withHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function withHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function withPayload(array $payload): self
    {
        $this->payload = $payload;
        return $this;
    }

    public function usingMethod(string $method): self
    {
        $this->method = strtoupper($method);
        return $this;
    }

    public function get(): array
    {
        $this->method = 'GET';
        return $this->execute();
    }

    public function post(): array
    {
        $this->method = 'POST';
        return $this->execute();
    }

    public function put(): array
    {
        $this->method = 'PUT';
        return $this->execute();
    }

    public function delete(): array
    {
        $this->method = 'DELETE';
        return $this->execute();
    }

    protected function execute(): array
    {
        $curl = curl_init($this->url);

        $formattedHeaders = [];
        foreach ($this->headers as $key => $value) {
            $formattedHeaders[] = "$key: $value";
        }

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $this->method !== 'GET' ? json_encode($this->payload) : null,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_HTTPHEADER => $formattedHeaders,
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return [
                'code' => 500,
                'message' => 'Curl error: ' . $error,
            ];
        }

        curl_close($curl);
        return json_decode($response, true);
    }
}
