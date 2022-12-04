<?php 
   

$file = isset($_GET['file'])?$_GET['file']:false;
echo $file;
if ($file!="") {
   header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$ext = pathinfo($file, PATHINFO_EXTENSION);
$basename = pathinfo($file, PATHINFO_BASENAME);

header("Content-type: application/".$ext);
// tell file size
header('Content-length: '.filesize($file));
// set file name
header("Content-Disposition: attachment; filename=\"$basename\"");
readfile($file);
// Exit script. So that no useless data is output.
}


?>



<?php function listFolderFiles($dir){
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;

    echo '<ol>';
    foreach($ffs as $ff){
        echo '<li><a href="?file='.$dir.$ff.'">'.$ff.'</a>';
        if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
        echo '</li>';
    }
    echo '</ol>';
}

listFolderFiles('../images/');
?>