<?php
$path=getcwd();
if(is_array($_GET)&&!empty($_GET)&&!empty($_GET['dir'])){
    $path=$path.'\\'.$_GET['dir'];
}
$dir=opendir($path);
while (($file = readdir($dir)) !== false)
  {
    $filename=$file;
    if($filename!="index.php"&&$filename!=="."){
      $file_ext=substr(strrchr($filename,'.'),1);
      if($file_ext){
        if(isset($_GET['dir'])){
          echo "<p><a target='_blank' href=./$_GET[dir]/$filename>".$filename.'</a></p>';
        }else{
          echo "<p><a href=./$filename>".$filename.'</a></p>';
        } 
      }else{
        if(isset($_GET['dir'])){
          echo "<p><a href=/$filename>".$filename.'</a></p>';
        }else{
                echo "<p><a href=/$filename>".$filename.'</a></p>';
        }
      }
    }
  }
  closedir($dir);
?>