<?php
$Whosts = 'C:\Windows\System32\drivers\etc\hosts';
$Thosts = '127.0.0.2   power.off'; 

//checando se já está no hosts
$l = file($Whosts);

if(end($l) != $Thosts) {
	if(!is_writable($Whosts)) exit("\n\nNao consegui registrar o HOST do servidor - pode ser um prolbema de PERMISSAO!!\nPor favor localize o arquivo 'hosts' (normalmente em: ".$Whosts.") \nAcrescente a linha abaixo no final do arquivo: \n\n    ".$Thosts."\n\nDepois volte a rodar este script.\n\n");
	file_put_contents($Whosts, "\n".$Thosts, FILE_APPEND);
}

if(!file_exists(getcwd().'/index.php'))
	file_put_contents(getcwd().'/index.php', '<?php include \'phar://power.phar/index.php\';');

//get default Browser
exec('explorer http://power.off');

//start server
exec('cd '.dirname(__DIR__).' & php -S power.off:80');