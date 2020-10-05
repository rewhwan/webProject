<?php
require $_SERVER['DOCUMENT_ROOT']."/a4b1/common/lib/db.mysqli.class.php";
//싱글톤 객체 불러오기
$db = DB::getInstance();
$db->sessionStart();
?>
<!doctype html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <title>게임정보</title>
        <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/a4b1/common/css/common.css?ver=1">
    </head>
    <body>
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT']."/a4b1/common/lib/header.php";?>
        </header>
        게임정보 입니다.
    </body>
</html>