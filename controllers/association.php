<?php
require_once 'libs/Utility.php';
require_once 'libs/Model.php';
require_once 'models/association_model.php';
require_once 'models/groupe_model.php';
require_once 'models/formation_model.php';
require_once 'models/seance_model.php';
require_once 'models/membre_model.php';
require_once 'models/reponse_model.php';

require_once 'libs/objects/association_object.php';
require_once 'libs/objects/groupe_object.php';
require_once 'libs/objects/reponse_object.php';
require_once 'libs/objects/seance_object.php';
require_once 'libs/objects/formation_object.php';

class Association extends Controller {

    function __construct() {
          parent::__construct();
        $this->view = new View();
        
    }
    
    
    public function add_secteur()
    {
          if(isset($_POST["submit"]))
         {
             echo "ok";
             file_put_contents("c://wamp/www/mvc_test/libs/other/secteur_association.txt", "\n".$_POST["secteur_association"], FILE_APPEND );
            // $file=fopen("c://wamp/www/mvc_test/libs/other/fonction_association.txt","r+") or exit("Unable to open file!");
              //fwrite($file,$_POST["fonction"]."\n"); 
               //fclose($file);
             
         }
         $this->view->render("association/add_secteur_association");
        
        
        
    }
    
    
public function add()
{
    
    if (isset($_POST['submit'])) {
        
           
            $association = new Association_object(array(
                ""
                , $_POST["nom_association"]
                , $_POST["ad_association"]
                , $_POST["tel_association"]
                , $_POST["fax_association"]
                ,  $_POST["email_association"]
                , $_POST["president_association"]
                , $_POST["region_association"]
                    ,$_POST["secteur_association"]
            ));
       //  print_r($association);
            (new association_model())->add($association);
        }
    
    $this->view->render("association/add");  
}

public function look()
{
    
       $tab_rows = (new association_model())->getAll("association_object", 'association');

        if (isset($tab_rows)) {
            $_POST["noms_column"] = array("Identifiant", "Nom", "Adresse", "Télephone","Fax","Email", "Président", "Region","secteur");
            $_POST["donnees"] = $tab_rows;
           //print_r($tab_rows);
            // $_POST["type"]="animateur";
            // Utility::grid($tab_rows, array("identifiant", "Nom", "Prenom", "e-mail", "Téléphone", "CIN", "Adresse", "Photo", "CV", "Contrat"),"animateur");}
            $this->view->render("association/look");
        }    
}

public function lookone($id)
{
    
    if( isset($id) and intval($id)==$id)
    {
     $_POST["association"]=(new Association_model())->getAll("Association_object","association","idassociation=".$id);
          $temp=(new Membre_model())->get_membre_by_association_id($id);
          $_POST["membre"]=$temp[0];
          $_POST["fonction"]=$temp[1];
       //print_r($temp);
          $_POST["noms_column"]=array("Identifiant","Nom","Prenom","Fonction");
       //   print_r($_POST["membre"]);
         // print_r($_POST["membre"]);
          $_POST["formation_assiste"]=(new Reponse_model())->getAll("Reponse_object", "reponse","association_idassociation=".$id);
          $formationarray=array();
          if(isset($_POST["formation_assiste"])){
          foreach ($_POST["formation_assiste"] as $key => $value) {
            $formationarray[$key]= (new Formation_model())->getAll("Formation_object","formation","idformation=".$value->get_formationid());
          }
          $_POST["formations"]=$formationarray;}
         //print_r($formation_assiste);
    }
    
    
    $this->view->render("association/lookone");
}

public function agenda()
        
{
    
    $this->view->render("association/agenda");
}

public function add_animateur_to_association()      
{
    $tab_rows = (new Animateur_model())->getAll("Animateur_object", 'animateur');
    //print_r($tab_rows);
    if(isset($tab_rows)){
        $_POST["donnees"]=$tab_rows;
    $this->view->render("association/add_animateur_to_association");
    }
}

 public function delete($id) {

    
         if(intval($id).''==$id){
          (new association_model())->delete("association",$id,'idassociation');}
          else  {echo "Identifiant Non trouvé";}  
         
         $this->look();

    }
    
    
       public function modify($ids="") {
        
           if (isset($_POST['submit'])) {
               
                $assoc = new Association_object(array(
                $_POST["id_association"]
                , $_POST["nom_association"]
                , $_POST["ad_association"]
                , $_POST["tel_association"]
                , $_POST["fax_association"]
                , $_POST["email_association"]
                , $_POST["president_association"]
                , $_POST["region_association"]
                , $_POST["secteur_association"]
            ));
               
                        (new Association_model())->update($assoc);
   
           }
else {
                $id = explode(",", $ids);
                $where="idassociation=";
                 $where.=$id[0];
                
                
        $_POST["result"]=(new Association_model())->getAll("Association_object", "association",$where);
        $this->view->render("association/modify");
}
        
                        

        
    }
  

}
?>
