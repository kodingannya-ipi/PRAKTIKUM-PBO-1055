<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\UserService;
use App\Services\ProductService;

try {
    $service = new UserService();
    $user = $service->createUser(
        'Budi',
        'budi@example.com'
    );

    echo $service->displayUser($user);

    echo "<hr>";

    $productService = new ProductService();

    $product1 = $productService->createProduct('Buku Tulis', 15000);
    $product2 = $productService->createProduct('Pulpen', 3500);

    echo $productService->displayProduct($product1);
    echo "<br>";
    echo $productService->displayProduct($product2);

} catch (Throwable $e) {
    echo "<h3>Terjadi Error</h3>";
    echo "<p>Pesan: " . $e->getMessage() . "</p>";
    echo "<p>File: " . $e->getFile() . "</p>";
    echo "<p>Line: " . $e->getLine() . "</p>";
}