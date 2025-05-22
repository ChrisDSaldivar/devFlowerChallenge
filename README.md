# devFlowerChallenge

A simple object-oriented PHP application for managing a shopping basket at a fictional flower shop.
Includes both a **command-line interface (CLI)** and a **web-based UI** version with session persistence.

## Features

- Catalog of three products:

  - Red Flower (RF1): \$32.95
  - Green Flower (GF1): \$24.95
  - Blue Flower (BF1): \$7.95

- Pricing rules:

  - **Buy One Get One Half Off** for Red Flowers (RF1)
    - Interpreted to mean that this offer stacks:
      - ex. if you buy 9 flowers then 4 will be half off
  - Delivery fees:

    - <\$50: \$4.95
    - \$50–\$89.99: \$2.95
    - \$90+: Free

## Usage

Ensure PHP is installed

### Web UI Version

1. Start PHP's built-in server:

   ```bash
   php -S localhost:8000 -t public
   ```

2. Navigate to:

   ```
   http://localhost:8000/
   ```

3. Use the form to add products to your basket. The current quantity and total will be displayed.

---

### CLI Version

Run the interactive CLI tool by passing args directly:

```bash
php cli.php RF1=2 BF1=1 GF1=1
```

The syntax for the args is `<flowerCode>=<quantity>`

| Flower | Code  |
| :----: | :---: |
|  Red   | `RF1` |
|  Blue  | `BF1` |
| Green  | `GF1` |

The basket will be calculated and printed to the console.

## Project Structure

```
src/
  Product.php  # Defines the Product class
  Catalog.php  # Hardcoded product catalog
  Basket.php   # Basket logic with pricing rules

public/
  index.php    # Web interface with session persistence

cli.php        # Interactive CLI script
README.md
```
