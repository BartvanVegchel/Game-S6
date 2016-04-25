$userId = localStorage.getItem('userInfo');
console.log('functions ingeladen voor ' + $userId);

function getEnergypoints(){
    var dataString="username="+$userId+"&submit=";

    $.ajax({
        type:"POST",
        url:"http://game.onlineops.nl/phonegap_php/getEnergypoints.php",
        data: dataString,
        crossDomain: true,
        cache: false,
        dataType: 'json',
        success: function(data){
            if(data['error']=="error")
            {// if register is succesfull
                alert("error");
                $(".personalEnergypoints").html(0);
            } else if(data['energypoints'] !== ""){
                alert('energypoints');
                $(".personalEnergypoints").html(data['energypoints']);
            }
        },
        error: function () {
            alert("Er gaat iets verkeerd, neem contact met ons op");
        }
    })
}

