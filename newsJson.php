<?php
header("access-control-allow-origin: *");
header("Content-Type: text/json; charset=UTF-8"); 

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
$query = 'select title, wdate from notice';

//5. 쿼리 실행
$result = mysql_query($query);



//6. 결과 처리
//[
//  {"name" : "우유", "price" : 2000},
//  {"name" : "홍차", "price" : 5000},
//  {"name" : "커피", "price" : 5000}
//]
$output='';


while($row = mysql_fetch_array($result))
{	
    if ($output!="")
    {
        $output.= ",";//콤마붙이기
    }

     $output.='{"title":"'.$row['title'].'","wdate":"'.$row['wdate'].'"}';  
   
}
$output='['.$output.']';

echo $output;

//6. 연결 종료
mysql_close($connect);

?>
