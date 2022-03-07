<?php
require('view_begin.php');
?>
<center>
<h1>Pagination</h1>
<?php foreach($tab as $ligne)://Affiche les données present dans le tableau donné par le controller ?>
<p><?=$ligne['name']?></p>
<?php endforeach; ?>

<?php
//Systeme de pagination classique

echo 'Systeme de pagination classique :<br>';
if ($_GET['page']>1) {//mise en place du bouton precedent
    echo "<a href='?controller=home&action=changePage&page=".($_GET['page']-1)."' class='btn btn-danger'>Avant</a> ";
}

for ($i=0; $i < $nbdata/10; $i++) { //affiche un bouton pour chaque page
    if ($_GET['page']!=$i+1) {//si le numero de la page est different de la page actuelle
        echo "<a href='?controller=home&action=changePage&page=".($i+1)."' class='btn btn-secondary'>".($i+1)."</a> ";// met le bouton en gris
    }else {
        echo "<a href='?controller=home&action=changePage&page=".($i+1)."' class='btn btn-primary'>".($i+1)."</a> ";// met le bouton en bleu
    }
}

if ($_GET['page']<$nbdata/10) {//mise en place du bouton suivant
    echo "<a href='?controller=home&action=changePage&page=".($_GET['page']+1)."' class='btn btn-danger'>Suivant</a> ";
}

//-----------------

//Systeme de pagination dynamique, la liste des boutons s'actualise en fonction de la page où l'utilisateur est
echo '<br><br>Systeme de pagination dynamique :<br>';

$debut = $_GET['page']-1;//set la valeur qui sera utilisé pour initialiser le debut de la liste
$fin = (ceil($nbdata/10)-$_GET['page']);//set la valeur qui sera utilisé pour initialiser la fin de la liste
$fix = 1;// variable utiliser pour fix un declagae dans la liste

if($fin>2){
    $fin=2;
}

if ($debut>3) {
    $debut=3;
}

if ($_GET['page']>3) {
    $fix=0;
}

//[(page-debut)-fix;page+fin]

if ($_GET['page']>1) {//mise en place du bouton precedent
    echo "<a href='?controller=home&action=changePage&page=".($_GET['page']-1)."' class='btn btn-danger'>Avant</a> ";
}

for ($i=$_GET['page']-$debut-$fix; $i < $_GET['page']+$fin; $i++) {//affiche un bouton pour les pages proches de la page actuelle
    if ($_GET['page']!=$i+1) {
        echo "<a href='?controller=home&action=changePage&page=".($i+1)."' class='btn btn-secondary'>".($i+1)."</a> ";// met le bouton en gris
    }else {
        echo "<a href='?controller=home&action=changePage&page=".($i+1)."' class='btn btn-primary'>".($i+1)."</a> ";// met le bouton en bleu
    }
}

if ($_GET['page']<$nbdata/10) {//mise en place du bouton suivant
    echo "<a href='?controller=home&action=changePage&page=".($_GET['page']+1)."' class='btn btn-danger'>Suivant</a> ";
}


?>
<!-- Systeme de navigation via une liste -->
<p>Systeme de navigation via une liste:</p>
<label>Aller à la page :</label>

<select name="page" onchange="location = this.value;">
    <?php
    for ($i=0; $i < $nbdata/10; $i++) { //genere la liste
       echo "<option value=?controller=home&action=changePage&page=".($i+1).">".($i+1)."</option>";
    }
    ?>
</select>

</center>
<?php
require('view_end.php');
?>
