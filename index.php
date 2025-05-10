<?php
// 1. Definir arreglo de productos en PHP
$products = [
    [
        'id' => 1,
        'nombre' => 'Cámara Fotográfica',
        'descripcion' => 'Cámara réflex digital de 24MP con lente 18-55mm.',
        'precio' => 499.99,
        'imagen' => 'https://picsum.photos/seed/camera/300/200'
    ],
    [
        'id' => 2,
        'nombre' => 'Auriculares Bluetooth',
        'descripcion' => 'Auriculares inalámbricos con cancelación de ruido.',
        'precio' => 89.50,
        'imagen' => 'https://picsum.photos/seed/headphones/300/200'
    ],
    [
        'id' => 3,
        'nombre' => 'Smartwatch',
        'descripcion' => 'Reloj inteligente con monitor de ritmo cardíaco.',
        'precio' => 129.00,
        'imagen' => 'https://picsum.photos/seed/watch/300/200'
    ],
    [
        'id' => 4,
        'nombre' => 'Altavoz Portátil',
        'descripcion' => 'Altavoz Bluetooth resistente al agua.',
        'precio' => 59.25,
        'imagen' => 'https://picsum.photos/seed/speaker/300/200'
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Productos</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .products { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px,1fr)); gap: 20px; }
    .card { border: 1px solid #ccc; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .card img { width: 100%; display: block; }
    .card-body { padding: 12px; }
    .card-body h3 { margin: 0 0 8px; font-size: 1.1rem; }
    .card-body p { margin: 0 0 12px; font-size: 0.95rem; color: #555; }
    .card-body .price { font-weight: bold; margin-bottom: 12px; }
    .card-body button { background: #5C9DBF; color: #fff; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;}
    .card-body button:hover { background: #4a8ca5; }
    #cart { position: fixed; top: 20px; right: 20px; background: #5C9DBF; color: #fff; padding: 10px 14px; border-radius: 50px; cursor: pointer; }
    #cart span { font-weight: bold; }
  </style>
</head>
<body>

  <h1>Catálogo de Productos</h1>
  <div id="cart">
    🛒 Carrito: <span id="cart-count">0</span>
  </div>

  <div class="products">
    <?php foreach ($products as $p): ?>
      <div class="card">
        <img src="<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
        <div class="card-body">
          <h3><?= htmlspecialchars($p['nombre']) ?></h3>
          <p><?= htmlspecialchars($p['descripcion']) ?></p>
          <div class="price">$<?= number_format($p['precio'], 2) ?></div>
          <button data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['nombre']) ?>" data-price="<?= $p['precio'] ?>">
            Agregar al carrito
          </button>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <script>
    const buttons = document.querySelectorAll('.card-body button');
    const cartCountEl = document.getElementById('cart-count');
    let cart = JSON.parse(localStorage.getItem('cart')) || {};

    updateCartCount();

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const name = btn.dataset.name;
        const price = parseFloat(btn.dataset.price);

        
        if (cart[id]) {
          cart[id].quantity += 1;
        } else {
          cart[id] = { name, price, quantity: 1 };
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        alert(`${name} agregado al carrito`);
      });
    });

    function updateCartCount() {
      const totalItems = Object.values(cart).reduce((sum, item) => sum + item.quantity, 0);
      cartCountEl.textContent = totalItems;
    }
  </script>

</body>
</html>
