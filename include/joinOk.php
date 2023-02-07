<?php

    include_once("lib.php");

    $user_id = $_POST["user_id"];
    $user_pw = $_POST["user_pw"];
    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];

    $overlap_id_count = $pdo->query("select * from user where user_id = '{$user_id}'")->rowCount();
    if($overlap_id_count > 0){
        alert("이미 가입된 아이디가 있습니다.\\r\\n다른 아이디를 입력해주세요.");
        echo "<script>history.back()</script>";
    } else {
        $pdo->query("insert into user set user_id = '{$user_id}', user_pw = '{$user_pw}', user_name = '{$user_name}', user_email = '{$user_email}'");
    
        alert("회원가입이 완료되었습니다.");
        move("/");
    }