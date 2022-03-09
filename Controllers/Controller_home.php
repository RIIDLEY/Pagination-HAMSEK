<?php

class Controller_home extends Controller{

  public function action_default(){//fonction appele par defaut
    header('location:?controller=home&action=changePage&page=1');//set les parametres dans l'URL
    $this->action_changePage();//appel la fonction action_changePage
  }

  public function action_changePage(){
    $m = Model::getModel();//recupere le modele (la base de données)
    $tab = ['tab' => $m->getDataPage($_GET['page']),'nbdata' => $m->getNbData()];//utilise les fonctions sur modele et mets les données dans un tableau
    $this->render('home',$tab);//envoie du tableau avec les données dans la Vue
  }

}

?>
