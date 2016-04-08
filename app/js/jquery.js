$(document).ready(function() {

    //Screen overs
    $(".socialbtn").click(function() {
        $(".socialScreenUp").animate({top: "0"});
    });
    $(".closeDown").click(function() {
        $(".socialScreenUp").animate({top: "100%"});
    });


    $('.locked').click(function() {
        //get the right divs
        $fieldId = $(this).parent().attr("id");
        $parentItem = $(this).parent();

        //get the costs and personal energypoints
        $price = parseInt($(this).attr('data-energy'));
        $personalEnergy = $('.personalEnergypoints').find('strong');
        $personalEnergyValue = $($personalEnergy).text();

        //if you have enough points
        if($personalEnergyValue >= $price) {
            swal({
                title: "Weet je zeker dat je dit wilt kopen?",
                text: "",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                $.ajax(
                        {
                            type: "get",
                            url: "functions/unlock_function.php",
                            data: {'fieldid': $fieldId , 'dataenergy': $price},
                            timer: 2000,
                            success: function (data) {
                            }
                        }
                    )
                    .done(function (data) {
                        //swal("Goed zo!", "", "success","timer:"+2000);
                        swal({
                            title: "Goed zo!",
                            text: "",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                            });

                        //show image, remove locked block
                        $('#' + $fieldId).find('.locked').next('div').find('img').show();
                        $('#' + $fieldId).find('.locked').removeClass('locked');
                        $updatedEnergyPoints = $personalEnergyValue - $price;
                        $personalEnergy.text($updatedEnergyPoints);
                    })
                    .error(function (data) {
                        swal("Oeps", "We denken dat er iets verkeerd is gegaan.", "error");
                    });
            });
        }
        // if you dont have enough points
        else{
            sweetAlert("Oeps...", "Je hebt niet voldoende energypoints!", "error");
        }
    }); // end .locked click

    $('.monsterEgg').click(function() {
        $monsterName = $(this).attr('monster-name');
        swal({
            title: $monsterName,
            text: "Hallo vriendje!",
            imageUrl: "images/monster_"+$monsterName+".png"
        })

    });
});
