<?php
    include_once("./include/lib.php");


    session_destroy();
    alert("로그아웃 되었습니다");
    move("/");