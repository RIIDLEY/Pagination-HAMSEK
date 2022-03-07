<?php

class Controller_home extends Controller{

  public function action_home(){
    $m = Model::getModel();
    header('location:?controller=home&action=changePage&page=1');//set les parametres dans l'URL
    $this->action_changePage();
  }

  public function action_default(){
    $this->action_home();
  }

  public function action_changePage(){
    $m = Model::getModel();//recupere le model
    $tab = ['tab' => $m->getDataPage($_GET['page']),'nbdata' => $m->getNbData()];//utilise les fonctions sur model et mets les données dans un tableau
    $this->render('home',$tab);//envoie du tableau à la Vue
  }

  public function action_coucou(){
    header('location:?controller=home&action=changePage&page=10');
  }

}

?>
