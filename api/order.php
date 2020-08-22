<?php
include_once "../base.php";
$_POST['qt']=count($_POST['seat']);
$_POST['seat']=serialize($_POST['seat']);
$_POST['no']=$Ord->q("SELECT MAX(no) from ord")[0][0]+1;
$Ord->save($_POST);
echo $_POST['no'];