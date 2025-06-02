<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title> Sistema del Mundo Barbie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #ffe0f0, #ffc2d1);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #4b004f;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        h1 {
            color: #ff1493;
            text-shadow: 1px 1px 2px #fff;
            margin-bottom: 40px;
            font-size: 3rem;
            font-weight: bold;
        }
        .btn-barbie {
            background-color: #ff69b4;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            border-radius: 12px;
            padding: 15px 30px;
            margin: 15px;
            box-shadow: 0 4px 8px rgba(255, 20, 147, 0.3);
            transition: background-color 0.3s ease;
        }
        .btn-barbie:hover {
            background-color: #ff1493;
            color: white;
        }
        .logo-barbie {
            width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <img src="https://pngfre.com/wp-content/uploads/Barbie_logo108.png" alt="Logo Barbie" class="logo-barbie">
    <h1> Bienvenidos al sistema del mundo barbie</h1>

    <a href="registrar_personaje.php" class="btn btn-barbie">Registrar Personaje</a>
    <a href="registrar_profesion.php" class="btn btn-barbie">Registrar Profesion</a>
    <a href="personajes.php" class="btn btn-barbie">Ver Personajes</a>
    <a href="dashboard.php" class="btn btn-barbie">Ver Dashboard</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
