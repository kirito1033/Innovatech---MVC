<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inovatech.com</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>
    <header>
        <?= $this->include('partials/header') ?>
    </header>
    <main class="producto"> 
    <div class="container main-producto text-center">
        <div class="row">
            <div class="col borde1">
                <?php if ($producto['imagen']): ?>
                    <img src="<?= base_url('uploads/' . $producto['imagen']) ?>" alt="Imagen" width="60">
                <?php else: ?>
                    <span class="text-muted">Sin imagen</span>
                <?php endif; ?>
            </div>
            <div class="col borde2">
                <div class="titulo">
                    <h2 class="titulo-producto"><?= esc($producto['nom']) ?></h2>
                </div>
                <div class="precio">
                    <p class="precio-p">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
                </div>
            
                <div class="caracteristicas-gene">
                    <h5>Lo que tienes que saber de este producto</h5>
                    <p><?= esc($producto['descripcion']) ?></p>
                    <!-- Puedes convertir en lista si usas explode() desde el controlador -->
                </div>
            </div>
            <div class="col comprar-col">
                <div class="stock">
                    <p>Stock disponible (<?= esc($producto['existencias']) ?> unidades)</p>
                </div>
                <!-- Resto del contenido fijo como botones de compra, pagos, etc. -->
            </div>
        </div>
    </div>
</main>
<footer>
<?php require_once("../app/Views/footer/footerApp.php")?>
</footer>
</body>



