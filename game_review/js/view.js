window.onload = function() {
    $('.story span').click(function() {
        $(this).parent().children('span').removeClass('on');
        $(this).addClass('on').prevAll('span').addClass('on');
        $('#story').attr('value',$(".story .on").length);
        console.log($(".story .on").length);
        return false;
    });

    $('.graphic span').click(function() {
        $(this).parent().children('span').removeClass('on');
        $(this).addClass('on').prevAll('span').addClass('on');
        $('#graphic').attr('value',$(".graphic .on").length);
        console.log($(".graphic .on").length);
        return false;
    });
    $('.time span').click(function() {
        $(this).parent().children('span').removeClass('on');
        $(this).addClass('on').prevAll('span').addClass('on');
        $('#time').attr('value',$(".time .on").length);
        console.log($(".time .on").length);
        return false;
    });

    $('.difficulty span').click(function() {
        $(this).parent().children('span').removeClass('on');
        $(this).addClass('on').prevAll('span').addClass('on');
        $('#difficulty').attr('value',$(".difficulty .on").length);
        console.log($(".difficulty .on").length);
        return false;
    });
}