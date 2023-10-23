<?php
  include 'connexion.php';
  header('location:index0.php');
  $id=$_GET['id'];
  $change=$conn->prepare("UPDATE todo SET checked=1 WHERE id=?");
  $change->execute(array($id));
  
?>
