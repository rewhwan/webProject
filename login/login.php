<?php
    require $_SERVER['DOCUMENT_ROOT']."/a4b1/common/lib/db.mysqli.class.php";

    //싱글톤 객체 불러오기
    $db = DB::getInstance();
    $db->sessionStart();
    $dbcon = $db->MysqliConnect();

    if(!isset($_POST['id']) || trim($_POST['id']) == '') {
        echo "<script>alert('아이디 값이 입력되지 않았습니다.');history.go(-1);</script>";
        return;
    }

    if(!isset($_POST['password']) || trim($_POST['password']) == '') {
        echo "<script>alert('패스워드 값이 입력되지 않았습니다.');history.go(-1);</script>";
        return;
    }

    $sql = "SELECT * FROM members where id = '{$_POST['id']}' AND password = '{$_POST['password']}';";

    $result = mysqli_query($dbcon,$sql)or die('Error: ' . mysqli_error($dbcon));
    $row = mysqli_fetch_array($result);

    if(mysqli_num_rows($result) != 1) {
        echo "<script>alert('아이디와 비밀번호가 일치하지 않습니다.');history.go(-1);</script>";
    }else {
        $_SESSION['id'] = $row['id'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['admin'] = $row['admin'];

        echo "<script>alert('로그인에 성공했습니다!.\\n환영합니다! ".$_SESSION['id']."님');history.go(-2);</script>";
    }