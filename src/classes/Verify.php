<?php

namespace Classes;



class Correct{

  function __construct() {

  }

  public static function ValidateSheet($sheet) {

          // start função
        $correctFormat=function ($s,$n) {

            $result = (string) "";
            $cellCorrect =  (array) array(
               "Data" =>function($cell) {
                          $t=10;
                          $size = strlen($cell);
                          $cell = ($size <=$t)?$cell:substr($cell,0,0-($size-$t));
                          $delimi = (array) array("/","-");
                          $convertDay = function ($n)
                          {
                               $n = (int) $n;
                               if($n>1000)
                                {
                                  $ano = (int) ($n/365);
                                  $rday = (int) ($n-($ano*365));
                                  $mes = (int) ($rday/30);
                                  $dia = (int) ($rday-($mes*30));
                                  return "{$dia}/{$mes}/".($ano+1900);
                                };
                          };

                          if($size>=($t-2))
                          {
                             $cell = str_replace($delimi,"/",$cell);
                             list($dia,$mes,$ano) = explode("/",$cell);
                             $cell = (strlen($dia)>2)?"{$ano}/{$mes}/$dia":"{$dia}/{$mes}/{$ano}";
                             return $cell;
                          } else {

                              return $convertDay($cell);

                                 };

                          },


               "Email"=> function($cell)
                        {
                          if($cell==NULL) { return NULL; };
                        },
               "Nome"=> function($cell)
                        {
                          if($cell==NULL) { return NULL; };
                        },
               "Assunto"=> function($cell)
                        {
                          if($cell==NULL) { return NULL; };
                        },
               "Corpo"=> function($cell)
                        {
                          if($cell==NULL) { return  NULL; };
                        },
               "Ja usou uma ferramenta similar"=> function($cell)
                        {

                          if($cell != NULL)
                            {

                                $positivo = array("im","positivo","claro","certeza");
                              if(strlen($cell)<=25)
                                {
                                    foreach($positivo as $p)
                                    {
                                      $cell = strtolower($cell);
                                      $pos = strpos($cell,$p);
                                      if($pos>=1) { return "1"; } else { return "0"; };
                                    };

                                };
                            };

                        }
                      );


               $caract = array("?","á");
               $substr = array("","a");
               $n = str_replace($caract,$substr,$n);


               switch($n)
               {
                  case "Data":$result = $cellCorrect[$n]($s);break;
                  case "Email":$result = $cellCorrect[$n]($s);break;
                  case "Nome":$result = $cellCorrect[$n]($s);break;
                  case "Assunto":$result = $cellCorrect[$n]($s);break;
                  case "Corpo":$result = $cellCorrect[$n]($s);break;
                  case "Ja usou uma ferramenta similar":$result = $cellCorrect[$n]($s);break;
               };

               return $result;
          };
            // fim função

        foreach($sheet as $sh) {
            if(isset($sh[0])) { $head = $sh;  break; };
          };

        if($head)
        {
            $line=0;
            foreach($sheet as $sh)
            {  $p=0;
              foreach(array_map($correctFormat,$sh,$head) as $l) {
                 if($l!=NULL)
                   {
                     $sheet[$line]=array_replace($sheet[$line],array($p=>$l));
                   }; $p++;
                }; $line++;
            };};

      return $sheet;
  }

};





?>
