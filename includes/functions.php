

<?php
    require_once __DIR__ . '/../config/database.php';

    function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    function formatDate($date) {
        if ($date instanceof MongoDB\BSON\UTCDateTime) {
            return $date->toDateTime()->format('Y-m-d');
        }
        return '';
    }
    
    
    function crearTarea($nombre, $producto, $fechaPedido, $fechaEntrega) {
        global $tasksCollection;
        $resultado = $tasksCollection->insertOne([
            'nombre' => sanitizeInput($nombre),
            'producto' => sanitizeInput($producto),
            'fechaPedido' => new MongoDB\BSON\UTCDateTime(strtotime($fechaPedido) * 1000),
            'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
            'completada' => false
        ]);
        return $resultado->getInsertedId();
    }
    
    function obtenerTareas() {
        global $tasksCollection;
        return $tasksCollection->find()->toArray();
    }
    

    function obtenerTareaPorId($id) {
        global $tasksCollection;
        return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    
    function actualizarTarea($id, $nombre, $producto, $fechaPedido,$fechaEntrega, $completada) {
        global $tasksCollection;
        $resultado = $tasksCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'producto' => sanitizeInput($producto),
                'fechaPedido' => new MongoDB\BSON\UTCDateTime(strtotime($fechaPedido) * 1000),
                'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
                'completada' => $completada
            ]]
        );
        return $resultado->getModifiedCount();
    }

    function eliminarTarea($id) {
        global $tasksCollection;
        $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    

    
?>