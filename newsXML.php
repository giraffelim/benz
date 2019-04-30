<?php
header("access-control-allow-origin: *");
header("Content-Type: text/xml"); 

$mysql_hostname = 'localhost';
$mysql_username = 'tyang';
$mysql_password = 'xodid1541';
$mysql_database = 'tyang';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//1. DB 연결
$connect = @mysql_connect($mysql_hostname.':'.$mysql_port, $mysql_username, $mysql_password); 

if(!$connect){
	echo '[연결실패] : '.mysql_error().'<br>'; 
	die('MySQL 서버에 연결할 수 없습니다.');
    
} 
//2. DB 선택
@mysql_select_db($mysql_database, $connect) or die('DB 선택 실패');

//3. 문자셋 지정
mysql_query(' SET NAMES '.$mysql_charset);

//4. 쿼리 생성
$query = 'select title,wdate from news;';

//5. 쿼리 실행
$result = mysql_query($query);



//6. 결과 처리
$output='<?xml version="1.0" encoding="UTF-8"?>';
$output.='<news>';
while($row = mysql_fetch_array($result))
{
	//echo $row['name'].'<br>';
    $output.='<today>';
    $output.='<title>'.$row['title'].'</title>';
    $output.='<wdate>'.$row['wdate'].'</wdate>';
    $output.='</today>';
}
$output.='</news>';

echo $output;

//6. 연결 종료
mysql_close($connect);

?>