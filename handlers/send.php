<?php
	require_once "lib/class_RequireFiles.php";
	$allreq = new RequireFiles();
	$allreq->TakeRequireFilesTree();
	$l = $_POST['l'];
	$p = md5($_POST['p']);
	$la = md5($l."pg");
	$e = $_POST['e'];
	$table = 'account_data';
	$cell = array('login','psw_hash','email','label');
	$data = array($l,$p,$e,$la);
	$db = new DB();
	//print_r($data);
	$db->InsertData($table,$data,$cell,"registration");
?>