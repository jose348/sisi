    <?php
    require_once("../config/conexion.php");
    require_once("../models/Rutas.php");

    $rutas = new Rutas();

    switch ($_GET["op"]) {

        case "obtenerHorarios":
            $datos = $rutas->obtenerHorarios();
            echo json_encode($datos);
            break;


        case "guardarRuta":
            error_log("Método: " . $_SERVER['REQUEST_METHOD']); // Verifica el método

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode(["success" => false, "message" => "Método no permitido."]);
                exit;
            }

            $input = json_decode(file_get_contents('php://input'), true);
            error_log("Datos recibidos: " . json_encode($input));

            if ($input === null) {
                echo json_encode(["success" => false, "message" => "No se recibieron datos correctamente."]);
                exit;
            }

            $nombre = $input['nombre'] ?? '';
            $estado = $input['estado'] ?? 1;
            $geojson = $input['geojson'] ?? '';
            $horarioId = $input['horarioId'] ?? null;
            $ubicaciones = $input['ubicaciones'] ?? [];

            if (empty($nombre) || empty($geojson) || !$horarioId) {
                echo json_encode(["success" => false, "message" => "Por favor, completa todos los campos."]);
                exit;
            }

            $resultado = $rutas->guardarRuta($nombre, $estado, $geojson, $horarioId, $ubicaciones);

            if ($resultado) {
                echo json_encode(["success" => true, "message" => "Ruta guardada exitosamente."]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al guardar la ruta."]);
            }
            break;

        default:
            echo json_encode(["success" => false, "message" => "Acción no válida."]);
            break;




        case "obtenerRutas":
            $datos = $rutas->obtenerRutas();
            error_log("Rutas obtenidas: " . json_encode($datos)); // Log para verificar rutas
            echo json_encode($datos);
            break;



            case "editarRuta":
                $input = json_decode(file_get_contents('php://input'), true);
        
                $resultado = $rutas->editarRuta(
                    $input['id'],
                    $input['nombre'],
                    $input['geojson'],
                    $input['horarioId'],
                    $input['ubicaciones']
                );
        
                echo json_encode([
                    "success" => $resultado,
                    "message" => $resultado ? "Ruta editada correctamente." : "Error al editar la ruta."
                ]);
                break;
        
            case "eliminarRuta":
                $id = $_POST['id'];
        
                $resultado = $rutas->eliminarRuta($id);
        
                echo json_encode([
                    "success" => $resultado,
                    "message" => $resultado ? "Ruta eliminada correctamente." : "Error al eliminar la ruta."
                ]);
                break;
        
           
    }
