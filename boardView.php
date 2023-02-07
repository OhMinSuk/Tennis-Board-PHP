<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/include/lib.php");

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

    $hitAdd = $view["board_hit"] + 1;
    $pdo->query("update board set board_hit = '{$hitAdd}' where board_no = '{$board_no}'");
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
                <div id="boardView">
                    <div class="boardViewTitle">
                        <h2>[<?php echo $view["board_index"] ?>] <?php echo $view["board_title"] ?></h2>
                        <div class="boardViewInfo">
                            <span><?php echo $view["user_name"]; ?></span>
                            <span><?php echo $view["board_date"]; ?></span>
                            <span>조회수 <?php echo $view["board_hit"]; ?></span>
                        </div>
                    </div>
                    <div class="boardViewContents">
                        <?php if(isset($view["file_name"])){ ?>
                        <div class="boardViewImage">
                            <img src="/resources/uploadFiles/<?php echo $view["file_name"] ?>">
                        </div>
                        <?php } ?>
                        <pre><?php echo $view["board_contents"] ?></pre>
                    </div>
                    <div class="boardViewComment">
                        <h3>댓글 <?php echo $pdo->query("select * from comment where board_no='{$board_no}'")->rowCount(); ?></h3>
                        <div class="boardViewControl">
                            <ul>
                                <li><a href="/">[목록]</a></li>
                                <?php if($view["user_no"] == $_SESSION["user_no"]){ ?>
                                <li><a href="boardModify.php?board_no=<?php echo $board_no; ?>">[수정]</a></li>
                                <li><a href="/include/boardDelete.php?board_no=<?php echo $board_no; ?>"onClick="return confirm('정말 삭제하시겠습니까?')">[삭제]</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="commentList">
                            <?php
                                $commentList = $pdo->query("select * from comment natural join user where board_no='{$board_no}'");
                                while($comment = $commentList->fetch(2)){
                            ?>
                                <div class="comment">
                                    <h4 class="commentWriter"><?php echo $comment["user_name"]; ?></h4>
                                    <span class="commentDate"><?php echo $comment["comment_date"]; ?></span>
                                    <p class="commentContents"><?php echo $comment["comment_contents"] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="writeComment">
                            <form action="/include/writeCommentOk.php" method="POST">
                                <input type="hidden" name="board_no" value="<?php echo $_GET["board_no"]; ?> ">
                                <?php if($_SESSION["user_no"] == ""){ ?>
                                    <div class="commentContents">
                                        <input type="text" name="comment_contents" value="" placeholder="로그인 후 이용 가능합니다." disabled>
                                    </div>
                                    <div class="commentSubmit">
                                        <button type="submit" disabled>댓글</button>
                                    </div>
                                <?php } else { ?>
                                    <div class="commentContents">
                                        <input type="text" name="comment_contents" value="" placeholder="댓글을 남겨보세요" required>
                                    </div>
                                    <div class="commentSubmit">
                                        <button type="submit">댓글</button>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("./frame/script.php") ?>
</body>
</html>