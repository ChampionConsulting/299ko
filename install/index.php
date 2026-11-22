<?php
/**
 * This file is part of True Loaded.
 *
 * @link http://www.holbi.co.uk
 * @copyright Copyright (c) 2005 Holbi Group LTD
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

error_reporting(0);
ini_set("display_errors", 0);

define('SETUP_PACKAGE', 'application_do_not_unzip.zip');
define('INSTALL_ROOT', dirname(__FILE__));

define('INSTALL_DIR', (strlen($_POST['install_dir']) && valid_folder($_POST['install_dir'])) ? '/' . ltrim(rtrim($_POST['install_dir'], "\\/") . '/', "\\/") : '/');
define('INSTALL_PATH', INSTALL_ROOT . INSTALL_DIR);

if (!isset($_GET['step'])) {
    $content = step1();
} else {
    if (function_exists($_GET['step'])) {
        $function = $_GET['step'];
        $content = $function();
    }
}

function step1() {
    $phpcheckdata = checkParams();
    if (!do_match_absreq()) {
        $content .='<div style="margin-top: 10px; padding: 0pt 0.7em;" class="ui-state-error ui-corner-all">
                        <p>Your Server does not fulfill the requirements needed to unpack the Installation Package. Please unpack the File "' . SETUP_PACKAGE . '" on your local computer and upload it via FTP. After that, open the file "index.php" of the Site Root-Folder in your Browser.</p>
                    </div>';
    }
    $content .= '
		<table class="tableWrap" style="border-collapse: collapse; width: 100%">
                    <thead class="ui-state-default">
                    <tr>
                        <th width="54%">Name</th>
                        <th width="19%">Installed</th>
                        <th width="19%">Required</th>
                        <th width="6%"></th>
                    </tr>
                    </thead>
                    <tbody>';
    $okicon = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAANCAYAAACgu+4kAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RUFERTlDMjk0NkM2MTFFN0E5QkNFNTdFQzlBQTc2QTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RUFERTlDMkE0NkM2MTFFN0E5QkNFNTdFQzlBQTc2QTYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpFQURFOUMyNzQ2QzYxMUU3QTlCQ0U1N0VDOUFBNzZBNiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpFQURFOUMyODQ2QzYxMUU3QTlCQ0U1N0VDOUFBNzZBNiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PsMZOJsAAACrSURBVHjaYvj//z8DqVhks7YgjM3EQCIQ3aKzCki9A9LlID4jyBQSNYciCaUTbQAWzSBwFmwAUFIQyEkD4lmvfa68J1IzSJ0JIyhAgIwzQKwExPdAgsiG4NMMVHcPFIi7oZoZoPQZqIsIagZxWKACyABmyFlCmkEA5IIwIN6DxRCCmsEGQP2LzRCCmmEuYCBgCE7NcAPwGIJXM9aUCI2BVdBwcMWnGQQAAgwA/06Kt9+Gd/wAAAAASUVORK5CYII=";
    $failicon = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAANCAYAAABy6+R8AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MENCODFEM0I0NkM3MTFFN0I1QTdGOUE4MkM5MDc4MEQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MENCODFEM0M0NkM3MTFFN0I1QTdGOUE4MkM5MDc4MEQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDowQ0I4MUQzOTQ2QzcxMUU3QjVBN0Y5QTgyQzkwNzgwRCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDowQ0I4MUQzQTQ2QzcxMUU3QjVBN0Y5QTgyQzkwNzgwRCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pj5wCcsAAADJSURBVHjahJLREYMgDIbR6wI6Qc9ZeNABZBU6go7QFdoBfLCr9NoJygj0D5d4OYo2dzFA/Ej4wcQYDfmr7zsZ557nagN7D8MN4Yk4mcyw5jm3whtaqzG4Io78j9cgAzK3cNrcVCj9QWyyAjM8KEBbe8LH8Q4a9KZs7rwsoaKDoQ1bAEvAPbVHEPdP4PoPSEKoxFGVTk+kvVGUObALqs2i3h4QCtUTuCe5Y6gkTlvznfwcGv5Q8HZ/JLm8LU8VqdXCu7Ocm2TtK8AAq/CN1aFVwHcAAAAASUVORK5CYII=";
    foreach ($phpcheckdata as $fname => $fdata) {
        if (isset($fdata['adviced_fail'])) {
            $passfail_color = ($fdata['adviced_fail']) ? 'neutral' : (($fdata['passfail']) ? 'positive' : 'negative');
            $passfail_icon = ($fdata['adviced_fail']) ? 'style/warn.png' : (($fdata['passfail']) ? $okicon : $failicon);
        } else {
            $passfail_color = ($fdata['passfail']) ? 'positive' : 'negative';
            $passfail_icon = (($fdata['passfail']) ? $okicon : $failicon);
        }
        $content .= '<tr>
                        <td>' . $fdata['name'] . '</td>
                        <td class="' . $passfail_color . '">' . $fdata['installed'] . '</td>
                        <td class="positive">' . $fdata['required'] . '</td>
                        <td><img src="' . $passfail_icon . '" alt="passfail" /></td>
                    </tr>';
    }
    $content .='</tbody>
                </table>
                <br />
                <table width="100%" border="0" cellspacing="1" cellpadding="2">
                    <tr>
                        <td align="right" style="background: #fff8eb; vertical-align: middle;">
						<span style="font-weight: 500;">
						Destination Folder<span><br/>
						<span style="font-weight: 300;">(select destination folder)<span></td>
                        <td style="background: #fff8eb;">
						<input type="text" name="install_dir" size="25" value="' . INSTALL_DIR . '" class="input" style="width: 95%;" /></td>
                    </tr>
		</table>';
    $button = (do_match_req()) ? 'Next' : 'Check again';
    $next_step = (do_match_req()) ? 'step2' : 'step1';
    return array('content' => $content, 'button' => $button, 'next_step' => $next_step);
}

function checkParams() {
    return array(
        'php' => array(
            'name' => 'PHP-Version',
            'required' => '8.1.0+',
            'installed' => phpversion(),
            'passfail' => (phpversion() >= '8.1.0') ? true : false,
        ),
        'zLib' => array(
            'name' => 'Zip-Functions',
            'required' => 'Yes',
            'installed' => (function_exists('zip_open')) ? 'Yes' : 'No',
            'passfail' => (function_exists('zip_open')) ? true : false,
        ),
        'setupfile' => array(
            'name' => 'Setup-Package',
            'required' => 'Yes',
            'installed' => (file_exists(SETUP_PACKAGE)) ? 'Yes' : 'No',
            'passfail' => (file_exists(SETUP_PACKAGE)) ? true : false,
            'ignore_asb' => true,
        ),
        'writable' => array(
            'name' => 'Directory Writable',
            'required' => 'Yes',
            'installed' => (checkWritable()) ? 'Yes' : 'No',
            'passfail' => (checkWritable()) ? true : false,
            'ignore_asb' => true,
        ),
    );
}

function do_match_req() {
    $allmatched_req = true;
    foreach (checkParams() as $fname => $fdata) {
        $allmatched_req = ($fdata['passfail'] || $fdata['ignore']) ? $allmatched_req : false;
    }
    return $allmatched_req;
}

function do_match_absreq() {
    $allmatched_req = true;
    foreach (checkParams() as $fname => $fdata) {
        $allmatched_req = ($fdata['passfail'] || $fdata['ignore_asb']) ? $allmatched_req : false;
    }
    return $allmatched_req;
}

function checkWritable() {
    $folder = INSTALL_ROOT . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR;
    @mkdir($folder, 0755);
    @chmod($folder, 0755);
    if (@file_exists($folder)) {
        if (!( $f = @fopen($folder . 'tmp.php', 'wb'))) {
            return false;
        }
        @fwrite($f, 'Trueloaded');
        @fclose($f);
        if (!@file_exists($folder . 'tmp.php') || (@file_get_contents($folder . 'tmp.php') != "Trueloaded")) {
            return false;
        }
        @unlink($folder . 'tmp.php');
        if (@file_exists($folder . 'tmp.php')) {
            return false;
        }
        @rmdir($folder);
        return true;
    } else {
        return false;
    }
}

function valid_folder($path) {
    $ignore = array('.', '..', '.svn', 'CVS', 'cache', 'install', 'index.html', '.htaccess', '_images', 'libraries.php');
    if (isset($path)) {
        if (!in_array(basename($path), $ignore) && !is_file($path) && !@is_link($path)) {
            return true;
        }
    }
    return false;
}

function step2() {
    $loadingicon = '';
    $content = '<br /><img src="' . $loadingicon . '" style="vertical-align:middle;"/> Unpacking ...';
    $js = '$(document).ready(function(){
	    $("#submit_button").attr( "disabled", "disabled" );
		$.post("?step=ajax_unpack", { install_dir: "' . INSTALL_DIR . '"},
  	        function(data) {
			    if (data == "true"){
				    $("#submit_button").removeAttr("disabled");
				    window.location.href = ".' . INSTALL_DIR . 'install/";
                } else {
                    $("#content").html(\'<p style="color: red">\' + data);
                }
		    });
		});
	';
    return array('content' => $content/*, 'button' => 'Install'*/, 'next_step' => '', 'js' => $js);
}

function _symlink( $target, $link ) {
  if ($_SERVER['WINDIR'] || $_SERVER['windir']) {
    exec('junction "' . $link . '" "' . $target . '"');
  } else {
    symlink($target,$link);
  }
}

function ajax_unpack() {
    try {
        // fix for windows: unlink works but unzipping index.php fails
        $fnIndex = INSTALL_ROOT . '/index.php';
        $fnIndexNew = INSTALL_ROOT . '/index_old.php';
        if (rename($fnIndex, $fnIndexNew)) {
            $fnIndex = $fnIndexNew;
        }
        @unlink($fnIndex);
        extractZip(INSTALL_ROOT . DIRECTORY_SEPARATOR . SETUP_PACKAGE);
        echo "true";
        @unlink(INSTALL_ROOT . DIRECTORY_SEPARATOR . SETUP_PACKAGE);
    } catch (\Exception $e) {
        error_log('!!! ' .$e->getMessage() );
        echo $e->getMessage();
    }
    die();
}

function getLastError() {
    $lastError = error_get_last();
    return !empty($lastError['message']) ? $lastError['message'] : 'unknown reason';
}

function errorClear() {
    if (PHP_VERSION_ID >= 70000) error_clear_last();
}

function extractZip($zipFile = '', $dirFromZip = '') {
    @set_time_limit(0);
    $zipDir = INSTALL_PATH . $dirFromZip;
    $zip = zip_open($zipFile);
    if ($zip) {
        while ($zip_entry = zip_read($zip)) {
            $completePath = $zipDir . dirname(zip_entry_name($zip_entry));
            $completeName = $zipDir . zip_entry_name($zip_entry);
            if (!file_exists($completePath) && preg_match('#^' . $dirFromZip . '.*#', dirname(zip_entry_name($zip_entry)))) {
                $tmp = '';
                foreach (explode('/', $completePath) AS $k) {
                    $tmp .= $k . '/';
                    if (!file_exists($tmp)) {
                        if (PHP_VERSION_ID >= 70000) error_clear_last();
                        if (!mkdir($tmp, 0755) && !is_dir($tmp)) {
                            throw new \Exception("Can not create folder '$tmp': " . getLastError());
                        }
                    }
                }
            }
            if (zip_entry_open($zip, $zip_entry, "r")) {
                if (preg_match('#^' . $dirFromZip . '.*#', dirname(zip_entry_name($zip_entry)))) {
                    if ($fd = @fopen($completeName, 'w+')) {
                        $zip_entry_size = zip_entry_filesize($zip_entry);
                        $entry = zip_entry_read($zip_entry, $zip_entry_size);
                        errorClear();
                        $written = fwrite($fd, $entry);
                        if ($zip_entry_size !== $written) {
                            throw new \Exception("Error while writing file '$completeName' (written $written bytes of $zip_entry_size): " . getLastError());
                        }
                        fclose($fd);
                    } else {
                        errorClear();
                        if (!mkdir($completeName, 0755) && !is_dir($completeName) && substr($completeName, -1) == '/') {
                            throw new \Exception("Can not create folder '$completeName': " . getLastError());
                        }
                    }
                    zip_entry_close($zip_entry);
                }
            }
        }
        zip_close($zip);
    }
    return true;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" media="screen" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/base/jquery-ui.css" />
        <script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
        <style type="text/css">
            @import url('//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700');

            body {
                font-family: 'Montserrat';
                background: #ffffff;
                font-size: 12px;
                color: #333;
                padding:0;
                margin:0;
            }
            #header {
                margin: 0 auto;
                max-width: 820px;
                width: 100%;
            }
            #logo {
                background-image: url('logo.png');
                background-repeat: no-repeat;
                height: 100px;
                width:470px;
                margin: 50px auto 10px;
            }
            #logotext{
              color: #333;
              font-size: 16px;
              margin: -33px 0 15px;
            }
            #languageselect{
                float: right;
                width: 300px;
                margin-top: 14px;
                padding-right: 20px;
                text-align:right;
                color: white;
            }
            #installer{
                background-color: #ffffff;
                margin: 0 auto;
                width: 950px;
                border: 1px solid #ececec;
                -webkit-box-shadow: 0px 1px 1px 0px rgba(214, 214, 214, 0.35);
                -moz-box-shadow: 0px 1px 1px 0px rgba(214, 214, 214, 0.35);
                box-shadow: 0px 1px 1px 0px rgba(214, 214, 214, 0.35);
            }
            #main{
                font-size: 12px;
            }
            #steps, #content{
                padding:20px;
            }

            #footer {
                clear: right;
                color: #ccc;
                font-size: 12px;
                padding: 20px 0;
                text-align: center;
            }
            #footer a{
                color: #ccc;
                text-decoration: none;
            }
            #footer a:hover{
                text-decoration: underline;
            }
            .install_label {
                position: absolute;
                width: 90%;
                text-align: center;
                line-height: 1.9em;
                left:5%;
                right:5%;
            }
            select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
                border-radius: 2px 2px 2px 2px;
                color: #555555;
                font-size: 13px;
                line-height: 20px;
                padding: 4px 6px;
                vertical-align: middle;
                background-color: #FFFFFF;
                border: 1px solid #CCCCCC;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
                transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;
                margin: 3px;
            }
            select:focus, textarea:focus, input:focus {
                border-color: rgba(82, 168, 236, 0.8);
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(82, 168, 236, 0.6);
                outline: 0 none;
            }
            input[type=radio], input[type=checkbox]{
                background:none;
                border: none;
            }
            h1 {
                font-size: 24px;
                color: #3c3b3b;
                text-align: center;
                font-weight: 500;
                padding: 0;
                margin: 0 0 15px;
                font-weight: 500;
            }
            .buttonbar{
                margin: 15px 10px 0px 0px;
                text-align: center;
            }
            .positive{
                color: #665cac!important;
                font-weight: 500;
                font-size: 14px;
            }
            .negative{
                color: #e11010!important;
                font-weight: bold;
                font-weight: 500;
                font-size: 14px;
            }
            .neutral{
                color: orange;
                font-weight: bold;
            }
            th, td {
                padding: 0.25em 0.5em;

            }
            th{
                font-size: 12px;
                text-align: left;
                font-weight: bold;
            }
            td{
                font-size: 13px;
            }
            .ui-widget-content tr.ui-state-highlight{
                border:0;
            }
            .subname{
                font-weight: normal;
                font-size: 10px;
                font-style: italic;
            }
            .button, input[type="submit"], input[type="button"], input[type="reset"], button{
                display: inline-block;
                zoom: 1; /* zoom and *display = ie7 hack for display:inline-block */
                *display: inline;
                vertical-align: baseline;
                margin: 0 2px;
                outline: none;
                cursor: pointer !important;
                text-align: center;
                text-decoration: none;
                font-size: 14px;
                padding: 5px 5px;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
            }
            .button:hover, input[type="submit"]:hover, input[type="button"]:hover , input[type="reset"]:hover, button:hover{
                text-decoration: none;
            }
            .button:active, input[type="submit"]:active, input[type="button"]:active, input[type="reset"]:active, button:active{
                position: relative;
            }
            .bigrounded {
                -webkit-border-radius: 2em;
                -moz-border-radius: 2em;
                border-radius: 2em;
            }
            .medium, .button, input[type="submit"], input[type="button"],input[type="reset"], button {
                font-size: 14px;
                font-weight: 500;
                padding: 9px 35px;
            }
            .small {
                font-size: 11px;
            }
            a.blue, a.blue:hover, a.button, a.button:hover {
                color: #d9eef7;
                line-height: 15px;
            }
            .blue, .button, input[type="submit"], input[type="button"], input[type="reset"], button {
                  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #9E9E9E), color-stop(1, #9E9E9E)); 
				  background:-moz-linear-gradient(top, #9E9E9E 10%, #9E9E9E 100%); 
				  background:-webkit-linear-gradient(top, #9E9E9E 10%, #9E9E9E 100%);
				  background:-o-linear-gradient(top, #9E9E9E 10%, #9E9E9E 100%);   
				  background:-ms-linear-gradient(top, #9E9E9E 10%, #9E9E9E 100%); 
				  background:linear-gradient(to bottom, #9E9E9E 10%, #9E9E9E 100%); 
				  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#9E9E9E', endColorstr='#9E9E9E',GradientType=0);
				  background-color:#9E9E9E; 
				  -moz-border-radius: 10px;    
				  -webkit-border-radius: 10px; 
				  border-radius: 10px;        
				  display:inline-block;      
				  cursor:pointer;          
				  color: #FFFFFF;
                  font-weight: 700;
            }
            .blue:hover, .button:hover, input[type="submit"]:hover, input[type="button"]:hover, input[type="reset"]:hover, button:not(.ui-widget):hover {
                color: #fff;
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #4F93E0), color-stop(1, #4F93E0));
				background:-moz-linear-gradient(top, #4F93E0 15%, #4F93E0 100%); 
				background:-webkit-linear-gradient(top, #4F93E0 15%, #4F93E0 100%);
				background:-o-linear-gradient(top, #4F93E0 15%, #4F93E0 100%); 
				background:-ms-linear-gradient(top, #4F93E0 15%, #4F93E0 100%);
				background:linear-gradient(to bottom, #4F93E0 15%, #4F93E0 100%); 
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#4F93E0', endColorstr='#4F93E0',GradientType=0); 
				background-color:#4F93E0;
            }
            .blue:active, .button:hover, input[type="submit"]:active, input[type="button"]:active, input[type="reset"]:active, button:not(.ui-widget):active {
                color: #fff;
                background: rgb(144,154,169);
                background: -moz-linear-gradient(top, rgba(144,154,169,1) 0%, rgba(128,140,156,1) 100%);
                background: -webkit-linear-gradient(top, rgba(144,154,169,1) 0%,rgba(128,140,156,1) 100%);
                background: linear-gradient(to bottom, rgba(144,154,169,1) 0%,rgba(128,140,156,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#909aa9', endColorstr='#808c9c',GradientType=0 );
            }
            #installer table, .debug table {
                border-collapse:collapse;
            }
            #installer th, .debug th{
                font-weight: 400;
                white-space:nowrap;
                text-align:left;
                background: #fff;
            }
            #installer table.no-borders td {
                border: none !important;
            }
            .tableWrap .ui-state-default{
                border-width: 0 0 1px;
                border-bottom: 1px solid #e2e0e0;
            }
            #installer .tableWrap .ui-state-default th{
                color: #858686;
            }
            #installer th, #installer td, .debug th, .debug td {
                line-height: 20px;
                padding: 7px 15px;
                text-align: left;
                vertical-align: top;
                color: #3c3b3b;
                font-weight: 400;
            }
            #installer tr:nth-child(even) td{
                background: #f5f5f5;
            }
            #installer .tableWrap .ui-state-default th:nth-child(3), #installer .tableWrap td:nth-child(3){
                font-weight: 500;
            }
        </style>

        <script type="text/javascript">
            //<![CDATA[
            $(function () {

                $("#progressbar").progressbar({
                    value: 0,
                });
            });

<?php if (isset($content['js'])) echo $content['js']; ?>
            //]]>
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Champion CMS Installation</title>
    </head>

    <body>
        <form action="?step=<?php echo $content['next_step']; ?>" method="post" id="form_install">
            <div id="header">
                <div id="logo"></div>
                <div id="logotext">Zip-Installer<br/>Champion v0.2.2</div>
            </div>
            <div id="installer">
                <div id="main">
                    <div id="content">

                        <h1 class="hicon home">Unpacking Installation Files</h1> 
						<?php echo $content['content']; 
						if (isset($content['button'])) {
						?>
                        <div class="buttonbar">
                            <input id="submit_button" type="submit" class="blue" name="next" value="<?php echo $content['button']; ?>" />
                        </div> 
						<?php  
						}  
					?>
                    </div>
                </div>
            </div>
            <div id="footer">
                Copyright &copy; 1995 - <?php echo date('Y', time()); ?> <a target="_blank" href="http://www.championconsulting.com">
				Champion Consulting </a> is provided under <a href="https://www.championconsulting.com/legal" target="_blank">Terms and Conditions</a> 
				and this <a href="https://www.championconsulting.com/legal" target="_blank">Disclaimer</a>
				<br>Champion CMS the Content Management Engine Copyright © 1995 – 2026 Champion Consulting, LLC<br>Champion CMS is a Trademark owned by Champion Consulting, LLC.
            </div>
        </form>
    </body>
</html>
