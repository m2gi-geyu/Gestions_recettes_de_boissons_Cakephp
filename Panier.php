<!DOCTYPE html>
<html>

<head>
      <title> Panier </title>
	  <meta charset="utf-8" />
</head>
<body>
<h1>Panier</h1>
<div>
  
<?php 
session_start();
include 'Donnees.inc.php';

?>

<table border="1" width="100" cellpadding="0" cellspacing="0">
  <tr>
      <td>Numéro</td>
      <td>titre</td>
      <td>ingredients</td>
      <td>preparation</td>
      <td> index</td>
      <td></td>
  </tr>

<?php
 //$uid=$_SESSION["uid"];

 /**$sql="select * from Recettes";
 $arr=$mysql_query("select * from ")
 $i=0;$i<count($Recettes);$i++ */
for($i=0;$i<count($Recettes);$i++){
  /**print_r($Recettes[$i]['titre']);
  echo "</br>";*/
  $arr=$Recettes[$i];
  $index=$arr['index'];
  echo "<tr>
    <td>{$i}</td>
    <td>{$arr['titre']}</td>
    <td>{$arr['ingredients']}</td>
    <td>{$arr['preparation']}</td>
    <td>
      {$index[0]}</td>
    <td> <a href='ajoute.php?ids={$i}'> acheter</a></td>
    </tr>";
}
?>

</body>
</html>