<?php
require("./autoload.php");

use Classes\Excel;
use Classes\Database;


function saveSheet() {
$sheetinfo = array(
  "name" => $_FILES["sheet"]["name"],
  "tipo" => $_FILES["sheet"]["type"],
  "tamanho" => $_FILES["sheet"]["size"],
  "tmp_name" => $_FILES["sheet"]["tmp_name"],
  "error" => $_FILES["sheet"]["error"]
);

$path = __DIR__."\\tmpsheet\\".basename($sheetinfo["tmp_name"]);


if(move_uploaded_file($sheetinfo["tmp_name"],$path))  {
    $sheet = new Excel();
    $spreadsheet = $sheet->loadFile($path);
    $mysheet = $sheet->getSheet($spreadsheet);

    $DB = new Database();
    $DB->Create($mysheet);

    echo json_encode($mysheet);
} else  {
    echo json_encode(array("erro ao enviar!"));
};};

saveSheet();

 ?>
