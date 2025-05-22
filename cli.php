<?php
declare(strict_types=1);
require_once __DIR__ . '/src/Basket.php';

$catalog = new Catalog();
$basket = new Basket($catalog);

if ($argc < 2) {
  echo "Usage: php cli.php RF1=2 BF1=1 GF1=1\n";
  exit(1);
}

for ($i = 1; $i < $argc; $i++) {
  $arg = $argv[$i];
  if (!str_contains($arg, '=')) {
    echo "Invalid argument: $arg. Use format CODE=QTY\n";
    continue;
  }

  [$code, $qty] = explode('=', $arg, 2);
  $code = strtoupper(trim($code));
  $qty = max(0, intval($qty));

  $basket->add($code, $qty);
}

echo "Basket contents:\n";
foreach ($catalog->getAll() as $product) {
  $qty = $basket->getQuantity($product->code);
  if ($qty > 0) {
    echo "- {$product->name} ({$product->code}) × $qty\n";
  }
}

echo "\nTotal: $" . number_format($basket->total(), 2) . "\n";
