function logoutCheck(host) {
    let check = confirm("정말 로그아웃하시겠습니까?");
    if(check) location.href="http://"+host+"/a4b1/login/logout.php";
}

window.onscroll = function () {
    // 메뉴바 변수 적용
    var menu = document.getElementById("menu");
    var offsetTop = menu.offsetTop;
    var scrollTop = document.scrollingElement.scrollTop;

    // body 태그 변수 적용
    var body = document.getElementById("body");

    if(scrollTop > 20) {
        menu.classList.add("leftTopFixed");
        body.classList.add("bodyMenuFixed");
    } else {
        menu.classList.remove("leftTopFixed");
        body.classList.remove("bodyMenuFixed");
    }
}