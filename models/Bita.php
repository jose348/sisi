<?php

class Bita  extends Conectar
{


    public function combo_tipo_busquedad()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_tipo_unidad
            ORDER BY tiun_id ASC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function combo_modelo_busquedad()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_modelo where   mode_estado=1
        ORDER BY mode_id ASC ";
        $sql = $con->prepare($sql);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function combo_marca_busquedad()
    {
        $con = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM sc_residuos_solidos.tb_marca
            ORDER BY marc_id ASC ";
        $sql = $con->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }





    public function get_lista_bitacora($tiun_id, $mode_id, $marc_id, $placaUnidad, $fechaDesde, $fechaHasta) {
        $con = parent::conexion();
        parent::set_names();

        // Construimos la consulta con los parámetros
        $sql = "SELECT u.unid_placa, 
                       tu.tiun_descripcion, 
                       m.mode_descripcion,
                       ma.marc_descripcion, 
                       i.inun_fecha, 
                       pm.prma_fecha,
                       t.tickdo_numtick,
                       tm.mant_fech,
                       u.unid_id
                FROM sc_residuos_solidos.tb_ingreso_unidad i
                LEFT JOIN sc_residuos_solidos.tb_unidad u ON i.unid_id = u.unid_id
                LEFT JOIN sc_residuos_solidos.tb_tipo_unidad tu ON u.tiun_id = tu.tiun_id
                LEFT JOIN sc_residuos_solidos.tb_modelo m ON u.mode_id = m.mode_id
                LEFT JOIN sc_residuos_solidos.tb_marca ma ON m.marc_id = ma.marc_id
                LEFT JOIN sc_residuos_solidos.tb_programacion_mantenimiento pm ON i.prma_id = pm.prma_id
                LEFT JOIN sc_residuos_solidos.tb_ticket_dotacion t ON i.inun_id = t.inun_id
                LEFT JOIN sc_residuos_solidos.tb_mantenimiento tm ON i.inun_id = tm.inun_id
                WHERE 1=1"; // Condición inicial para evitar problemas con filtros opcionales

        // Aplicar los filtros condicionalmente
        if (!empty($tiun_id)) {
            $sql .= " AND tu.tiun_id = :tiun_id";
        }
        if (!empty($mode_id)) {
            $sql .= " AND m.mode_id = :mode_id";
        }
        if (!empty($marc_id)) {
            $sql .= " AND ma.marc_id = :marc_id";
        }
        if (!empty($placaUnidad)) {
            $sql .= " AND u.unid_placa LIKE :placaUnidad";
        }
        if (!empty($fechaDesde) && !empty($fechaHasta)) {
            $sql .= " AND i.inun_fecha BETWEEN :fechaDesde AND :fechaHasta";
        }

        $sql .= " ORDER BY i.inun_fecha DESC"; // Orden por fecha descendente

        $query = $con->prepare($sql);

        // Vincular los parámetros
        if (!empty($tiun_id)) {
            $query->bindValue(':tiun_id', $tiun_id, PDO::PARAM_INT);
        }
        if (!empty($mode_id)) {
            $query->bindValue(':mode_id', $mode_id, PDO::PARAM_INT);
        }
        if (!empty($marc_id)) {
            $query->bindValue(':marc_id', $marc_id, PDO::PARAM_INT);
        }
        if (!empty($placaUnidad)) {
            $query->bindValue(':placaUnidad', "%$placaUnidad%", PDO::PARAM_STR);
        }
        if (!empty($fechaDesde) && !empty($fechaHasta)) {
            $query->bindValue(':fechaDesde', $fechaDesde);
            $query->bindValue(':fechaHasta', $fechaHasta);
        }

        // Ejecutar la consulta
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }








    public function get_movimientos_unidad($unid_id)
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "SELECT 
                  m.mant_fech AS fecha_mantenimiento,
                  m.mant_diagnostico AS diagnostico,
                  pm.prma_fecha AS fecha_programacion,
                  t.tickdo_numtick AS ticket,
                  t.tickdo_fecha AS fecha_ticket,
                  e.esme_descripcion AS especialidad
              FROM sc_residuos_solidos.tb_mantenimiento m
              LEFT JOIN sc_residuos_solidos.tb_ticket_dotacion t ON m.tickdo_id = t.tickdo_id
              LEFT JOIN sc_residuos_solidos.tb_programacion_mantenimiento pm ON t.tickdo_id = pm.tickdo_id
              LEFT JOIN sc_residuos_solidos.tb_especialidad_mantenimiento e ON pm.esme_id = e.esme_id
              WHERE m.unid_id = :unid_id
              ORDER BY m.mant_fech DESC";

        $query = $con->prepare($sql);
        $query->bindValue(':unid_id', $unid_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    /*TODO DETALLE DE MI HISTORIAL EN MI MODAL */
    public function get_historial_unidad($unid_id)
    {
        $con = parent::conexion();
        parent::set_names();

        $sql = "SELECT i.inun_id,
                   u.unid_placa,
                   (per.pers_nombre || ' ' || per.pers_apelpat || ' ' || per.pers_apelmat) as chofer,
                   tu.tiun_descripcion, 
                   m.mode_descripcion,
                   ma.marc_descripcion, 
                   i.inun_fecha, 
                   i.inun_hora, 
                   i.inun_diagnostico, 
                   pm.prma_fecha,
                   t.tickdo_numtick,
                   tm.mant_fech,
                   u.unid_id
            FROM sc_residuos_solidos.tb_ingreso_unidad i
            LEFT JOIN sc_residuos_solidos.tb_unidad u ON i.unid_id = u.unid_id
            LEFT JOIN sc_residuos_solidos.tb_tipo_unidad tu ON u.tiun_id = tu.tiun_id
            LEFT JOIN sc_residuos_solidos.tb_modelo m ON u.mode_id = m.mode_id
            LEFT JOIN sc_residuos_solidos.tb_marca ma ON m.marc_id = ma.marc_id
            LEFT JOIN sc_residuos_solidos.tb_programacion_mantenimiento pm ON i.prma_id = pm.prma_id
            LEFT JOIN sc_residuos_solidos.tb_ticket_dotacion t ON i.inun_id = t.inun_id
            LEFT JOIN sc_residuos_solidos.tb_mantenimiento tm ON i.inun_id = tm.inun_id
            LEFT JOIN sc_escalafon.tb_persona per ON t.pers_id = per.pers_id
            WHERE u.unid_id = ?
            ORDER BY i.inun_fecha DESC           ";

        $sql = $con->prepare($sql);
        $sql->bindValue(1, $unid_id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

 
    public function generarPDF($datos) {
        // Iniciar TCPDF en orientación horizontal (Landscape)
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    
        // Configuración del documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Reporte de Bitácora');
        $pdf->SetSubject('Reporte');
        $pdf->SetKeywords('TCPDF, PDF, reporte, bitacora');
    
        // Configurar las fuentes
        $pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
        // Márgenes
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);
    
        // Añadir página
        $pdf->AddPage();
    
        // Encabezado del PDF con la Municipalidad y Servicios Internos
        $html = '
        <h2 style="color:#2E86C1;text-align:center;">Municipalidad Provincial de Chiclayo</h2>
        <h4 style="color:#34495E;text-align:center;">Servicios Internos</h4>
        <h1 style="color:#2E86C1;text-align:center;">Reporte de Bitácora</h1>';
    
        // Tabla de los datos
        $html .= '
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
            }
            th {
                background-color: #2E86C1;
                color: #ffffff;
                text-align: center;
                padding: 8px;
            }
            td {
                border: 1px solid #ddd;
                text-align: center;
                padding: 8px;
            }
        </style>
        <table>
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Tipo de Unidad</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Fecha de Ingreso</th>
                    <th>F. Prog. Mant.</th>
                    <th>Ticket</th>
                    <th>Mantenimiento</th>
                </tr>
            </thead>
            <tbody>';
    
        foreach ($datos as $row) {
            $html .= '<tr>
                <td>' . $row['unid_placa'] . '</td>
                <td>' . $row['tiun_descripcion'] . '</td>
                <td>' . $row['mode_descripcion'] . '</td>
                <td>' . $row['marc_descripcion'] . '</td>
                <td>' . $row['inun_fecha'] . '</td>
                <td>' . $row['prma_fecha'] . '</td>
                <td>' . $row['tickdo_numtick'] . '</td>
                <td>' . $row['mant_fech'] . '</td>
            </tr>';
        }
    
        $html .= '</tbody></table>';
    
        // Escribir el HTML en el PDF
        $pdf->writeHTML($html, true, false, true, false, '');
    
        // Pie de página
        $pdf->SetFooterMargin(15);
        $pdf->SetFooterData('', '', 'Municipalidad Provincial de Chiclayo - Servicios Internos', '');
    
        // Salida del PDF
        $pdf->Output('Reporte_Bitacora.pdf', 'I');
    }
    
    
    


    // Generar Excelpublic function generarExcel($datos) {public function generarExcel($datos) {
    // Crear un nuevo archivo de Excel
    public function generarExcel($datos) {
        // Crear un nuevo archivo de Excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Encabezados de la Municipalidad y Servicios Internos
        $sheet->setCellValue('A1', 'Municipalidad Provincial de Chiclayo');
        $sheet->mergeCells('A1:H1'); // Unir celdas
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
    
        $sheet->setCellValue('A2', 'Servicios Internos');
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
    
        // Establecer el título
        $sheet->setCellValue('A3', 'Reporte de Bitácora');
        $sheet->mergeCells('A3:H3'); // Unir celdas para el título
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A3')->getAlignment()->setHorizontal('center');
    
        // Encabezados de columnas
        $headers = ['Placa', 'Tipo de Unidad', 'Modelo', 'Marca', 'Fecha de Ingreso', 'Fecha Prog. Mant.', 'Ticket', 'Mantenimiento'];
        $columnIndex = 'A';
    
        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '5', $header);
            $sheet->getStyle($columnIndex . '5')->getFont()->setBold(true);
            $sheet->getStyle($columnIndex . '5')->getAlignment()->setHorizontal('center');
            $columnIndex++;
        }
    
        // Datos
        $rowIndex = 6;
        foreach ($datos as $row) {
            $sheet->setCellValue('A' . $rowIndex, $row['unid_placa']);
            $sheet->setCellValue('B' . $rowIndex, $row['tiun_descripcion']);
            $sheet->setCellValue('C' . $rowIndex, $row['mode_descripcion']);
            $sheet->setCellValue('D' . $rowIndex, $row['marc_descripcion']);
            $sheet->setCellValue('E' . $rowIndex, $row['inun_fecha']);
            $sheet->setCellValue('F' . $rowIndex, $row['prma_fecha']);
            $sheet->setCellValue('G' . $rowIndex, $row['tickdo_numtick']);
            $sheet->setCellValue('H' . $rowIndex, $row['mant_fech']);
            $rowIndex++;
        }
    
        // Ajustar ancho de las columnas
        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    
        // Generar y descargar el archivo Excel
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Reporte_Bitacora.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
          

 
}
