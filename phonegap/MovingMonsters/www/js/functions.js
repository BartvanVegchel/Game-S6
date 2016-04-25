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
                    $(".personalUnlockedFields").html(0);
                } else if (data['energypoints'] !== "") {
                    $(".personalUnlockedFields").html(data['unlockedfields']);
                }
            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
}

function getWorldSize(){
    var dataString="username="+$userId+"&submit=";
    if(localStorage.getItem('userInfo') !== null) {
        $.ajax({
            type: "POST",
            url: "http://game.onlineops.nl/phonegap_php/getWorldSize.php",
            data: dataString,
            crossDomain: true,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data['error'] == "error") {// if register is succesfull
                    alert("error");
                    $(".personalUnlockedFields").html(0);
                } else if (data['energypoints'] !== "") {
                    $(".personalUnlockedFields").html(data['worldsize']);
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
                console.log(data);
                $(".map-container").html(data);

            },
            error: function () {
                alert("Er gaat iets verkeerd, neem contact met ons op!");
            }
        })
    }
}