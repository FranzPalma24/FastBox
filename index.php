<?php
require_once __DIR__ . '/includes/functions.php';

if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {

    var_dump($_GET['id']);


    $count = eliminarTarea($_GET['id']);

    $mensaje = $count > 0 ? "Pedido eliminado con éxito." : "No se pudo eliminar el pedido.";
}


if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
}


$tareas = obtenerTareas();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastBox</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <center><h1>FastBox</h1></center>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        

        <center><h2>Lista de Entregas</h2></center>
<table>
    <tr>
        <th>Nombre Completo</th>
        <th>Producto</th>
        <th>Fecha de Pedido</th>
        <th>Fecha de Entrega</th>
        <th>Estado de la Entrega</th>
        <th>Acciones</th> <!-- Nueva columna para las acciones -->
    </tr>
    <?php foreach ($tareas as $tarea): ?>
    <tr>
        <td><?php echo htmlspecialchars($tarea['nombre']); ?></td>
        <td><?php echo htmlspecialchars($tarea['producto']); ?></td>
        <td><?php echo formatDate($tarea['fechaPedido']); ?></td>
        <td><?php echo formatDate($tarea['fechaEntrega']); ?></td>
        <td><?php echo $tarea['completada'] ? 'Entregado' : 'Pendiente'; ?></td>
        <td class="actions">
            <a href="editarEntrega.php?id=<?php echo $tarea['_id']; ?>" class="button">Editar</a>
            <a href="index.php?accion=eliminar&id=<?php echo $tarea['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table><br>
<a href="agregarEntrega.php" class="button">Agregar Nueva Entrega</a>
    </div>
</div>
</body>
</html>

