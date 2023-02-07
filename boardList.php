<?php
    $board_type = isset($_GET["board_type"]) ? $_GET["board_type"] : "all";
    $search_category = isset($_GET["search_category"]) ? $_GET["search_category"] : "";
    $search_contents = isset($_GET["search_contents"]) ? $_GET["search_contents"] : "";
    $board_page = isset($_GET["board_page"]) ? $_GET["board_page"] : 1;
?>

<div id="boardList">
    <table class="boardList">
        <thead>
            <tr>
                <th>글 번호</th>
                <th>제 목</th>
                <th>글쓴이</th>
                <th>작성일</th>
                <th>조회수</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $where = "";

            switch($board_type){
                case "racket" : 
                    $where .= " where board_type = 'racket'";
                break;
                case "etc" :
                    $where .= " where board_type = 'etc'";
                break;
                case "cloth" :
                    $where .= " where board_type = 'cloth'";
                break;
                default : 
                    $where .= " where board_type LIKE '%%'";
                break;
            }

            switch($search_category){
                case "board_title" : 
                    $where .= " AND board_title LIKE '%{$search_contents}%'";
                break;
                case "board_contents" :
                    $where .= " AND board_contents LIKE '%{$search_contents}%'";
                break;
                case "user_name" :
                    $where .= " AND user_name LIKE '%{$search_contents}%'";
                break;
            }

            $limit = ($board_page - 1) * 5;

            $boardCount = $pdo->query("select * from board natural join user {$where}")->rowCount();
            if($boardCount > 0){
                $board_list = $pdo->query("select * from board natural join user {$where} order by board_no desc limit {$limit}, 5");
    
                while($board = $board_list->fetch(2)){
                    $board_no = $board["board_no"];
                    $commentCount = $pdo->query("select * from comment where board_no = '{$board_no}'")->rowCount();
        ?>
                    <?php
                        $date = $board["board_date"];
                        $dateVal = substr($date,0,10);
                    ?>
                    <tr>
                        <td><?php echo $board["board_no"]; ?></td>
                        <td><a href="boardView.php?board_no=<?php echo $board["board_no"] ?>"><span class="boardIndex"><?php echo "[".$board["board_index"]."]" ?></span> <?php echo $board["board_title"]." [".$commentCount."]"; ?></a></td>
                        <td><?php echo $board["user_name"]; ?></td>
                        <td><?php echo $dateVal; ?></td>
                        <td><?php echo $board["board_hit"]; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5">작성된 글이 없습니다.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
        $first_board_page = 1;
        $current_page = $board_page;
        $last_board_page = ceil($boardCount / 5);
        $prev_page = $current_page - 1;
        $next_page = $current_page + 1;
        $request_url = $_SERVER["REQUEST_URI"];

        if($request_url == "/"){
            $page_url = $request_url."?board_page=";
        } else {
            $page_url = $request_url."&board_page=";
        }
    ?>
        


    <div id="pagination">
        <div class="prevPage">
        <?php if($prev_page < $first_board_page) { ?>
            <a href="<?php echo $prev_page = "javascript:void(0)"; ?>">이전</a>
        <?php } else { ?>
            <a href="<?php echo $page_url.$prev_page; ?>">이전</a>
        <?php } ?>
        </div>
        <ul>
            <?php if($last_board_page == 0){ ?>
                <li><a href="javascript:void(0)" class="currentPage">[1]</a></li>
            <?php
                } else {    
                    for($i = 1; $i <= $last_board_page; $i++){
            ?>
                <li><a href="<?php echo $page_url.$i; ?>" <?php if($current_page == $i) echo "class='currentPage'" ?>>[<?php echo $i; ?>]</a></li>
                <?php } ?>
            <?php } ?>
        </ul>
        <div class="nextPage">
        <?php if($next_page  > $last_board_page) { ?>
            <a href="<?php echo $prev_page = "javascript:void(0)"; ?>">다음</a>
        <?php } else { ?>
            <a href="<?php echo $page_url.$next_page; ?>">다음</a>
        <?php } ?>
        </div>
    </div>

    <div id="search">
        <div class="searchArea">
            <form action="/" method="GET">
                <input type="hidden" name="board_type" value="<?php echo $board_type; ?>">
                <div class="searchCategory">
                    <select name="search_category">
                        <option value="board_title" <?php if($search_category == "board_title") echo "selected"; ?>>제목</option>
                        <option value="board_contents" <?php if($search_category == "board_contents") echo "selected"; ?>>내용</option>
                        <option value="user_name" <?php if($search_category == "user_name") echo "selected"; ?>>작성자</option>
                    </select>
                </div>
                <div class="searchContents">
                    <input type="text" name="search_contents" value="<?php echo $search_contents; ?>">
                </div>
                <div class="searchBtn">
                    <button type="submit">검색</button>
                </div>
            </form>
        </div>
        <?php if($_SESSION["user_no"]){ ?>
        <div class="writeBtn">
            <button type="button" onClick="link('boardWrite.php')">글쓰기</button>
        </div>
        <?php } ?>
    </div>
</div>