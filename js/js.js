/**
 * Created by ºÆ on 2016/5/19.
 */
(function(){
    $('#myTabs a').click(function () {
        var pos = $('#myTabs a').index(this);
        //console.log("pos",pos);
        $('#myTabs a').removeClass('bg-white').eq(pos).addClass('bg-white');
        $('.loginOrRegister > div').hide().eq(pos).show();
    });

    $('.navlist li').click(function(){
        $(this).siblings('li').removeClass('active').end().addClass('active');
    });

    $('.regBar,.loginBar').click(function(){
        var pos = $(this).parent().index(this);
        $('.loginOrRegister>div').eq(pos).removeClass('display-none').siblings('div').addClass('display-none');
    });

    $('.carousel').carousel();
})();