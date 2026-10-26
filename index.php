
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Tarea02.1 (20% de la UD2)</h1>

<?php
require_once 'tarifas.php';
?>
<form action="procesar.php" method="post">
    <h2>Inscripción en talleres</h2>

    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
    </p>

    <p>
        <label for="taller">Taller:</label>
        <select id="taller" name="taller" required>
            <?php foreach ($tarifas as $nombreTaller => $precio): ?>
                <option value="<?= htmlspecialchars($nombreTaller)  ?>">
                    <?= htmlspecialchars($nombreTaller . ': '. $precio. " €") ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label for="sesiones">Número de sesiones:</label>
        <input type="number" id="sesiones" name="sesiones"
               min="1" max="10" step="1" required>
    </p>

    <button type="submit">Calcular importe</button>
</form>

</body>
</html>