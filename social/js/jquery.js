$(document).ready(function() {


    $(function(){
        $(".social_text p").each(function(i){
            len=$(this).text().length;
            if(len>30)
            {
                $(this).text($(this).text().substr(0,30)+'...');
            }
        });
    });

    $(function(){
        $("section.blog .panel-body p").each(function(i){
            len=$(this).text().length;
            if(len>150)
            {
                $(this).text($(this).text().substr(0,150)+'...');
            }
        });
    });



});