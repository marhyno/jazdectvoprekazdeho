$(document).ready(function () {      
    getLoginStateOfUser(evaluateIfUserIsLoggedIn);
    function evaluateIfUserIsLoggedIn(response) {
        if (response == 1){        
            getUserRights(evaluateIfUserIsAdmin);
            function evaluateIfUserIsAdmin(response) {
                if (response == 1) {
                    displayAdminGui();
                }else{
                    displayUserGui();
                }
            }
        }
    }
    
    if (window.location.href.indexOf('moj-profil') > 0){ 
        getUserInfo(showUserDetails);
        setTimeout(function (){
            getUserBarns(showBarns);
        }, 10);
        setTimeout(function () {
            getUserServices(showServices);
        }, 200);
    }

    if (window.location.href.indexOf('stajna') > 0) {
        var barnId = findGetParameter('ID');
        getBarnDetails(barnId,showBarnDetails);
    }

    $(document).on('click', '.showBarnServiceDetails',function () {
        showHideServiceDetails(this);
    })

});

function displayAdminGui() {
    displayUserProfileMenuItem();
    addNewTopicPanelInNewsPage();
}

function displayUserGui() {
    displayUserProfileMenuItem();
}

/* MINOR FUNCTIONS */

function getLoginStateOfUser(evaluationFunction) {
    if (localStorage.getItem("token") == null){
        return false;
    }else{
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: '/api/callBackend/user/isUserLoggedIn/' + localStorage.getItem("token"),
            xhrFields: {
                withCredentials: true
            },
            success: function (data) { 
                evaluationFunction(data);
            },
            error: function (data) {
                console.log(data);
                
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            }
        });
    }
}

function getUserRights(evaluationFunction) {
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/user/isUserAdmin/' + localStorage.getItem("token"),
        xhrFields: {
            withCredentials: true
        },
        success: function (data) { 
            evaluationFunction(data);
        },
        error: function (data) {
            localStorage.removeItem('token');
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function displayUserProfileMenuItem() {
    $('.loginButton').attr('href', '/moj-profil.php');
    $('.loginButton').html('Môj Profil');
    $('.nav-menu').append('<li class="menu-active"><a href="#" id="logout">Odhlásiť</a></li>');
}

function getUserInfo(callBackFunction) {
    if (localStorage.getItem("token") == null) {
        $('#userDetails').html('<h4>Užívateľ neprihlásený, <br> Pokračujte na <a href="/prihlasenie">prihlásenie</a></h4>');
        return false;
    } else {
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: '/api/callBackend/user/' + localStorage.getItem("token"),
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {      
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            }
        });
    }
}

function showUserDetails(userData) {
    console.log(userData);
    $('#usersFullName').html('Vitaj, ' + userData.fullName);
    var userDetails = '<div id="userFields">';
    userDetails += '<label class="userInput"><span class="userDetailText">Celé meno</span><input type="text" name="fullName" value="' + userData.fullName + '"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Email</span><input type="text" name="email" value="' + userData.email + '"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Telefón</span><input type="text" name="phoneNumber" value="' + (userData.phoneNumber ? userData.phoneNumber : '') + '"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Nové Heslo (prázdne heslo sa neuloží)</span><input type="password" name="newPassword"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Zopakovať heslo</span><input type="password" name="newPasswordRepeat"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">SJF Odkaz</span><input type="text" name="sjfLink" value="' + (userData.sjfLink ? userData.sjfLink : '') + '"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">FEI Odkaz</span><input type="text" name="feiLink" value="' + (userData.feiLink ? userData.feiLink : '') + '"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Fotka</span></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Povedzte o sebe niečo</span><br><textarea name="userDescription">' + (userData.userDescription ? userData.userDescription : '') + '</textarea></label>' + '<br>';
    userDetails += '</div>';
    $('#userDetails').append(userDetails);
    fillLocationSelects();
}

function addNewTopicPanelInNewsPage() {
    var newTopicPanel = 
    '<div class="single-widget editNewsPanel category-widget">'+
        '<h4 class="title">EDITOVAŤ NOVINKY</h4>'+
        '<ul>'+
            '<li><a href="/novy-clanok.php" class="justify-content-between align-items-center d-flex"><h6>Pridať nový článok</h6></a></li>'+
            '<li><a href="/vsetky-clanky.php" class="justify-content-between align-items-center d-flex"><h6>Spravovať články</h6></a></li>'+
        '</ul>'+
    '</div>';
    $('.newsSideBar').prepend(newTopicPanel);
}

function getUserBarns(callBackFunction) {
    if (localStorage.getItem("token") == null) {
        $('#servicesAndBarns').hide();
        return false;
    } else {
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: '/api/callBackend/getUserBarns/' + localStorage.getItem("token"),
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            }
        });
    }
}

function getUserServices(callBackFunction) {
    if (localStorage.getItem("token") == null) {
        $('#servicesAndBarns').hide();
        return false;
    } else {
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: '/api/callBackend/getUserServices/' + localStorage.getItem("token"),
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            }
        });
    }
}

function showBarns(userBarns) {
    console.log(userBarns);
    if (userBarns.length == 0) {
        return;
    }
    var showUserBarns = "<div class='userBarns'>";
    showUserBarns += "<h3>Moje stajne</h3>";
    userBarns.forEach(function (singleBarn) {
        showUserBarns += "<a href='stajna.php?ID=" + singleBarn.ID + "' title='Prejsť do stajne'>";
            showUserBarns += "<div class='singleBarn' id='barnId" + singleBarn.ID + "'>";
                showUserBarns += "<div class='barnImage'><img src='" + singleBarn.barnImage + "' alt=''></div>";
                showUserBarns += "<div class='barnName'><h4>" + singleBarn.barnName + "</h4></div>";
                showUserBarns += "<div class='barnLocation'><b>Lokalita:</b> " + singleBarn.barnLocation + "</div>";
                showUserBarns += "<div class='barnDescription'><b>Popis:</b> " + singleBarn.barnDescription + "</div>";
                showUserBarns += "<div class='barnRidingStyle'><b>Jazdecký štýl:</b> " + singleBarn.barnRidingStyle + "</div>";
            showUserBarns += "</div>";
        showUserBarns += "</a>";
    });
    showUserBarns += "</div>";
    $('#servicesAndBarns').find('.container').append(showUserBarns);
}

function showServices(userServices) {
    console.log(userServices);
    
    if (userServices.length == 0) {
        return;
    }
    var showUserServices = "<div class='userServices'>";
    showUserServices += "<hr>";
    showUserServices += "<h3>Moje služby</h3>";
    userServices.forEach(function (singleService) {
        showUserServices += "<a href='sluzba.php?ID=" + singleService.ID + "' title='Prejsť do služby'>";
            showUserServices += "<div class='singleService' id='barnId" + singleService.ID + "'>";
                showUserServices += "<div class='serviceImage'><img src='" + getServiceImage(singleService.type) + "' alt=''></div>";
                showUserServices += "<div class='type'><h4>" + singleService.type + "</h4></div>";
                showUserServices += "<div class='provider'><b>Poskytovateľ:</b> " + (singleService.userId != null ? singleService.fullName : singleService.barnName) + "</div>";
                showUserServices += "<div class='serviceLocation'><b>Lokalita:</b> " + singleService.location + "</div>";
                showUserServices += "<div class='descriptionOfService'><b>Popis:</b> " + singleService.descriptionOfService + "</div>";
            showUserServices += "</div>";
        showUserServices += "</a>";
    });
    showUserServices += "</div>";
    $('#servicesAndBarns').find('.container').append(showUserServices);
}

function getServiceImage(serviceName) {
    switch (serviceName) {
        case 'Kováč':
            return '/img/serviceImages/horseshoe.png';
            break;
        case 'Ustajnenie':
            return '/img/serviceImages/horseBarn.png';
        default:
            break;
    }
}

function showBarnDetails(barnDetails) {
    console.log(barnDetails);
    showGeneralBarnInfo(barnDetails);
    if (barnDetails.barnServices.length > 0){
        showBarnServices(barnDetails);
    }
    if (barnDetails.barnGallery.length > 0){
        fillGaleryImages(barnDetails);
    }
}

function showGeneralBarnInfo(barnDetails) {
    barnDetails.generalDetails.forEach(function (barnDetails) {
        $('#barnName').html(barnDetails.barnName);
        document.title = barnDetails.barnName + ' - ' + document.title;
        var showedBarnDetails = "<div class='barnAllDetails'>";
                showedBarnDetails += "<div class='barnLeftDetails'>";
                showedBarnDetails += "<h3>Detaily stajne</h3>";
                showedBarnDetails += "<div class='generalBarnInfo'>";
                    showedBarnDetails += "<div><b>Názov stajne:</b> " + barnDetails.barnName + "</div>";
                    showedBarnDetails += "<div><b>Popis:</b> " + barnDetails.barnDescription + "</div>";
                    showedBarnDetails += "<div><b>Jazdecký štýl:</b> " + barnDetails.barnRidingStyle + "</div>";
                    showedBarnDetails += "<div><b>Typ koní:</b> " + barnDetails.barnHorseTypes + "</div>";
                showedBarnDetails += "</div>";
            showedBarnDetails += "</div>";
            showedBarnDetails += "<div class='barnRightDetails'>";
                showedBarnDetails += "<h3>Kontaktné informácie</h3>";
                showedBarnDetails += "<div class='barnContactInfo'>";
                    showedBarnDetails += "<div><b>Adresa:</b> " + barnDetails.barnLocation + "</div>";
                    showedBarnDetails += "<div><b>Email:</b> " + barnDetails.barnEmail + "</div>";
                    showedBarnDetails += "<div><b>Kontaktná osoba:</b> " + barnDetails.barnContactPerson + "</div>";
                    showedBarnDetails += "<div><b>Telefón:</b> " + barnDetails.barnPhone + "</div>";
                    showedBarnDetails += "<div><b>Otváracie hodiny:</b> " + barnDetails.barnHasOpenHours + "</div>";
                showedBarnDetails += "</div>";
            showedBarnDetails += "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "<div class='barnSocialNetworks'>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnFacebook ? barnDetails.barnFacebook + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnFacebook ? '' : 'notAvailable') + "' title='Facebook - " + barnDetails.barnName + "'><img src='/img/socialFacebook.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnInstagram ? barnDetails.barnInstagram + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnInstagram ? '' : 'notAvailable') + "' title='Instagram - " + barnDetails.barnName + "'><img src='/img/socialInstagram.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnYoutube ? barnDetails.barnYoutube + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnYoutube ? '' : 'notAvailable') + "' title='Youtube - " + barnDetails.barnName + "'><img src='/img/socialYoutube.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnTwitter ? barnDetails.barnTwitter + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnTwitter ? '' : 'notAvailable') + "' title='Twitter - " + barnDetails.barnName + "'><img src='/img/socialTwitter.png' alt=''></a></div>";
        showedBarnDetails += "</div>";
        $('#barnDetails').append(showedBarnDetails);
    });
}

function showBarnServices(barnDetails) {
    var showedBarnDetails = "<h3>Ponúkané služby</h3>";
    barnDetails.barnServices.forEach(function (barnService) {
        showedBarnDetails += "<div class='singleService' id='barnId" + barnService.ID + "'>";
            showedBarnDetails += "<div class='serviceImage'><img src='" + getServiceImage(barnService.type) + "' alt=''></div>";
            showedBarnDetails += "<div class='type'><h4>" + barnService.type + "</h4></div>";
            showedBarnDetails += "<div class='servicePrice'><b>Cena:</b> " + barnService.price + " €</div>";
            showedBarnDetails += "<div class='isWillingToTravel'><b>Prídeme aj za vami:</b> " + barnService.isWillingToTravel + "</div>";
            showedBarnDetails += "<div class='rangeOfOperation'><b>Do okolia: </b> " + barnService.rangeOfOperation + " km</div>";
            showedBarnDetails += "<div class='showBarnServiceDetails'><b>Zobraziť detaily</b><i class='arrow down' style='margin-left: 10px;margin-bottom:2px;'></i></div>";
            showedBarnDetails += "<div class='descriptionOfService' style='display:none;'><b>Detaily:</b> " + barnService.descriptionOfService + "</div>";
        showedBarnDetails += "</div>";

        showedBarnDetails += "</div>";
        $('#offeredServices').append(showedBarnDetails);
    });
}

function fillGaleryImages(barnDetails) {
    var imageList = "";
    barnDetails.barnGallery.forEach(function (barnImage) {
    imageList += '<div>'+
                    '<img data-u="image" src="' + barnImage.imageLink + '" />' +
                    '<img data-u="thumb" src="' + barnImage.imageThumbLink + '" />' +
                '</div>';
    });
    $('#gallery').before("<hr>");
    $('#gallery').prepend("<h3>Galéria</h3>");
    $('.gallerySlides').show();
    jssor_1_slider.$ReloadSlides(imageList);
}

function showHideServiceDetails(detailButton) {
    var serviceDetails = $(detailButton).next('.descriptionOfService')
    if ($(serviceDetails).is(':visible')){
        $(serviceDetails).hide(200);
        $(detailButton).find('i').removeClass('up').addClass('down');
    }else{
        $(serviceDetails).show(200);
        $(detailButton).find('i').removeClass('down').addClass('up');
    }
}