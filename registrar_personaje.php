<?php
include 'funciones.php';

$personajes = cargarDatos('data/personajes.json');
$profesiones = cargarDatos('data/profesiones.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($profesiones) > 0) {
    $id = uniqid();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nacimiento = $_POST['nacimiento'];
    $profesion = $_POST['profesion'];
    $experiencia = $_POST['experiencia'];

    $fotoNombre = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $fotoNombre = "img/" . $id . "." . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], $fotoNombre);
    }

    $personajes[] = [
        'id' => $id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'nacimiento' => $nacimiento,
        'foto' => $fotoNombre,
        'profesion' => $profesion,
        'experiencia' => $experiencia
    ];

    guardarDatos('data/personajes.json', $personajes);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Personaje</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Registrar Nuevo Personaje</h1>

    <?php if (count($profesiones) === 0): ?>
        <p style="color:red;">Lo siento, no hay profesiones registradas. <a href="registrar_profesion.php">Registrar aqui</a> antes de continuar.</p>
    <?php else: ?>
        <form method="POST" enctype="multipart/form-data">
            <label>Nombre:</label><br>
            <input type="text" name="nombre" required><br><br>

            <label>Apellido:</label><br>
            <input type="text" name="apellido" required><br><br>

            <label>Fecha de Nacimiento:</label><br>
            <input type="date" name="nacimiento" required><br><br>

            <label>Foto del Personaje:</label><br>
            <input type="file" name="foto" accept="image/*" required><br><br>

            <label>Profesion:</label><br>
            <select name="profesion" required>
                <?php foreach ($profesiones as $p): ?>
                    <option value="<?= $p['nombre'] ?>"><?= $p['nombre'] ?> (<?= $p['categoria'] ?>)</option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Nivel de Experiencia:</label><br>
            <select name="experiencia" required>
                <option value="Principiante">Principiante</option>
                <option value="Intermedio">Intermedio</option>
                <option value="Avanzado">Avanzado</option>
            </select><br><br>

            <button type="submit">Guardar Personaje</button>
        </form>
    <br>
    <button onclick="window.location.href='index.php'">Volver Atras</button>
    <?php endif; ?>
</body>
</html>
