<?php

//連線到資料庫

//先設定資料庫資訊，主機通常都用本機
$host = 'localhost';
//以root管理者帳號進入資料庫
$dbuser = 'hj'; //hj //test1234
//root的資料庫密碼
$dbpw = 'tesrt1234';
//登入後要使用的資料庫
$dbname = 'testdb';

//宣告一個 link 變數，並執行連結資料庫函式 mysqli_connect()，連結結果會帶入 link 當中
$conn = mysqli_connect($host, $dbuser, $dbpw, $dbname);

if ($conn)
{
  //若傳回正值，代表已經連線
  //設定連線編碼為UTF-8
  //mysqli_query(資料庫連線, "語法內容") 為執行sql語法的函式
  mysqli_query($conn, "SET NAMES utf8");
  mysqli_select_db($conn, $dbname);
  //echo "已正確連線";
}
else
{
  //連線失敗 mysqli_connect_error() 顯示連線錯誤訊息
  echo '無法連線mysql資料庫 :<br/>' . mysqli_connect_error();
  }


?>