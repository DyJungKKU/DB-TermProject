<?php // 공통 파일
include_once("./dbconfig.php"); // DB 정보
$conn = mysqli_connect("localhost", $DB_User, $DB_Password, $DB_Name);

// 사용 함수 정의 

function sql_query($sql) {
    global $conn;
    return mysqli_query($conn, trim($sql));
} 

function sql_fetch_array($result) {
    return mysqli_fetch_array($result);
}