<?php

class Assiste_model extends Object {

    function __construct() {
                parent::__construct(new PDO('mysql:host=localhost;dbname=pole', 'root', ''));

        
    }

      public  function add(Assiste_object $assiste) {
       //  print_r($membre);
        $add = $this->_db->prepare('INSERT INTO assiste(bolassist,membre_idmembre,seance_idseance) values(:idmembre,:idseance,:boolassist)');

        $add->bindValue(':idmembre', $assiste->get_idmembre());
        $add->bindValue(':idseance', $assiste->get_idseance());
        $add->bindValue(':boolassist', $assiste->get_bolassiste());
        
        $add->execute();
       //print_r($add->errorinfo());
       return $this->_db->lastInsertId();
       
       
        
      /*  echo "\nPDOStatement::errorInfo():\n";
        $inserto = $sth->errorInfo();
        print_r($arr);
      
      */
    }
    
    
    
    
}
?>
