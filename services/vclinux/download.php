<?php
if(isset($_GET['name'])){
  //ユーザー名, パスワード, ホスト, データベース名, テーブル名
  //ldzvsyxb_vc, vcborn@2021, localhost, ldzvsyxb_vc, VCL_DLCOUNT
  $pdo = new PDO('mysql:host=localhost;dbname=ldzvsyxb_vc', 'ldzvsyxb_vc', 'vcborn@2021');
  $sql = 'UPDATE `VCL_DLCOUNT` SET `name`="'.$_GET['name'].'",`count`=count + 1';
  $pdo->query($sql);     
}
?>