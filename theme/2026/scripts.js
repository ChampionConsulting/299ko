/**
 * @copyright (C) 2022, Champion CMS
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Andrew Champion <a.champion@championconsultingl.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */

$(document).ready(function () {
    $('#mobile_menu').click(function () {
        if ($('#navigation').css('display') == 'none') {
            $('#navigation').animate({
                width: "toggle"
            });
        } else {
            $('#navigation').animate({
                width: "toggle"
            });
        }
    });
    var pathname = window.location.href.split('#')[0];
    $('a[href^="#"]').each(function () {
        var $this = $(this),
                link = $this.attr('href');
        $this.attr('href', pathname + link);
    });

    $(".msg").each(function (index) {
        $(this).children(".msg-button-close").click(function () {
            $(this).parent().dequeue();
        });
        $(this).delay(5000 + index * 5000).slideUp();
    });
});