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

        $price = parseInt($(this).attr('data-energy'));
        $personalEnergy = $('.personalEnergypoints').find('strong');
        $personalEnergyValue = $($personalEnergy).text();
        console.log('energy is' + $price);

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
                            success: function (data) {
                            }
                        }
                    )
                    .done(function (data) {
                        swal("Gefeliciteerd!", "Je bent weer een stapje verder in het ontdekken van deze wereld", "success");

                        $('#' + $fieldId).find('.locked').removeClass('locked');
                        $updatedEnergyPoints = $personalEnergyValue - $price;
                        $personalEnergy.text($updatedEnergyPoints);
                    })
                    .error(function (data) {
                        swal("Oeps", "We denken dat er iets verkeerd is gegaan.", "error");
                    });
            });
        } else{
            sweetAlert("Oeps...", "Je hebt niet voldoende energypoints!", "error");
        }
    });
});
