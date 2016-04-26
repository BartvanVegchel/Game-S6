$userName = localStorage.getItem('userInfo');
$worldId = 2;

console.log('functions ingeladen voor ' + $userName);

// getEnergyPoints function
function getEnergypoints(){
    var dataString="username="+$userName+"&submit=";
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

// getUnlockedFields function
function getUnlockedFields(){
    var dataString="username="+$userName+"&submit=";
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

function unlockFunction(id, element){
    //get the parameters from the function inside buildMap function
    $fieldId = id;
    $clickedelement = element;

    //get the costs and personal energypoints
    $price = parseInt($clickedelement.attr('data-energy'));
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
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Oke",
            cancelButtonText: "Nee",
            html: true
        }, function () {
            $.ajax(
                {
                    type: "get",
                    url: "http://game.onlineops.nl/phonegap_php/unlockFields.php",
                    data: {'fieldid': $fieldId , 'dataenergy': $price, 'id': $worldId, 'username' : $userName},
                    timer: 2000,
                    success: function (data) {
                    }
                }
                )
                .done(function (data) {
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
}// end .locked click


function unlockMonsters(monstername){
    alert('monster klik' + monstername);
    $monsterName = monstername
    $monsterNameLowerCase = $monsterName.toLowerCase();

    swal({
            title: $monsterName,
            text: "Speel "+$monsterName+" nu vrij",
            imageUrl: "images/monster_"+$monsterNameLowerCase+".png",
            confirmButtonText: "Start",
            showCancelButton: true,
            cancelButtonText: "Nu niet",
        },
        function(){
            window.location.href = 'monster_challenge.html?monstername='+$monsterName;
        });
}

function buildMap(){
    var dataString="worldid="+$worldId+"&username="+$userName+"&submit=";
    if(localStorage.getItem('userInfo') !== null) {
        $.ajax({
            type: "POST",
            url: "http://game.onlineops.nl/phonegap_php/buildMap.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            success: function (data) {
                $(".map-container").html(data);
                countClickItems();

                //unlock field
                $(".locked").click(function(){
                    $fieldId = $(this).parent().attr("id");
                    $element = $(this);
                    unlockFunction($fieldId, $element);
                });

                //unlock monsters
                $('img.monsterEgg').click(function() {
                    $monsterName = $(this).attr('monster-name');
                    unlockMonsters($monsterName);
                });
            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
}


document.addEventListener("deviceready",onDeviceReady,false);

function onDeviceReady(){
    buildMap();
}

function countClickItems(){
    var numItems = $('.locked').length;
    //alert(numItems);
}

    $(window).load(function() {
        $(".world-name").click(function(){
            localStorage.clear();
            window.location.href = "inloggen.html";
        });

        console.log( "ready!");
    });