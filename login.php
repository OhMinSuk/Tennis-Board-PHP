<?php include_once($_SERVER["DOCUMENT_ROOT"]."/include/lib.php"); ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <?php include_once("./frame/head.php") ?>
</head>
<body>
    <div id="wrap">
        <?php include_once("./frame/nav.php") ?>
        <!-- CONTENTS -->
        <div id="contents">
            <div class="wrap">
                <div id="sub">
                    <div id="login">
                        <h3 class="subTitle">로그인</h3>
                        <form action="/include/loginOk.php" method="post">
                            <ul>
                                <li><label for="user_id">ID : </label></li>
                                <li><input type="text" id="user_id" name="user_id" value="" required></li>
                            </ul>
                            <ul>
                                <li><label for="user_pw">P/W : </label></li>
                                <li><input type="password" id="user_pw" name="user_pw" value="" required></li>
                            </ul>
                            <div class="btnArea">
                                <p><button type="submit">로그인</button></p>
                                <p><button type="button" onClick="link('join.php')">회원가입</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./frame/script.php") ?>
</body>
</html>