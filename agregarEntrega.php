<?php
    require_once __DIR__ . '/includes/functions.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = crearTarea($_POST['nombre'], $_POST['producto'], $_POST['fechaPedido'], $_POST['fechaEntrega']);
        if ($id) {
            header("Location: index.php?mensaje=" . urlencode("Pedido creada con éxito"));
            exit;
        }else{
            $error = "No se pudo crear el Pedido.";
        }
    }
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Tarea</title>
    <link rel="stylesheet" href="public/css/styleEntrega.css">
</head>
<body>
    <div class="form-container">
        <h1>Agregar nueva tarea</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <label>Nombre Completo: <input type="text" name="nombre" required></label>
            <label>Producto: <input name="producto" required></input></label>
            <label>Fecha de Pedido: <input type="date" name="fechaPedido" required></label>
            <label>Fecha de Entrega: <input type="date" name="fechaEntrega" required></label>
            <input type="submit" value="Crear Tarea">
        </form>

        <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>
</html>
