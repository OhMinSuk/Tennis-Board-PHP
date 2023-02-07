<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/include/lib.php");

    if(!isset($_SESSION['user_name'])) {
        alert("로그인 후 이용할 수 있습니다.");
        move("login.php");
    }

    $board_no = $_GET["board_no"];

    $sql = "select * from board";

    $join = " natural join user";
    
    // 게시글에 파일이 존재 여부
    $issetFile = $pdo->query("select * from file where board_no = '{$board_no}'")->rowCount();
    if($issetFile){
        $join .= " natural join file";
    }

    $where = " where board_no = '{$board_no}'";
    
    $sql = $sql.$join.$where;

    $view = $pdo->query($sql)->fetch(2);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <?php include_once("./frame/head.php") ?>
</head>
<body>
    <div id="wrap">
        <?php include_once("./frame/nav.php") ?>
        <div id="contents">
            <div class="wrap">
                <div id="boardWrite">
                    <form action="/include/modifyOk.php?board_no=<?php echo $view["board_no"] ?>" method="post" enctype="multipart/form-data" class="boardWriteForm">
                        <div class="boardWriteHead">
                            <div class="boardWriteIndex">
                                <select name="board_index" required>
                                    <option value="">말머리 선택</option>
                                    <option value="삽니다" <?php if($view["board_index"] == "삽니다") echo "selected" ?>>삽니다</option>
                                    <option value="팝니다" <?php if($view["board_index"] == "팝니다") echo "selected" ?>>팝니다</option>
                                    <option value="거래완료" <?php if($view["board_index"] == "거래완료") echo "selected" ?>>거래완료</option>
                                </select>
                            </div>
                            <div class="boardWriteTitle">
                                <label for="board_title">제목:</label>
                                <input type="text" name="board_title" id="board_title" value="<?php echo $view['board_title']; ?>" required>
                            </div>
                            <div class="boardWriteType">
                                <select name="board_type" required>
                                    <option value="">카테고리 선택</option>
                                    <option value="racket" <?php if($view["board_type"] == "racket") echo "selected" ?>>테니스 라켓</option>
                                    <option value="etc" <?php if($view["board_type"] == "etc") echo "selected" ?>>테니스 용품</option>
                                    <option value="cloth" <?php if($view["board_type"] == "cloth") echo "selected" ?>>테니스 의류</option>
                                </select>
                            </div>
                        </div>
                        <div class="boardWriteBody">
                            <div class="boardWriteFile">
                                <label>첨부파일:</label>
                                <input type="file" name="file"> <?php if(isset($view["file_name"])) echo $view["file_name"] ?>
                            </div>
                            <div class="boardWriteContents">
                                <label for="board_contents">내용:</label>
                                <textarea name="board_contents" id="board_contents" rows="20" required><?php echo $view['board_contents']; ?></textarea>
                            </div>
                        </div>
                        <div class="boardWriteFooter">
                            <div class="boardWriteButton">
                                <button type="submit">수정</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./frame/script.php") ?>
</body>
</html>