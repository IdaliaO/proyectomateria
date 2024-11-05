<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
</head>
<body>
    <h1>Recuperación de Contraseña</h1>
    <p>Hola, {{ $usuario->name }} {{ $usuario->apellido }}</p>
    <p>Parece que has solicitado recuperar tu contraseña. Haz clic en el enlace de abajo para restablecerla:</p>
    <a href="{{ route('resetear.contrasena', ['email' => $usuario->email]) }}">Restablecer Contraseña</a>
</body>
</html>
