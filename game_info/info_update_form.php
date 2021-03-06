<?php 
session_start();
    //설정한 지역의 시간대로 설정
    date_default_timezone_set("Asia/Seoul");
    require $_SERVER['DOCUMENT_ROOT'] . "/a4b1/common/lib/db.mysqli.class.php";
    include $_SERVER['DOCUMENT_ROOT']."/a4b1/common/lib/submit_function.php";
    //싱글톤 객체 불러오기
    $db = DB::getInstance();
    $dbcon = $db->connector();

    //세션 값 이용 관리자 인지 파악하기
    if (!isset($_SESSION['admin'])||!isset($_SESSION['id']) || $_SESSION['admin'] < 1) {
        alert_back("권한이 없습니다.");
    }
    $num = $_GET['num'];
    $sql = "SELECT * from `game_info` where num = $num";
    $result = mysqli_query($dbcon,$sql) or die("update_form_error1 : ".mysqli_error($dbcon));
    while($row = mysqli_fetch_array($result)){
        $num = $row['num'];
        $name = $row['name'];
        $content = $row['content'];
        $developer = $row['developer'];
        $grade = $row['grade'];
        $release_date = $row['release_date'];
        $price = intval($row['price']);
        $homepage = $row['homepage'];
        $service_kor = $row['service_kor'];
        $circulation = $row['circulation'];
        $image = $row['image'];
        $created_by = $row['created_by'];
        $created_at = $row['created_at'];
    }
    $sql = "SELECT * from `game_info_genre` where `info_num` = $num";
        $result = mysqli_query($dbcon, $sql) or die("list select error3 : " . mysqli_error($dbcon));
        $genre=null;
        while($row1 = mysqli_fetch_array($result)){
            if($genre == null){
                $genre = $row1['genre'];
            }else{
                $genre = $genre.",".$row1['genre'];
            }  
        }
        $platform=null;
        $sql = "SELECT * from `game_info_platform` where `info_num` = $num";
        $result = mysqli_query($dbcon, $sql) or die("list select error4 : " . mysqli_error($dbcon));
        while($row2 = mysqli_fetch_array($result)){
            if($platform == null){
                $platform = $row2['platform'];
            }else{
                $platform = $platform.",".$row2['platform'];
            }
         }
        $screen=null;
        $sql = "SELECT * from `game_info_files` where `info_num` = $num";
        $result = mysqli_query($dbcon, $sql) or die("list select error4 : " . mysqli_error($dbcon));
        while($row3 = mysqli_fetch_array($result)){
            if($screen == null){
                $screen = $row3['name'];
            }else{
                $screen = $screen.",".$row3['name'];
            }
         }
         mysqli_close($dbcon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게임 정보 수정 양식</title>
    <!--Jquery 추가-->
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/a4b1/common/js/jquery/jquery-3.5.1.min.js?ver=1"></script>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/a4b1/common/css/common.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/a4b1/game_info/css/game_info_form.css">
    <script src="http://<?=$_SERVER['HTTP_HOST']?>/a4b1/common/js/common.js?ver=1"></script>
    <script src="./js/info.js"></script>
    <!--alert & toastr 라이브러리 추가-->
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] ?>/a4b1/common/css/toastr/toastr.min.css?ver=1" />
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/a4b1/common/js/toastr/toastr.min.js?ver=1"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST'] ?>/a4b1/common/js/sweetalert/sweetalert.min.js?ver=1"></script>
</head>

<body id="body">
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT']."/a4b1/common/lib/header.php";?>
    </header>
    <div id="form_container">
    <!-- 파일을 보내기위한 인코딩 방식 설정 -->
    <form action="game_info_update.php?num=<?=$num?>" method="post" enctype="multipart/form-data" id="insert_form">
    <h1>게임 정보 수정하기</h1>
        <ul>
            <li>
                <label for="title_image" class="subject">타이틀 이미지</label>
                <br>
                <input type="file" name="title_image" id="title_image" accept="image/*" onchange="file_check(this)">
                <?php
                    if($image != null){
                ?>
                <span>기존 첨부파일 :<?=$image?></span>
                <label for="file">기존 이미지 삭제</label>
                <input type="checkbox" name="title_select" id="title_select" value="check">
                <?php
                }
                ?>
            </li>

            <br>
            <li>
                <label for="name" class="subject">게임 명</label>
                <br>
                <input type="text" name="name" id="name" value="<?=$name?>">
                <br>
                <br>
                <label for="developer" class="subject">개발사</label>
                <br>
                <input type="text" name="developer" id="developer" value="<?=$developer?>">
            </li>
            
            <br>
            <li>
                <label for="platform" class="subject">플랫폼</label>
                <br>
                <label>PS3<input type="checkbox" name="platform[]" value="PS3" id="PS3"></label>
                <label>PS4<input type="checkbox" name="platform[]" value="PS4" id="PS4"></label>
                <label>PS5<input type="checkbox" name="platform[]" value="PS5" id="PS5"></label>
                <label>XBOX 360<input type="checkbox" name="platform[]" value="XBOX 360" id="XBOX 360"></label>
                <label>XBOX one<input type="checkbox" name="platform[]" value="XBOX ONE" id="XBOX one"></label>
                <label>nintendo switch<input type="checkbox" name="platform[]" value="NINTENDO SWITCH" id="nintendo switch"></label>
                <script>platform_check('<?=$platform?>')</script>
            </li>

            <br>
            <li>
                <label for="genre" class="subject">장르</label>
            </li>
            <li>
                <label>액션<input type="checkbox" name="genre[]" value="액션" id="act"></label>
                <label>공포<input type="checkbox" name="genre[]" value="공포" id="fear"></label>
                <label>어드밴처<input type="checkbox" name="genre[]" value="어드밴처" id="adv"></label>
                <label>롤플레잉<input type="checkbox" name="genre[]" value="롤플레잉" id="roll"></label>
            </li>
            <li>
                <label>스포츠<input type="checkbox" name="genre[]" value="스포츠" id="sport"></label>
                <label>레이싱<input type="checkbox" name="genre[]" value="레이싱" id="rac"></label>
                <label>음악<input type="checkbox" name="genre[]" value="음악" id="music"></label>
                <label>퍼즐<input type="checkbox" name="genre[]" value="퍼즐" id="puzzle"></label>
            </li>
            <script>genre_check('<?=$genre?>')</script>
            <br>
            <li>
                <label for="open_day" class="subject">출시일자</label>
                <br>
                <input type="date" name="open_day" id="open_day" value="<?=$release_date?>">
            </li>
            <br>
            <li>
                <span class="subject">심의등급</span>
                <br>
                
                <label for="all">전체이용가<input type="radio" name="grade" id="all" value="전체이용가"></label>
                <label for="12">12세이용가<input type="radio" name="grade" id="12" value="12세이용가"></label>
                <label for="15">15세이용가<input type="radio" name="grade" id="15" value="15세이용가"></label>
                <label for="18">청소년이용불가<input type="radio" name="grade" id="18" value="청소년이용불가"></label>
                <label for="empty">등급면제<input type="radio" name="grade" id="empty" value="등급면제"></label>
                <label for="test_ver">테스트용<input type="radio" name="grade" id="test_ver" value="테스트용"></label>
                <script>grade_check('<?=$grade?>')</script>
            </li>

            <br>
            <li>
                <label for="circulation" class="subject">유통사</label>
                <br>
                <input type="text" name="circulation" id="circulation" value="<?=$circulation?>">
                <br>
                <br>
                <label for="price" class="subject">가격</label>
                <br>
                <input type="number" name="price" id="price" value="<?=$price?>">
            </li>
            <br>
            <li>
                <label for="service_kor" class="subject">한국어 지원</label>
                <br>
                <label for="service_kor">지원 <input type="radio" name="service_kor" id="service_kor1" value="1"></label>
                <label for="service_kor">미 지원 <input type="radio" name="service_kor" id="service_kor0" value="0"></label>
                <script>service_kor_check('<?=$service_kor?>')</script>
            </li>
            <br>
            <li>
                <label for="homepage" class="subject">공식 홈페이지</label>
                <br>
                <input type="text" name="homepage" id="homepage" value="<?=$homepage?>">
            </li>
            <br>
            <li>
                <label for="content" class="subject">게임 개요</label>
                <br>
                <textarea name="content" id="content" cols="100" rows="10"><?=$content?></textarea>
            </li>
            <li>
                <label for="screen_shot" class="subject">게임 내 스크린 샷</label>
                <br>
                <input type="file" name="screen_shot[]" id="screen_shot" multiple accept="image/*" onchange="file_check(this)">
                <br>
                <br>
                <?php
                    if($screen != null){
                ?>
                <span>기존 첨부파일</span>
                <br>
                <span id="screen_content"><?=$screen?></span>
                <br>
                <label for="file">기존 이미지 삭제</label>
                <input type="checkbox" name="screen_select" id="screen_select" value="check">
                <?php
                    }
                ?>
            </li>
        </ul>
        <?php if(intval($_SESSION['admin']) >= 1){?>
            <div id="div_b">
                <button onclick="history.go(-1)" type="button">뒤로가기</button>
                <button onclick="check_input()" type="button">수정하기</button>
            </div>
        <?php } ?>
    </form>
    </div>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/a4b1/common/lib/footer.php"; ?>
    </footer>
</body>

</html>