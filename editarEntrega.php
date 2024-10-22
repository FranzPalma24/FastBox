<?php
require_once __DIR__ . '/includes/functions.php';

$id = $_GET['id'];
$tarea = obtenerTareaPorId($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $producto = $_POST['producto'];
    $fechaPedido = $_POST['fechaPedido'];
    $fechaEntrega = $_POST['fechaEntrega'];
    $completada = isset($_POST['completada']) ? true : false;

    $updated = actualizarTarea($id, $nombre, $producto, $fechaPedido, $fechaEntrega, $completada);
    if ($updated) {
        header("Location: index.php?mensaje=" . urlencode("Entrega actualizada con éxito"));
        exit;
    } else {
        $error = "No se pudo actualizar la entrega.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Entrega</title>
    <link rel="stylesheet" href="public/css/styleEditar.css">
</head>
<body>
    <div class="container">
        <h1>Editar Entrega</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <label>Nombre Completo: <input type="text" name="nombre" value="<?php echo htmlspecialchars($tarea['nombre']); ?>" required></label>
            <label>Producto: <input type="text" name="producto" value="<?php echo htmlspecialchars($tarea['producto']); ?>" required></label>
            <label>Fecha de Pedido: <input type="date" name="fechaPedido" value="<?php echo formatDate($tarea['fechaPedido']); ?>" required></label>
            <label>Fecha de Entrega: <input type="date" name="fechaEntrega" value="<?php echo formatDate($tarea['fechaEntrega']); ?>" required></label>
            <label>¿Entregado? <input type="checkbox" name="completada" <?php echo $tarea['completada'] ? 'checked' : ''; ?>></label>

            <input type="submit" value="Actualizar Entrega">
        </form>

        <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>
</html>
