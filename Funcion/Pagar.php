<?php
include('conexion.php');

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $usuario =  $_POST["usuario"];
    $subtotal =  $_POST["subtotal"];

    $tarjeta_usuario_ID = $_POST["tarjeta_usuario_ID"];
    $tarjeta_nombre = $_POST["tarjeta_nombre"];
    $tarjeta_num = $_POST["tarjeta_num"];

    $tarjeta_mes = $_POST["mes"];
    $tarjeta_year = $_POST["year"];
    
    // Asegúrate de que ambos valores sean cadenas
    $tarjeta_mes_str = strval($tarjeta_mes);
    $tarjeta_year_str = strval($tarjeta_year);
    
    // Concatena los valores
    $tarjeta_fecha_vencimiento = $tarjeta_mes_str . $tarjeta_year_str;
    
    $tarjeta_csv = $_POST["tarjeta_csv"];
    $tarjeta_credito_debito = $_POST["tarjeta_credito_debito"];
    //$tarjeta_estatus = $_POST["tarjeta_estatus"];
    $tarjeta_estatus =1;

    $usua_ID_comp = $_POST["tarjeta_usuario_ID"];
    $cali_valor = $_POST["cali_valor"];
    $vent_estatus = 1;

    //$vent_estatus = $_POST["vent_estatus"];

    $query = "CALL InsertarVentaYProductos($tarjeta_usuario_ID, '$tarjeta_nombre', '$tarjeta_num', '$tarjeta_fecha_vencimiento', '$tarjeta_csv', $tarjeta_credito_debito, $tarjeta_estatus, $usua_ID_comp, $cali_valor, $vent_estatus, $subtotal
    )";

    if ($conn->query($query)) {
        // Éxito
       //echo "Compra realizada con éxito.";
        header("Location: ../PagP_usuario_registrado.php?usuario=$usuario");
    } else {
        // Error
        echo "Error al realizar la compra: " . $conn->error;
        echo  $query;
    }

/*
    // Llamada al procedimiento almacenado
    $stmt = $conn->prepare("CALL InsertarVentaYProductos(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssbibib", $tarjeta_usuario_ID, $tarjeta_nombre, $tarjeta_num, $tarjeta_fecha_vencimiento, $tarjeta_csv, $tarjeta_credito_debito, $tarjeta_estatus, $usua_ID_comp, $cali_valor, $vent_estatus);

    // Ejecutar la consulta
    $stmt->execute();
    if ($stmt->execute()) {
        // La ejecución del procedimiento fue exitosa
        echo "Procedimiento ejecutado exitosamente.";
    } else {
        // La ejecución del procedimiento falló
        echo "Error al ejecutar el procedimiento: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    */
    $conn->close();
}

?>


