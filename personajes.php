<?php
include 'funciones.php';

$personajes = cargarDatos('data/personajes.json');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Personajes</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Lista de Personajes</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Nacimiento</th>
            <th>Profesion</th>
            <th>Experiencia</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($personajes as $index => $p): ?>
        <tr>
            <td><img src="<?= $p['foto'] ?>" width="50"></td>
            <td><?= $p['nombre'] ?> <?= $p['apellido'] ?></td>
            <td><?= $p['nacimiento'] ?></td>
            <td><?= $p['profesion'] ?></td>
            <td><?= $p['experiencia'] ?></td>
            <td>
            <a href="editar_personaje.php?id=<?= $p['id'] ?>">Editar</a>
            <a href="eliminar_personaje.php?id=<?= $index ?>" onclick="return confirm('Quiere eliminar personaje?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
            </form>
    <br>
    <button onclick="window.location.href='index.php'">Volver Atras</button>
</body>
</html>
