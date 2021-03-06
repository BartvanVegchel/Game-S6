$(document).ready(function() {

    //Screen overs
    $(".socialbtn").click(function() {
        $(".socialScreenUp").animate({top: "0"});
    });
    $(".closeDown").click(function() {
        $(".socialScreenUp").animate({top: "100%"});
    });


    //hide townhall popup
    //$('.popup').hide();

    // show townhall popup
    $('div.part .townhallbackground img').click(function(){
        $('.popup.monsters').show("fast");
    });

    // show worlds popup
    // uit voor de test
    //$('.pinda').click(function(){
        //$('.popup.worlds').show("fast");
    //});

    //hide popup
    $('.popup a').click(function(){
        $('.popup').hide("fast");
    });


    $('.locked').click(function() {
        //get the right divs
        $fieldId = $(this).parent().attr("id");
        $parentItem = $(this).parent();

        //get the costs and personal energypoints
        $price = parseInt($(this).attr('data-energy'));
        $personalEnergy = $('.personalEnergypoints').find('strong');
        $personalEnergyValue = $($personalEnergy).text();
        
        $personalUnlockedFields = $('.personalUnlockedFields').find('span.unlocked');
        $personalUnlockedFieldsValue = $($personalUnlockedFields).text();
        $personalUnlockedFieldsValueInt = parseInt($personalUnlockedFieldsValue);

        //if you have enough points
        if($personalEnergyValue >= $price) {
            swal({
                title: "Dit kost <i class='fa fa-bolt'></i> "+$price+" ",
                text: "",
                type: "",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Oke",
                cancelButtonText: "Nee",
                html: true
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

                        // unlocked fiedls
                        $updatedUnlockedFields = ($personalUnlockedFieldsValueInt + 1);
                        $personalUnlockedFields.text($updatedUnlockedFields);
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

    //monster updaten
    // $('img.monsterEgg').click(function() {
    //     $monsterName = $(this).attr('monster-name');
    //     $monsterNameLowerCase = $monsterName.toLowerCase();
    //     $parentId = $(this).parent().parent().attr('id');
    //     swal({
    //         title: $monsterName,
    //         text: "Je hebt "+$monsterName+" toegevoegd aan je collectie!",
    //         type: "",
    //         imageUrl: "images/monster_"+$monsterNameLowerCase+".png",
    //         showCancelButton: false,
    //         closeOnConfirm: true,
    //         showLoaderOnConfirm: true,
    //         confirmButtonText: "Super!"
    //     }, function () {
    //         $.ajax(
    //                 {
    //                     type: "get",
    //                     url: "functions/update_monsters.php",
    //                     data: {'monstername': $monsterName},
    //                     success: function (data) {}
    //                 }
    //             )
    //             .done(function (data) {
    //                 console.log($parentId);
    //                 $('#' + $parentId).find('.monsterEgg').hide();
    //                 $('#' + $parentId).find('.monsterbackground').append('<img src="images/egg_'+$monsterNameLowerCase+'_broken.png" monster-name='+$monsterName+'>');
    //             })
    //             .error(function (data) {
    //                 swal("Oeps", "We denken dat er iets verkeerd is gegaan.", "error");
    //             });
    //     });
    // });//end monsterEgg clicked
});
