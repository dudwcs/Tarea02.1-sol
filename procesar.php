<?php

require_once 'funciones.php';
require_once 'tarifas.php';

$errores = [];

$nombre = trim($_POST['nombre'] ?? '');
$taller = $_POST['taller'] ?? '';
$sesionesTexto = $_POST['sesiones'] ?? '';

if ($nombre === '') {
    $errores[] = 'El nombre es obligatorio.';
}

if (!is_string($taller) || !array_key_exists($taller, $tarifas)) {
    $errores[] = 'El taller seleccionado no existe.';
}

$sesiones = is_string($sesionesTexto)
    ? filter_var($sesionesTexto, FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 10]
    ])
    : false;

if ($sesiones === false) {
    $errores[] = 'Las sesiones deben ser un entero entre 1 y 10.';
}

if (empty($errores)) {
    $precio = $tarifas[$taller];
    $importe = calcularImporte($precio, $sesiones);
    $descuento = calcularDescuento($importe, $sesiones);
    $total = calcularTotal($importe, $descuento);
}
?>

<h1>Resultado de la inscripción</h1>

<?php if (!empty($errores)): ?>
    <ul>
        <?php foreach ($errores as $error): ?>
            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Nombre: <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></p>
    <p>Taller: <?= htmlspecialchars($taller, ENT_QUOTES, 'UTF-8') ?></p>
    <p>Sesiones: <?= $sesiones ?></p>
    <p>Importe inicial: <?= number_format($importe, 2, ',', '.') ?> €</p>
    <p>Descuento: <?= number_format($descuento, 2, ',', '.') ?> €</p>
    <p>Total: <?= number_format($total, 2, ',', '.') ?> €</p>
<?php endif; ?>

<h2>Talleres disponibles</h2>
<ul>
    <?php foreach ($tarifas as $nombreTaller => $precio): ?>
        <li>
            <?= htmlspecialchars($nombreTaller, ENT_QUOTES, 'UTF-8') ?>:
            <?= number_format($precio, 2, ',', '.') ?> € por sesión
        </li>
    <?php endforeach; ?>
</ul>

<p><a href="index.php">Volver al formulario</a></p>