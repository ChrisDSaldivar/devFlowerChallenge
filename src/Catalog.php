<?php
declare(strict_types=1);
require_once __DIR__ . '/Product.php';

class Catalog
{
  private array $products = [];

  public function __construct()
  {
    $this->products = [
      'RF1' => new Product('RF1', 'Red Flower', 32.95),
      'GF1' => new Product('GF1', 'Green Flower', 24.95),
      'BF1' => new Product('BF1', 'Blue Flower', 7.95),
    ];
  }

  public function getProduct(string $code): ?Product
  {
    return $this->products[$code] ?? null;
  }

  public function getAll(): array
  {
    return $this->products;
  }
}
