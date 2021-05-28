<?php

namespace Classes;

use MongoDB\Client;

class Database {

  function __construct()  {
      $client = new Client('mongodb+srv://wellingthom346:4s56K6wrERHOZiNB@cluster0.fdwvo.mongodb.net/DevPleno?retryWrites=true&w=majority');
      $this->client = $client;
      $this->collection  = ($client)->test->users;
  }

  public function Create($sheet) {

        $header =  $sheet[0];
        array_splice($sheet,0,1);

          foreach($sheet as $sh)
          {
            $newCollection = (array) array();
              foreach(array_map(function($s,$h) {return array($h,$s); },$sh,$header) as $hs)
              {
                  list($key,$value)  = $hs;
                  if($key == "Nome")
                    {
                      $result = ($this->Read($key,$value)?true:false);
                      if($result ==true) { break; };
                    };
                  $newCollection[$key]=trim($value);
              };
             if(count($newCollection)>0)
              {
                $collection = $this->collection;
                $insertOneResult  =  $collection -> insertOne($newCollection);
              };
        };


  }

  public function Read($key,$value) {

      if(isset($key) && isset($value))
      {
        $collection = $this->collection;
        $document =$collection->findOne([$key =>$value]);
        return $document;

      };

  }

  public function Update() {



  }

  public function Delete() {


    }



};



?>
