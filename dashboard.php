<?php
include 'funciones.php';

$personajes = cargarDatos('data/personajes.json');
$profesiones = cargarDatos('data/profesiones.json');

function calcularEdad($fechaNacimiento) {
    $nacimiento = new DateTime($fechaNacimiento);
    $hoy = new DateTime();
    return $hoy->diff($nacimiento)->y;
}

function obtenerSalario($nombreProfesion, $profesiones) {
    foreach ($profesiones as $p) {
        if ($p['nombre'] === $nombreProfesion) {
            return $p['salario'];
        }
    }
    return 0;
}

$totalPersonajes = count($personajes);
$totalProfesiones = count($profesiones);

$edades = array_map(fn($p) => calcularEdad($p['nacimiento']), $personajes);
$edadPromedio = $edades ? array_sum($edades) / count($edades) : 0;

$conteoExperiencia = [];
$conteoCategorias = [];
$salarioTotal = 0;
$salarioMax = -INF;
$salarioMin = INF;
$personajeSalarioMax = null;
$salariosPorCategoria = [];

foreach ($personajes as $p) {
    $exp = $p['experiencia'];
    $prof = $p['profesion'];

    if (!isset($conteoExperiencia[$exp])) $conteoExperiencia[$exp] = 0;
    $conteoExperiencia[$exp]++;

    foreach ($profesiones as $pro) {
        if ($pro['nombre'] === $prof) {
            $cat = $pro['categoria'];
            $sal = $pro['salario'];
            if (!isset($conteoCategorias[$cat])) $conteoCategorias[$cat] = 0;
            $conteoCategorias[$cat]++;

            if (!isset($salariosPorCategoria[$cat])) $salariosPorCategoria[$cat] = [];
            $salariosPorCategoria[$cat][] = $sal;

            $salarioTotal += $sal;

            if ($sal > $salarioMax) {
                $salarioMax = $sal;
                $personajeSalarioMax = $p['nombre'] . ' ' . $p['apellido'];
            }

            if ($sal < $salarioMin) {
                $salarioMin = $sal;
            }
        }
    }
}

$salarioPromedio = $totalPersonajes ? $salarioTotal / $totalPersonajes : 0;
$experienciaMasComun = !empty($conteoExperiencia)
    ? array_search(max($conteoExperiencia), $conteoExperiencia)
    : 'Ninguno';

$labels = array_keys($salariosPorCategoria);
$valores = array_map(fn($salarios) => array_sum($salarios) / count($salarios), $salariosPorCategoria);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Barbie</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #ffe6f0 !important;
        }
        h1 {
            color: #d63384 !important;
        }
        .card {
            border-color: #ff69b4 !important;
        }
        .card-title {
            color: #c71585 !important;
        }
        .list-group-item {
            background-color: #fff0f5 !important;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <h1 class="text-center mb-4 titulo-barbie">Estadisticas del Mundo Barbie</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Total de personajes:</strong> <?= $totalPersonajes ?></li>
                <li class="list-group-item"><strong>Total de profesiones:</strong> <?= $totalProfesiones ?></li>
                <li class="list-group-item"><strong>Edad promedio:</strong> <?= round($edadPromedio, 1) ?> años</li>
                <li class="list-group-item"><strong>Nivel de experiencia más común:</strong> <?= $experienciaMasComun ?></li>
                <li class="list-group-item"><strong>Categorías de profesión:</strong>
                    <ul class="list-group list-group-flush ms-3">
                        <?php foreach ($conteoCategorias as $cat => $cant): ?>
                            <li class="list-group-item"><?= $cat ?>: <?= $cant ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="list-group-item"><strong>Profesión con mayor salario:</strong> $<?= number_format($salarioMax, 2) ?></li>
                <li class="list-group-item"><strong>Profesión con menor salario:</strong> $<?= number_format($salarioMin, 2) ?></li>
                <li class="list-group-item"><strong>Salario promedio:</strong> $<?= number_format($salarioPromedio, 2) ?></li>
                <li class="list-group-item"><strong>Personaje con mayor salario:</strong> <?= $personajeSalarioMax ?: 'Ninguno' ?></li>
            </ul>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">Salario Promedio por Categoría</h5>
            <canvas id="graficoSalarios" width="600" height="400"></canvas>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('graficoSalarios');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Salario Promedio por Categoria',
                data: <?= json_encode($valores) ?>,
                backgroundColor: '#FF69B4',
                borderColor: '#C71585',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    </script>
    <div class="text-center mt-4">
        <a href="index.php" class="btn" style="background-color: #ff69b4; color: white;">Volver Atrás</a>
    </div>
</body>
</html>
