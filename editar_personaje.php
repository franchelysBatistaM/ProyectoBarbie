<?php
include 'funciones.php';

$personajes = cargarDatos('data/personajes.json');
$profesiones = cargarDatos('data/profesiones.json');
$id = $_GET['id'] ?? '';

$personaje = null;
$indice = null;
foreach ($personajes as $key => $p) {
    if ($p['id'] === $id) {
        $personaje = $p;
        $indice = $key;
        break;
    }
}

if (!$personaje) {
    echo "Personaje no aparece.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $personajes[$indice] = [
        'id' => $id,
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'nacimiento' => $_POST['nacimiento'],
        'foto' => $_POST['foto'],
        'profesion' => $_POST['profesion'],
        'experiencia' => $_POST['experiencia']
    ];
    guardarDatos('data/personajes.json', $personajes);
    header('Location: personajes.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Personaje</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Editar Personaje</h1>
    <form method="POST">
        <input type="text" name="nombre" value="<?= $personaje['nombre'] ?>" required><br><br>
        <input type="text" name="apellido" value="<?= $personaje['apellido'] ?>" required><br><br>
        <input type="date" name="nacimiento" value="<?= $personaje['nacimiento'] ?>" required><br><br>
        <input type="text" name="foto" value="<?= $personaje['foto'] ?>" required><br><br>
        <select name="profesion" required>
            <?php foreach ($profesiones as $p): ?>
                <option value="<?= $p['nombre'] ?>" <?= $p['nombre'] == $personaje['profesion'] ? 'selected' : '' ?>>
                    <?= $p['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <select name="experiencia" required>
            <option value="Principiante" <?= $personaje['experiencia'] == 'Principiante' ? 'selected' : '' ?>>Principiante</option>
            <option value="Intermedio" <?= $personaje['experiencia'] == 'Intermedio' ? 'selected' : '' ?>>Intermedio</option>
            <option value="Avanzado" <?= $personaje['experiencia'] == 'Avanzado' ? 'selected' : '' ?>>Avanzado</option>
        </select><br><br>
        <button type="submit">Guardar </button>
    </form>
    <br>
    <button onclick="window.location.href='index.php'">Volver Atras</button>
</body>
</html>
