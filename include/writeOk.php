<?php

    include_once("lib.php");

    $board_title = $_POST["board_title"];
    $board_contents = $_POST["board_contents"];
    $board_type = $_POST["board_type"];
    $user_no = $_SESSION["user_no"];
    $board_index = $_POST["board_index"];

    $pdo->query("insert into board set board_title = '{$board_title}', board_contents = '{$board_contents}', board_type = '{$board_type}', user_no = '{$user_no}', board_index = '{$board_index}'");

    $board = $pdo->query("select * from board order by board_no desc")->fetch(2);
    $board_no = $board["board_no"];

    if(isset($_FILES["file"])){
        $dir = "../resources/uploadFiles/";
	    $filename = "";

        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $filename = date("Ymd-His")."_".$_FILES['file']['name'];
            $dst = $dir.$filename;

            if(!move_uploaded_file($_FILES['file']['tmp_name'], $dst)){
                alert("파일이 지정된 폴더에 저장되지 않았습니다.");
                echo "<script>history.back()</script>";
                exit();
            }

            $pdo->query("insert into file set board_no='{$board_no}', file_name = '{$filename}'");
        }
    }

    alert("글 작성이 완료되었습니다.");
    move("/");