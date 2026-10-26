
<?php

const DESCUENTO = 0.10;

/**
 * Calcula el importe inicial de la inscripción.
 *
 * @param float $precio Precio por sesión.
 * @param int $sesiones Número de sesiones contratadas.
 * @return float Importe antes del descuento.
 */
function calcularImporte(float $precio, int $sesiones): float
{
    return $precio * $sesiones;
}

/**
 * Calcula el descuento aplicable a la inscripción.
 *
 * Se aplica un 10 % de descuento a partir de cinco sesiones.
 *
 * @param float $importe Importe inicial de la inscripción.
 * @param int $sesiones Número de sesiones contratadas.
 * @return float Importe del descuento.
 */
function calcularDescuento(float $importe, int $sesiones): float
{
    if ($sesiones >= 5) {
        return $importe * DESCUENTO;
    }

    return 0.0;
}

/**
 * Calcula el importe final de la inscripción.
 *
 * @param float $importe Importe inicial de la inscripción.
 * @param float $descuento Descuento que se debe restar.
 * @return float Importe final.
 */
function calcularTotal(float $importe, float $descuento): float
{
    return $importe - $descuento;
}
