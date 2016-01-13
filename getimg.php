<?php
/*
 * @author lerte
 * @date 2016-01-13
 * @email lertesmith@gmail.com
 *
*/
# 快播没有了,抓点图片娱乐下，希望宅男们喜欢😍
$resource = 'http://me2-sex.lofter.com/tag/mygirl?page=';
$pagesum = 1;
$dirname = "./sexygirl/";
if(!is_dir($dirname)) {
  mkdir($dirname,0777,true);
}
function getimgurls($url, $page=1){
  $str = file_get_contents($url.$page);
  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
  preg_match_all($pattern,$str,$match);
  return $match[1];
}
function httpgetimg($url, $dir){
  $ch = curl_init($url);
  $fp = fopen($dir,"wb");
  curl_setopt($ch, CURLOPT_FILE, $fp);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  $result = curl_exec($ch);
  curl_close($ch);
  fclose($fp);
  return $result;
}
for($i=1;$i<=$pagesum;$i++){
  $imgurls = getimgurls($resource,$i);
  $length = count($imgurls);
  foreach ($imgurls as $key => $url){
    if(httpgetimg($url,$dirname.$i.'-'.$key.'.jpg')){
      echo "😍 已保存第".$i."页，(总共".$pagesum."页)"."第".($key+1)."张，(总共".$length."张)\n";
    }
  }
}
?>
