<?php

// this file generates the page and the header menus
// $folderConfig is an "associative" array of "associative" arrays

// NOTE
// you can make the drop down menus flush "right" below their parent by adding the classes "dropdown-menu dropwdown-menu-right" to the parent
// the default is flush left using just dropdown-menu

$path = $_GET['path'] ?? NULL;
$pathParts = pathinfo($_SERVER['PHP_SELF']);
$callingFolderPath = $pathParts['dirname']; // /aspengroup/empireresidences or production = sommetblanc/residences

if ($_SERVER['SERVER_ADDR'] == "::1") {
	$root = "//localhost/aspengroup.online";
	define("ROOT", $root);
	$bareRoot =  "//localhost";
	define("BARE_ROOT", $bareRoot);
	$documentRoot = $_SERVER['DOCUMENT_ROOT'] . "/aspengroup.online"; 
	define("DOCUMENT_ROOT",$documentRoot); // local file system root: /Users/lpadan/Software/aspengroup
} else {
	$root = "https://aspengroup.online";
	define("ROOT", $root);
	$bareRoot = "https://aspengroup.online";
	define("BARE_ROOT", $bareRoot);
	$documentRoot = $_SERVER['DOCUMENT_ROOT'];
	define("DOCUMENT_ROOT",$documentRoot); // webserver file system root: public_html
}


$customConfig['folderConfig'] = $folderConfig;
$folderConfig = json_encode($folderConfig);

function fromCamelCase($camelCaseString) {
    $re = '/(?<=[a-z])(?=[A-Z])/x';
    $a = preg_split($re, $camelCaseString);
    //return ucfirst(join($a, " " ));
    return ucfirst(implode(" ",$a));
}

function fromUnderscoreCase($string) {
	$string = str_replace('_',' ',$string);
	return ucwords($string);
}

function getFolderDepth($path) {
	global $folderDepth;
	$folders = glob($path . "/*",GLOB_ONLYDIR);
	if (!count($folders)) {
		return;
	}
	$folderName = substr($folders[0], strrpos($folders[0], '/') + 1);
	$path .= "/" . $folderName;
	$folderDepth ++; 
	getFolderDepth($path);
}

?>

<div style="padding:0 3%;margin:10px 0">
    <nav class="navbar navbar-expand-lg scrolling-navbar navbar-dark" style="width:100%;background-color:#2bbbad!important;padding-left:10px!important">
        <h2 style="color:white;margin:0 30px 0 10px"><?php echo $title;?></h2>
            
            <ul class="nav navbar-nav nav-flex-icons" style="color:white">

                <?php

					$rootFolders = glob("*",GLOB_ONLYDIR);
					
					// sort $rootFolders asphabetically, otherwise DRB will come before architectural
					usort($rootFolders, function ($a,$b) {
						return strcmp(strtolower($a), strtolower($b));
					});
					
					$html = '';

					foreach($rootFolders as $rootFolder) { // top level menu items				

						$subFolders = glob($rootFolder . "/*", GLOB_ONLYDIR);
						$menuFlag = false;
						$ul = false;

						foreach ($subFolders as $subFolder) { // sub menu items  e.g. applications
		
							// NOTE: folderDepth = the number of folders below AND including the subFolder
							$folderDepth = 1;
							getFolderDepth($subFolder);
							
							$tabs = true;
							$subSubFolder = glob($subFolder . "/*", GLOB_ONLYDIR);

							if (sizeof($subSubFolder)) {
																					
								if ($folderDepth == 2) { // strip image folder from end of path
									$index = strrpos($subSubFolder[0],'/');
									$subSubFolder[0] = substr($subSubFolder[0],0,$index);
								} 

								if (array_key_exists($subSubFolder[0],$customConfig['folderConfig'])) {
									if(array_key_exists('tabs', $customConfig['folderConfig'][$subSubFolder[0]])) { 
										$tabs = $customConfig['folderConfig'][$subSubFolder[0]]['tabs'];
									}
								} 

							} else {
								if (array_key_exists($subFolder,$customConfig['folderConfig'])) {
									if(array_key_exists('tabs', $customConfig['folderConfig'][$subFolder])) { 
										$tabs = $customConfig['folderConfig'][$subFolder]['tabs'];
									}
								} 
							}

							if ($folderDepth == 1 || ($folderDepth == 2 && $tabs)) {

								$subFolder = pathinfo($subFolder,PATHINFO_DIRNAME);
								
								$subFolderFileName = pathinfo($subFolder,PATHINFO_FILENAME); 
								if (strstr($subFolderFileName, "_")) {
									$subFolderSeparatedName = fromUnderscoreCase($subFolderFileName);
								} else {
									$subFolderSeparatedName = fromCamelCase($subFolderFileName);
								}


								$html .=

									'<li class="nav-item">' .
					                    '<a class="nav-link menu" data-menuitempath="' . $subFolder . '">' .
					                        fromCamelCase($rootFolder) .
					                    '</a>' .
					                '</li>';    
					            $menuFlag = true;
					            break;
					            
							} 

							else if ($folderDepth > 1 && !$menuFlag) {
								$html .=

									'<li class="nav-item dropdown multi-level-dropdown">' .
			            			'<a data-toggle="dropdown" class="top nav-link dropdown-toggle w-100">' . fromCamelCase($rootFolder) .'</a>' .
			            			'<ul class="dropdown-menu mt-2 rounded-0 border-0 z-depth-1">';
			            		$menuFlag = true;
			            		$ul = true;

							}  

							$submenu = false;
							
							if (($folderDepth > 2 && !$tabs) || ($folderDepth == 4 && $tabs)) {
								$submenu = true;
							}

							$subFolderFileName = pathinfo($subFolder,PATHINFO_FILENAME);
							
							if (strstr($subFolderFileName, "_")) {
								$subFolderSeparatedName = fromUnderscoreCase($subFolderFileName);
							} else {
								$subFolderSeparatedName = fromCamelCase($subFolderFileName);
							}

							if ($submenu) { 
								$subFolders2 = glob($subFolder . "/*", GLOB_ONLYDIR);

								$html .= 
									'<li class="dropdown-item dropdown-submenu p-0">' .
									'<a data-toggle="dropdown" class="dropdown-toggle dropdown-item text-black w-100">' . $subFolderSeparatedName . '</a>'.
				            		'<ul class="dropdown-menu ml-2 rounded-0 border-0 z-depth-1">';

								foreach ($subFolders2 as $subFolder2) { // e.g. Argent, Empire Residences, Goldener Hirsch
									
									$subFolder2FileName = pathinfo($subFolder2,PATHINFO_FILENAME);
									
									if (strstr($subFolder2FileName, "_")) {
										$subFolder2SeparatedName = fromUnderscoreCase($subFolder2FileName);
									} else {
										$subFolder2SeparatedName = fromCamelCase($subFolder2FileName);
									}

									$html .= 

										'<li class="dropdown-item p-0">' .
					                	'<a class="menu text-black w-100" data-menuitempath="' . $subFolder2 . '">' . $subFolder2SeparatedName . '</a>' .
					            		'</li>';
								}
								
								$html .= '</ul></li>';

							} else {

								$html .= '<a class="menu dropdown-item" data-menuitempath="' . $subFolder . '">' . $subFolderSeparatedName . '</a>';
							}
						} // END SUB FOLDER LOOP
						
						if (($folderDepth > 1 && !$tabs) || $ul) {
							$html .= "</ul></li>";
						} else {
							$html .= "</li>";
						}

					} // END ROOT FOLDER LOOP

					//echo htmlspecialchars($html); // for testing to display raw html
					echo $html;
					?>

            </ul>

        </div>

    </nav>
</div>

<style>

	/*.page-intro {
		position:fixed;
		top:65px;
		left:0;
		width:100%;
		border-bottom: none;
    	background-color: #27272a;
    	box-shadow: 0 -1px 2px rgb(0 0 0 / 6%) inset;
	}

	.breadcrumb {
	    padding: 0;
	    background-color: transparent!important;
	    margin-bottom: 0;
	    font-size: 13px;
	    padding: 8px 0;
	    list-style: none;
	    background-color: #f5f5f5;
	    border-radius: 4px;
	}

	.breadcrumb li, .breadcrumb li a {
    	color: #cdcdcd;
	}

	.breadcrumb>li {
	    display: inline-block;
	}*/
</style>


<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="<?php echo ROOT; ?>/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="js/mdb.min.js"></script>

<script>

$(document).ready(function() {

	$(".button-collapse").sideNav();

	$('a.menu').click(function(e){
		e.preventDefault();
		var callingFolderPath = '<?php echo $callingFolderPath; ?>';
		var menuItemPath = $(this).data('menuitempath'); //architectural/floorPlates
		var menuItemPathArray = menuItemPath.split('/');
		if (menuItemPathArray.slice(-1)[0] == '/') {
			menuItemPathArray.pop();
		}
		var newArray = [];
		menuItemPathArray.forEach(function(item) {
			if (item.indexOf('_') != -1) {
				newArray.push(fromUnderscoreCase(item));
			} else {
				newArray.push(fromCamelCase(item));
			}
		});

		var breadcrumb = '<li><i class="fa fa-home pr-10"></i><a href="<?php echo BARE_ROOT . $callingFolderPath;?>">Home</a></li>';
		newArray.forEach(function(item) {
			breadcrumb += "<li>" + item + "</li>";
		}); 
			
		var data = {
			"menuItemPath": menuItemPath,
			"callingFolderPath": callingFolderPath,
			"folderConfig": '<?php echo $folderConfig; ?>'
		}

		$.ajax({
			type: "POST",
			url: '<?php echo ROOT . "/imageMaker/display_images.php";?>', // absolute path
			data: {data:data}, 
			dataType: "html",
			success: function(html) {
				$('#breadcrumb').html(breadcrumb);
				$('#page_body_content').html(html);
				$('#page_body').removeClass('page-body');
				var callingFolderFullPath = '<?php echo BARE_ROOT . $callingFolderPath; ?>';
				var url = callingFolderFullPath + "/" + menuItemPath + '/';
				//history.pushState(null,null,url); 
			}
		});
	});

	window.onpopstate = function(e) {
		location.replace(document.location);
	}

	<?php 

		if (isset($path)) { ?>
			
			// ADD
			// refactor code into a single function that makes the AJAX call
			// test for GET call.  If true, do not pushState()

			var callingFolderPath = '<?php echo $callingFolderPath; ?>';
			var menuItemPath = '<?php echo $path; ?>';
		
			var menuItemPathArray = menuItemPath.split('/');
			menuItemPathArray.pop();
			
			var newArray = [];
			menuItemPathArray.forEach(function(item) {
				if (item.indexOf('_') != -1) {
					newArray.push(fromUnderscoreCase(item));
				} else {
					newArray.push(fromCamelCase(item));
				}
			});

			var breadcrumb = '<li><i class="fa fa-home pr-10"></i><a href="<?php echo BARE_ROOT . $callingFolderPath;?>">Home</a></li>';
			newArray.forEach(function(item) {
				breadcrumb += "<li>" + item + "</li>";
			}); 

			var data = {
				"menuItemPath": menuItemPath,
				"callingFolderPath": callingFolderPath,
				"folderConfig": '<?php echo $folderConfig; ?>'
			}

			$.ajax({
				type: "POST",
				url: '<?php echo ROOT . "/imageMaker/display_images.php";?>', // absolute path
				data: {data:data}, 
				dataType: "html",
				success: function(html) {
					$('#breadcrumb').html(breadcrumb);
					$('#page_body').html(html);
					var callingFolderFullPath = '<?php echo BARE_ROOT . $callingFolderPath; ?>';
					var url = callingFolderFullPath + "/" + menuItemPath;
				}
			}); <?php
		}

	?>

	function fromCamelCase(string) {
		var match = string.match(/[a-z]+/g,"$1");
		if (!match) {
			return string;
		} else {
			var result = string.replace( /([A-Z])/g, " $1" );
			return result.charAt(0).toUpperCase() + result.slice(1);
		}
	}

	function fromUnderscoreCase(string) {
		string = string.replace('_',' '); 
		return string;
	}

});


</script>



