<?php
require_once 'api.php';

$action= $_GET['action'];

if ($action =='create') {
	$tache= $_POST['tache'];
	

		$tododb->create($tache);
		$_SESSION['error']='tache crée avec succes';
	}


if ($action =='update') {
	$idtodo=$_POST['idtodo'];
	$tache= $_POST['tache'];
	

	$tododb->update($tache);
		$_SESSION['error']='tache modifié avec succes';
		
	}


if ($action =='delete') {
	$idclient= $_GET['idtodo'];

	$tododb->delete($idtodo);
		$_SESSION['error']='tache supprimé avec succes';
		
	}
?>