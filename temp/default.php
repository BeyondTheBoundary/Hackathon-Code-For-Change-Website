<?
header('Content-Type: text/html; charset=utf-8');
$host = $_SERVER['HTTP_HOST'];
setlocale(LC_TIME, "en_US");
date_default_timezone_set('UTC');

/*
Directory Listing Script - Version 2
====================================
Script Author: Ash Young <ash@evoluted.net>. www.evoluted.net
Layout: Manny <manny@tenka.co.uk>. www.tenka.co.uk
*/
$startdir = '.';
$showthumbnails = false; 
$showdirs = true;
$forcedownloads = false;
$hide = array(
				'dlf',
				'public_html',				
				'index.php',
				'Thumbs',
				'.htaccess',
				'.htpasswd'
			);
$displayindex = false;
$allowuploads = false;
$overwrite = false;

$indexfiles = array (
				'index.html',
				'index.htm',
				'default.htm',
				'default.html'
			);
			
$filetypes = array (
				'png' => 'jpg.gif',
				'jpeg' => 'jpg.gif',
				'bmp' => 'jpg.gif',
				'jpg' => 'jpg.gif', 
				'gif' => 'gif.gif',
				'zip' => 'archive.png',
				'rar' => 'archive.png',
				'exe' => 'exe.gif',
				'setup' => 'setup.gif',
				'txt' => 'text.png',
				'htm' => 'html.gif',
				'html' => 'html.gif',
				'php' => 'php.gif',				
				'fla' => 'fla.gif',
				'swf' => 'swf.gif',
				'xls' => 'xls.gif',
				'doc' => 'doc.gif',
				'sig' => 'sig.gif',
				'fh10' => 'fh10.gif',
				'pdf' => 'pdf.gif',
				'psd' => 'psd.gif',
				'rm' => 'real.gif',
				'mpg' => 'video.gif',
				'mpeg' => 'video.gif',
				'mov' => 'video2.gif',
				'avi' => 'video.gif',
				'eps' => 'eps.gif',
				'gz' => 'archive.png',
				'asc' => 'sig.gif',
			);
			
error_reporting(0);
if(!function_exists('imagecreatetruecolor')) $showthumbnails = false;
$leadon = $startdir;
if($leadon=='.') $leadon = '';
if((substr($leadon, -1, 1)!='/') && $leadon!='') $leadon = $leadon . '/';
$startdir = $leadon;

if($_GET['dir']) {
	// check this is okay.
	
	if(substr($_GET['dir'], -1, 1)!='/') {
		$_GET['dir'] = $_GET['dir'] . '/';
	}
	
	$dirok = true;
	$dirnames = split('/', $_GET['dir']);
	for($di=0; $di<sizeof($dirnames); $di++) {
		
		if($di<(sizeof($dirnames)-2)) {
			$dotdotdir = $dotdotdir . $dirnames[$di] . '/';
		}
		
		if($dirnames[$di] == '..') {
			$dirok = false;
		}
	}
	
	if(substr($_GET['dir'], 0, 1)=='/') {
		$dirok = false;
	}
	
	if($dirok) {
		 $leadon = $leadon . $_GET['dir'];
	}
}



$opendir = $leadon;
if(!$leadon) $opendir = '.';
if(!file_exists($opendir)) {
	$opendir = '.';
	$leadon = $startdir;
}

clearstatcache();
if ($handle = opendir($opendir)) {
	while (false !== ($file = readdir($handle))) { 
		// first see if this file is required in the listing
		if ($file == "." || $file == "..")  continue;
		$discard = false;
		for($hi=0;$hi<sizeof($hide);$hi++) {
			if(strpos($file, $hide[$hi])!==false) {
				$discard = true;
			}
		}
		
		if($discard) continue;
		if (@filetype($leadon.$file) == "dir") {
			if(!$showdirs) continue;
		
			$n++;
			if($_GET['sort']=="date") {
				$key = @filemtime($leadon.$file) . ".$n";
			}
			else {
				$key = $n;
			}
			$dirs[$key] = $file . "/";
		}
		else {
			$n++;
			if($_GET['sort']=="date") {
				$key = @filemtime($leadon.$file) . ".$n";
			}
			elseif($_GET['sort']=="size") {
				$key = @filesize($leadon.$file) . ".$n";
			}
			else {
				$key = $n;
			}
			$files[$key] = $file;
			
			if($displayindex) {
				if(in_array(strtolower($file), $indexfiles)) {
					header("Location: $file");
					die();
				}
			}
		}
	}
	closedir($handle); 
}

// sort our files
if($_GET['sort']=="date") {
	@ksort($dirs, SORT_NUMERIC);
	@ksort($files, SORT_NUMERIC);
}
elseif($_GET['sort']=="size") {
	@natcasesort($dirs); 
	@ksort($files, SORT_NUMERIC);
}
else {
	@natcasesort($dirs); 
	@natcasesort($files);
}

// order correctly
if($_GET['order']=="desc" && $_GET['sort']!="size") {$dirs = @array_reverse($dirs);}
if($_GET['order']=="desc") {$files = @array_reverse($files);}
$dirs = @array_values($dirs); $files = @array_values($files);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Welcome to <? print $host; ?>! - Hosted by FreeHosting.io</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">


#listingheader {
	color: #476BB3;
	font-weight:bold;
	text-align:right;
	padding-bottom: 20px;
}

#listingheader a, #listingheader a:active, #listingheader a:visited, #listingheader a:link {
	text-decoration: none;
	color: #476BB3;
}

#listingheader a:hover {
	text-decoration: underline;
	color: #476BB3;
}


#headerfile {
	text-align:left;
	float: left;
	width: 320px; 
}

#headersize {
	text-align:right;
	width: 75px;
	float: left;
}


#headermodified {
	text-align:right;
	width: 310px;
	float: left;
}

#listing {
	background-color: #ECE9FF;
	border: 1px solid #AFA7FF;
}

#listing a {
	display:block;
	padding: 2px 5px 2px 5px;
	font-size:small;
	color: #7361DC;
	font-family:Arial, Helvetica, sans-serif;
	text-decoration:none;
	text-align:right;
}

#listing a:hover {
	background-color:#DBE6FE;
}

#listing a img {
	float:left;
	margin-right: 4px;
}



#listing a strong {
	width: 300px;
	float:left;
	cursor:hand;
	cursor:pointer;
	text-align:left;
}

#listing a em {
	float: left;
	width: 75px;
	text-align:right;
	cursor:hand;
	cursor:pointer;
}

#listing a span {
	position: absolute;
	margin-left: -151px;
	margin-top: -2px;
}

#listing a span img {
	width: 150px;
	background-color:#CCCCCC;
	visibility: hidden;	
}

#listing a:hover span img {
	border: 1px solid #666666;
	visibility: visible;
}

#listingcontainer {
	padding-top: 20px;
	padding-bottom: 20px;
	padding-left: 100px;
	padding-right: 100px;
}

.clear {
    display:inline-block;
}

.clear:after {
    content:" ";
    display:block;
    height:0;
    clear:both;
    overflow:hidden;
    visibility:hidden;
}

.clear {
    display:block;
}

body {
    background-color:#f9f9f9;
    font-family:Tahoma,Geneva,Kalimati,sans-serif;
}

img {
    border:none;
}

#content {
    width:963px;
    margin-left:auto;
    margin-right:auto;
    margin-top:90px;
}

#logo {
    top:36px;
    left:55px;
    position:absolute;
    display:block;
    width:auto;
    height:auto;
}

#content .content {
    background:#63B4D2  repeat-y 7px top;
    margin:0;
    position:relative;
    float:left;
    width:961px;
    background-size:99%;
}

h1 {
    font-size:40px;
    text-align:center;
    font-weight:700;
    color:white;
    margin-top:130px;
}

#content p {
    color:#ffffff;
    font-size:15px;
    padding:0 69px;
}

#files .top {
    background:transparent url('http://cdn.freehosting.io/cpanel/welcome/corners-top.png') no-repeat top left;
    width:961px;
    height:6px;
    position:relative;
    float:left;
}

#files .bottom {
    background:transparent url('http://cdn.freehosting.io/cpanel/welcome/corners-bottom.png') no-repeat top left;
    width:961px;
    height:5px;
    position:relative;
    float:left;
}

#files .cont {
    background:transparent url('http://cdn.freehosting.io/cpanel/welcome/bg.png') repeat top left;
    width:961px;
    height:auto;
    position:relative;
    float:left;
}

ul.list {
    margin:26px 190px;
    padding:5px;
    list-style:none;
    display:block;
    background-color:#ece9ff;
    border:1px solid #afa7ff;
    font-size:14px;
    color:#7361dc;
    height:auto;
}

ul.list li .filesize,
ul.list li .datetime {
    float:right;
}

ul.list li .filesize {
    font-style:italic;
    margin-right:28px;
}

#files {
    margin-bottom:20px;
    height:auto;
}

#footer {
    clear:both;
    font-size:11px;
    color:#999999;
    width:961px;
    margin-left:auto;
    margin-right:auto;
    margin-top:25px;
    margin-bottom:20px;
    position:relative;
}

#footer .links a {
    color:#999999;
}

#footer .links {
    text-align:center;
}

#footer .links .pipe {
    color:#cccccc;
}

#footer .copyright {
    color:#6b6b6b;
    text-align:center;
    margin-top:6px;
}
        
        </style>
    </head>
    <body>
        <div id="main">
            <div id="content">
                <div class="content">
					<a id="logo" href="http://www.freehosting.io/"><img src="http://cdn.freehosting.io/images/logo-white.png" alt="Web hosting" width="291" height="71" /></a>
                    <h1>Your account has been created!</h1>
                    <p>Your website <b><? print $host; ?></b> has been successfully installed on the server! Please delete the file <b>default.php</b> from the <b>public_html</b> folder and then upload your website by using FTP or a File Manager.</p>
                    <p>Here is a list of files in your public_html folder:</p>
                    <div id="files">
                        <div class="top"></div>
                        <div class="cont">

                            <div id="listingcontainer">
                                <div id="listing">
                                <?
                                $class = 'b';
                                if($dirok) {
                                ?>
                                  <div><a href="<?=$dotdotdir;?>" class="<?=$class;?>"><img src="http://cdn.freehosting.io/cpanel/welcome/dirup.png" alt="Folder" /><strong>..</strong> <em>-</em><? $mtime = filemtime($dotdotdir); $mtime = date("m/d/Y H:i:s", $mtime); $mtime = strftime("%B %e, %G %T", strtotime($mtime)); print ucfirst($mtime); ?></a></div>
                                <?
                                    if($class=='b') $class='w';
                                    else $class = 'b';
                                }
                                $arsize = sizeof($dirs);
                                for($i=0;$i<$arsize;$i++) {
                                ?>
                                  <div><a href="<?=$leadon.$dirs[$i];?>" class="<?=$class;?>"><img src="http://cdn.freehosting.io/cpanel/welcome/folder.png" alt="<?=$dirs[$i];?>" /><strong><?=$dirs[$i];?></strong> <em>-</em><? $mtime = filemtime($leadon.$dirs[$i]); $mtime = date("m/d/Y H:i:s", $mtime); $mtime = strftime("%B %e, %G %T", strtotime($mtime)); print ucfirst($mtime); ?></a></div>
                                <?
                                    if($class=='b') $class='w';
                                    else $class = 'b';	
                                }
                                
                                $arsize = sizeof($files);
                                for($i=0;$i<$arsize;$i++) {
                                    $icon = 'unknown.png';
                                    $ext = strtolower(substr($files[$i], strrpos($files[$i], '.')+1));
                                    $supportedimages = array('gif', 'png', 'jpeg', 'jpg');
                                    $thumb = '';
                                            
                                    if($filetypes[$ext]) {
                                        $icon = $filetypes[$ext];
                                    }
                                    
                                    $filename = $files[$i];
                                    if(strlen($filename)>43) {
                                        $filename = substr($files[$i], 0, 40) . '...';
                                    }
                                    
                                    $fileurl = $leadon . $files[$i];
                                ?>
                                  <div><a href="<?=$fileurl;?>" class="<?=$class;?>"<?=$thumb2;?>><img src="http://cpanel.main-hosting.com/images/index/<?=$icon;?>" alt="<?=$files[$i];?>" /><strong><?=$filename;?></strong><em><?=round(filesize($leadon.$files[$i])/1024);?> KB</em><? $mtime = filemtime($leadon.$files[$i]); $mtime = date("m/d/Y H:i:s", $mtime); $mtime = strftime("%B %e, %G %T", strtotime($mtime)); print ucfirst($mtime); ?><?=$thumb;?></a></div>
                                <?
                                    if($class=='b') $class='w';
                                    else $class = 'b';	
                                }	
                                ?>
                                </div>
                            </div>

                        </div>
                        <div class="bottom"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div id="footer">
                <div class="links">
                    <a href="http://www.freehosting.io/" target="_blank">Free Hosting</a> 
                    <span class="pipe">|</span> 
                    <a href="http://cpanel.freehosting.io/" target="_blank">Client Area</a>
                    <span class="pipe">|</span> 
                    <a href="http://www.facebook.com/pages/FreeHostingio/1418756735007977?ref=hl" target="_blank">Find FreeHosting.io on Facebook</a>
                </div>
                <div class="copyright">Copyright &copy; FreeHosting.io <? print date('Y'); ?>. All rights reserved</div>
            </div>
        </div>
    </body>
</html>

<!--DEFAULT_WELCOME_PAGE-->
