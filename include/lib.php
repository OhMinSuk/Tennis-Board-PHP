<?php
    // 세션 사용 시작
    session_start();

    // 한글 깨짐 방지를 위한 utf-8 인코딩
    header("Content-Type: text/html; charset=utf-8");

    // 데이터베이스 연결
    $pdo = new PDO("mysql:host=127.0.0.1; charset=utf8; dbname=bbs", "root", "");

    // 서버 날짜 설정
    date_default_timezone_set("Asia/Seoul");

    function alert($msg){
        echo "<script>alert('{$msg}')</script>";
    }

    function move($url){
        echo "<script>document.location.replace('{$url}')</script>";
    }


    // 세션 초기화
	$_SESSION['user_no'] = isset($_SESSION['user_no']) ? $_SESSION['user_no'] : NULL;
    $_SESSION['user_name'] = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : NULL;