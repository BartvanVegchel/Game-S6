$userId = localStorage.getItem('userInfo');
$worldId = 2;

console.log('functions ingeladen voor ' + $userId);

function getEnergypoints(){
    var dataString="username="+$userId+"&submit=";
    if(localStorage.getItem('userInfo') !== null) {
        $.ajax({
            type: "POST",
            url: "http://game.onlineops.nl/phonegap_php/getEnergypoints.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data['error'] == "error") {// if register is succesfull
                    alert("error");
                    $(".personalEnergypoints").html(0);
                } else if (data['energypoints'] !== "") {
                    $(".personalEnergypoints").html(data['energypoints']);
                }
            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
}

function getUnlockedFields(){
    var dataString="username="+$userId+"&submit=";
    if(localStorage.getItem('userInfo') !== null) {
        $.ajax({
            type: "POST",
            url: "http://game.onlineops.nl/phonegap_php/getUnlockedFields.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data['error'] == "error") {// if register is succesfull
                    alert("error");
                    $(".personalUnlockedFields").html("0 / 0");
                } else if (data['energypoints'] !== "") {
                    $(".personalUnlockedFields").html("<span class='unlocked'>" + data['unlockedfields'] + "</span>/" + data['worldsize']);
                }
            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
}

function buildMap(){
    var dataString="worldid="+$worldId+"&username="+$userId+"&submit=";
    if(localStorage.getItem('userInfo') !== null) {
        $.ajax({
            type: "POST",
            url: "http://game.onlineops.nl/phonegap_php/buildMap.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            success: function (data) {
                $(".map-container").html(data);

            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
}

$(document).ready(function() {
    //alert('hier');
    var numItems = $('.world-progress').length;

    console.log( "ready!" + numItems );
    $('body').on('click', '.locked', function () {
            //get the right divs
            $fieldId = $(this).parent().attr("id");
            $parentItem = $(this).parent();

            //get the costs and personal energypoints
            $price = parseInt($(this).attr('data-energy'));
            $personalEnergy = $('.personalEnergypoints');
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
                            url: "http://game.onlineops.nl/phonegap_php/unlockFields.php",
                            data: {'fieldid': $fieldId , 'dataenergy': $price, 'id': $worldId, 'username' : $userId},
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
                            $('#' + $fieldId).find('.locked').find('.fa').hide();
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
});