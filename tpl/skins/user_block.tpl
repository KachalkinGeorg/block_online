<script>
function onlineHintInit() {
    $(".ionline").mouseleave(function(){
        $("#ionline_vis").hide();
    });
    $(".ionline a").hover(function(){
        if(!($("#ionline_vis").is(":visible"))) {
            $("#ionline_vis").show();
        }
        var postop = $(this).position().top - 105;
        var posleft = $(this).position().right - 245;
        var uhint = $(this).attr('udata');
        var uhint = uhint.replace(/\[\[quot\]\]/g, '"');
        $("#ionline_vis").stop().html(uhint).animate({
            top:postop,
            left:posleft
        }, 'normal');
    });
}
$(function(){
    onlineHintInit();
});
var hidecomm = [], rateval = 0, oright = 0, otop = 0;
</script>

<div class="ionline">
<div id="ionline_vis"></div>

<text style="color: rgba(133, 153, 0, 1);">Сейчас на сайте:</text> {sum_count}<br />
<text style="color: rgba(133, 153, 0, 1);">Гостей:</text> {guest_count}<br />
<text style="color: rgba(133, 153, 0, 1);">Роботов:</text> {bot_count}<br />
<text style="color: rgba(133, 153, 0, 1);">Пользователей:</text> {user_count}<br />

<center><font style="color: rgba(14, 144, 210, 1);"> ‹---☢---› </font></center>

<text style="color: rgba(133, 153, 0, 1);">Пользователи:</text> {online_user}<br />
<text style="color: rgba(133, 153, 0, 1);">Роботы:</text> {online_bot}<br />

<center><font style="color: rgba(14, 144, 210, 1);"> ‹---☢---› </font></center>

<br />
<div style="text-transform:uppercase;text-align: center;position:relative;">&nbsp;Последние посетители&nbsp;</div>
<br />
{online_user_list}
<div style="clear:both"></div>
<br />
<div style="clear:both"></div>
<br />
<div style="text-transform:uppercase;text-align: center;position:relative;">&nbsp;Сегодня нас посетили&nbsp;</div>
<br />
{online_user_vizit}
<div style="clear:both"></div>
<br />
<br />		
</div>			