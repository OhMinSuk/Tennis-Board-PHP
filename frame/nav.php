<!-- HEADER -->
<header id="header">
    <div class="wrap">
        <!-- LOGO -->
        <h1 id="logo"><a href="/" title="HOME">테니스 용품 중고거래 게시판</a></h1>

        <ul id="util">
            <?php if(isset($_SESSION['user_no'])){ ?>
                <li><strong><?php echo $_SESSION['user_name'] ?></strong> 님 환영합니다.</li>
                <li><a href="../logout.php"><strong>로그아웃</strong></a></li>
            <?php } else { ?>
                <li><a href="../login.php">로그인</a></li>
                <li><a href="../join.php">회원가입</a></li>
            <?php } ?>
        </ul>

        <nav id="menu">
            <ul class="menu">
                <li><a href="/?board_type=racket">테니스 라켓</a></li>
                <li><a href="/?board_type=etc">테니스 용품</a></li>
                <li><a href="/?board_type=cloth">테니스 의류</a></li>
            </ul> 
        </nav>
    </div>
</header>