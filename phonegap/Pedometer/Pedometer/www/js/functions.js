$userName = localStorage.getItem('userInfo');
$worldId = localStorage.getItem('worldId');

// check if worldId isset, else worldId = 1
if (localStorage.getItem('worldId') == null) {
    $worldId = 1;
    console.log('geen worldId gezet');
} else {
    $worldId = localStorage.getItem('worldId');
    console.log('worldId ' + $worldId + ' gezet');
} //end else localstorage WorlID

console.log('functions ingeladen voor ' + $userName);

// getEnergyPoints function and place in div element
function getEnergypoints() {
    var dataString = "username=" + $userName + "&submit=";

    if (localStorage.getItem('userInfo') !== null) {
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
}// end function getEnergyPoints

// getUnlockedFields function and place in div element
function getUnlockedFields() {
    var dataString = "username=" + $userName + "&worldid=" + $worldId + "&submit=";
    if (localStorage.getItem('userInfo') !== null) {
        $.ajax({
            type: "POST",
            url: "http://game.onlineops.nl/phonegap_php/getUnlockedFields.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data['error'] == "error") {// if register is succesfull
                    //alert("error");
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
} //end function getUnlockedFields


//function is called from the buildMap function with paramters of clicked element
function unlockFunction(id, element) {
    $fieldId = id; // get id of clicked parent-element
    $clickedelement = element; //get clicked div

    $price = parseInt($clickedelement.attr('data-energy')); //get price of element
    $personalEnergy = $('.personalEnergypoints'); // get personal energypoints box
    $personalEnergyValue = $($personalEnergy).text(); // get personal energypoints value

    $personalUnlockedFields = $('.personalUnlockedFields').find('span.unlocked'); // unlocked fields box where to place the new value
    $personalUnlockedFieldsValue = $($personalUnlockedFields).text(); // unlocked fields box value
    $personalUnlockedFieldsValueInt = parseInt($personalUnlockedFieldsValue); // convert value to integer

    //if you have enough points
    if ($personalEnergyValue >= $price) {
        swal({
            title: "Dit kost <i class='fa fa-bolt'></i> " + $price + " ",
            text: "",
            type: "",
            showCancelButton: true,
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            confirmButtonText: "Oke",
            cancelButtonText: "Nee",
            html: true,
            inputPlaceholder: "Write something"
        }, function () {
            $.ajax(
                {
                    type: "get",
                    url: "http://game.onlineops.nl/phonegap_php/unlockFields.php",
                    data: {'fieldid': $fieldId, 'dataenergy': $price, 'id': $worldId, 'username': $userName},
                    timer: 2000,
                    success: function (data) {
                    }
                }
            )
                .done(function (data) {
                    //show image, remove locked block
                    $('#' + $fieldId).find('.locked').next('div').find('img').show();
                    $('#' + $fieldId).find('.locked').find('.fa').animate({opacity: 0}, 1500);
                    $('#' + $fieldId).find('.locked').find('.fog').animate({opacity: 0}, 1500, function () {
                        $(this).hide();
                        $('#' + $fieldId).find('.locked').removeClass('locked');
                    });


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
    else {
        sweetAlert("Oeps...", "Je hebt niet voldoende energypoints!", "error");
    }
}//end function UnlockFunction


// popup screen for daily challenge
function dailyChallenge(name, id, description, time, reward) {
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
        function () {
            localStorage.setItem('dailyChallenge', $challengeId);
            window.location.href = 'challenge.html';
        });
} //end function dailyChallenge

function temporaryMonsterFunction(monstername){
    $monsterName = monstername;
    $monsterNameLowerCase = $monsterName.toLowerCase();


    //check if clicktype is from monsterEgg or monster-detail page
    swal({
            title: $monsterName,
            text: "Je hebt " + $monsterName + " ontdekt",
            imageUrl: "img/monster_" + $monsterNameLowerCase + ".png",
            confirmButtonText: "Oke",
            showCancelButton: false
        },
        function () {
            $.ajax(
                {
                    type: "get",
                    url: "http://game.onlineops.nl/phonegap_php/temporaryMonsterFunction.php",
                    data: {'monstername': $monsterName, 'username': $userName},
                    timer: 2000,
                    success: function (data) {
                    }
                }
            )
                .done(function (data) {
                    //alert('ontdekt');
                //show image, remove locked block
                    window.location.href = 'index.html';
                });

        });
}


//start monsterChallenge
// function monsterChallenge(monstername, name, id, description, time, clicktype) {
//     $name = name;
//     $monsterName = monstername;
//     $monsterNameLowerCase = $monsterName.toLowerCase();
//     $reward = '';//empty for check on challenge.html
//     $challengeId = id;
//     $description = description
//     $time = time;
//     $clickType = clicktype;
//
//     //check if clicktype is from monsterEgg or monster-detail page
//     if ($clickType == 'monsterEgg') {
//         swal({
//                 title: $monsterName,
//                 text: "Speel " + $monsterName + " nu vrij",
//                 imageUrl: "img/monster_" + $monsterNameLowerCase + ".png",
//                 confirmButtonText: "Start",
//                 showCancelButton: true,
//                 cancelButtonText: "Nu niet",
//             },
//             function () {
//                 localStorage.setItem('monsterChallenge', $challengeId);
//                 window.location.href = 'challenge.html';
//             });
//     } else {
//         localStorage.setItem('monsterChallenge', $challengeId);
//         window.location.href = 'challenge.html';
//     }
// } //end function monsterChallenge

//

// function getMonsterChallengeInfo(monstername, clicktype) {
//     $monsterName = monstername;
//     $clickType = clicktype;
//
//     var dataString = "monsterName=" + $monsterName + "&submitMonster=";
//     $.ajax({
//         type: "POST",
//         url: "http://game.onlineops.nl/phonegap_php/getDailyChallenge.php",
//         data: dataString,
//         crossDomain: true,
//         cache: false,
//         dataType: 'json',
//         success: function (data) {
//             if (data['error'] == "error") {
//                 //do nothing
//             } else if (data['description'] !== "") {
//                 //get the data
//                 $name = data['name'];
//                 $description = data['description'];
//                 $time = data['timelimit'];
//                 $monsterId = data['id'];
//             }
//         }
//     }).done(function (data) {
//         monsterChallenge($monsterName, $name, $monsterId, $description, $time, $clickType);
//     })
// } //end function getMonsterChallengeInfo

//Function for build the map
function buildMap() {
    var dataString = "worldid=" + $worldId + "&username=" + $userName + "&submit=";
    if (localStorage.getItem('userInfo') !== null) {
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
                $(".locked").click(function () {
                    $fieldId = $(this).parent().attr("id");
                    $element = $(this);
                    unlockFunction($fieldId, $element); // call function with params
                });

                $('img.monsterEgg').click(function () {
                    $monsterName = $(this).attr('monster-name');
                    //$clickType = 'monsterEgg';
                    //getMonsterChallengeInfo($monsterName, $clickType);
                    temporaryMonsterFunction($monsterName);

                });//end monsterEgg click

                $("div.transportbackground img").click(function () {
                    window.location.href = "worlds.html";
                });
            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
} //end function buildMap


document.addEventListener("deviceready", onDeviceReady, false); // call first function if device is ready

function onDeviceReady() {
    buildMap(); //build map if device is ready
    getEnergypoints(); //set energypoints in div
    getUnlockedFields(); //set unlocked fields in div
    //getWorlds(); //set worlds in div menu
} //end function onDeviceReady

function countClickItems() {
    var numItems = $('.locked').length;
} //end function countClickItems


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
}; // end getUrlParameter

//countdown
function Countdown(options) {
    var timer,
        instance = this,
        seconds = options.seconds || 10,
        updateStatus = options.onUpdateStatus || function () {
            },
        counterEnd = options.onCounterEnd || function () {
            };

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
} //end Countdown function

function createElements() {
    $elementsAccelerometer = '<div class="app">' +
        '<h1>PhoneGap</h1>' +
        '<div id="deviceready" class="blink">' +
        '<p class="event listening">Connecting to Device</p>' +
        '<p class="event received">Device is Ready</p>' +
        '<div id="geefterug"></div>' +
        '<div id="pedometerGeefterug"></div>' +
        '</div>' +
        '</div>';
    $($elementsAccelerometer).insertAfter($(".bottom-bar"));
    
    //get Pagetitle of div on page 
    $pageTitle = $("#pageTitle").html();
    
    //if is no pageTitle set Moving monsters as title
    if($pageTitle !== ""){
        $title = $pageTitle;
    } else{
        $title = 'Moving Monsters';
    }

    $('.sync a').attr( "href", "http://game.onlineops.nl/phonegap_php/startEnergypointsUpdate.php?username="+ $userName);
    $('.syncforChallenge').attr( "href", "http://game.onlineops.nl/phonegap_php/updateBeforeChallenge.php?username="+ $userName);


    $elementsTopBar = '<span class="world-name" id="number2">'+$title+'</span>';

    $($elementsTopBar).appendTo($(".top-bar"));

    $elementsBottomBar = '<ul>' +
        '<li>' +
        '<a href="index.html">' +
        '<div id="number5" class="circle">' +
        '<span class="fa fa-home"></span>' +
        '</div>' +
        '</a>' +
        '</li>' +
        '<li>' +
        '<a href="worlds.html">' +
        '<div id="number6" class="circle">' +
        '<span class="fa fa-rocket"></span>' +
        '</div>' +
        '</a>' +
        '</li>' +
        '<li>' +
        '<a href="monsters.html">' +
        '<div id="number7" class="circle">' +
        '<span class="fa fa-monster"></span>' +
        '</div>' +
        '</a>' +
        '</li>' +
        '<li> ' +
        '<a href="user.html">' +
        '<div id="number8" class="circle">' +
        '<span class="fa fa-user"></span>' +
        '</div>' +
        '</a>' +
        '</li>' +
        '</ul>';
    $($elementsBottomBar).appendTo($(".bottom-bar"));

    $tutorailElements = ''+
        '<li data-text="Volgende">' +
        '<h2>Welkom!</h2>' +
        '<p>Welkom bij MovingMonsters, leuk dat je meedoet! Tijdens deze korte tutorial word het spel kort uitgelegd. Veel plezier!</p>' +
        '</li>' +
        '<li data-id="number1" data-text="Volgende" data-prev-text="Prev" class="custom1">' +
        '<h2>Energie punten</h2>' +
        '<p>Hier zie je hoeveel Energie punten je hebt. Deze punten kun je verdienen door te bewegen! Je kunt dit in en uitklappen door er op te tikken.</p>' +
        '</li>' +
        '<li data-id="number2" data-text="Volgende" class="custom2">' +
        '<h2>Energie punten toevoegen</h2>' +
        '<p>Wanneer je hier op klikt, worden de stappen van de stappenteller afgehaald, en toegevoegd aan jouw energie punten.</p>' +
        '</li>' +
        '<li data-id="number3" data-text="Volgende" class="custom3">' +
        '<h2>Voortgang wereld</h2>' +
        '<p>Hier zie je het aantal ontdekte gebieden van de wereld waar je op dit moment bent. Je kunt dit in en uitklappen door er op te tikken.</p>' +
        '</li>' +
        '<li data-id="number4" data-text="Volgende" class="custom4">' +
        '<h2>Dagelijkse uitdaging</h2>' +
        '<p>Iedere dag staat er een nieuwe uitdaging voor je klaar, waarmee je extra punten kunt verdienen!</p>' +
        '</li>' +
        '<li data-id="number5" data-text="Volgende" class="custom5" data-options="tipLocation:top;">' +
        '<h2>Home</h2>' +
        '<p>Wanneer je hier op klikt ga je terug naar de wereld die je op dit moment aan het verkennen bent.</p>' +
        '</li>' +
        '<li data-id="number6" data-text="Volgende" class="custom6" data-options="tipLocation:top;">' +
        '<h2>Raketbasis</h2>' +
        '<p>Vanuit je raketbasis kun je kiezen naar welke wereld je wilt reizen. Hier kun je ook zien welke werelden je al hebt vrijgespeeld, en welke nog verborgen zijn.</p>' +
        '</li>' +
        '<li data-id="number7" data-text="Volgende" class="custom7" data-options="tipLocation:top;">' +
        '<h2>Monsterdex</h2>' +
        '<p>Alle ontdekte monsters worden verzameld in jouw eigen monsterdex. Klik op een monster voor meer informatie, of als je de monsterchallenge opnieuw wilt doen.</p>' +
        '</li>'+
        '<li data-id="number8" data-text="Ik snap het!" class="custom8" data-options="tipLocation:top;">' +
        '<h2>Profiel</h2>' +
        '<p>Op deze pagina kun je eigen prestaties bekijken. Ook kun je vanuit hier vrienden uitnodigen, zodat jullie tegen elkaar kunnen strijden om de eerste plek!</p>' +
        '</li>';
    $($tutorailElements).appendTo($("#joyRideTipContent"));

    // Joyride tip
    var tutorial = getUrlParameter('tutorial');
    console.log(tutorial);
    if(tutorial == 'true'){
        $('#joyRideTipContent').joyride({
            autoStart: true,
            modal: true,
            prev_button: true,
            template : {
                link        : '<a href="#close" class="joyride-close-tip"><span class="fa fa-times"></span></a>',
                button: '<a href="#" class="joyride-next-tip button buttonmiddle buttonblue"></a>',
                prev_button : '<a href="#" class="joyride-next-tip button buttonright buttonblue"></a>'
            },
        });
    }

    clickEvents(); // cal clickevents after set items
} // end function createElements

function clickEvents() {
    $('.dailyChallenge').click("click", function () {
        $date = new Date();
        $day = $date.getDate();

        var dataString = "currentday=" + $day + "&submitDaily=";
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
    }); // end .dailyChallenge click

    $(".world-name").click(function () {
        localStorage.clear();
        window.location.href = "inloggen.html";
    }); //end .world-name click

} //end function clickEvents

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
        //alert('onError!');
    }

    var options = {frequency: 3000};  // Update every 3 seconds
    var watchID = navigator.accelerometer.watchAcceleration(onSuccess, onError, options);

    navigator.accelerometer.getCurrentAcceleration(onSuccess, onError);
} //end function accelerometer

function pedometerFunction() {
    //alert(pedometer);

    //var testPedometer = pedometer.isDistanceAvailable(successCallback, failureCallback);
    var testPedometer = 'Ja';
    document.getElementById('pedometerGeefterug').innerHTML = 'Distance available? ' + testPedometer;


    // var successHandler = function (pedometerData) {
    //     alert('successHandler');
    //     // pedometerData.startDate; -> ms since 1970
    //     // pedometerData.endDate; -> ms since 1970
    //     // pedometerData.numberOfSteps;
    //     // pedometerData.distance;
    //     // pedometerData.floorsAscended;
    //     // pedometerData.floorsDescended;
    // }
    //
    //  var onError = function(){
    //      alert('onError');
    //  }
    // pedometer.startPedometerUpdates(successHandler, onError);
    //alert('pedometerfunction');

    var successCallback = function () {
        //alert('success');
        var successHandler = function (pedometerData) {
            //alert(pedometerData.numberOfSteps);
        };

        var onError = function () {
            //alert('onError');
        };
        pedometer.startPedometerUpdates(successHandler, onError);
    };

    var failureCallback = function () {
        //alert('failure');
    };

    pedometer.isStepCountingAvailable(successCallback, failureCallback);
    //alert(testje);
}//end function pedometer

function tooltiponClick(element){
    $tooltip = $(this).find('.tooltipIcon');
    $($tooltip).fadeIn().delay(2000).fadeOut();
}