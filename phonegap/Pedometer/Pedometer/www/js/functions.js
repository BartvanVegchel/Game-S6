$userName = localStorage.getItem('userInfo');
$worldId = localStorage.getItem('worldId');

if(localStorage.getItem('worldId') == null){
    $worldId = 1;
    console.log('geen worldId gezet');
} else{
    $worldId = localStorage.getItem('worldId');
    console.log('worldId ' + $worldId +' gezet');
}

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
    var dataString="username="+$userName+"&worldid="+$worldId+"&submit=";
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


//unlock elements
function unlockFunction(id, element){
    //get the parameters from the function inside buildMap function
    $fieldId = id; // get id of clicked parent-element
    $clickedelement = element; //get clicked div

    $price = parseInt($clickedelement.attr('data-energy')); //get price of element
    $personalEnergy = $('.personalEnergypoints'); // get personal energypoints box
    $personalEnergyValue = $($personalEnergy).text(); // get personal energypoints value

    $personalUnlockedFields = $('.personalUnlockedFields').find('span.unlocked'); // unlocked fields box
    $personalUnlockedFieldsValue = $($personalUnlockedFields).text(); // unlocked fields box value
    $personalUnlockedFieldsValueInt = parseInt($personalUnlockedFieldsValue); // convert value to integer

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

                    $updatedEnergyPoints = $personalEnergyValue - $price; //the new energypoints value
                    $personalEnergy.text($updatedEnergyPoints); //set the new value

                    // unlocked fiedls
                    $updatedUnlockedFields = ($personalUnlockedFieldsValueInt + 1); //unlockedfields value update
                    $personalUnlockedFields.text($updatedUnlockedFields); // set the new value
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


// function unlockMonsters(monstername){
//     $monsterName = monstername
//     $monsterNameLowerCase = $monsterName.toLowerCase();
//
//     swal({
//         title: $monsterName,
//         text: "Speel "+$monsterName+" nu vrij",
//         imageUrl: "images/monster_"+$monsterNameLowerCase+".png",
//         confirmButtonText: "Start",
//         showCancelButton: true,
//         cancelButtonText: "Nu niet",
//     },
//     function(){
//         window.location.href = 'challenge.html?monstername='+$monsterName;
//     });
// }

function dailyChallenge(name, id, description, time, reward){
    $name = name;
    $monsterName = '';//empty for check on challenge.html
    $reward = reward;
    $challengeId = id;
    $description = description
    $time = time;

    swal({
            title: "Dagelijkse uitdaging",
            text: $name,
            confirmButtonText: "Start",
            showCancelButton: true,
            cancelButtonText: "Nu niet",
        },
        function(){
            window.location.href = 'challenge.html?monstername='+$monsterName+'&challengeId='+$challengeId+'&challengeName='+$name+'&time='+$time+'&reward='+$reward+'&description='+$description;
        });
}

function monsterChallenge(monstername, name, id, description, time, clicktype){
    $name = name;
    $monsterName = monstername;
    $monsterNameLowerCase = $monsterName.toLowerCase();
    $reward = '';//empty for check on challenge.html
    $challengeId = id;
    $description = description
    $time = time;
    $clickType = clicktype;

    if($clickType == 'monsterEgg') {
        swal({
                title: $monsterName,
                text: "Speel " + $monsterName + " nu vrij",
                imageUrl: "img/monster_" + $monsterNameLowerCase + ".png",
                confirmButtonText: "Start",
                showCancelButton: true,
                cancelButtonText: "Nu niet",
            },
            function () {
                window.location.href = 'challenge.html?monstername=' + $monsterName + '&challengeId=' + $challengeId + '&challengeName=' + $name + '&time=' + $time + '&description=' + $description;
            });
    } else{
        window.location.href = 'challenge.html?monstername=' + $monsterName + '&challengeId=' + $challengeId + '&challengeName=' + $name + '&time=' + $time + '&description=' + $description;
    }
}

function getMonsterChallengeInfo(monstername, clicktype){
    $monsterName = monstername;
    $clickType = clicktype;

    var dataString = "monsterName=" + $monsterName + "&submitMonster=";
    $.ajax({
        type: "POST",
        url: "http://game.onlineops.nl/phonegap_php/getDailyChallenge.php",
        data: dataString,
        crossDomain: true,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data['error'] == "error") {
                //do nothing
            } else if (data['description'] !== "") {
                //get the data
                $name = data['name'];
                $description = data['description'];
                $time = data['timelimit'];
                $monsterId = data['id'];
            }
        }
    }).done(function (data) {
        monsterChallenge($monsterName, $name, $monsterId, $description, $time, $clickType);
    })
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

                // click event for locked field
                $(".locked").click(function(){
                    $fieldId = $(this).parent().attr("id");
                    $element = $(this);
                    unlockFunction($fieldId, $element); // call function with params
                });

                // click event for locked monsters
                // $('img.monsterEgg').click(function() {
                //     $monsterName = $(this).attr('monster-name');
                //     unlockMonsters($monsterName); // call function with param
                // });

                $('img.monsterEgg').click(function () {
                    $monsterName = $(this).attr('monster-name');
                    $clickType = 'monsterEgg';
                    getMonsterChallengeInfo($monsterName, $clickType);
                });//end monsterEgg click
            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
}


document.addEventListener("deviceready",onDeviceReady,false);// call first function if device is ready

function onDeviceReady() {
    buildMap(); //build map if device is ready
    getEnergypoints(); //set energypoints in div
    getUnlockedFields(); //set unlocked fields in div
    //getWorlds(); //set worlds in div menu

    $('.dailyChallenge').click(function () {
        $date = new Date();
        $day = $date.getDate();

        var dataString="currentday="+$day+"&submitDaily=";
        $.ajax({
            type: "POST",
            url: "http://game.onlineops.nl/phonegap_php/getDailyChallenge.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data['error'] == "error") {
                    //do nothing
                } else if (data['description'] !== "") {
                    //get the data
                    $name = data['name'];
                    $description = data['description'];
                    $time = data['timelimit'];
                    $reward = data['reward'];
                }
            }
        }).done(function (data) {
            dailyChallenge($name, $day, $description, $time, $reward);
        })
    });
}

function countClickItems(){
    var numItems = $('.locked').length;
}

$(window).load(function() {
    $(".world-name").click(function(){
        localStorage.clear();
        window.location.href = "inloggen.html";
    });
    console.log('ja');



    console.log( "ready!");
});


//callable function for get vars out of url in jquery
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

//countdown
function Countdown(options) {
    var timer,
        instance = this,
        seconds = options.seconds || 10,
        updateStatus = options.onUpdateStatus || function () {},
        counterEnd = options.onCounterEnd || function () {};

    function decrementCounter() {
        updateStatus(seconds);
        if (seconds === 0) {
            counterEnd();
            instance.stop();
        }
        seconds--;
    }

    this.start = function () {
        clearInterval(timer);
        timer = 0;
        seconds = options.seconds;
        timer = setInterval(decrementCounter, 1000);
    };

    this.stop = function () {
        clearInterval(timer);
    };
}

function createElements(){
    $elementsAccelerometer = '<div class="app">' +
        '<h1>PhoneGap</h1>' +
        '<div id="deviceready" class="blink">' +
        '<p class="event listening">Connecting to Device</p>'+
        '<p class="event received">Device is Ready</p>' +
        '<div id="geefterug"></div>' +
        '</div>' +
        '</div>';
    $($elementsAccelerometer).insertAfter( $(".bottom-bar") );
}

function accelerometer() {
    function onSuccess(acceleration) {
        /*alert('Acceleration X: ' + acceleration.x + '\n' +
         'Acceleration Y: ' + acceleration.y + '\n' +
         'Acceleration Z: ' + acceleration.z + '\n' +
         'Timestamp: '      + acceleration.timestamp + '\n');*/
        var accel = 'Acceleration X: ' + acceleration.x + '\n' +
            'Acceleration Y: ' + acceleration.y + '\n' +
            'Acceleration Z: ' + acceleration.z + '\n' +
            'Timestamp: ' + acceleration.timestamp + '\n';
        document.getElementById('geefterug').innerHTML = accel;
    }

    function onError() {
        alert('onError!');
    }

    var options = {frequency: 3000};  // Update every 3 seconds

    var watchID = navigator.accelerometer.watchAcceleration(onSuccess, onError, options);

    navigator.accelerometer.getCurrentAcceleration(onSuccess, onError);
}

