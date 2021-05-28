<?php

namespace Classes;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Cell;


class Excel extends IOFactory {

function __construct()  {
    $reader = $this->createReader("Xlsx");
    $reader->setReadDataOnly(TRUE);
    $this->reader =$reader;
}


public function loadFile($inputFileName) {
    $reader = $this->reader;
    $spreadsheet = $reader->load($inputFileName);
    return $spreadsheet;
}

public function getSheet($spreadsheet) {
  $worksheet = $spreadsheet->getActiveSheet();
  $sheet = (array) array();
  foreach ($worksheet->getRowIterator() as $row)
       {

      $cellIterator = $row->getCellIterator();
      $cellIterator->setIterateOnlyExistingCells(FALSE);
      $n = (int) count($sheet);

        foreach ($cellIterator as $cell)
        {
            if($value = $cell->getValue())
            {
              if(@$sheet[$n]==false) {
                  $sheet[$n]= (array) array();
                };
               array_push($sheet[$n],$value);
            };
        };

      };

      $sheet =  Correct::ValidateSheet($sheet);

  return $sheet;
}


};




?>
