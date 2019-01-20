$(document).ready(function () {
    getLoginStateOfUser(evaluateIfUserIsLoggedIn);

    function evaluateIfUserIsLoggedIn(response) {
        if (response == 1) {
            getUserRights(evaluateIfUserIsAdmin);

            function evaluateIfUserIsAdmin(response) {
                if (response == 1) {
                    displayAdminGui();
                } else {
                    displayUserGui();
                }
            }
        }else{
            if (window.location.href.indexOf('moj-profil') > 0) {
                localStorage.removeItem('token');
                window.location.replace = '/prihlasenie';
            }
            localStorage.removeItem('token');
        }
    }

    if (window.location.href.indexOf('moj-profil') > 0) {
        getUserInfo(showUserDetails);
        getUserBarns(showBarns); //+services
    }

    //IF PAGE IS BARN
    if (window.location.href.indexOf('stajna') > 0) {
        var barnId = findGetParameter('ID');
        getBarnDetails(barnId, showBarnDetails);
    }

    //IF PAGE IS SERVICE
    if (window.location.href.indexOf('sluzba') > 0) {
        var serviceId = findGetParameter('ID');
        getServiceDetails(serviceId, showServiceDetails);
    }

    $(document).on('click', '.showBarnServiceDetails', function () {
        showHideServiceDetails(this);
    })

    $(document).on('click', '.saveUserDetails', function () {
        updateUserData();
    })

    $(document).on('change', "[name=userImage]:file", function () {
        var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(".path").html(fileName);
    });

    $(document).on('change', '#serviceProvider, #organizer',function () {
        fetchLocation($(this).attr('id'));
    });

    $(document).on('click', "#imageBorder", function () {
        $('#userImage').click();
    });

    $('.addAsset').confirm({
        title: 'Naozaj chcete pridať ' + decodeURIComponent(findGetParameter('what')) + ' ?',
        content: '',
        columnClass: 'col-sm-6',
        buttons: {
            áno: function () {
                addAsset();
            },
            nie: function () {
                return true;
            },
        }
    });

    $(document).on('click', '.facebookShare', function () {
        window.open(this.href, 'mywin', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');
        return false;
    });

    $(document).on('change', '#mainCategory', function () {
        getSubcategoriesFromMain();
    })


});

function displayAdminGui() {
    localStorage.setItem("hideUpcoming", 1);
    displayUserProfileMenuItem('admin');
    addNewTopicPanelInNewsPage();
}

function displayUserGui() {
    displayUserProfileMenuItem('user');
}


function displayUserProfileMenuItem(userType) {
    $('.loginButton').attr('href', '/moj-profil.php');
    $('.loginButton').html('Môj Profil');
    var logoutButton = '<li class="menu-active"><a href="#" id="logout">Odhlásiť</a></li>';
    $('.nav-menu, #mobile-nav ul').append(logoutButton);
    $('.dropup').show();
    $('.dropup #fastAddMenu').append('<a href="pridat.php?what=stajňu" id="addBarn">Novú Stajňu</a>');
    $('.dropup #fastAddMenu').append('<a href="pridat.php?what=službu" id="addService">Novú Službu</a>');
    $('.dropup #fastAddMenu').append('<a href="pridat.php?what=udalosť" id="addEvent">Novú Udalosť</a>');
    if (userType == 'admin') {
        $('.dropup #fastAddMenu').append('<a href="novy-clanok.php" id="addArticle">Nový Článok</a>');
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
        '<div class="single-widget editNewsPanel category-widget">' +
        '<h4 class="title">EDITOVAŤ NOVINKY</h4>' +
        '<ul>';
    if (window.location.href.indexOf('clanok') > 0) {
        newTopicPanel += '<li><a href="/editovat-clanok.php?ID=' + findGetParameter('ID') + '" class="justify-content-between align-items-center d-flex"><h6><img src="/img/editIcon.png">Editovať tento článok</h6></a></li>';
    }
    newTopicPanel += '<li><a href="/novy-clanok.php" class="justify-content-between align-items-center d-flex"><h6><img src="/img/addNew.png">Pridať nový článok</h6></a></li>' +
        '<li><a href="/vsetky-clanky.php" class="justify-content-between align-items-center d-flex"><h6><img src="/img/list.png">Spravovať články</h6></a></li>' +
        '</ul>' +
        '</div>';
    $('.newsSideBar').prepend(newTopicPanel);
}

function showBarns(userBarns) {
    console.log(userBarns);
    if (userBarns.length == 0) {
        return;
    }
    var showUserBarns = "<div class='userBarns'>";
    showUserBarns += "<h3>Moje stajne</h3>";
    userBarns.forEach(function (singleBarn) {
        showUserBarns += "<div class='singleBarn' id='barnId" + singleBarn.ID + "'>";
        showUserBarns += "<div class='removeAsset' title='Zmazať stajňu' id='barn" + singleBarn.ID + "'>X</div>";
        showUserBarns += "<a href='stajna.php?ID=" + singleBarn.ID + "' title='Prejsť do stajne'>";
        showUserBarns += "<div class='barnImage'><img src='" + (singleBarn.barnImage == null ? returnDefaultImage('stajňa') : singleBarn.barnImage) + "' alt=''></div>";
        showUserBarns += "<div class='barnName'><h4>" + singleBarn.barnName + "</h4></div>";
        showUserBarns += "<div class='barnLocation'><b>Lokalita:</b> " + singleBarn.location + "</div>";
        showUserBarns += "<div class='barnDescription'><b>Popis:</b> " + singleBarn.barnDescription.replace(/<\/?[^>]+(>|$)+/g, "").replace('&nbsp;', '').trim() + "</div>";
        showUserBarns += "<div class='barnRidingStyle'><b>Jazdecký štýl:</b> " + singleBarn.barnRidingStyle + "</div>";
        showUserBarns += "</div>";
        showUserBarns += "</a>";
    });
    showUserBarns += "</div>";
    $('#servicesBarnsEvents').find('.container').append(showUserBarns);
    //now get user services
    getUserServices(showServices);
}

function showServices(userServices) {
    console.log(userServices);

    if (userServices.length == 0) {
        return;
    }
    var showUserServices = "<div class='userServices'>";
    showUserServices += "<hr>";
    showUserServices += "<h3>Moje služby</h3>";
    showUserServices += "<p>Ponúkané v mojom mene alebo v mene stajne, ktorú spravujem</p>";
    userServices.forEach(function (singleService) {
        showUserServices += "<div class='singleService' id='barnId" + singleService.ID + "'>";
        showUserServices += "<div class='removeAsset' title='Zmazať službu' id='service" + singleService.ID + "'>X</div>";
        showUserServices += "<a href='sluzba.php?ID=" + singleService.ID + "' title='Prejsť do služby'>";
        showUserServices += "<div class='serviceImage'><img src='" + returnDefaultImage(singleService.type) + "' alt=''></div>";
        showUserServices += "<div class='type'><h4>" + singleService.type + "</h4></div>";
        showUserServices += "<div class='provider'><b>Poskytovateľ:</b> " + (singleService.userId != null ? singleService.fullName : singleService.barnName) + "</div>";
        showUserServices += "<div class='serviceLocation'><b>Lokalita:</b> " + singleService.location + "</div>";
        showUserServices += "<div class='descriptionOfService'><b>Popis:</b> " + singleService.descriptionOfService + "</div>";
        showUserServices += "</div>";
        showUserServices += "</a>";
    });
    showUserServices += "</div>";
    $('#servicesBarnsEvents').find('.container').append(showUserServices);
}

function showBarnDetails(barnDetails) {
    console.log(barnDetails);
    showGeneralBarnInfo(barnDetails);
    if (barnDetails.barnServices.length > 0) {
        showBarnServices(barnDetails);
    }
    if (barnDetails.gallery.length > 0) {
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
        showedBarnDetails += "<div><b>Jazdecký štýl:</b> " + barnDetails.barnRidingStyle + "</div>";
        showedBarnDetails += "<div><b>Typ koní:</b> " + barnDetails.barnHorseTypes + "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "<div class='barnRightDetails'>";
        showedBarnDetails += "<h3>Kontaktné informácie</h3>";
        showedBarnDetails += "<div class='barnContactInfo'>";
        showedBarnDetails += "<div><b>Adresa:</b> " + barnDetails.location + "</div>";
        showedBarnDetails += "<div><b>Ulica:</b> " + barnDetails.barnStreet + "</div>";
        showedBarnDetails += "<div><b>Email:</b> <a href='mailto:" + barnDetails.barnEmail + "'>" + barnDetails.barnEmail + "</a></div>";
        showedBarnDetails += "<div><b>Kontaktná osoba:</b> " + barnDetails.barnContactPerson + "</div>";
        showedBarnDetails += "<div><b>Telefón:</b> " + barnDetails.barnPhone + "</div>";
        showedBarnDetails += "<div><b>Otváracie hodiny:</b> " + openHoursTable(barnDetails.barnOpenHours) + "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "<div style='text-align:center;margin-top:15px;'><h3 style='border-bottom: 1px solid rgb(197, 197, 197);'>Popis</h3><div style='text-align:left;'>" + barnDetails.barnDescription + "</div></div>";
        showedBarnDetails += "<div class='barnSocialNetworks'>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnFacebook ? barnDetails.barnFacebook + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnFacebook ? '' : 'notAvailable') + "' title='Facebook - " + barnDetails.barnName + "'><img src='/img/socialFacebook.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnInstagram ? barnDetails.barnInstagram + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnInstagram ? '' : 'notAvailable') + "' title='Instagram - " + barnDetails.barnName + "'><img src='/img/socialInstagram.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnYoutube ? barnDetails.barnYoutube + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnYoutube ? '' : 'notAvailable') + "' title='Youtube - " + barnDetails.barnName + "'><img src='/img/socialYoutube.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnTwitter ? barnDetails.barnTwitter + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnTwitter ? '' : 'notAvailable') + "' title='Twitter - " + barnDetails.barnName + "'><img src='/img/socialTwitter.png' alt=''></a></div>";
        showedBarnDetails += "</div>";
        $('#barnDetails').append(showedBarnDetails);

        $('#servicesBarnsEvents').before('<section id="googleMap"><div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=' + barnDetails.location + ',' + barnDetails.barnStreet + '&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{margin-left:auto;margin-right:auto;height:500px;width:100%;max-width:1000px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></section><hr>');
    });
}

function showBarnServices(barnDetails) {
    var showedBarnDetails = "<h3>Ponúkané služby</h3>";
    barnDetails.barnServices.forEach(function (barnService) {
        showedBarnDetails += "<div class='singleService' id='barnId" + barnService.ID + "'>";
        showedBarnDetails += "<div class='serviceImage'><img src='" + returnDefaultImage(barnService.type) + "' alt=''></div>";
        showedBarnDetails += "<div class='type'><h4>" + barnService.type + "</h4></div>";
        showedBarnDetails += "<div class='servicePrice'><b>Cena:</b> " + barnService.price + " €</div>";
        showedBarnDetails += "<div class='isWillingToTravel'><b>Prídeme aj za vami:</b> " + barnService.isWillingToTravel + "</div>";
        showedBarnDetails += "<div class='rangeOfOperation'><b>Do okolia: </b> " + barnService.rangeOfOperation + " km</div>";
        showedBarnDetails += "<div class='showBarnServiceDetails'><b>Zobraziť detaily</b><i class='arrow down' style='margin-left: 10px;margin-bottom:2px;'></i></div>";
        showedBarnDetails += "<div class='descriptionOfService' style='display:none;'><b>Detaily:</b> " + barnService.descriptionOfService + "</div>";
        showedBarnDetails += "</div>";
    });

    $('#offeredServices').append(showedBarnDetails);
}

function fillGaleryImages(serviceOrBarnDetails) {
    var imageList = "";
    serviceOrBarnDetails.gallery.forEach(function (barnImage) {
        imageList += '<div>' +
            '<img data-u="image" src="' + barnImage.imageLink + '" />' +
            '<img data-u="thumb" src="' + barnImage.imageLink + '" />' +
            '</div>';
    });
    $('#gallery').before("<hr>");
    $('#gallery').prepend("<h3>Galéria</h3>");
    $('.gallerySlides').show();
    jssor_1_slider.$ReloadSlides(imageList);
}

function showHideServiceDetails(detailButton) {
    var serviceDetails = $(detailButton).next('.descriptionOfService')
    if ($(serviceDetails).is(':visible')) {
        $(serviceDetails).hide(200);
        $(detailButton).find('i').removeClass('up').addClass('down');
    } else {
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
        showedServiceDetails += "<div><b>Meno / Poskytovateľ:</b> " + (serviceDetails.barnName == null ? serviceDetails.fullName :
        "<a href='stajna.php?ID=" + serviceDetails.barnId + "' title='Prejsť do stajne'>" + serviceDetails.barnName) + "</a>" + "</div>";
        showedServiceDetails += "</div>";
        showedServiceDetails += "</div>";
        showedServiceDetails += "<div class='serviceRightDetails'>";
        showedServiceDetails += "<h3>Kontaktné informácie</h3>";
        showedServiceDetails += "<div class='serviceContactInfo'>";
        showedServiceDetails += "<div><b>Adresa:</b> " + serviceDetails.location + "</div>";
        showedServiceDetails += "<div><b>Email:</b> <a href='mailto:'" + (serviceDetails.userEmail == null ? serviceDetails.barnEmail : serviceDetails.userEmail) + "'>" + (serviceDetails.userEmail == null ? serviceDetails.barnEmail : serviceDetails.userEmail) + "</a></div>";
        showedServiceDetails += "<div><b>Telefón:</b> " + (serviceDetails.userPhone == null ? serviceDetails.barnPhone : serviceDetails.userPhone) + "</div>";
        showedServiceDetails += "<div><b>Pracuje v čase:</b> " + openHoursTable(serviceDetails.workHours) + "</div>";
        showedServiceDetails += "</div>";
        showedServiceDetails += "</div>";
        showedServiceDetails += "</div>";
        showedServiceDetails += "<div style='text-align:center;margin-top:15px;'><h3 style='border-bottom: 1px solid rgb(197, 197, 197);'>Popis</h3><div style='text-align:left;'>" + serviceDetails.descriptionOfService + "</div></div>";
        showedServiceDetails += "<div class='serviceSocialNetworks'>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Facebook ? serviceDetails.Facebook + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Facebook ? '' : 'notAvailable') + "' title='Facebook - " + serviceDetails.type + "'><img src='/img/socialFacebook.png' alt=''></a></div>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Instagram ? serviceDetails.Instagram + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Instagram ? '' : 'notAvailable') + "' title='Instagram - " + serviceDetails.type + "'><img src='/img/socialInstagram.png' alt=''></a></div>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Youtube ? serviceDetails.Youtube + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Youtube ? '' : 'notAvailable') + "' title='Youtube - " + serviceDetails.type + "'><img src='/img/socialYoutube.png' alt=''></a></div>";
        showedServiceDetails += "<div><a href='" + (serviceDetails.Twitter ? serviceDetails.Twitter + "' target=_blank" : "#a") + "' class='" + (serviceDetails.Twitter ? '' : 'notAvailable') + "' title='Twitter - " + serviceDetails.type + "'><img src='/img/socialTwitter.png' alt=''></a></div>";
        showedServiceDetails += "</div>";
        $('#serviceDetails').append(showedServiceDetails);
        $('#servicesBarnsEvents').before('<section id="googleMap"><div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=' + serviceDetails.location + ',' + serviceDetails.street + '&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{margin-left:auto;margin-right:auto;height:500px;width:100%;max-width:1000px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></section><hr>');
    });


    if (serviceDetails.gallery.length > 0) {
        fillGaleryImages(serviceDetails);
    }
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
    formData.append('fullName', $('[name=fullName]').val());
    formData.append('email', $('[name=email]').val());
    formData.append('phoneNumber', $('[name=phoneNumber]').val());
    formData.append('newPassword', $('[name=newPassword]').val());
    formData.append('newPasswordRepeat', $('[name=newPasswordRepeat]').val());
    formData.append('sjfLink', $('[name=sjfLink]').val());
    formData.append('feiLink', $('[name=feiLink]').val());
    formData.append('userImage[]', $('[name=userImage]').prop('files')[0]);
    formData.append('userDescription', tinymce.activeEditor.getContent());
    formData.append('token', localStorage.getItem("token"));
    sendNewDataToDb(formData)
}

function showEvents(events) {
    console.log(events);
    if (events.length == 0) {
        return;
    }
    var showEvents = "";
    events.forEach(function (singleEvent) {
        showEvents += "<div class='single-post'>";
        showEvents += "<a href='udalost.php?ID=" + singleEvent.eventId + "' title='Zobraziť udalosť'>";
        showEvents += "<div class='singleEvent' id='eventId" + singleEvent.ID + "'>";
        showEvents += "<div class='eventImage'><img src='" + (singleEvent.eventImage == null ? returnDefaultImage('event') : singleEvent.eventImage) + "' alt=''></div>";
        showEvents += "<div class='eventName'><h4>" + singleEvent.eventName + "</h4></div>";
        showEvents += "<div class='eventOrganizer'><b>Organizator:</b> " + (singleEvent.barnId == null ? singleEvent.fullName : singleEvent.barnName) + "</h4></div>";
        showEvents += "<div class='eventLocation'><b>Lokalita:</b> " + singleEvent.province + ' - ' + singleEvent.region + ' - ' + singleEvent.localCity +"</div>";
        showEvents += "<div class='eventDate'><b>Dátum:</b> " + singleEvent.eventDate + "</div>";
        showEvents += "<div class='eventDescription'><b>Popis:</b> " + singleEvent.eventDescription.replace(/<\/?[^>]+(>|$)+/g, "").replace('&nbsp;', '').trim() + "</div>";
        showEvents += "</div>";
        showEvents += "</a>";
        showEvents += "</div>";
    });
    $('#eventSearchResults').html(showEvents);
    $('#eventSearchResults').prepend(navigation());
    $('#eventSearchResults').append(navigation());
}


function addAsset() {
    switch (decodeURIComponent(findGetParameter('what'))) {
        case 'stajňu':
            addNewBarn();
            break;
        case 'službu':
            addNewService();
            break;
        case 'udalosť':
            addNewEvent();
            break;
        case 'inzerát':
            addNewItemToMarket();
            break;
        default:
            break;
    }
}

function addNewBarn() {
    if (
        $('#barnName').val() == "" ||
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#barnPhone').val() == "" ||
        $('#barnEmail').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia');
        return;
    }

    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('barnName', $('#barnName').val());
    formData.append('barnImage[]', $('#barnImage').prop('files')[0]);
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('barnStreet', $('#barnStreet').val());
    formData.append('barnPhone', $('#barnPhone').val());
    formData.append('barnContactPerson', $('#barnContactPerson').val());
    formData.append('barnEmail', $('#barnEmail').val());
    formData.append('barnRidingStyle', $('#barnRidingStyle').val());
    formData.append('barnHorseTypes', $('#barnHorseTypes').val());
    formData.append('barnFacebook', $('#barnFacebook').val());
    formData.append('barnInstagram', $('#barnInstagram').val());
    formData.append('barnTwitter', $('#barnTwitter').val());
    formData.append('barnYoutube', $('#barnYoutube').val());
    formData.append('barnDescription', tinymce.activeEditor.getContent());
    var galleryImages = $('#barnGallery')[0].files.length;
    for (var x = 0; x < galleryImages; x++) {
        formData.append("barnGallery[]", $('#barnGallery')[0].files[x]);
    }
    sendNewAssetToDB(formData, '/addNewBarn/');

}

function addNewService() {
    if (
        $('#type').val() == "" ||
        $('#eventDate').val() == "" ||
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#price').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia');
        return;
    }
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('serviceProvider', $('#serviceProvider').val());
    formData.append('type', $('#type').val());
    formData.append('serviceImage[]', $('#serviceImage').prop('files')[0]);
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('street', $('#street').val());
    formData.append('isWillingToTravel', $('#isWillingToTravel').val());
    formData.append('rangeOfOperation', $('#rangeOfOperation').val());
    formData.append('price', $('#price').val());
    formData.append('specialServiceCriteria', $('#specialServiceCriteria').val());
    formData.append('descriptionOfService', tinymce.activeEditor.getContent());
    var galleryImages = $('#serviceGallery')[0].files.length;
    for (var x = 0; x < galleryImages; x++) {
        formData.append("serviceGallery[]", $('#serviceGallery')[0].files[x]);
    }
    sendNewAssetToDB(formData, '/addNewService/');

}

function addNewEvent() {
    if (
        $('#eventName').val() == "" ||
        $('#eventDate').val() == "" ||
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#eventType').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia');
        return;
    }
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('organizer', $('#organizer').val());
    formData.append('eventName', $('#eventName').val());
    formData.append('eventDate', $('#eventDate').val());
    formData.append('eventImage[]', $('#eventImage').prop('files')[0]);
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('eventStreet', $('#eventStreet').val());
    formData.append('eventFBLink', $('#eventFBLink').val());
    formData.append('eventType', $('#eventType').val());
    formData.append('eventDescription', tinymce.activeEditor.getContent());
    var galleryImages = $('#eventGallery')[0].files.length;
    for (var x = 0; x < galleryImages; x++) {
        formData.append("eventGallery[]", $('#eventGallery')[0].files[x]);
    }
    sendNewAssetToDB(formData, '/addNewEvent/');
}

function addNewItemToMarket(){
    if (
        $('#marketTitle').val() == "" ||
        $('#mainCategory').val() == "" ||
        $('#subCategory').val() == "" ||
        $('#marketPhone').val() == "" ||
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#marketContactPerson').val() == "" ||
        $('#marketEmail').val() == "" ||
        $('#priceMarket').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia');
        return;
    }
    var formData = new FormData();
    console.log(localStorage.getItem("token"));
    
    formData.append('token', localStorage.getItem("token"));
    formData.append('marketTitle', $("#marketTitle").val());
    formData.append('mainCategory',$("#mainCategory").val());
    formData.append('subCategory',$("#subCategory").val());
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('marketPhone',$("#marketPhone").val());
    formData.append('marketContactPerson',$("#marketContactPerson").val());
    formData.append('marketEmail',$("#marketEmail").val());
    formData.append('priceMarket',$("#priceMarket").val());
    formData.append('marketDescription', tinymce.activeEditor.getContent());
    var galleryImages = $('#marketGallery')[0].files.length;
    for (var x = 0; x < galleryImages; x++) {
        formData.append("marketGallery[]", $('#marketGallery')[0].files[x]);
    }
    sendNewAssetToDB(formData, '/addNewItemToMarket/');
}

function fetchLocation(callerId) {
    getLocationFromBacked(callerId, fillLocationsBasedOnOwner);
}

function fillLocationsBasedOnOwner(callerId,resultOfBacked) {
    if (resultOfBacked.length == 0){
        $('.locationProvince').val('');
        $('.locationRegion').val('');
        $('.locationLocalCity').val('');
    }else{
        $('.locationProvince').val('province|' + resultOfBacked[0].province);
        $('.locationRegion').val('region|' + resultOfBacked[0].region);
        $('.locationLocalCity').val('localCity|' + resultOfBacked[0].localCity);
    }
}


function returnDefaultImage(service) {
    switch (service.toLowerCase()) {
        case "jazdenie / výcvik":
            return '/img/icons/jazdenie.png';
        case "prenájom koňa":
            return '/img/icons/prenajom.png';
        case "ustajnenie":
            return '/img/icons/ustajnenie.png';
        case "tréner":
            return '/img/icons/trener.png';
        case "kováč":
            return '/img/icons/kovac.png';
        case "sedlár":
            return '/img/icons/sedlar.png';
        case "fyzioterapeut":
            return '/img/icons/fyzioterapeut.png';
        case "veterinár":
            return '/img/icons/veterinar.png';
        case "prevoz":
            return '/img/icons/prevoz.png';
        case "strihač":
            return '/img/icons/strihac.png';
        case "práca / brigáda":
            return '/img/icons/praca.png';
        case "ostatné":
            return '/img/icons/ostatne.png';
        case "event":
            return '/img/icons/event.png';
        case "stajňa":
            return '/img/icons/stajna.png';
        default:
            break;
    }
}

//BIND ALL DELETE EVENTS
$(window).on('load', function () {
    bindDeleteEvent('.removeAsset', removeAsset)
});

function openHoursTable(inputTime) {
    var table = "<table class='openHours'>";
    table += "<tr><th>Pondelok</th><td>08:00</td><td>-</td><td>19:00</td></tr>";
    table += "<tr><th>Utorok</th><td>08:00</td><td>-</td><td>19:00</td></tr>";
    table += "<tr><th>Streda</th><td>08:00</td><td>-</td><td>19:00</td></tr>";
    table += "<tr><th>Štvrtok</th><td>08:00</td><td>-</td><td>19:00</td></tr>";
    table += "<tr><th>Piatok</th><td>08:00</td><td>-</td><td>19:00</td></tr>";
    table += "<tr><th>Sobota</th><td>08:00</td><td>-</td><td>19:00</td></tr>";
    table += "<tr><th>Nedeľa</th><td>08:00</td><td>-</td><td>19:00</td></tr>";    
    table += "</table>";
    return table;
}