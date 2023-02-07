<?php
    include_once("lib.php");

    $board_no = $_GET["board_no"];

    $pdo->query("delete from board where board_no='{$board_no}'");
    $pdo->query("delete from comment where board_no='{$board_no}'");
    $pdo->query("delete from file where board_no='{$board_no}'");
    alert("게시글이 삭제되었습니다.");
    move("/");
