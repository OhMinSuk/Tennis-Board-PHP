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
                <?php include_once("./boardList.php") ?>
            </div>
        </div>
    </div>
    <?php include_once("./frame/script.php") ?>
</body>
</html>