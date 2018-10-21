$(document).ready(function()
{
    var showCharLimit = 300;
    var endingText = '...';
    var moreText = 'Show more';
    var lessText = 'Show less';

    $(".expandableText").each(function()
    {
        var content = $(this).html();

        if (content.length > showCharLimit)
        {
            var less = content.substr(0, showCharLimit);
            var more = content.substr(showCharLimit, content.length - showCharLimit);

            var html = less + '<span class="moreexpandableending">' + endingText + '</span><span class="moreexpandablecontent"><span>'+ more +'</span> <a href="" class="moreexpandablelink text-muted">'+ moreText +'</a></span>';
            $(this).html(html);
        }
    });

    $('.moreexpandablelink').click(function()
    {
        if ($(this).hasClass("more"))
        {
            $(this).removeClass("more");
            $(this).html(lessText);
        }
        else
        {
            $(this).addClass("more");
            $(this).html(moreText);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});