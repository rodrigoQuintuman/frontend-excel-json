<?php

include "autoload.php";
include '../../includes/db.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$error = null;
if (is_null($error)) {
  try {
    $bd = new DB();
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getProperties()->setCreator("GrupoZ")->setTitle("PlanillaUsuarios");
    $spreadsheet->setActiveSheetIndex(0);
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("Lista Usuarios");
    $sheet->getStyle("1")->getFont()->setBold(true);
    $sheet->getRowDimension('1')->setRowHeight(50);
    $sheet->getStyle('1')->getAlignment()->setHorizontal('center');
    $sheet->getStyle('1')->getAlignment()->setWrapText(true);
    $sheet->getStyle('1')->getAlignment()->setVertical('center');
    $sheet->getColumnDimension('A')->setWidth(30);
    $sheet->getColumnDimension('B')->setWidth(30);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->setCellValue('A1', 'Username');
    $sheet->setCellValue('B1', 'Password');
    $sheet->setCellValue('C1', '*No cambiar formato  **Omitir campo "Password" si es necesario');
    $stmt = $bd->connect()->prepare("SELECT * FROM `user_event` WHERE `nombre_evento` = :nombre_evento");
    $stmt->execute(['nombre_evento' => $_POST['nombre_evento']]);
    while ($row = $stmt->fetch()) {
      $usuarios[] = $row;
    }

    if ($_POST['datos'] == 1) {
      for ($i = 0; $i < count($usuarios); $i++) {
        $sheet->setCellValue('A' . ($i + 2), $usuarios[$i]['correo']);
        $sheet->setCellValue('B' . ($i + 2), $usuarios[$i]['password']);
      }
    } elseif($_POST['datos']==2){
      for ($i = 0; $i < count($usuarios); $i++) {
        $sheet->setCellValue('A' . ($i + 2), $usuarios[$i]['rut']);
        $sheet->setCellValue('B' . ($i + 2), $usuarios[$i]['password']);
      }
    } elseif ($_POST['datos'] !== 1 && $_POST['datos'] !== 2 ) {
      for ($i = 0; $i < count($usuarios); $i++) {
        $sheet->setCellValue('A' . ($i + 2), $usuarios[$i][$_POST['datos']]);
      }
    }
    $spreadsheet->getActiveSheet();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="PlanillaUsuarios.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  } catch (Exception $ex) {
    $error = $ex->getMessage();
  }
}

// INSERT INTO `user_event`(`nombre`, `apellido`, `rut`, `correo`, `password`, `nombre_evento`) VALUES ('pepe','lota','124536789','pepe@gmail.cl','abc1','pepsi');
