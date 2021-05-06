<?php

$stdConfig = array(
	"gallery" => 1,
	"tabs" => 1,
	"overlay" => 1,
	"displayImageFolderName" => 1,
	"border" => 1,
	"imageFolder" => 1,
	"containerWidth" => 200,
);

$data = $_POST['data']; 
$menuItemPath = rtrim($data['menuItemPath'],"/"); // remove trailing slash from GET call
$callingFolderPath = $data['callingFolderPath'];
$folderConfig = json_decode($data['folderConfig'],true);

$directoryConfig = $stdConfig;

if (array_key_exists($menuItemPath,$folderConfig)) {
	foreach ($directoryConfig as $key => $value) {
		if(array_key_exists($key, $folderConfig[$menuItemPath])) { 
	        $directoryConfig[$key] = $folderConfig[$menuItemPath][$key]; 
	    }
	}
}

$gallery = $directoryConfig['gallery'] ?? true;
$tabs = $directoryConfig['tabs'] ?? true;
$overlay = $directoryConfig['overlay'] ?? false;
$displayImageFolderName = $directoryConfig['displayImageFolderName'] ?? false;
$border = $directoryConfig['border'] ?? false;
$callingFullPath = $_SERVER['DOCUMENT_ROOT'] . $callingFolderPath;
$containerWidth = $directoryConfig['containerWidth'] ?? '';
$imageFolder = $directoryConfig['imageFolder'] ?? true;

if (!$imageFolder) {
	$fileName = pathinfo($menuItemPath,PATHINFO_FILENAME);
	$path = $callingFullPath . "/" . $menuItemPath . "/" . $fileName;
	if (file_exists($path . ".html")) {
		include($path . ".html");
	} elseif (file_exists($path . ".php")) {
		include($path . ".php");
	}
	exit;
}

$root = ($_SERVER['SERVER_ADDR'] == "::1" || $_SERVER['SERVER_ADDR'] == "127.0.0.1") ? "//localhost":"https://aspengroup.online";
define("ROOT", $root);

if ($tabs) {  
	$imagesGrandparentRelativePath = $menuItemPath; // menuItemPath is a grandparent
} else {  
	$imagesParentRelativePath = $menuItemPath; // menuItemPath is a parent
	$imagesParentFullPath = $callingFullPath . "/" . $imagesParentRelativePath;
	$imagesGrandparentRelativePath = substr($menuItemPath,0,strrpos($menuItemPath,'/'));
}

$imagesGrandparentFullPath = $callingFullPath . "/" . $imagesGrandparentRelativePath;

function fromCamelCase($camelCaseString) {
    $re = '/(?<=[a-z])(?=[A-Z])/x';
    $a = preg_split($re, $camelCaseString);
    // return ucfirst(join($a, " " ));
    return ucfirst(implode(" ",$a));
}

function fromUnderscoreCase($string) {
	$string = str_replace('_',' ',$string);
	return ucfirst($string);
}

function fileNameCompare($array1,$array2) {
	$name1 = $array1[0];
	$digits1 = $array1[1];

	$name2 = $array2[0];
	$digits2 = $array2[1];

	if ($name1 != $name2) {
		// sort by name
		return $name1 > $name2;
	} elseif ($name1 == $name2) {
		// sort by digits
		return $digits1 > $digits2;
	}
}

function advancedSort($imageFolders) {

	// sorts path names that end in digits, where the preceding names are potentially different
	/// e.g. basement, level-1, level-2, parking-1 will sort correctly, first by name, then by digit

	$dirName = pathinfo($imageFolders[0],PATHINFO_DIRNAME);

	$newArray = [];
	foreach ($imageFolders as $name) {
		$name = basename($name);
		$digitsOnly = '';
		$portionToRemove = '';

	    preg_match('/(?![-|_])[0-9]+/',$name,$matches);
	    if ($matches) $digitsOnly = $matches[0];

		preg_match('/[_-][0-9]+/',$name,$matches);
		if ($matches) $portionToRemove = $matches[0];
		$newName = str_replace($portionToRemove,'',$name);

	    $temp = [$newName, $digitsOnly];
	    $new2dArray[] = $temp;
	}

	usort($new2dArray,'fileNameCompare');

	$finalArray = [];
	foreach($new2dArray as $value) {
		$tempName = $value[0];
		$tempDigits = $value[1];
		if ($tempDigits) $fullName = $tempName . "_" . $tempDigits;
		else $fullName = $tempName;
		$fullPath = $dirName . '/' . $fullName;
		$finalArray[] = $fullPath;
	}

	return $finalArray;
}

?>

<style>

	.overlay-container span.hover {
		color:white;
		background-color:#4e5b5e;
	}

	.overlay-container>a {
		text-decoration: none;
	}

	.overlay-container {
		display:inline-block;
		margin:10px 10px 5px 10px;
		max-width:300px;
		<?php 
		if ($containerWidth) {
			echo "width:" . $containerWidth . "px";
		}?>

	}

	@media (max-width:650px) {
		.overlay-container {
		    display:inline-block!important;
		    width:100%!important;
		    margin:0 0 10px 0!important;
		}

		.tab-pane>div {
			padding:0;
		}
	}

	.overlay-hover {
		background-color:#4e5b5e;
		color:white;
	}

	.overlay-container span {
		text-align:center;
		text-transform:uppercase;
		color:#333;
		font-size:18px;
		background-color:#f2f2f2;
		border-color:#f3f3f3;
		display:block;
		width:100%;
		padding:17px 12px;
		white-space: nowrap;
		overflow-x:scroll;
	}

	img {
		max-width: 100%
	}

	.tab-content {
		padding:0;
	}

	@media (max-width:1200px) {
		.tabs-style-2 {
			text-align:center;
		}
	}

	<?php

		if ($border) { ?>
			.overlay-container {
				border:1px solid gray;
			} <?php
		} ?>
</style>


<div>
	<div class="tabs-style-2" >
	<br>

	<?php

	if (!$gallery && !$tabs) {

	    $imageFolders = glob($imagesParentFullPath . "/*", GLOB_ONLYDIR);
	    
	    if ($imageFolders) {
        	if (preg_match('/[-_][0-9]+/',$imageFolders[0])) {
        		$imageFolders = advancedSort($imageFolders); // must use = to
        	} else {
        		sort($imageFolders); // must not use = to as sort returns a boolean
        	}
        }

        echo '<div style="text-align:center;margin-bottom:40px">';
        
        foreach($imageFolders as $imageFolder) {
        	$fileNames = glob($imageFolder . "/*.{jpg,png,gif}", GLOB_BRACE);
        	$imageFolderName = str_replace($imagesParentFullPath . "/",'', $imageFolder);
        	
        	if ($displayImageFolderName && strstr($imageFolderName, "_")) {
        		$imageFolderName = fromUnderscoreCase($imageFolderName);
        		$imageFolderName = fromCamelCase($imageFolderName);
        	} else {
        		$imageFolderName = fromCamelCase($imageFolderName);
        	}

        	foreach($fileNames as $fileName) {
				$fileName = str_replace($callingFullPath . "/", '',$fileName . "?" . filemtime($fileName));
				
				if (substr($fileName,0,1) == "/") $fileName = substr($fileName,1);

				if (strstr($fileName,"fullsize")) {
					$fullSizePath = ROOT . $callingFolderPath . "/" . $fileName;
			    	$thumbnailPath = str_replace('fullsize','thumbnail',$fullSizePath);

					echo '<div class="overlay-container">';
						echo "<a href='" . $fullSizePath . "' class='popup-img-single'><img src='" . $thumbnailPath . "'>";
						if ($displayImageFolderName) {
							echo "<span style='margin:0' >$imageFolderName</span>";
						}
						echo "</a></div>";
				}
				continue;
			}
	    }
	    echo '</div';
	}

	if (!$gallery && $tabs) { ?>
		<div>
			<ul class="nav nav-pills" role="tablist"> <?php
				$tabFolders = glob($imagesGrandparentFullPath . "/*", GLOB_ONLYDIR);
				$i = 0;
				
				foreach($tabFolders as $tabFolder) { // generate the li tags for the tabs
				    $tabFolderName = str_replace($imagesGrandparentFullPath . "/",'',$tabFolder);
					$tabFolderSeparatedName = fromCamelCase($tabFolderName);
					if ($i == 0) {
						echo "<li class='active'><a href=#" . $tabFolderName . " role='tab' data-toggle='tab'>" . $tabFolderSeparatedName . "</a></li>"; // make first tab active
					} else {
						echo "<li><a href=#" . $tabFolderName . " role='tab' data-toggle='tab'>" . $tabFolderSeparatedName . "</a></li>";
					}
					$i++;
				} ?>

			</ul>

			<hr>

			<div class="tab-content"><?php

				$tabFolders = glob($imagesGrandparentFullPath . "/*", GLOB_ONLYDIR);
				$i = 0;
	    		
	    		foreach($tabFolders as $tabFolder) { // loop through Empire Residences folder (common, interior, exterior..)
	    			
	    			$tabFolderName = str_replace($imagesGrandparentFullPath . "/",'',$tabFolder);
	    			if ($i == 0) {
			        	echo"<div class='tab-pane fade in active' id='" . $tabFolderName . "'>"; // add classes "in" and "active"
			        } else {
			        	echo"<div class='tab-pane fade' id='" . $tabFolderName . "'>";
			        }
			        $imageFolders = glob($tabFolder . "/*", GLOB_ONLYDIR);
			        if ($imageFolders) {
			        	if (preg_match('/[-_][0-9]+/',$imageFolders[0])) {
			        		$imageFolders = advancedSort($imageFolders); // must use = to
			        	} else {
			        		sort($imageFolders); // must not use = to as sort returns a boolean
			        	}
			        }

			        echo '<div style="text-align:center">';
			        
			        foreach($imageFolders as $imageFolder) {

			    		$imageFolderName = str_replace($tabFolder . "/",'', $imageFolder);
			        	if ($displayImageFolderName && strstr($imageFolderName, "_")) {
			        		$imageFolderName = fromUnderscoreCase($imageFolderName);
			        		$imageFolderName = fromCamelCase($imageFolderName);
			        	} else {
			        		$imageFolderName = fromCamelCase($imageFolderName);
			        	}

			        	$fileNames = glob($imageFolder . "/*.{jpg,png,gif}", GLOB_BRACE);

				        	foreach($fileNames as $fileName) {
				        		$fileName = str_replace($callingFullPath . "/", '',$fileName . "?" . filemtime($fileName));
							if (substr($fileName,0,1) == "/") $fileName = substr($fileName,1);

							if (strstr($fileName,"fullsize")) {
								$fullSizePath = ROOT . $callingFolderPath . "/" . $fileName;
			    				$thumbnailPath = str_replace('fullsize','thumbnail',$fullSizePath);

								echo '<div class="overlay-container">';
									echo "<a href='" . $fullSizePath . "' class='popup-img-single'><img src='" . $thumbnailPath . "'>";
									if ($displayImageFolderName) {
										echo "<span style='margin:0' >$imageFolderName</span>";
									}
									echo "</a></div>";
							}
							continue;
						}

				    }
				    echo "</div></div>";

				    $i++;
				} ?>
			</div> <!-- end tab-content -->
		</div> <?php
	}

	if ($gallery) {

    	$tabFolders = glob($imagesGrandparentFullPath . "/*", GLOB_ONLYDIR);

	    foreach($tabFolders as $tabFolder) { // loop through tabFolders
			$tabFolderName = str_replace($imagesGrandparentFullPath . "/",'',$tabFolder);
	        $id = ucfirst($tabFolderName); // ensure unique id 
	        // add class blueimp-gallery-controls to initialize gallery wtih visible controls
	        ?>
		    
		    <div id="blueimp-gallery-<?php echo$id;?>" class="blueimp-gallery blueimp-gallery-controls" data-use-bootstrap-modal="false">
		        
		        <div class="slides"></div>
		        
		        <h3 class="title"></h3>
		        <a class="prev"></a>
		        <a class="next"></a>
		        <a class="close"></a>
		        <a class="play-pause"></a>
		        <ol class="indicator"></ol>
		        
		        <div class="modal fade">
		            <div class="modal-dialog">
		                <div class="modal-content">
		                    <div class="modal-header">
		                        <button type="button" class="close" aria-hidden="true">&times;</button>
		                        <h4 class="modal-title"></h4>
		                    </div>
		                    <div class="modal-body next"></div>
		                    <div class="modal-footer">
		                        <button type="button" class="btn btn-default pull-left prev">
		                            <i class="glyphicon glyphicon-chevron-left"></i>
		                            Previous
		                        </button>
		                        <button type="button" class="btn btn-primary next">
		                            Next
		                            <i class="glyphicon glyphicon-chevron-right"></i>
		                        </button>
		                    </div>
		                </div>
		            </div>
		        </div>

		    </div> <?php
		}; 

		if ($tabs) { ?> 
		    <div>
				<!-- <ul class="nav md-pills pills-primary" role="tablist"> -->
				<ul class="nav md-pills pills-purple-gradient" role="tab"> 

					<?php

					$i = 0;
					foreach($tabFolders as $tabFolder) { // generate the li tags for the tabs
					    $tabFolderName = str_replace($imagesGrandparentFullPath . "/",'',$tabFolder);
						
						if (strstr($tabFolderName, "_")) {
							$tabFolderSeparatedName = fromUnderscoreCase($tabFolderName);
						} else {
							$tabFolderSeparatedName = fromCamelCase($tabFolderName);
						}

						if ($i == 0) {
							echo "<li class='nav-item'><a class='nav-link active' href=#" . $tabFolderName . " role='tab' data-toggle='tab'>" . $tabFolderSeparatedName . "</a></li>"; // make first tab active
						} else {
							echo "<li class='nav-item'><a class='nav-link' href=#" . $tabFolderName . " role='tab' data-toggle='tab'>" . $tabFolderSeparatedName . "</a></li>";
						}
						$i++;
					} ?>
				</ul>

				<hr>

				<div class="tab-content"><?php

					$tabFolders = glob($imagesGrandparentFullPath . "/*", GLOB_ONLYDIR);
					$i = 0;

		    		foreach($tabFolders as $tabFolder) {

		    			$tabFolderName = str_replace($imagesGrandparentFullPath . "/",'',$tabFolder);
		    			
		    			if ($i == 0) {
				        	echo"<div class='tab-pane fade in show active' id='" . $tabFolderName . "'>"; // add classes "in" and "active"
				        } else {
				        	echo"<div class='tab-pane fade' id='" . $tabFolderName . "'>";
				        }

				        $imageFolders = glob($tabFolder . "/*", GLOB_ONLYDIR);

				        if ($imageFolders) {
				        	if (preg_match('/[-_][0-9]+/',$imageFolders[0])) {
				        		$imageFolders = advancedSort($imageFolders); // must use = to
				        	} else {
				        		sort($imageFolders); // do not use = to as sort returns a boolean
				        	}
				        }

				        echo '<div>';
				        
				        foreach($imageFolders as $imageFolder) {

				        	$imageFolderName = str_replace($tabFolder . "/",'', $imageFolder);
				        	if ($displayImageFolderName && strstr($imageFolderName, "_")) {
				        		$imageFolderName = fromUnderscoreCase($imageFolderName);
				        		$imageFolderName = fromCamelCase($imageFolderName);
				        	} else {
				        		$imageFolderName = fromCamelCase($imageFolderName);
				        	}

				        	$fileNames = glob($imageFolder . "/*.{jpg,png,gif}", GLOB_BRACE);

				        	foreach($fileNames as $fileName) { // loop through images

			    				$fileName = str_replace($callingFullPath . "/", '',$fileName . "?" . filemtime($fileName));
			    				
			    				if (substr($fileName,0,1) == "/") $fileName = substr($fileName,1); // strip leading "/" if present. occurs when index.php is the parent of the image folders.

			    				if (strstr($fileName,"fullsize")) {
			    					// absolute paths
			    					$fullSizePath = ROOT . $callingFolderPath . "/" . $fileName;
			    					$thumbnailPath = str_replace('fullsize','thumbnail',$fullSizePath);
			    					continue;
			    				}
								
			    				echo '<div class="overlay-container">';
			    				echo "<a href='" . $fullSizePath . "' data-gallery=#blueimp-gallery-". ucfirst($tabFolderName) . "><img src='" . $thumbnailPath . "'>";

			    				if ($displayImageFolderName) {
									echo "<span>$imageFolderName</span>";
								}
								echo "</a></div>";
							}
					    }

					    echo "</div></div>";
					    $i++;
					} ?>

				</div> <!-- end tab-content -->
			</div> <?php
		} elseif (!$tabs) { // no tabs

			echo '<div style="margin-bottom:40px">';
	        $imageFolders = glob($imagesParentFullPath . "/*", GLOB_ONLYDIR);

	        if ($imageFolders) {
	        	if (preg_match('/[-_][0-9]+/',$imageFolders[0])) {
	        		$imageFolders = advancedSort($imageFolders); // must use = to
	        	} else {
	        		sort($imageFolders); // do not use "= to" as sort returns a boolean
	        	}
	        }

	        foreach($imageFolders as $imageFolder) {
	        	$fileNames = glob($imageFolder . "/*.{jpg,png,gif}", GLOB_BRACE);
	        	
	        	$imageFolderName = str_replace($imagesParentFullPath . "/",'', $imageFolder);
	        	
	        	if ($displayImageFolderName && strstr($imageFolderName, "_")) {
	        		$imageFolderName = fromUnderscoreCase($imageFolderName);
	        		$imageFolderName = fromCamelCase($imageFolderName);
	        	} else {
	        		$imageFolderName = fromCamelCase($imageFolderName);
	        	}
	        	
	        	foreach($fileNames as $fileName) {
					$fileName = str_replace($callingFullPath . "/", '',$fileName . "?" . filemtime($fileName));
					if (substr($fileName,0,1) == "/") $fileName = substr($fileName,1);

					if (strstr($fileName,"fullsize")) {
						//absolute path
						$fullSizePath = ROOT . $callingFolderPath . "/" . $fileName;
			    		$thumbnailPath = str_replace('fullsize','thumbnail',$fullSizePath);

						if ($overlay) echo '<div class="overlay-container">';

							echo "<a href='" . $fullSizePath . "' data-gallery=#blueimp-gallery-". ucfirst($tabFolderName) . "><img src='" . $thumbnailPath . "'>";

							if ($displayImageFolderName) {
								echo "<span>$imageFolderName</span>";
							}
							echo "</a>";

						if ($overlay) echo "</div>";
					}
					continue;
				}
		    }
		    echo "</div></div>";
		}
	} ?>

</div>

<script>

	// $(".popup-img-single").magnificPopup({
	// 	type:"image",
	// 	gallery: {
	// 		enabled: false,
	// 	}
	// });

	$(".overlay-container").hover(function(){
		$(this).find('span').addClass('hover');
		}, function(){
			$(this).find('span').removeClass('hover');
	});

</script>



