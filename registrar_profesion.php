<?php
include 'funciones.php';

$profesiones = cargarDatos('data/profesiones.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevaProfesion = [
        'nombre' => $_POST['nombre'],
        'categoria' => $_POST['categoria'],
        'salario' => floatval($_POST['salario'])
    ];

    $profesiones[] = $nuevaProfesion;
    guardarDatos('data/profesiones.json', $profesiones);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Profesion</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Registrar Profesion</h1>
    <form method="POST">
        <label>Nombre de la Profesion:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Categoria:</label><br>
        <select name="categoria" required>
            <option value="Ciencia">Ciencia</option>
            <option value="Arte">Arte</option>
            <option value="Deporte">Deporte</option>
            <option value="Entretenimiento">Entretenimiento</option>
            <option value="Tecnologia">Tecnologia</option>
            <option value="Educacion">Educacion</option>
        </select><br><br>

        <label>Salario Mensual (USD):</label><br>
        <input type="number" name="salario" step="0.01" min="0" required><br><br>

        <button type="submit">Guardar </button>
    </form>

    <br>
    <button onclick="window.location.href='index.php'">Volver Atras</button>
</body>
</html>
