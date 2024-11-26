<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');

echo('<div class=\'bg-primary-subtle\'>');

include $root . '/app/view/fragment/fragmentMenu.php';
include $root . '/app/view/fragment/fragmentJumbotron.html';


$results=$specialites;
$title="Liste des spécialités";
require($root.'/app/view/Administrateur/Table.php');

$results=$praticiens;
$title="Liste des praticiens";
require($root.'/app/view/Administrateur/Table.php');

$results=$patients;
$title="Liste des patients";
require($root.'/app/view/Administrateur/Table.php');

$results=$admins;
$title="Liste des admins";
require($root.'/app/view/Administrateur/Table.php');

$results=$rdvs;
$title="Liste de tous les rendez-vous";
require($root.'/app/view/Administrateur/Table.php');

include $root . '/app/view/fragment/fragmentFooter.html';

echo('</div>');



?>