<?php
//获取美女图片，宅男必备
$url = 'http://me2-sex.lofter.com/tag/mygirl?page=';
function getimgurls($url, $page=1){
  $str = file_get_contents($url.$page);
  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
  preg_match_all($pattern,$str,$match);
  return $match[1];
}
function httpgetimg($url){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_URL, $url);
  ob_start();
  curl_exec($ch);
  $return_content = ob_get_contents();
  ob_end_clean();
  $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  return $return_content;
}
//获取10页图片
$pagesum = 10;
for($i=1;$i<$pagesum;$i++){
  $imgurls = getimgurls($url,$i);
  foreach ($imgurls as $key => $value){
    $fp = @fopen($i.'-'.$key.'.jpg',"a");
    fwrite($fp,httpgetimg($value));
  }
}
?>
