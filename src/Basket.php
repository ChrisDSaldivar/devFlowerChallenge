<?php
declare(strict_types=1);
require_once __DIR__ . '/Catalog.php';

class Basket
{
  private array $items = [];
  private Catalog $catalog;

  public function __construct(Catalog $catalog)
  {
    $this->catalog = $catalog;
  }

  public function getQuantity(string $code): int
  {
    return $this->items[$code] ?? 0;
  }

  public function add(string $code, int $quantity): void
  {
    if (!isset($this->items[$code])) {
      $this->items[$code] = 0;
    }
    if ($quantity < 0) {
      throw new InvalidArgumentException("Quantity cannot be negative");
    }

    $this->items[$code] += $quantity;
  }

  public function total(): float
  {
    $total = 0.0;

    foreach ($this->items as $code => $qty) {
      $product = $this->catalog->getProduct($code);
      if (!$product)
        continue;

      if ($code === 'RF1') {
        $pairs = intdiv($qty, 2);
        $remainder = $qty % 2;
        $total += $pairs * ($product->price + $product->price / 2) + $remainder * $product->price;
      } else {
        $total += $qty * $product->price;
      }
    }

    // Delivery fee logic
    if ($total >= 90)
      return round($total, 2);
    if ($total >= 50)
      return round($total + 2.95, 2);
    return round($total + 4.95, 2);
  }
}
