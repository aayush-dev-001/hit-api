# HitApi

`HitApi` is a PHP helper class for making HTTP requests using `cURL`. It simplifies the process of sending GET, POST,
PUT, and DELETE requests with customizable headers and payloads.

## Installation

To use `HitApi`, you need to have `cURL` enabled in your PHP environment. Simply include the `HitApi.php` file in your
project and follow the usage instructions below.

## Usage

### Basic Usage

1. **Initialize**: Start by initializing `HitApi` with the desired endpoint.

   ```php
   use App\Helpers\HitApi;

   $response = HitApi::to('/endpoint')
       ->withHeader('Authorization', 'Bearer YOUR_TOKEN')
       ->withPayload(['key' => 'value'])
       ->get(); // Use get(), post(), put(), or delete() based on your needs
   ```

2. **Initialize**: Start by initializing `HitApi` with the desired endpoint.

   ```php
   use App\Helpers\HitApi;

   $response = HitApi::to('/endpoint')
       ->withHeaders(['Authorization' => 'Bearer YOUR_TOKEN'])
       ->withPayload(['key' => 'value'])
       ->post(); // Use get(), post(), put(), or delete() based on your needs
   ```

### How To Install

```bash
composer require aayush/hit-api
```
