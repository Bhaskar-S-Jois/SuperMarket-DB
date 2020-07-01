<?php
$dir    = '/opt/lampp/htdocs';
$files1 = scandir($dir);

$fdScan = fopen("logScan.txt","w");
$fdrScan = fopen("logScan.txt","r");
file_put_contents("logScan.txt", print_r($files1,true));
while(fscanf($fdrScan, "%s %s %s",$s1,$s2,$s))
{
	//list($li) = $s;
	echo $s . " ";
}
?>