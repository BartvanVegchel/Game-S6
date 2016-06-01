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
            async: false,
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
                swal("Er gaat iets verkeerd, probeer het opnieuw!");
            }
        });
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
                swal("Er gaat iets verkeerd, probeer het opnieuw!");
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
    $description = description;
    $time = time;

    swal({
            title: "Dagelijkse uitdaging",
            text: $name,
            confirmButtonText: "Start",
            showCancelButton: true,
            cancelButtonText: "Nu niet"
        },
        function () {
            localStorage.setItem('dailyChallenge', $challengeId);
            window.location.href = 'challenge.html';
        });
} //end function dailyChallenge



// function temporaryMonsterFunction(monstername){
//     $monsterName = monstername;
//     $monsterNameLowerCase = $monsterName.toLowerCase();
//
//     //check if clicktype is from monsterEgg or monster-detail page
//     swal({
//             title: $monsterName,
//             text: "Je hebt " + $monsterName + " ontdekt",
//             imageUrl: "img/monster_" + $monsterNameLowerCase + ".png",
//             confirmButtonText: "Oke",
//             showCancelButton: false,
//             cancelButtonText: "",
//         },
//         function () {
//             $.ajax(
//                 {
//                     type: "get",
//                     url: "http://game.onlineops.nl/phonegap_php/temporaryMonsterFunction.php",
//                     data: {'monstername': $monsterName, 'username': $userName},
//                     timer: 2000,
//                     success: function (data) {
//                     }
//                 }
//             )
//                 .done(function (data) {
//                     //alert('ontdekt');
//                 //show image, remove locked block
//                     window.location.href = 'index.html';
//                 });
//
//         });
// } //end temporaryMonsterFunction

function addGiftReward(giftElementId, giftCategory , giftValue){

    $giftElementId = giftElementId;
    $giftCategory = giftCategory;
    $giftValue = giftValue;

    if($giftCategory == 'energypoints'){
        $title = 'Energiepunten gevonden';
        $text = 'Je hebt ' + $giftValue + ' energiepunten gekregen';
    }
    //check if clicktype is from monsterEgg or monster-detail page
    swal({
        title: $title,
        text: $text,
        confirmButtonText: "Oke",
        showCancelButton: false,
        cancelButtonText: "",
    },
    function () {
        $.ajax(
            {
                type: "get",
                url: "http://game.onlineops.nl/phonegap_php/addGiftValues.php",
                data: {'giftelementid': $giftElementId, 'giftvalue': $giftValue, 'giftcategory': $giftCategory, 'username': $userName},
                timer: 2000,
                success: function (data) {
                }
            }
        )
        .done(function (data) {
            //refresh page on done
            window.location.href = 'index.html';
        });

    });
} //end addGiftReward


//start monsterChallenge
function monsterChallenge(monstername, name, challengeid, description, time, clicktype) {
    $challengeId = challengeid;
    $name = name;
    $monsterName = monstername;
    $monsterNameLowerCase = $monsterName.toLowerCase();
    $reward = '';//empty for check on challenge.html
    $description = description;
    $time = time;
    $clickType = clicktype;

    if($clickType == 'monsterEgg'){
        $titel = $monsterName;
        $text = "Speel " + $monsterName + " nu vrij";
    } else if($clickType == 'monsterdetail'){
        $titel = $monsterName;
        $text = "Voer de challenge nog een keer uit!";
    }

    //check if clicktype is from monsterEgg or monster-detail page
        swal({
                title: $titel,
                text: $text,
                imageUrl: "img/monster_" + $monsterNameLowerCase + ".png",
                confirmButtonText: "Start",
                showCancelButton: true,
                cancelButtonText: "Nu niet",
            },
            function () {
                localStorage.setItem('monsterChallenge', $challengeId);
                window.location.href = 'challenge.html';
            });

} //end function monsterChallenge


function getMonsterChallengeInfo(monstername, clicktype) {
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
                $challengeId = data['challengeid'];
                //alert('id is' + $challengeId);
                //alert($name);
            }
        }
    }).done(function (data) {
        monsterChallenge($monsterName, $name, $challengeId, $description, $time, $clickType);
    })
} //end function getMonsterChallengeInfo

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

                if(localStorage.getItem('discover') != 1){
                    $(".monsterbackground").parent().on('click', function(){
                        localStorage.setItem('discover',1);
                        $discovered = localStorage.getItem('discover');
                        console.log($discovered);
                        $('#joyRideTipContent.tip2').joyride({
                            autoStart: true,
                            modal: true,
                            prev_button: true,
                            postRideCallback: function(){
                                location.reload();
                            },
                            template : {
                                link        : '<a href="#close" class="joyride-close-tip"><span class="fa fa-times"></span></a>',
                                button: '<a href="#" class="joyride-next-tip button buttonmiddle buttonblue"></a>',
                                prev_button : '<a href="#" class="joyride-next-tip button buttonright buttonblue"></a>'
                            },
                        });
                    });
                }

                $('img.monsterEgg').click(function () {
                    $monsterName = $(this).attr('monster-name');
                    $clickType = 'monsterEgg';
                    localStorage.removeItem('dailyChallenge');

                    getMonsterChallengeInfo($monsterName, $clickType);
                    //temporaryMonsterFunction($monsterName);
                });//end monsterEgg click

                $('.monsterdetailChallenge').click(function () {
                    $monsterName = $(this).attr('monster-name');
                    $clickType = 'monsterdetail';
                    localStorage.removeItem('dailyChallenge');

                    getMonsterChallengeInfo($monsterName, $clickType);
                    //temporaryMonsterFunction($monsterName);
                });//end monsterEgg click

                $('img.giftBox').click(function () {
                    $giftElementId = $(this).parent().parent().attr('id');
                    $giftCategory = $(this).attr('id');
                    $giftValue = $(this).attr('giftValue');

                    addGiftReward($giftElementId, $giftCategory, $giftValue);
                });//end monsterEgg click

                $("div.transportbackground img").click(function () {
                    window.location.href = "worlds.html";
                });
            },
            error: function () {
                swal("Er gaat iets verkeerd, probeer het opnieuw!");
            }
        }).done(function(){
            $mapWidth = $('.map').width();
            $mapHeight = $('.map').height();
            // alert($mapWidth);

            // function scrollToElement($('#1_14')){
            //     $(window).scrollTop($('#1_14').offset().top).scrollLeft($('#1_14').offset().left);
            // }
            var dingetje = $(".part:nth-child(10)").attr('id');

            var element = document.getElementById(dingetje);
            element.scrollIntoView();
        })
    }

} //end function buildMap


document.addEventListener("deviceready", onDeviceReady, false); // call first function if device is ready

function onDeviceReady() {
    buildMap(); //build map if device is ready
    getEnergypoints(); //set energypoints in div
    getUnlockedFields(); //set unlocked fields in div
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
        '<span class="fa fa-globe"></span>' +
        '</div>' +
        '</a>' +
        '</li>' +
        '<li>' +
        '<a href="monsters.html">' +
        '<div id="number77" class="circle">' +
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

    clickEvents(); // cal clickevents after set items
} // end function createElements
$(window).load(function(){
    buildJoyride();
});

function buildJoyride(){
    $tutorailElements = ''+
        '<li data-text="Volgende">' +
        '<h2>Welkom!</h2>' +
        '<p>Je bent zojuist geland in de eerste wereld! In deze wereld zitten een aantal monsters verstopt. Ontdek de wereld en verzamel alle monsters!</p>' +
        '</li>' +
        '<li data-text="Volgende">' +
        '<h2>Ontdekken</h2>' +
        '<img src="img/custom-fog-animate.gif">'+
        '<p>Klik op een slotje om de wolk weg te laten trekken.</p>' +
        '</li>' +
        '<li data-id="number1" data-text="Volgende" class="custom1">' +
        '<h2>Energie punten</h2>' +
        '<p>Hier kun je zien hoeveel <span class="fa fa-bolt"></span> energiepunten je nog hebt</p>' +
        '</li>' +
        '<li data-id="number3" data-text="Volgende" class="custom3">' +
        '<h2>Voortgang wereld</h2>' +
        '<p>Hier zie je hoeveel wolken er zijn ontgrendeld in deze wereld.</p>' +
        '</li>' +
        '<li data-id="number4" data-text="Volgende" class="custom4">' +
        '<h2>Dagelijkse uitdaging</h2>' +
        '<p>Met deze uitdaging kun je eens per dag, extra energiepunten winnen!</p>' +
        '</li>' +
        '<li data-id="number5" data-text="Volgende" class="custom5" data-options="tipLocation:top;">' +
        '<h2>Home</h2>' +
        '<p>Klik hier om terug te gaan naar de wereld.</p>' +
        '</li>' +
        '<li data-id="number8" data-text="Ik snap het!" class="custom8" data-options="tipLocation:top;">' +
        '<h2>Profiel</h2>' +
        '<p>Bekijk hier je profiel en nodig je vrienden uit! Strijd tegen je vrienden om de eerste plaats te behalen!</p>' +
        '</li>';
    $($tutorailElements).appendTo($(".tip1"));

    $tutorailElements2 = ''+
        '<li data-text="Volgende">' +
        '<h2>Goedzo!</h2>' +
        '<p>Je hebt een monster ei ontdekt! breek het ei open, kijk welk monster er in zit en speel de uitdaging!</p>' +
        '</li>' +
        '<li data-id="number77" data-text="Ik snap het!" data-options="tipLocation:top;" class="custom7">' +
        '<h2>Monsterdex</h2>' +
        '<p>Alle monsters worden hier verzameld, Speel de monster-uitdaging opnieuw om drie sterren te behalen!.</p>' +
        '</li>';
    $($tutorailElements2).appendTo($(".tip2"));

    $tutorailElements3 = ''+
        '<li data-text="Volgende">' +
        '<h2>Oh nee!</h2>' +
        '<p>Je energiepunten zijn bijna op!</p>' +
        '</li>' +
        '<li data-text="Volgende">' +
        '<h2>Nieuwe punten</h2>' +
        '<img src="img/moves-logo.png">'+
        '<p>Je kunt zelf energiepunten verdienen! Download de Moves app en houd bij hoeveel stappen je zet!</p>' +
        '</li>' +
        '<li data-id="number22" data-text="Volgende" data-prev-text="Prev" class="custom2">' +
        '<h2>Energiepunten toevoegen</h2>' +
        '<p>Klik nadat je de Moves app hebt aangezet op <span class="fa fa-add-points"></span> om de nieuwe energiepunten toe te voegen.</p>' +
        '</li>'+
        '<li data-text="Ik snap het!">' +
        '<h2>Stappenteller</h2>' +
        '<img src="img/tutorialimg.png">'+
        '<p>Zometeen krijg je een soortgelijk scherm als hierboven. Klik op "Open" en daarna op "ALLOW" om verder te gaan.</p>' +
        '</li>';

    $($tutorailElements3).appendTo($(".tip3"));

    // Joyride tip intro
    var tutorial = getUrlParameter('tutorial');
    console.log(tutorial);
    if(tutorial == 'true'){
        $('#joyRideTipContent.tip1').joyride({
            autoStart: true,
            modal: true,
            prev_button: true,
            postRideCallback: function(){
                window.location.href = 'index.html';
            },
            template : {
                link        : '<a href="#close" class="joyride-close-tip"><span class="fa fa-times"></span></a>',
                button: '<a href="#" class="joyride-next-tip button buttonmiddle buttonblue"></a>',
                prev_button : '<a href="#" class="joyride-next-tip button buttonright buttonblue"></a>'
            }
        });
    }

    $epempty = localStorage.getItem('epempty');
    console.log('null of 0 of 1');
    console.log($epempty);

    $('.map-container').on( "click", function(){
        if ($('.personalEnergypoints').length){
            var epsleft = $('.personalEnergypoints').text();
            console.log("aantal ep");
            console.log(epsleft);
        }
        if(localStorage.getItem('epempty') != 1){
            if( epsleft <= 400) {
                localStorage.setItem('epempty', 1);
                $('#joyRideTipContent.tip3').joyride({
                    autoStart: true,
                    modal: true,
                    prev_button: true,
                    postRideCallback: function () {
                        location.reload();
                    },
                    template: {
                        link: '<a href="#close" class="joyride-close-tip"><span class="fa fa-times"></span></a>',
                        button: '<a href="#" class="joyride-next-tip button buttonmiddle buttonblue"></a>',
                        prev_button: '<a href="#" class="joyride-next-tip button buttonright buttonblue"></a>'
                    }
                });
            }
        }
    })
}

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

    $('a, input[type="submit"], button').on('click', function(){
        var snd = new Audio("sounds/square_pop.wav");
        snd.play();
        snd.currentTime=0;
    });

    $('input[type="submit"], button').on('click', function(){
        preventDefault();
        var snd = new Audio("sounds/square_pop.wav");
        snd.play();
        snd.currentTime=0;
        return true;
    });


    $(".world-name").click(function () {
        localStorage.clear();
        window.location.href = "inloggen.html";
    }); //end .world-name click

} //end function clickEvents

function tooltiponClick(element){
    $tooltip = $(this).find('.tooltipIcon');
    $($tooltip).fadeIn().delay(2000).fadeOut();
}