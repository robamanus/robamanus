<?php
	require_once "lib/class_RequireFiles.php";
	$allreq = new RequireFiles();
	$allreq->TakeRequireFilesTree();
	$l = $_POST['l'];
	$p = md5($_POST['p']);
	$cpu = new Processor();
	$cpu->Login($l,$p);
?>