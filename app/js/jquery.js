$(document).ready(function() {

    //Screen overs
    $(".socialbtn").click(function() {
        $(".socialScreenUp").animate({top: "0"});
    });
    $(".closeDown").click(function() {
        $(".socialScreenUp").animate({top: "100%"});
    });

    //grid maken
    for (var i = 0; i < 100; i++)
    {
        $("section.map").append("<div class='part'><div class='overlay'></div><div class='background'></div></div>");
    }

    $('.part').click(function(){
        $(this).find(".overlay").hide();
    });

});