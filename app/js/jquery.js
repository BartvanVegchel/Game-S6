$(document).ready(function() {

    //Screen overs
    $(".socialbtn").click(function() {
        $(".socialScreenUp").animate({top: "0"});
    });
    $(".closeDown").click(function() {
        $(".socialScreenUp").animate({top: "100%"});
    });



    $('.locked').click(function() {
        $fieldId = $(this).parent().attr("id");
        $parentItem = $(this).parent();

        swal({  title: "Weet je zeker dat je dit wilt kopen?",
                text: "",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
        }, function(){
            $.ajax(
                {
                    type: "get",
                    url: "http://localhost:8888/Game-S6/app/functions/unlock_function.php",
                    data: {"fieldid":$fieldId},
                    success:function(data){
                    }
                }
            )
            .done(function(data) {
                swal("Gefeliciteerd!", "Je bent weer een stapje verder in het ontdekken van deze wereld", "success");

                $('#'+$fieldId).find('.locked').removeClass('locked');
            })
                .error(function(data) {
                    swal("Oops", "We couldn't connect to the server!", "error");
                });
        });
    });
});
