<?php
    include_once("lib.php");

    $user_no = $_SESSION["user_no"];
    $board_no = $_POST["board_no"];
    $comment_contents = $_POST["comment_contents"];

    if($_SESSION["user_no"]){
        $pdo->query("insert into comment set board_no='{$board_no}', user_no='{$user_no}', comment_contents='{$comment_contents}'");
        alert("댓글 작성이 완료되었습니다.");
        move("../boardView.php?board_no={$board_no}");
    }else{
        alert("로그인 후 이용 가능합니다.");
        move("../login.php");
    }
