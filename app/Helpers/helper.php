<?php

// Convierto la fecha de DD-MM-YYYY a YYYY-MM-DD
function formatDate(string $date): ?string
{
    $dateTime = DateTime::createFromFormat('d/m/Y', $date);
    return $dateTime ? $dateTime->format('Y-m-d') : null; // para recordarlo: expresión condicional ternaria
}

