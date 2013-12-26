<?php
ob_start();
define('INITIME', microtime());
define('PATH', __DIR__.'/');
define('VIEW', PATH.'view/');
define('VIEWTMP', getcwd().'/');
define('PLAT', php_sapi_name());

//checando ORIGEM do script
if(PLAT == 'cli') {
	include 'install.php';
	exit('cli executado.');
}

define('URL', 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']);

if(strpos($_SERVER['PATH_INFO'], 'style') !== false 
	|| strpos($_SERVER['PATH_INFO'], 'script') !== false) 
		download(dirname(__DIR__).$_SERVER['PATH_INFO']);


//Mini Cache
//$cfile = VIEWTMP.'temp.cache.html';
//if(!incache($cfile)){
	include VIEW.'head.html';
	include VIEW.'splash.php';
	include VIEW.'footer.html';
//} 
//cache($cfile);


//-- --- -- - 
//verifique se o cache existe e se está ativo (não precisa de renovação)
function incache($file, $time = 5){
	return (file_exists($file) && (time() - filemtime($file)) < $time) ? true : false;
}
//gera a saída direta ou pelo cache
function cache($file, $time = 5, $cache = true){
	if($cache && incache($file, $time)){
		ob_get_clean();
    	$content = file_get_contents($file).'<p class="status">in cache: '.date('d/m/Y | H:i:s', filemtime($file)).' | ';
    } else {
    	$content = ob_get_clean();
    	file_put_contents($file, $content);
    	$content .= '<p class="status">';
    }
	
	$t = explode(' ',microtime());
    $i = explode(' ', INITIME);
	echo $content.'time: '.number_format((($t[0] * 1000)-$i[0] * 1000),1,',','.').' ms</p>';
}

//Faz download de arquivos ...
function download($path){
    //procurando o mime type
    include PATH.'mimes.php';
    $ext = explode('.', $path);
    $ext = end($ext);
    if (!isset($_mimes[$ext])) $mime = 'text/plain';
    else $mime = (is_array($_mimes[$ext])) ? $_mimes[$ext][0] : $_mimes[$ext];
    //pegando o arquivo
    if($ext == 'css') $dt = preg_replace("#/\*[^*]*\*+(?:[^/*][^*]*\*+)*/#","",preg_replace('<\s*([@{}:;,]|\)\s|\s\()\s*>S','\1',str_replace(array("\n","\r","\t"),'',file_get_contents($path)))).'xxx';
    elseif($ext == 'js') $dt = preg_replace("/^\s/m",'',str_replace("\t",'',file_get_contents($path)));
    else $dt = file_get_contents($path);
    //enviando
    ob_end_clean();
    ob_start('ob_gzhandler');

    header('Vary: Accept-Language, Accept-Encoding');
    header('Content-Type: ' . $mime);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
    header('Cache-Control: must_revalidate, public, max-age=31536000');
    header('Content-Length: ' . strlen($dt));
    header('x-Server: nfw/RunPHP');
    header('ETAG: '.md5($path));
    //saindo...
    exit($dt);
}