<?php

    include_once("lib.php");

    $user_id = $_POST["user_id"];
    $user_pw = $_POST["user_pw"];

    $user = $pdo->query("select * from user where user_id = '{$user_id}' and user_pw = '{$user_pw}'")->fetch(2);


    if($user){
        $_SESSION['user_no'] = $user['user_no'];
        $_SESSION['user_name'] = $user['user_name'];

        alert("로그인이 완료되었습니다.");
        move("/");
    } else {
        alert("아이디나 비밀번호를 다시 확인해주세요.");
        echo "<script>history.back()</script>";
    }