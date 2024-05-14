<?php 
    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);
    require '../../modelos/Producto.php';
    
    $mensaje = '';
    $precio =  $_POST['cliente_telefono'];
    // VALIDAR INFORMACION
    $_POST['cliente_nombre'] = htmlspecialchars( $_POST['cliente_nombre']);
    $_POST['cliente_telefono'] = filter_var( $precio , FILTER_VALIDATE_FLOAT) ;
    
    if($_POST['cliente_telefono'] == '' || !$_POST['cliente_telefono'] || $_POST['cliente_telefono'] < 0 ){
        // ALERTA PARA VALIDAR DATOS
        $resultado = [
            'mensaje' => 'DEBE VALIDAR LOS DATOS',
            'codigo' => 2
        ];
    }else{
        try {
            // REALIZAR CONSULTA
            $clientes = new Clientes($_POST);
            $guardar = $clientes->guardar();
            $resultado = [
                'mensaje' => 'PRODUCTO INSERTADO CORRECTAMENTE',
                'codigo' => 1
            ];
            
        } catch (PDOException $pe){
            $resultado = [
                'mensaje' => 'OCURRIO UN ERROR INSERTANDO A LA BD',
                'detalle' => $pe->getMessage(),
                'codigo' => 0
            ];
        } catch (Exception $e) {
            $resultado = [
                'mensaje' => 'OCURRIO UN ERROR EN LA EJECUCIÓN',
                'detalle' => $e->getMessage(),
                'codigo' => 0
            ];
        }
        
    }


    // $alerta = 'success';

    // switch ($resultado['codigo']) {
    //     case 0:
    //         $alerta = 'danger';
    //         break;
    //     case 1:
    //         $alerta = 'success';
    //         break;
    //     case 2:
    //         $alerta = 'warning';
    //         break;
    // }


    $alertas = ['danger', 'success', 'warning'];

    
    include_once '../../vistas/templates/header.php'; ?>

    <div class="row justify-content-center">
        <div class="col-lg-6 alert alert-<?=$alertas[$resultado['codigo']] ?>" role="alert">
            <?= $resultado['mensaje'] ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <a href="../../vistas/producto/index.php" class="btn btn-primary w-100">Volver al formulario</a>
        </div>
    </div>


<?php include_once '../../vistas/templates/footer.php'; ?>  