<?php
$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$languages = array_reverse($languages);
 
$result = '';
 
foreach ($languages as $language) {
  if (preg_match('/^en/i', $language)) {
    $result = 'English';
    header("Location: /en/"); //海外から
  } elseif (preg_match('/^ja/i', $language)) {
    $result = 'Japanese';
    header("Location: /"); //日本から
  } 
}
if ($result == '') {
  $result = 'Japanese';
  header("Location: /"); //判定できない(日本ということにする）
}