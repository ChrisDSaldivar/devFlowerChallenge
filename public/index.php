<?php
declare(strict_types=1);
session_start();
require_once '../src/Basket.php';

$catalog = new Catalog();

if (!isset($_SESSION['basket'])) { // Check if the basket is already in session
  // If not, create a new basket and store it in session
  $_SESSION['basket'] = serialize(new Basket($catalog));
}

// Get the basket from session
$basket = unserialize($_SESSION['basket']);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product']) && is_array($_POST['product'])) {
  foreach ($_POST['product'] as $code => $qty) {
    $basket->add($code, max(0, intval($qty)));
  }

  // Update the basket in session
  $_SESSION['basket'] = serialize($basket);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dev Flower Shop</title>
</head>

<body>
  <h1>Dev Flower Shop</h1>

  <form method="POST">
    <table border="1" cellpadding="5">
      <tr>
        <th>Product</th>
        <th>Code</th>
        <th>Price</th>
        <th>Current amount in cart</th>
        <th>Add Quantity</th>
      </tr>
      <?php foreach ($catalog->getAll() as $product): ?>
        <tr>
          <td><?= htmlspecialchars($product->name) ?></td>
          <td><?= htmlspecialchars($product->code) ?></td>
          <td>$<?= number_format($product->price, 2) ?></td>
          <td>
            <?= $basket->getQuantity($product->code) ?>
          </td>
          <td><input type="number" name="product[<?= $product->code ?>]" min="0" value="0"></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <button type="submit">Add to Basket</button>
  </form>

  <?php if (!empty($_POST['product'])): ?>
    <h2>Basket Total: $<?= $basket->total() ?></h2>
  <?php elseif (isset($_SESSION['basket'])): ?>
    <h2>Current Basket Total: $<?= $basket->total() ?></h2>
  <?php endif; ?>
</body>

</html>