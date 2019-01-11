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
        getUserBarns(showBarns); //+services
    }

    //IF PAGE IS BARN
    if (window.location.href.indexOf('stajna') > 0) {
        var barnId = findGetParameter('ID');
        getBarnDetails(barnId,showBarnDetails);
    }

    //IF PAGE IS SERVICE
    if (window.location.href.indexOf('sluzba') > 0) {
        var serviceId = findGetParameter('ID');
        getServiceDetails(serviceId, showServiceDetails);
    }

    $(document).on('click', '.showBarnServiceDetails',function () {
        showHideServiceDetails(this);
    })

    $(document).on('click', '.saveUserDetails', function () {
        updateUserData();
    })

    $(document).on('change', "[name=userImage]:file", function () {   
        var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(".path").html(fileName);
    });

    $(document).on('click', "#imageBorder", function () {
        $('#userImage').click();
    });


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
        var formData = new FormData();
        formData.append('token', localStorage.getItem("token"));
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            url: '/api/callBackend/user/isUserLoggedIn/',
            data: formData,
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
    var logoutButton = '<li class="menu-active"><a href="#" id="logout">Odhlásiť</a></li>';
    $('.nav-menu, #mobile-nav ul').append(logoutButton);
}

function getUserInfo(callBackFunction) {
    if (localStorage.getItem("token") == null) {
        $('#userDetails').html('<h4>Užívateľ neprihlásený, <br> Pokračujte na <a href="/prihlasenie">prihlásenie</a></h4>');
        return false;
    } else {
        $('.loading').show();
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
                $('.loading').hide();
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').hide();
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
    userDetails += '<label class="userInput"><span class="userDetailText">Fotka</span><span class="path"></span><label class="btn btn-primary chooseUserPhoto"><i class="fa fa-image"></i> Aktualizovať fotku<input type="file" style="display: none;" id="userImage" name="userImage" accept=".gif, .jpeg, .png, .jpg"></label></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText" style="font-weight:bold;">Povedzte o sebe niečo</span><br><textarea id="userDescription" name="userDescription">' + (userData.userDescription ? userData.userDescription : '') + '</textarea></label>' + '<br>';
    userDetails += '</div>';
    $('#userDetails').append(userDetails);
    console.log(userData.userPhoto);
    
    if (userData.userPhoto != "" && userData.userPhoto != null) {
        $('#imageBorder img').attr('src', userData.userPhoto);
    }
    fillLocationSelects();
    initiateUserTinyMCE();
}

function addNewTopicPanelInNewsPage() {
    var newTopicPanel = 
    '<div class="single-widget editNewsPanel category-widget">'+
        '<h4 class="title">EDITOVAŤ NOVINKY</h4>'+
        '<ul>';
        if (window.location.href.indexOf('clanok') > 0) {
            newTopicPanel += '<li><a href="/editovat-clanok.php?ID=' + findGetParameter('ID') + '" class="justify-content-between align-items-center d-flex"><h6><img src="/img/editIcon.png">Editovať tento článok</h6></a></li>';
        }
        newTopicPanel += '<li><a href="/novy-clanok.php" class="justify-content-between align-items-center d-flex"><h6><img src="/img/addNew.png">Pridať nový článok</h6></a></li>' +
                        '<li><a href="/vsetky-clanky.php" class="justify-content-between align-items-center d-flex"><h6><img src="/img/list.png">Spravovať články</h6></a></li>' +
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
                getUserServices(showServices);
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


function showServiceDetails(serviceDetails) {
    console.log(serviceDetails);
    serviceDetails.generalDetails.forEach(function (serviceDetails) {
        document.title = serviceDetails.type + ' - ' + document.title;
        $('#serviceName').html(serviceDetails.type);
    var showedServiceDetails = "<div class='serviceAllDetails'>";
                showedServiceDetails += "<div class='serviceLeftDetails'>";
                    showedServiceDetails += "<h3>Detaily služby</h3>";
                    showedServiceDetails += "<div class='generalServiceInfo'>";
                    showedServiceDetails += "<div><b>Meno / Poskytovateľ:</b> " + serviceDetails.fullName + "</div>";    
                    showedServiceDetails += "<div><b>Popis:</b> " + serviceDetails.descriptionOfService + "</div>";
                showedServiceDetails += "</div>";
            showedServiceDetails += "</div>";
            showedServiceDetails += "<div class='serviceRightDetails'>";
                showedServiceDetails += "<h3>Kontaktné informácie</h3>";
                showedServiceDetails += "<div class='serviceContactInfo'>";
                    showedServiceDetails += "<div><b>Adresa:</b> " + serviceDetails.address + "</div>";
                    showedServiceDetails += "<div><b>Email:</b> " + serviceDetails.email + "</div>";
                    showedServiceDetails += "<div><b>Telefón:</b> " + serviceDetails.phone + "</div>";
                    showedServiceDetails += "<div><b>Pracuje v čase:</b> " + serviceDetails.operationHours + "</div>";
                showedServiceDetails += "</div>";
            showedServiceDetails += "</div>";
        showedServiceDetails += "</div>";
        showedServiceDetails += "<div class='serviceSocialNetworks'>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Facebook ? serviceDetails.Facebook + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Facebook ? '' : 'notAvailable') + "' title='Facebook - " + serviceDetails.type + "'><img src='/img/socialFacebook.png' alt=''></a></div>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Instagram ? serviceDetails.Instagram + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Instagram ? '' : 'notAvailable') + "' title='Instagram - " + serviceDetails.type + "'><img src='/img/socialInstagram.png' alt=''></a></div>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Youtube ? serviceDetails.Youtube + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Youtube ? '' : 'notAvailable') + "' title='Youtube - " + serviceDetails.type + "'><img src='/img/socialYoutube.png' alt=''></a></div>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Twitter ? serviceDetails.Twitter + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Twitter ? '' : 'notAvailable') + "' title='Twitter - " + serviceDetails.type + "'><img src='/img/socialTwitter.png' alt=''></a></div>";
        showedServiceDetails += "</div>";
        $('#serviceDetails').append(showedServiceDetails);
    });

    /*showGeneralBarnInfo(barnDetails);
    if (barnDetails.barnServices.length > 0) {
        showBarnServices(barnDetails);
    }
    if (serviceDetails.serviceGallery.length > 0) {
        fillGaleryImages(barnDetails);
    }*/
}

function initiateUserTinyMCE() {
    tinymce.init({
        selector: '#userDescription',
        language: 'sk',
        resize: 'both',
        theme: 'modern',
        plugins: 'print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template table charmap hr pagebreak nonbreaking anchor insertdatetime lists textcolor wordcount imagetools contextmenu colorpicker textpattern paste',
        toolbar1: 'formatselect | undo redo | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
        paste_data_images: true,
        media_live_embeds: true,
        min_height: 200,
        extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    });
}


if (window.location.href.indexOf('vyhladat') > 0 || window.location.href.indexOf('bazar') > 0 || window.location.href.indexOf('novinky-clanky') > 0) {
    if (localStorage.getItem("hideUpcoming") == null) {
        $('body').append('<div id="upcoming">PRIPRAVUJEME<br><span>Očakávané spustenie 01.03.2019</span></div>');
    }
}

function updateUserData() {
    var formData = new FormData();
    formData.append('fullName',$('[name=fullName]').val());
    formData.append('email',$('[name=email]').val());
    formData.append('phoneNumber',$('[name=phoneNumber]').val());
    formData.append('newPassword',$('[name=newPassword]').val());
    formData.append('newPasswordRepeat',$('[name=newPasswordRepeat]').val());
    formData.append('sjfLink',$('[name=sjfLink]').val());
    formData.append('feiLink',$('[name=feiLink]').val());
    formData.append('userImage[]', $('[name=userImage]').prop('files')[0]);
    formData.append('userDescription', tinymce.activeEditor.getContent());
    formData.append('token', localStorage.getItem("token"));
    sendNewDataToDb(formData)
}