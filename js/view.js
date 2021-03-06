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
            if (window.location.href.indexOf('moj-profil') > 0 || (window.location.href.indexOf('pridat') > -1 && decodeURIComponent(findGetParameter('what')) != 'inzerát')) {
                localStorage.removeItem('token');
                window.location.href = '/prihlasenie';
            }
            localStorage.removeItem('token');
        }
    }

    //LOAD MY ASSETS
    if (window.location.href.indexOf('moj-profil') > 0) {
        getMyInfo(showMyDetails);
        getMyBarns(showBarns); // CHAIN LOAD 1. USER BARNS 2. USER SERVICES 3. USER EVENTS 4. USER MARKET ITEMS
    }

    //LOAD USER ASSETS
    if (window.location.href.indexOf('uzivatel') > 0) {
        getSpecificUserInfo(showSpecificUserDetails); //all in one query
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

    //IF PAGE IS EVENT
    if (window.location.href.indexOf('udalost') > 0) {
        var eventId = findGetParameter('ID');
        getEventDetails(eventId, showEventDetails);
    }

    //IF PAGE IS ADVERT
    if (window.location.href.indexOf('inzerat') > 0) {
        var advertId = findGetParameter('ID');
        getAdvertDetails(advertId, showAdvertDetails);
        increaseViewCountAdvert(advertId);
    }

    $(document).on('click', '.showBarnServiceDetails', function (e) {
        e.preventDefault();
        showHideServiceDetails(this);
    });

    $(document).on('click', '.saveUserDetails', function () {
        updateUserData();
    });

    $(document).on('click', '#addComment', function () {
        showCommentInputBox();
    });

    $(document).on('click', '#sendMessage',function(){
        sendMessageToAdvertiser();
    });

    $(document).on('click', '.removeComment', function () {
        var commentbutton = this;
        $.confirm({
            title: 'Naozaj chcete vymazať komentár ?',
            content: '',
            escapeKey: 'close',
            columnClass: 'col-sm-6',
            closeIcon: true,
            buttons: {
                áno: function () {
                    removeComment(commentbutton);
                },
                nie: function () {
                    return true;
                },
                close: {
                    isHidden: true,
                    action: function () {
                        return true;
                    }
                }
            }
        });
    });

    $(document).on('click', '#closeNewComment', function () {
        $('#commentBox').remove();
    });

    $(document).on('click', '.editComment', function () {
        editComment(this);
    });

    $(document).on('click', '#updateComment', function () {
        updateComment(this);
    });

    $(document).on('click', '#saveComment', function () {
        saveComment();
    });

    $(document).on('change', "[name=userImage]:file", function () {
        var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
        $(".path").html(fileName);
    });

    $(document).on('change', '#serviceProvider, #organizer',function () {
        fetchLocation($(this).attr('id'));
    });

    $(document).on('change', '#chooseTutorial', function () {
        window.location.href = '/navody-a-ziadosti?nazov='+$(this).val();
    });

    $(document).on('change', '#type', function () {
        var chosenService = $(this).val();
        if (chosenService == 'Ostatné'){
            $("#serviceNameFormGroup").show();
        }else{
            $("#serviceNameFormGroup").hide();
        }
    });

    $(document).on('click', "#imageBorder", function () {
        $('#userImage').click();
    });

    if (window.location.href.indexOf('pridat') != -1 || window.location.href.indexOf('editovat') != -1) {
        $('.addAsset').confirm({
            title: 'Naozaj chcete pridať ' + decodeURIComponent(findGetParameter('what')) + ' ?',
            content: '',
            closeIcon: true,
            escapeKey: 'close',
            columnClass: 'col-sm-6',
            buttons: {
                áno: function () {
                    addAsset();
                },
                nie: function () {
                    return true;
                },
                close: {
                    isHidden: true,
                    action: function () {
                        return true;
                    }
                }
            }
        });

        $('.saveEditAsset').confirm({
            title: 'Naozaj chcete uložiť ' + decodeURIComponent(findGetParameter('what')) + ' ?',
            content: '',
            escapeKey: 'close',
            closeIcon: true,
            columnClass: 'col-sm-6',
            buttons: {
                áno: function () {
                    saveEditAsset();
                },
                nie: function () {
                    return true;
                },
                close: {
                    isHidden: true,
                    action: function () {
                        return true;
                    }
                }
            }
        });
    }

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
    $('.loginButton').css('text-transform', 'none');
    $('.loginButton').html('Môj Profil');
    var logoutButton = '<li class="menu-active"><a href="#" id="logout">Odhlásiť</a></li>';
    $('.nav-menu').append(logoutButton);
    $('#mobile-nav ul').eq(0).append(logoutButton);
    $('.dropup').show();
    if (userType == 'admin') {
        $('.dropup #fastAddMenu').append('<a href="novy-clanok.php" id="addArticle">Nový Článok</a>');
        $('.dropup #fastAddMenu').append('<a href="novy-navod.php" id="addTutorial">Nový Návod</a>');
    }
}

function showMyDetails(userData) {
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
        newTopicPanel += '<li><a href="/editovat-clanok.php?nazov=' + findGetParameter('nazov') + '" class="justify-content-between align-items-center d-flex"><h6><img src="/img/editIcon.png">Editovať tento článok</h6></a></li>';
    }
    newTopicPanel += '<li><a href="/novy-clanok.php" class="justify-content-between align-items-center d-flex"><h6><img src="/img/addNew.png">Pridať nový článok</h6></a></li>' +
        '<li><a href="/vsetky-clanky.php" class="justify-content-between align-items-center d-flex"><h6><img src="/img/list.png">Spravovať články</h6></a></li>' +
        '</ul>' +
        '</div>';
    $('.newsSideBar').prepend(newTopicPanel);
}

function showBarns(userBarns, stopChain) {
    stopChain = stopChain || null;
    var showUserBarns = "<div class='userBarns'>";
    showUserBarns += "<h3>Moje stajne</h3>";
    if (userBarns == null || userBarns.length == 0) {
        showUserBarns += "<b>Uživateľ nevlastní žiadne stajne</b>";
        showUserBarns += "</div>";
        $('#servicesBarnsEvents').find('.container').append(showUserBarns);
        if (!stopChain) {
            getMyServices(showServices);
        }
        return;
    }
    userBarns.forEach(function (singleBarn) {
        showUserBarns += "<div class='singleBarn' id='barnId" + singleBarn.ID + "'>";
        showUserBarns += "<div class='editAsset' title='Editovať' id='barn" + singleBarn.ID + "'><a href='editovat.php?ID=" + singleBarn.ID + "&what=stajňu'><img src='/img/editIcon.png' alt=''></a></div>";
        showUserBarns += "<div class='removeAsset' title='Zmazať stajňu' id='barn" + singleBarn.ID + "'>X</div>";
        showUserBarns += "<a href='stajna.php?ID=" + singleBarn.ID + "' title='Prejsť do stajne'>";
        showUserBarns += "<div class='barnImage'><img src='" + (singleBarn.barnImage == null ? returnDefaultImage('stajňa') : singleBarn.barnImage) + "' alt=''></div>";
        showUserBarns += "<div class='barnName'><h4>" + singleBarn.barnName + "</h4></div>";
        showUserBarns += "<div class='barnLocation'><b>Lokalita:</b> " + singleBarn.location + "</div>";
        showUserBarns += "<div class='barnRidingStyle'><b>Jazdecký štýl:</b> " + singleBarn.barnRidingStyle + "</div>";
        showUserBarns += "<div class='barnDescription'><b>Popis:</b> " + singleBarn.barnDescription.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showUserBarns += "</div>";
        showUserBarns += "</a>";
    });
    showUserBarns += "</div>";
    $('#servicesBarnsEvents').find('.container').append(showUserBarns);
    //now get user services
    
    if (!stopChain){
        getMyServices(showServices);
    }
}

function showServices(userServices, stopChain) {
    stopChain = stopChain || null;
    var showUserServices = "<div class='userServices'>";
    showUserServices += "<hr>";
    showUserServices += "<h3>Moje služby</h3>";
    showUserServices += "<p>Ponúkané v mojom mene alebo v mene stajne, ktorú spravujem</p>";

    if (userServices == null || userServices.length == 0) {
        showUserServices += "<b>Uživateľ neponúka žiadne služby</b>";
        showUserServices += "</div>";
        $('#servicesBarnsEvents').find('.container').append(showUserServices);
        if (!stopChain) {
            getMyEvents(showUserEvents);
        }
        return;
    }
    userServices.forEach(function (singleService) {
        showUserServices += "<div class='singleService' id='barnId" + singleService.ID + "'>";
        showUserServices += "<div class='editAsset' title='Editovať' id='service" + singleService.ID + "'><a href='editovat.php?ID=" + singleService.ID + "&what=službu'><img src='/img/editIcon.png' alt=''></a></div>";
        showUserServices += "<div class='removeAsset' title='Zmazať službu' id='service" + singleService.ID + "'>X</div>";
        showUserServices += "<a href='sluzba.php?ID=" + singleService.ID + "' title='Prejsť do služby'>";
        showUserServices += "<div class='serviceImage'><img src='" + (singleService.serviceImage == null ? returnDefaultImage(singleService.type) : singleService.serviceImage) + "' alt=''></div>";
        showUserServices += "<div class='type'><h4>"+(singleService.serviceName.length == 0 ? "" : singleService.serviceName + " - ") + (singleService.barnId == null ? singleService.fullName : singleService.barnName) + "</h4></div>";
        showUserServices += "<div class='provider'><b>Služba:</b> " + singleService.type + "</div>";
        showUserServices += "<div class='provider'><b>Poskytovateľ:</b> " + (singleService.barnId != null ? singleService.barnName : singleService.fullName) + "</div>";
        showUserServices += "<div class='serviceLocation'><b>Lokalita:</b> " + singleService.location + "</div>";
        showUserServices += "<div class='descriptionOfService'><b>Popis:</b> " + singleService.descriptionOfService.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showUserServices += "</div>";
        showUserServices += "</a>";
    });
    showUserServices += "</div>";
    $('#servicesBarnsEvents').find('.container').append(showUserServices);
    if (!stopChain) {
        getMyEvents(showUserEvents);
    }
}

function showUserEvents(userEvents, stopChain) {
    stopChain = stopChain || null;
    var showUserEvents = "<div class='userEvents'>";
    showUserEvents += "<hr>";
    showUserEvents += "<h3>Moje udalosti</h3>";
    showUserEvents += "<p>Usporiadané v mojom mene alebo v mene stajne, ktorú spravujem</p>";

    if (userEvents == null || userEvents.length == 0) {
        showUserEvents += "<b>Uživateľ neusporadúva žiadne udalosti</b>";
        showUserEvents += "</div>";
        $('#servicesBarnsEvents').find('.container').append(showUserEvents);
        if (!stopChain) {
            getMyMarketItems(showUserMarketItems);
        }
        return;
    }
    userEvents.forEach(function (singleEvent) {
            showUserEvents += "<div class='singleEvent' id='eventId" + singleEvent.ID + "'>";
            showUserEvents += "<div class='editAsset' title='Editovať' id='service" + singleEvent.ID + "'><a href='editovat.php?ID=" + singleEvent.ID + "&what=udalosť'><img src='/img/editIcon.png' alt=''></a></div>";
            showUserEvents += "<div class='removeAsset' title='Zmazať udalosť' id='event" + singleEvent.ID + "'>X</div>";
            showUserEvents += "<a href='udalost.php?ID=" + singleEvent.ID + "' title='Zobraziť udalosť'>";
            showUserEvents += "<div class='eventImage'><img src='" + (singleEvent.eventImage == null ? returnDefaultImage('event') : singleEvent.eventImage) + "' alt=''></div>";
            showUserEvents += "<div class='eventName'><h4>" + singleEvent.eventName + "</h4></div>";
            showUserEvents += "<div class='eventOrganizer'><b>Organizátor:</b> " + (singleEvent.barnId == null ? singleEvent.fullName : singleEvent.barnName) + "</h4></div>";
            showUserEvents += "<div class='eventLocation'><b>Lokalita:</b> " + singleEvent.location + "</div>";
            showUserEvents += "<div class='eventDate'><b>Dátum:</b> " + singleEvent.eventDate + ' - ' + singleEvent.eventEnd + "</div>";
            showUserEvents += "<div class='eventDescription'><b>Popis:</b> " + singleEvent.eventDescription.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showUserEvents += "</a>";
        showUserEvents += "</div>";
    });
    showUserEvents += "</div>";
    $('#servicesBarnsEvents').find('.container').append(showUserEvents);
    if (!stopChain) {
        getMyMarketItems(showUserMarketItems);
    }
}

function showUserMarketItems(marketItems) {
    var showUserAdverts = "<div class='userMarketItems'>";
    showUserAdverts += "<hr>";
    showUserAdverts += "<h3>Moje inzeráty</h3>";

    if (marketItems == null || marketItems.length == 0) {
        showUserAdverts += "<b>Užívateľ nemá vytvorené žiadne inzeráty</b>";
        showUserAdverts += "</div>";
        $('#servicesBarnsEvents').find('.container').append(showUserAdverts);
        return;
    }
    marketItems.forEach(function (singleItem) {
        showUserAdverts += "<div class='singleAdvert' id='advertId" + singleItem.ID + "'>";
        showUserAdverts += "<div class='editAsset' title='Editovať' id='advert" + singleItem.ID + "'><a href='editovat.php?ID=" + singleItem.ID + "&what=inzerát'><img src='/img/editIcon.png' alt=''></a></div>";
        showUserAdverts += "<div class='removeAsset' title='Zmazať inzerát' id='advert" + singleItem.ID + "'>X</div>";
        showUserAdverts += "<a href='inzerat.php?ID=" + singleItem.ID + "' title='Zobraziť udalosť'>";
        showUserAdverts += "<div class='eventImage'><img src='" + (singleItem.eventImage == null ? returnDefaultImage('advert') : singleItem.eventImage) + "' alt=''></div>";
        showUserAdverts += "<div class='advertName'><h4>" + singleItem.title + "</h4></div>";
        showUserAdverts += "<div class='advertCategory'><b>Kategória:</b> " + singleItem.mainCategory + "</h4></div>";
        showUserAdverts += "<div class='advertSubCategory'><b>Podkategória:</b> " + singleItem.subCategory + "</div>";
        showUserAdverts += "<div class='eventLocation'><b>Lokalita:</b> " + singleItem.location + "</div>";
        showUserAdverts += "<div class='advertDescription'><b>Popis:</b> " + singleItem.details.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showUserAdverts += "</a>";
        showUserAdverts += "</div>";
    });
    showUserAdverts += "</div>";
    $('#servicesBarnsEvents').find('.container').append(showUserAdverts);
}

function showBarnDetails(barnDetails) {
    showGeneralBarnInfo(barnDetails);
    if (barnDetails.barnServices.length > 0) {
        showBarnServices(barnDetails);
    }else{
        $('#offeredServices').append("Stajňa neponúka zatiaľ žiadne služby");
    }

    if (barnDetails.events.length > 0) {
        showBarnEvents(barnDetails);
    } else {
        $('#events').append("Stajňa nemá naplánované žiadne udalosti");
    }
    
    if (barnDetails.gallery.length > 0) {
        fillGaleryImages(barnDetails);
    }else{
        $('#gallery').append("Stajňa nemá žiadne fotky v galérii");
    }
    $('#gallery').after("<div id='advertFbShare' style='text-align:center;'>Zdieľať na <a class='facebookShare' href='https://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "' title='Zdielať na Facebooku'><i class='fa fa-facebook'></i></a></div>");
}

function showGeneralBarnInfo(barnDetails) {
    barnDetails.generalDetails.forEach(function (barnDetails) {
        $('#barnName').html(barnDetails.barnName);
        //document.title = barnDetails.barnName + ' - ' + document.title;
        var showedBarnDetails = "<div class='barnAllDetails'>";
        showedBarnDetails += "<div class='barnLeftDetails'>";
        showedBarnDetails += "<h3>Detaily stajne</h3>";
        showedBarnDetails += "<div class='generalBarnInfo'>";
        showedBarnDetails += "<div><b>Názov stajne:</b> " + barnDetails.barnName + "</div>";
        showedBarnDetails += "<div><b>Adresa:</b> " + barnDetails.location + "</div>";
        showedBarnDetails += "<div><b>Ulica:</b> " + barnDetails.barnStreet + "</div>";
        showedBarnDetails += "<div><b>Email:</b> <a href='mailto:" + barnDetails.barnEmail + "'>" + barnDetails.barnEmail + "</a></div>";
        showedBarnDetails += "<div><b>Kontaktná osoba:</b> " + barnDetails.barnContactPerson + "</div>";
        showedBarnDetails += "<div><b>Telefón:</b> " + barnDetails.barnPhone + "</div>";
        showedBarnDetails += "<div><b>Jazdecký štýl:</b> " + (barnDetails.barnRidingStyle != "null" ? barnDetails.barnRidingStyle : "Neuvedené")  + "</div>";
        showedBarnDetails += "<div><b>Typ koní:</b> " + barnDetails.barnHorseTypes + "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "<div class='barnRightDetails'>";
        showedBarnDetails += "<h3>Otváracie hodiny</h3>";
        showedBarnDetails += "<div class='barnContactInfo'>";
        showedBarnDetails += "<div>" + openHoursTable(barnDetails.barnOpenHours) + "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "<div style='text-align:center;margin-top:15px;'><h3 class='detailsHeading'>Popis</h3><div style='text-align:left;'>" + barnDetails.barnDescription + "</div></div>";
        showedBarnDetails += "<div class='barnSocialNetworks'>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnFacebook ? barnDetails.barnFacebook + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnFacebook ? '' : 'notAvailable') + "' title='Facebook - " + barnDetails.barnName + "'><img src='/img/socialFacebook.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnInstagram ? barnDetails.barnInstagram + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnInstagram ? '' : 'notAvailable') + "' title='Instagram - " + barnDetails.barnName + "'><img src='/img/socialInstagram.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnYoutube ? barnDetails.barnYoutube + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnYoutube ? '' : 'notAvailable') + "' title='Youtube - " + barnDetails.barnName + "'><img src='/img/socialYoutube.png' alt=''></a></div>";
        showedBarnDetails += "<div><a href='" + (barnDetails.barnTwitter ? barnDetails.barnTwitter + "' target=_blank" : "#a") + "' class='" + (barnDetails.barnTwitter ? '' : 'notAvailable') + "' title='Twitter - " + barnDetails.barnName + "'><img src='/img/socialTwitter.png' alt=''></a></div>";
        showedBarnDetails += "</div>";
        $('#barnDetails').html(showedBarnDetails);

        $('#servicesBarnsEvents').before('<section id="googleMap"><div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=' + barnDetails.location + ',' + barnDetails.barnStreet + '&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{margin-left:auto;margin-right:auto;height:500px;width:100%;max-width:1000px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></section><hr>');
    });
}

function showBarnServices(barnDetails) {
    var showedBarnDetails = "";
    barnDetails.barnServices.forEach(function (barnService) {
        showedBarnDetails += "<a href='sluzba.php?ID=" + barnService.ID + "' title='Zobraziť detaily služby'>";
        showedBarnDetails += "<div class='singleService' id='barnId" + barnService.ID + "'>";
        showedBarnDetails += "<div class='serviceImage'><img src='" + returnDefaultImage(barnService.type) + "' alt=''></div>";
        showedBarnDetails += "<div class='type'><h4>" + barnService.type + "</h4></div>";
        showedBarnDetails += "<div class='provider'><b>Poskytovateľ:</b> " + barnDetails.generalDetails[0].barnName + "</div>";
        showedBarnDetails += "<div class='servicePrice'><b>Cena:</b> " + (!isNaN(barnService.price) ? barnService.price + " €" : barnService.price) + " </div>";
        showedBarnDetails += "<div class='descriptionOfService'><b>Detaily:</b> " + barnService.descriptionOfService.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</a>";
    });

    $('#offeredServices').append(showedBarnDetails);
}

function showBarnEvents(barnDetails) {
    var showedBarnDetails = "";
    barnDetails.events.forEach(function (singleEvent) {
        showedBarnDetails += "<a href='udalost.php?ID=" + singleEvent.ID + "' title='Zobraziť detaily udalosti'>";
        showedBarnDetails += "<div class='singleEvent' id='eventId" + singleEvent.ID + "'>";
        showedBarnDetails += "<div class='eventImage'><img src='" + (singleEvent.eventImage == null ? returnDefaultImage('event') : singleEvent.eventImage) + "' alt=''></div>";
        showedBarnDetails += "<div class='type'><h4>" + singleEvent.eventName + "</h4></div>";
        showedBarnDetails += "<div class='eventOrganizer'><b>Organizátor:</b> " + (singleEvent.barnId == null ? singleEvent.fullName : singleEvent.barnName) + "</h4></div>";
        showedBarnDetails += "<div class='eventLocation'><b>Lokalita:</b> " + singleEvent.location + "</div>";
        showedBarnDetails += "<div class='eventDate'><b>Dátum:</b> " + singleEvent.eventDate + " - " + singleEvent.eventEnd + "</div>";
        showedBarnDetails += "<div class='eventDetails'><b>Popis:</b> " + singleEvent.eventDescription.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showedBarnDetails += "</div>";
        showedBarnDetails += "</a>";
    });

    $('#events').append(showedBarnDetails);
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
    serviceDetails.generalDetails.forEach(function (oneService) {
        //document.title = oneService.type + ' - ' + document.title;
        var serviceName = oneService.serviceName.length == 0 ? "" : " - " + oneService.serviceName;
        $('#serviceName').html(oneService.type + serviceName);
        var showedService = "<div class='serviceAllDetails'>";
        showedService += "<div class='serviceLeftDetails'>";
        showedService += "<h3>Detaily služby</h3>";
        showedService += "<div class='generalServiceInfo'>";
        showedService += "<div><b>Meno / Poskytovateľ:</b> " + (oneService.barnName == null ? "<a href='uzivatel.php?ID=" + oneService.userId + "' title='Zobraziť užívateľa'>" + oneService.fullName + "</a>" :
        "<a href='stajna.php?ID=" + oneService.barnId + "' title='Prejsť do stajne'>" + oneService.barnName + "</a>") + "</div>";
        //special criteria   
        if (serviceDetails.specialCriteria.length > 0) {
            var showSpecificValues = "";
            serviceDetails.specialCriteria.forEach(function(oneCriteria) {
                showSpecificValues += oneCriteria.specificValue + ', ';
            });
            showSpecificValues = showSpecificValues.substring(0, showSpecificValues.length - 2);
            if (serviceDetails.specialCriteria[0].specificCriteria != "null"){
                showedService += "<div><b>"+serviceDetails.specialCriteria[0].specificCriteria+":</b> " + showSpecificValues + "</div>";
            }
        }
        showedService += "<div><b>Adresa:</b> " + oneService.location + "</div>";
        showedService += "<div><b>Ulica:</b> " + oneService.street + "</div>";
        showedService += "<div><b>Email:</b> <a href='mailto:" + (oneService.barnId == null ? oneService.userEmail : oneService.barnEmail) + "'>" + (oneService.barnId == null ? oneService.userEmail : oneService.barnEmail) + "</a></div>"; 
        var phoneContact = oneService.userPhone == null ? oneService.barnPhone : oneService.userPhone
        showedService += "<div><b>Telefón:</b> " + (phoneContact == null ? "Neuvedené" : phoneContact) + "</div>";
        showedService += "<div><b>Prídeme aj za vami:</b> " + oneService.isWillingToTravel + "</div>";
        if (oneService.isWillingToTravel == 'Áno'){
            var traveling = !isNaN(oneService.rangeOfOperation) ? oneService.rangeOfOperation + " km" : oneService.rangeOfOperation;
            showedService += "<div><b>Do okolia:</b> " + (traveling != "" ? traveling : "Neuvedené") + "</div>";
        }
        showedService += "<div style='font-weight:bold;'><b>Cena:</b> " + (!isNaN(oneService.price) ? oneService.price + " €" : oneService.price) + "</div>";
        showedService += "</div>";
        showedService += "</div>";
        showedService += "<div class='serviceRightDetails'>";
        showedService += "<h3>Dostupný / Pracuje v časoch</h3>";
        showedService += "<div class='serviceContactInfo'>";
        showedService += "<div>" + openHoursTable(oneService.workHours) + "</div>";
        showedService += "</div>";
        showedService += "</div>";
        showedService += "</div>";
        showedService += "<div style='text-align:center;margin-top:15px;'><h3 class='detailsHeading'>Popis</h3><div style='text-align:left;'>" + oneService.descriptionOfService + "</div></div>";
        showedService += "<div class='serviceSocialNetworks'>";
        showedService += "<div><a href='" + (oneService.serviceFacebook ? oneService.serviceFacebook + "' target=_blank" : "#a") + "' class='" + (oneService.serviceFacebook ? '' : 'notAvailable') + "' title='Facebook - " + oneService.type + "'><img src='/img/socialFacebook.png' alt=''></a></div>";
        showedService += "<div><a href='" + (oneService.serviceInstagram ? oneService.serviceInstagram + "' target=_blank" : "#a") + "' class='" + (oneService.serviceInstagram ? '' : 'notAvailable') + "' title='Instagram - " + oneService.type + "'><img src='/img/socialInstagram.png' alt=''></a></div>";
        showedService += "<div><a href='" + (oneService.serviceYoutube ? oneService.serviceYoutube + "' target=_blank" : "#a") + "' class='" + (oneService.serviceYoutube ? '' : 'notAvailable') + "' title='Youtube - " + oneService.type + "'><img src='/img/socialYoutube.png' alt=''></a></div>";
        showedService += "<div><a href='" + (oneService.serviceTwitter ? oneService.serviceTwitter + "' target=_blank" : "#a") + "' class='" + (oneService.serviceTwitter ? '' : 'notAvailable') + "' title='Twitter - " + oneService.type + "'><img src='/img/socialTwitter.png' alt=''></a></div>";
        showedService += "</div>";
        $('#serviceDetails').html(showedService);
        $('#servicesBarnsEvents').before('<section id="googleMap"><div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=' + oneService.location + ',' + oneService.street + '&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{margin-left:auto;margin-right:auto;height:500px;width:100%;max-width:1000px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></section>');
    });
    
    if (serviceDetails.gallery.length > 0) {
        fillGaleryImages(serviceDetails);
    }else{
        $('#gallery').append("Služba nemá žiadne fotky v galérii");
    }
    $('#gallery').after("<div id='advertFbShare' style='text-align:center;'>Zdieľať na <a class='facebookShare' href='https://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "' title='Zdielať na Facebooku'><i class='fa fa-facebook'></i></a></div>");
}


function showEventDetails(eventDetails) {
    eventDetails.generalDetails.forEach(function (eventDetails) {
        //document.title = eventDetails.eventName + ' - ' + document.title;
        $('#eventName').html(eventDetails.eventName);
        var showEventDetails = "<div class='eventAllDetails'>";
        showEventDetails += "<div class='eventLeftDetails'>";
        showEventDetails += "<h3>Kontaktné informácie:</h3>";
        showEventDetails += "<div class='generalEventInfo'>";
        showEventDetails += "<div><b>Usporiadateľ:</b> " + (eventDetails.barnName == null ? "<a href='uzivatel.php?ID=" + eventDetails.userId + "' title='Zobraziť užívateľa'>" + eventDetails.fullName + "</a>" :
            "<a href='stajna.php?ID=" + eventDetails.barnId + "' title='Prejsť do stajne'>" + eventDetails.barnName + "</a>") + "</div>";
        showEventDetails += "<div><b>Typ udalosti:</b> " + (eventDetails.eventType ? eventDetails.eventType : "")  + "</div>";
        showEventDetails += "<div><b>Adresa:</b> " + eventDetails.location + "</div>";
        showEventDetails += "<div><b>Ulica:</b> " + eventDetails.eventStreet + "</div>";
        showEventDetails += "<div><b>Email:</b> <a href='mailto:" + (eventDetails.email == null ? eventDetails.barnEmail : eventDetails.email) + "'>" + (eventDetails.email == null ? eventDetails.barnEmail : eventDetails.email) + "</a></div>";
        showEventDetails += "<div><b>Telefón:</b> " + (eventDetails.phoneNumber == null ? eventDetails.barnPhone : eventDetails.phoneNumber) + "</div>";
        showEventDetails += "</div>";
        showEventDetails += "</div>";
        showEventDetails += "<div class='eventRightDetails'>";
        showEventDetails += "<h3>Dátum udalosti</h3>";
        showEventDetails += "<div class='eventContactInfo'>";
        showEventDetails += "<div class='eventDate'><b>Začiatok:</b> " + eventDetails.eventDate + "</div>";
        showEventDetails += "<div class='eventDate'><b>Koniec:</b> " + eventDetails.eventEnd + "</div>";
        showEventDetails += "</div>";
        showEventDetails += "</div>";
        showEventDetails += "</div>";
        showEventDetails += "<div style='text-align:center;margin-top:15px;'><h3 class='detailsHeading'>Popis</h3><div style='text-align:left;margin-top: 5px;'>" + eventDetails.eventDescription + "</div></div>";
        showEventDetails += "<div class='serviceSocialNetworks'>";
        showEventDetails += "<div><a href='" + (eventDetails.eventFBLink ? eventDetails.eventFBLink + "' target=_blank" : "#a") + "' class='" + (eventDetails.eventFBLink ? '' : 'notAvailable') + "' title='Facebook udalosť - " + eventDetails.eventName + "'><img src='/img/socialFacebook.png' alt=''></a></div>";
        showEventDetails += "</div>";
        $('#eventDetails').append(showEventDetails);
        $('#gallery').before('<section id="googleMap"><div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=' + eventDetails.location + ',' + eventDetails.eventStreet + '&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{margin-left:auto;margin-right:auto;height:500px;width:100%;max-width:1000px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div></section>');

    });


    if (eventDetails.gallery.length > 0) {
        fillGaleryImages(eventDetails);
    }else{
        $('#gallery').append("Udalosť nemá žiadne fotky v galérii");
    }
     $('#gallery').after("<div id='advertFbShare' style='text-align:center;'>Zdieľať na <a class='facebookShare' href='https://www.facebook.com/sharer/sharer.php?u=" + window.location.href + "' title='Zdielať na Facebooku'><i class='fa fa-facebook'></i></a></div>");
}

function showAdvertDetails(advertDetails){
    advertDetails.generalDetails.forEach(function (advertDetails) {
        document.title = advertDetails.title + ' - ' + document.title;
        $('#advert').html("Inzerát - " +advertDetails.title);
        var showadvertDetails = "<div class='text-center pb-40'><h3 class='detailsHeading'>Popis inzerátu</h3>";

        showadvertDetails += "<div><b>Typ:</b> " + advertDetails.offerOrSearch + "</div>";
        showadvertDetails += "<div><b>Kategória:</b> " + advertDetails.mainCategory + "</div>";
        showadvertDetails += "<div><b>Podkategória:</b> " + advertDetails.subCategory + "</div>";
        if (advertDetails.specificCriteria != null && advertDetails.specificCriteria != "null"){
            showadvertDetails += "<div><b>Poznámky:</b> " + advertDetails.specificCriteria + "</div>";
        }
        showadvertDetails += "<div><b>Cena:</b> <span style='font-weight:bold;'>" + (!isNaN(advertDetails.price) ? advertDetails.price + " €" : advertDetails.price) + "</span></div>";
        showadvertDetails += "<div style='text-align:left;'><b>Detail:</b><br>" + advertDetails.details + "</div>";
        showadvertDetails += "</div>";
        $('#advertDetails').append(showadvertDetails);
        showadvertDetails = "<div class='text-center advertAllDetails'>";
        showadvertDetails += "<h3>Kontaktné informácie</h3>";
        showadvertDetails += "<div class='generalEventInfo'>";
        showadvertDetails += "<div><b>Meno:</b> " + advertDetails.fullName + "</div>";
        showadvertDetails += "<div><b>Adresa:</b> " + advertDetails.location + "</div>";
        showadvertDetails += "<div><b>Email:</b> <a href='mailto:" + advertDetails.email + "'>" + advertDetails.email + "</a></div>";
        showadvertDetails += "<div><b>Telefón:</b> " + advertDetails.phone + "</div>";
        showadvertDetails += "</div>";
        showadvertDetails += "</div>";
        showadvertDetails += "<div id='viewCountAndEdit'>";
        showadvertDetails += "<div id='viewCount'><b>Zobrazené:</b> " + advertDetails.visited + "x</div>";
        showadvertDetails += "<div id='editDeleteAdvert'>Editovať / Zmazať inzerát</div>";
        showadvertDetails += "</div>";
        showadvertDetails += "<div id='advertFbShare'>Zdieľať na <a class='facebookShare' href='https://www.facebook.com/sharer/sharer.php?u="+window.location.href+"' title='Zdielať na Facebooku'><i class='fa fa-facebook'></i></a></div>";
        $('#advertContact').append(showadvertDetails);
        $('#messageArea').val($('#messageArea').val() + advertDetails.title);
        bindEditDeleteAdvert();
    });


    if (advertDetails.gallery.length > 0) {
        fillGaleryImages(advertDetails);
    } else {
        $('#gallery').append("Inzerát nemá žiadne fotky v galérii");
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
        force_br_newlines: true,
        force_p_newlines: false,
        forced_root_block: '', // Needed for 3.x
        indent: false,
        min_height: 200,
        toolbar: 'fullscreen',
        extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    });
}

if (localStorage.getItem("welcomMessage") == null && localStorage.getItem("token") != null) {
    $('#welcomeMessage').modal();
}

$(document).on('click', '.closeWelcomeMessage', function () {
    localStorage.setItem("welcomMessage","seen");
});

$(document).keyup(function (e) {
    if (e.which == 27 && $('body').hasClass('modal-open')) {
        localStorage.setItem("welcomMessage", "seen");
    }
})

$(document).click(function (e) {
    if (e.target.id === 'welcomeMessage' && $('body').hasClass('modal-open')) {
        localStorage.setItem("welcomMessage", "seen");
    }
})

//teaser banner - for apps, upcoming events, etc
if (localStorage.getItem("teaserBanner") == null) {
    $('#teaserBanner').modal();
}

$(document).on('click', '.closeteaserBanner', function () {
    localStorage.setItem("teaserBanner","seen");
    $('#teaserBanner').modal('toggle');
});

$(document).keyup(function (e) {
    if (e.which == 27 && $('body').hasClass('modal-open')) {
        localStorage.setItem("teaserBanner", "seen");
    }
});

$(document).click(function (e) {
    if (e.target.id === 'teaserBanner' && $('body').hasClass('modal-open')) {
        localStorage.setItem("teaserBanner", "seen");
    }
});

//end of teaser banner

function updateUserData() {
    if ($('[name=email]').val() == ""){
        warningAnimation("Email nesmie ostať prázdny.");
        return;
    }
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
    if (events.foundEvents.length == 0) {
        $('#eventSearchResults').html('');
        $('#assetsFound').html("");
        $('#eventSearchResults').append('<p><br>Zadaným kritériam nevyhovujú žiadne výsledky. Skúste menej detailov alebo pridajte <a href="pridat.php?what=udalosť">novú udalosť</a>.</p>');
        return;
    }
    var showEvents = "";
    events.foundEvents.forEach(function (singleEvent) {
        showEvents += "<div class='single-post'>";
        showEvents += "<a href='udalost.php?ID=" + singleEvent.eventId + "' title='Zobraziť udalosť'>";
        showEvents += "<div class='singleEvent' id='eventId" + singleEvent.ID + "'>";
        showEvents += "<div class='eventImage'><img src='" + (singleEvent.eventImage == null ? returnDefaultImage('event') : singleEvent.eventImage) + "' alt=''></div>";
        showEvents += "<div class='eventName'><h4>" + singleEvent.eventName + "</h4></div>";
        showEvents += "<div class='eventOrganizer'><b>Organizátor:</b> " + (singleEvent.barnId == null ? singleEvent.fullName : singleEvent.barnName) + "</h4></div>";
        showEvents += "<div class='eventLocation'><b>Lokalita:</b> " + singleEvent.province + ' - ' + singleEvent.region + ' - ' + singleEvent.localCity +"</div>";
        showEvents += "<div class='eventDate'><b>Dátum:</b> " + singleEvent.eventDate + ' - ' + singleEvent.eventEnd + "</div>";
        showEvents += "<div class='eventDescription'><b>Popis:</b> " + singleEvent.eventDescription.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showEvents += "</div>";
        showEvents += "</a>";
        showEvents += "</div>";
    });
    //pagination
    if (events.foundEvents.length > 0) {
        $('#assetsFound').html('Zobrazených <span id="resultRange"></span> udalostí z <span id="resultNumber"></span>');
    }
    $('#resultRange').html(rangeSearch(events.foundEvents.length));
    $('#resultNumber').html(events.allEvents);

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
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
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
    formData.append('barnOpenHours', getOpenHours());
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
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#price').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
        return;
    }
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('serviceProvider', $('#serviceProvider').val());
    formData.append('type', $('#type').val());
    formData.append('serviceName', $('#serviceNameForm').val());
    formData.append('serviceImage[]', $('#serviceImage').prop('files')[0]);
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('street', $('#street').val());
    formData.append('isWillingToTravel', $('#isWillingToTravel').val());
    formData.append('rangeOfOperation', $('#rangeOfOperation').val());
    formData.append('price', $('#price').val());
    formData.append('serviceInstagram', $('#serviceInstagram').val());
    formData.append('serviceFacebook', $('#serviceFacebook').val());
    formData.append('serviceTwitter', $('#serviceTwitter').val());
    formData.append('serviceYoutube', $('#serviceYoutube').val());
    formData.append('workHours', getOpenHours());
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
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
        return;
    }
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('organizer', $('#organizer').val());
    formData.append('eventName', $('#eventName').val());
    formData.append('eventDate', $('#eventDate').val().replace('-',''));
    formData.append('eventEnd', $('#eventEnd').val().replace('-', ''));
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
    if (!verifyCaptcha()) {
        return false;
    }
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
        $('#priceMarket').val() == "" ||
        $('#advertPassword').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
        return;
    }
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('marketTitle', $("#marketTitle").val());
    formData.append('offerOrSearch', $("#offerOrSearch").val());
    formData.append('mainCategory',$("#mainCategory").val());
    formData.append('subCategory',$("#subCategory").val());
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('marketPhone',$("#marketPhone").val());
    formData.append('marketContactPerson',$("#marketContactPerson").val());
    formData.append('marketEmail',$("#marketEmail").val());
    formData.append('priceMarket',$("#priceMarket").val());
    formData.append('advertPassword', $("#advertPassword").val());
    formData.append('specialAdvertCriteria', $('#specialAdvertCriteria').val());
    formData.append('marketDescription', tinymce.activeEditor.getContent());
    
    $('.marketGalleries').each(function(){
        var galleryImages = $(this)[0].files.length;
        for (var x = 0; x < galleryImages; x++) {
            formData.append("marketGalleries[]", $(this)[0].files[x]);
        }
    });
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
        $('.street').val('');
        $('.openHours').find('select').each(function () {
            $(this).val('');
        })
    }else{
        $('.locationProvince').val('province|' + resultOfBacked[0].province);
        $('.locationRegion').val('region|' + resultOfBacked[0].region);
        $('.locationLocalCity').val('localCity|' + resultOfBacked[0].localCity);
        $('.street').val(resultOfBacked[0].barnStreet);
        fillOpenHours(resultOfBacked[0].barnOpenHours);
    }
}


function returnDefaultImage(service) {
    switch (service.toLowerCase()) {
        case "jazdenie / výcvik":
            return '/img/icons/jazdenie.png\' style=\'width:90px;height:90px;';
        case "prenájom koňa":
            return '/img/icons/prenajom.png\' style=\'width:90px;height:90px;';
        case "ustajnenie":
            return '/img/icons/ustajnenie.png\' style=\'width:90px;height:90px;';
        case "tréner":
            return '/img/icons/trener.png\' style=\'width:90px;height:90px;';
        case "kováč":
            return '/img/icons/kovac.png\' style=\'width:90px;height:90px;';
        case "sedlár":
            return '/img/icons/sedlar.png\' style=\'width:90px;height:90px;';
        case "fyzioterapeut":
            return '/img/icons/fyzioterapeut.png\' style=\'width:90px;height:90px;';
        case "veterinár":
            return '/img/icons/veterinar.png\' style=\'width:90px;height:90px;';
        case "prevoz":
            return '/img/icons/prevoz.png\' style=\'width:90px;height:90px;';
        case "strihač":
            return '/img/icons/strihac.png\' style=\'width:90px;height:90px;';
        case "práca / brigáda":
            return '/img/icons/praca.png\' style=\'width:90px;height:90px;';
        case "ostatné":
            return '/img/icons/ostatne.png\' style=\'width:90px;height:90px;';
        case "event":
            return '/img/icons/event.png\' style=\'width:90px;height:90px;';
        case "stajňa":
            return '/img/icons/stajna.png\' style=\'width:90px;height:90px;';
        case "advert":
            return '/img/icons/noImage.png\' style=\'width:90px;height:90px;';
        default:
            break;
    }
}

function openHoursTable(inputTime) {
    
    if (inputTime == null || inputTime.replace(/&\|/g, "").replace(/\|/g, "") == "") {
        return "Nebolo definované";
    }
    var table = "<table class='openHours'>";
    var weekDays = inputTime.split('&');
    for (var weekDay = 0; weekDay < weekDays.length; weekDay++) {
        var start = weekDays[weekDay].split('|')[0];
        var end = weekDays[weekDay].split('|')[1];
        table += "<tr>";
        table += "<th><b>" + getWeekDay(weekDay) + "</b></th>";
        if (start != "Zatvorené") {
            table += "<td>" + start + "</td>";
            table += "<td>-</td>";
            table += "<td>" + end + "</td>";
        }else{
            table += "<td colspan='3' style='text-align:center;'>" + start + "</td>";
        }
        table += "</tr>";
    }
    table += "</table>";
    return table;
}

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}

function getWeekDay(index){
    var weekDays = new Array('Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok', 'Sobota', 'Nedeľa');
    return weekDays[index];
}

function showEditableData(resultData) {
        switch (decodeURIComponent(findGetParameter('what'))) {
            case 'stajňu':
                fillBarnEditForm(resultData);
                break;
            case 'službu':
                fillServiceEditForm(resultData);
                break;
            case 'udalosť':
                fillEventEditForm(resultData);
                break;
            case 'inzerát':
                fillAdvertEditForm(resultData);
                break;
            default:
                break;
        }

        bindDeleteEvent('.removeImageFromGallery',removeImageFromGallery,"Naozaj chcete vymazať obrázok z galérie ?");
}

function fillBarnEditForm(resultData) {
    $('#barnName').val(resultData.generalDetails[0].barnName);
    $('.locationProvince').val('province|' + resultData.generalDetails[0].location.split(' - ')[0]);
    $('.locationRegion').val('region|' + resultData.generalDetails[0].location.split(' - ')[1]);
    $('.locationLocalCity').val('localCity|' + resultData.generalDetails[0].location.split(' - ')[2]);
    $('#barnStreet').val(resultData.generalDetails[0].barnStreet);
    $('#barnPhone').val(resultData.generalDetails[0].barnPhone);
    $('#barnContactPerson').val(resultData.generalDetails[0].barnContactPerson);
    $('#barnEmail').val(resultData.generalDetails[0].barnEmail);
    var ridingStyles = resultData.generalDetails[0].barnRidingStyle.split(',');
    for (i = 0; i < ridingStyles.length; i++) {
        $("#barnRidingStyle option[value='" + ridingStyles[i] + "']").attr('selected', 'selected');
    }
    $('#barnRidingStyle').multiselect('reload');
    $('#barnHorseTypes').val(resultData.generalDetails[0].barnHorseTypes);
    $('#barnFacebook').val(resultData.generalDetails[0].barnFacebook);
    $('#barnInstagram').val(resultData.generalDetails[0].barnInstagram);
    $('#barnTwitter').val(resultData.generalDetails[0].barnTwitter);
    $('#barnYoutube').val(resultData.generalDetails[0].barnYoutube);
    fillOpenHours(resultData.generalDetails[0].barnOpenHours);
    tinymce.activeEditor.execCommand('mceInsertContent', false, resultData.generalDetails[0].barnDescription);
    var imageList = "";
    for (var index = 0; index < resultData.gallery.length; index++) {
        imageList += '<div class="singleImage">';
        imageList += '<div class="removeImageFromGallery" title="Zmazať obrázok z galérie">X</div>';
        imageList += '<img src="' + resultData.gallery[index].imageLink + '" alt="">';
        imageList += '</div>';
    }
     $('#editGallery').append(imageList);
     $('.removeAsset').attr('id', 'barn' + findGetParameter('ID'));
}

function fillServiceEditForm(resultData) {
    if (resultData.generalDetails[0].barnId == null){
        $('#serviceProvider').val("me")
    }else{
        $('#serviceProvider').val(resultData.generalDetails[0].barnId)
    }
    $('#type').val(resultData.generalDetails[0].type);
    $('#type').trigger("change");
    if ($('#type').val() == 'Ostatné'){
        $('#serviceNameForm').val(resultData.generalDetails[0].serviceName);
        $('#serviceNameGroup').show();
    }
    getSpecialServiceCriteria();
    $('.locationProvince').val('province|' + resultData.generalDetails[0].location.split(' - ')[0]);
    $('.locationRegion').val('region|' + resultData.generalDetails[0].location.split(' - ')[1]);
    $('.locationLocalCity').val('localCity|' + resultData.generalDetails[0].location.split(' - ')[2]);
    $('#street').val(resultData.generalDetails[0].street);
    $('#isWillingToTravel').val(resultData.generalDetails[0].isWillingToTravel);
    $('#rangeOfOperation').val(resultData.generalDetails[0].rangeOfOperation);
    fillOpenHours(resultData.generalDetails[0].workHours);
    $('#price').val(resultData.generalDetails[0].price);

    $('#serviceInstagram').val(resultData.generalDetails[0].serviceInstagram);
    $('#serviceFacebook').val(resultData.generalDetails[0].serviceFacebook);
    $('#serviceTwitter').val(resultData.generalDetails[0].serviceTwitter);
    $('#serviceYoutube').val(resultData.generalDetails[0].serviceYoutube);

    for (i = 0; i < resultData.specialCriteria.length; i++) {
        $("#specialServiceCriteria option[value$='" + resultData.specialCriteria[i].specificValue + "']").attr('selected', 'selected');
    }
    $('#specialServiceCriteria').multiselect('reload');

    tinymce.activeEditor.execCommand('mceInsertContent', false, resultData.generalDetails[0].descriptionOfService);
    var imageList = "";
    for (var index = 0; index < resultData.gallery.length; index++) {
        imageList += '<div class="singleImage">';
        imageList += '<div class="removeImageFromGallery" title="Zmazať obrázok z galérie">X</div>';
        imageList += '<img src="' + resultData.gallery[index].imageLink + '" alt="">';
        imageList += '</div>';
    }
    $('#editGallery').append(imageList);
    $('.removeAsset').attr('id', 'service' + findGetParameter('ID'));
}

function fillEventEditForm(resultData) {
    if (resultData.generalDetails[0].barnId == null) {
        $('#organizer').val("me")
    } else {
        $('#organizer').val(resultData.generalDetails[0].barnId)
    }
    $('#eventName').val(resultData.generalDetails[0].eventName);
    $('#eventDate').val(resultData.generalDetails[0].eventDate);
    $('#eventEnd').val(resultData.generalDetails[0].eventEnd);
    $('.locationProvince').val('province|' + resultData.generalDetails[0].location.split(' - ')[0]);
    $('.locationRegion').val('region|' + resultData.generalDetails[0].location.split(' - ')[1]);
    $('.locationLocalCity').val('localCity|' + resultData.generalDetails[0].location.split(' - ')[2]);
    $('#eventStreet').val(resultData.generalDetails[0].eventStreet);
    $('#eventFBLink').val(resultData.generalDetails[0].eventFBLink);
    var eventTypes = resultData.generalDetails[0].eventType.split(',');
    for (i = 0; i < eventTypes.length; i++) {
        $("#eventType option[value='" + eventTypes[i] + "']").attr('selected', 'selected');
    }
    $('#eventType').multiselect('reload');
    tinymce.activeEditor.execCommand('mceInsertContent', false, resultData.generalDetails[0].eventDescription);
    var imageList = "";
    for (var index = 0; index < resultData.gallery.length; index++) {
        imageList += '<div class="singleImage">';
        imageList += '<div class="removeImageFromGallery" title="Zmazať obrázok z galérie">X</div>';
        imageList += '<img src="' + resultData.gallery[index].imageLink + '" alt="">';
        imageList += '</div>';
    }
    $('#editGallery').append(imageList);
    $('.removeAsset').attr('id', 'event' + findGetParameter('ID'));
}

function fillAdvertEditForm(resultData) {
    $("#marketTitle").val(resultData.generalDetails[0].title);
    $("#mainCategory").val(resultData.generalDetails[0].mainCategory);
    getSubcategoriesFromMain();
    
    $("#subCategory").val(resultData.generalDetails[0].subCategory);
    $("#offerOrSearch").val(resultData.generalDetails[0].offerOrSearch);
    $('.locationProvince').val('province|' + resultData.generalDetails[0].location.split(' - ')[0]);
    $('.locationRegion').val('region|' + resultData.generalDetails[0].location.split(' - ')[1]);
    $('.locationLocalCity').val('localCity|' + resultData.generalDetails[0].location.split(' - ')[2]);
    $("#marketPhone").val(resultData.generalDetails[0].phone);
    $("#marketContactPerson").val(resultData.generalDetails[0].fullName);
    $("#marketEmail").val(resultData.generalDetails[0].email);
    $("#priceMarket").val(resultData.generalDetails[0].price);
    $("#offerOrSearch").val(resultData.generalDetails[0].offerOrSearch);
    var specificCriteria = resultData.generalDetails[0].specificCriteria.split(',');
    for (i = 0; i < specificCriteria.length; i++) {
        $("#specialAdvertCriteria option[value='" + specificCriteria[i] + "']").attr('selected', 'selected');
    }
    $('#specialAdvertCriteria').multiselect('reload');

    tinymce.activeEditor.execCommand('mceInsertContent', false, resultData.generalDetails[0].details);
    var imageList = "";
    for (var index = 0; index < resultData.gallery.length; index++) {
        imageList += '<div class="singleImage">';
        imageList += '<div class="removeImageFromGallery" title="Zmazať obrázok z galérie">X</div>';
        imageList += '<img src="' + resultData.gallery[index].imageLink + '" alt="">';
        imageList += '</div>';
    }
    $('#editGallery').append(imageList);
    $('.removeAsset').attr('id', 'advert' + findGetParameter('ID'));
}

function fillOpenHours(openHours) {
    if (openHours == null){return;}
    var weekDays = openHours.split('&');
    var hourSelectIndex = 0;
    for (var weekDay = 0; weekDay < weekDays.length; weekDay++) {
        var startEnd = weekDays[weekDay].split('|');
        for (var x = 0; x < startEnd.length; x++) {
            $('.openHours').find('select:eq(' + hourSelectIndex + ')').val(startEnd[x]);
            hourSelectIndex++;
        }
    }
}

/*
SAVE EDITED ASSET
*/
function saveEditAsset() {
    switch (decodeURIComponent(findGetParameter('what'))) {
        case 'stajňu':
            saveEditBarn();
            break;
        case 'službu':
            saveEditService();
            break;
        case 'udalosť':
            saveEditEvent();
            break;
        case 'inzerát':
            saveEditItemInMarket();
            break;
        default:
            break;
    }
}

function saveEditBarn() {
    if (
        $('#barnName').val() == "" ||
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#barnPhone').val() == "" ||
        $('#barnEmail').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
        return;
    }

    var formData = new FormData();
    formData.append('ID', findGetParameter('ID'));
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
    formData.append('barnOpenHours', getOpenHours());
    formData.append('barnDescription', tinymce.activeEditor.getContent());
    var galleryImages = $('#barnGallery')[0].files.length;
    for (var x = 0; x < galleryImages; x++) {
        formData.append("barnGallery[]", $('#barnGallery')[0].files[x]);
    }
    saveEditAssetToDB(formData, '/saveEditBarn/');

}

function saveEditService() {
    if (
        $('#type').val() == "" ||
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#price').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
        return;
    }
    var formData = new FormData();
    formData.append('ID', findGetParameter('ID'));
    formData.append('token', localStorage.getItem("token"));
    formData.append('serviceProvider', $('#serviceProvider').val());
    formData.append('type', $('#type').val());
    formData.append('serviceName', $('#serviceNameForm').val());
    formData.append('serviceImage[]', $('#serviceImage').prop('files')[0]);
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('street', $('#street').val());
    formData.append('isWillingToTravel', $('#isWillingToTravel').val());
    formData.append('rangeOfOperation', $('#rangeOfOperation').val());
    formData.append('price', $('#price').val());
    formData.append('serviceInstagram',$('#serviceInstagram').val());
    formData.append('serviceFacebook',$('#serviceFacebook').val());
    formData.append('serviceTwitter',$('#serviceTwitter').val());
    formData.append('serviceYoutube',$('#serviceYoutube').val());
    formData.append('specialServiceCriteria', $('#specialServiceCriteria').val());
    formData.append('descriptionOfService', tinymce.activeEditor.getContent());
    formData.append('workHours', getOpenHours());
    var galleryImages = $('#serviceGallery')[0].files.length;
    for (var x = 0; x < galleryImages; x++) {
        formData.append("serviceGallery[]", $('#serviceGallery')[0].files[x]);
    }
    saveEditAssetToDB(formData, '/saveEditService/');

}

function saveEditEvent() {
    if (
        $('#eventName').val() == "" ||
        $('#eventDate').val() == "" ||
        $('.locationProvince').val() == "" ||
        $('.locationRegion').val() == "" ||
        $('.locationLocalCity').val() == "" ||
        $('#eventType').val() == ""
    ) {
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
        return;
    }
    var formData = new FormData();
    formData.append('ID', findGetParameter('ID'));
    formData.append('token', localStorage.getItem("token"));
    formData.append('organizer', $('#organizer').val());
    formData.append('eventName', $('#eventName').val());
    formData.append('eventDate', $('#eventDate').val().replace('-',''));
    formData.append('eventEnd', $('#eventEnd').val().replace('-', ''));
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
    saveEditAssetToDB(formData, '/saveEditEvent/');
}

function saveEditItemInMarket() {
    if (!verifyCaptcha()) {
        return false;
    }
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
        warningAnimation('Nevyplnili ste všetky potrebné polia označené hviezdičkou.');
        return;
    }
    if ($('#advertPassword').val() == ""){
        warningAnimation('Pre uloženie musíte zadať heslo inzerátu');
        return;
    }
    var formData = new FormData();
    formData.append('ID', findGetParameter('ID'));
    formData.append('token', localStorage.getItem("token"));
    formData.append('marketTitle', $("#marketTitle").val());
    formData.append('offerOrSearch', $("#offerOrSearch").val());
    formData.append('mainCategory', $("#mainCategory").val());
    formData.append('subCategory', $("#subCategory").val());
    formData.append('locationProvince', $('.locationProvince').val());
    formData.append('locationRegion', $('.locationRegion').val());
    formData.append('locationLocalCity', $('.locationLocalCity').val());
    formData.append('marketPhone', $("#marketPhone").val());
    formData.append('marketContactPerson', $("#marketContactPerson").val());
    formData.append('marketEmail', $("#marketEmail").val());
    formData.append('priceMarket', $("#priceMarket").val());
    formData.append('offerOrSearch', $("#offerOrSearch").val());
    formData.append('advertPassword', $("#advertPassword").val());
    formData.append('marketDescription', tinymce.activeEditor.getContent());
    formData.append('specialAdvertCriteria', $('#specialAdvertCriteria').val());

    $('.marketGalleries').each(function () {
        var galleryImages = $(this)[0].files.length;
        for (var x = 0; x < galleryImages; x++) {
            formData.append("marketGalleries[]", $(this)[0].files[x]);
        }
    });
    
    saveEditAssetToDB(formData, '/saveEditItemInMarket/');
}

function removeImageFromGallery(image) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('ID', findGetParameter('ID'));
    formData.append('what', decodeURIComponent(findGetParameter('what')));
    if (decodeURIComponent(findGetParameter('what')) == 'inzerát'){
        if ($("#advertPassword").val() != ""){
            formData.append('advertPassword', $("#advertPassword").val());
        }else{
            warningAnimation('Musíte zadať heslo inzerátu aby ste mohli zmazať jednotlivé obrázky.');
            return;
        }
    }
    formData.append('imageLink', $(image.$target).next('img').attr('src'));
    removeSingleImageFromAssetGallery(formData, $(image.$target).next('img'));
}

function getOpenHours() { 
    var openHours = "";
    var x = 0;
    $('.openHours').find('select').each(function () {
        openHours += x % 2 == 0 ? $(this).val() + "|" : $(this).val();
        x++;
        openHours += x % 2 == 0 ? "&" : "";
    })
    return openHours.substring(0, openHours.length - 1);
}

function showFoundServices(result){
    var showServices = "";
    result.results.forEach(function (singleService) {
        showServices += "<div class='singleService' id='barnId" + singleService.ID + "'>";
        showServices += "<a href='sluzba.php?ID=" + singleService.ID + "' title='Prejsť do služby' target='_blank'>";
        showServices += "<div class='serviceImage'><img src='" + (singleService.serviceImage == null ? returnDefaultImage(singleService.type) : singleService.serviceImage) + "' alt=''></div>";
        showServices += "<div class='type'><h4>"+(singleService.serviceName.length == 0 ? "" : singleService.serviceName + " - ") + (singleService.barnId == null ? singleService.fullName : singleService.barnName) + "</h4></div>";
        showServices += "<div class='provider'><b>Služba:</b> " + singleService.type + "</div>";
        showServices += "<div class='serviceLocation'><b>Lokalita:</b> " + singleService.location + "</div>";
        if (singleService.criteriaName != "null" && singleService.criteriaName != null){
            showServices += "<div class='specialServiceCriteria'><b>" + singleService.criteriaName + ":</b> " + singleService.criteriaValues + "</div>";
        }
        showServices += "<div class='servicePrice'><b>Cena:</b> " + (!isNaN(singleService.price) ? singleService.price + " €" : singleService.price) + "</div>";
        showServices += "<div class='descriptionOfService'><b>Popis:</b> " + singleService.descriptionOfService.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showServices += "</div>";
        showServices += "</a>";
    });
    return showServices;
}

function showFoundBarns(result) {
    var showBarns = "";
    result.results.forEach(function (singleBarn) {
        showBarns += "<div class='singleService' id='barnId" + singleBarn.ID + "'>";
        showBarns += "<a href='stajna.php?ID=" + singleBarn.ID + "' title='Prejsť do služby' target='_blank'>";
        showBarns += "<div class='serviceImage'><img src='" + (singleBarn.barnImage == null ? returnDefaultImage('stajňa') : singleBarn.barnImage) + "' alt=''></div>";
        showBarns += "<div class='type'><h4>" + singleBarn.barnName + "</h4></div>";
        showBarns += "<div class='serviceLocation'><b>Lokalita:</b> " + singleBarn.location + "</div>";
        if (singleBarn.barnRidingStyle != "null" && singleBarn.barnRidingStyle != null) {
            showBarns += "<div class='specialServiceCriteria'><b>Jazdecký štýl:</b> " + singleBarn.barnRidingStyle + "</div>";
        }
        if (singleBarn.barnHorseTypes != "null" && singleBarn.barnHorseTypes != null) {
            showBarns += "<div class='specialServiceCriteria'><b>Aký typ koní máme:</b> " + singleBarn.barnHorseTypes + "</div>";
        }
        showBarns += "<div class='descriptionOfService'><b>Popis:</b> " + singleBarn.barnDescription.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showBarns += "</div>";
        showBarns += "</a>";
    });
    return showBarns;
}

function showFoundMarketItems(results) {
    var showAdverts = "";
    results.forEach(function (singleItem) {
        showAdverts += "<div class='singleAdvert' id='advertId" + singleItem.ID + "'>";
        showAdverts += "<a href='inzerat.php?ID=" + singleItem.ID + "' title='Zobraziť inzerát' target='_blank'>";
        showAdverts += "<div class='advertImage'><img src='" + (singleItem.advertImage == null ? returnDefaultImage('advert') : singleItem.advertImage) + "' alt=''></div>";
        showAdverts += "<div class='advertName'><h4>" + singleItem.title + "</h4></div>";
        showAdverts += "<div class='advertCategory'><b>Kategória:</b> " + singleItem.mainCategory + " - " + singleItem.offerOrSearch + "</h4></div>";
        showAdverts += "<div class='advertSubCategory'><b>Podkategória:</b> " + singleItem.subCategory + "</div>";
        showAdverts += "<div class='advertLocation'><b>Lokalita:</b> " + singleItem.location + "</div>";
        showAdverts += "<div class='advertPrice'><b>Cena:</b> " + (!isNaN(singleItem.price) ? singleItem.price + " €" : singleItem.price) + "</div>";
        showAdverts += "<div class='advertDescription'><b>Popis:</b> " + singleItem.details.replace(/<\/?[^>]+(>|$)+/g, " ").replace('&nbsp;', '').trim() + "</div>";
        showAdverts += "<div class='advertDateAdded'><b>Pridané:</b> " + singleItem.dateAddedVisible + "</div>";
        showAdverts += "<div class='advertVisited'><b>Zobrazené:</b> " + singleItem.visited + "x</div>";
        showAdverts += "</a>";
        showAdverts += "</div>";
    });
    return showAdverts;
}

function showSpecificUserDetails(userData) {
    var generalDetails = userData.generalDetails[0];
    $('#usersFullName').html(generalDetails.fullName);
    var userDetails = '<div id="userFields">';
    userDetails += '<label class="userInput"><span class="userDetailText">Celé meno</span><span class="readOnlyUserData">' + generalDetails.fullName +'</span></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Email</span><span class="readOnlyUserData">' + generalDetails.email + '</span></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Telefón</span><span class="readOnlyUserData">' + (generalDetails.phoneNumber ? generalDetails.phoneNumber : '') + '</span></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">SJF Odkaz</span><span class="readOnlyUserData">' + (generalDetails.sjfLink ? '<a href="'+generalDetails.sjfLink + '">LINK</a>': '') + '</span></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">FEI Odkaz</span><span class="readOnlyUserData">' + (generalDetails.feiLink ? '<a href="'+generalDetails.feiLink + '">LINK</a>' : '') + '</span></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText" style="font-weight:bold;">Niečo o mne</span><p id="userDescription" style="margin-top:40px;line-height:1rem" name="userDescription">' + (generalDetails.userDescription ? generalDetails.userDescription : '') + '</p></label>' + '<br>';
    userDetails += '</div>';
    $('#userDetails').append(userDetails);

    if (generalDetails.userPhoto != "" && generalDetails.userPhoto != null) {
        $('#imageBorder img').attr('src', generalDetails.userPhoto);
    }

    //chain is used when my profile is loaded, one function is calling next - here we stop it because we have all in one json
    showBarns(userData.userBarns, stopChain = true);
    showServices(userData.userServices, stopChain = true);
    showUserEvents(userData.userEvents, stopChain = true);
    showUserMarketItems(userData.userMarketItems, stopChain = true);
    $('.editAsset').remove();
    $('.removeAsset').remove();
}


function bindEditDeleteAdvert() {
    $('#editDeleteAdvert').confirm({
        title: 'Pre editáciu inzerátu vložte heslo',
        content: '' +
            '<form method="POST" action="" class="formName">' +
            '<div class="form-group">' +
            '<input type="text" placeholder="Heslo" class="advertPassword form-control" required />' +
            '</div>' +
            '</form>',
        buttons: {
            formSubmit: {
                text: 'Overiť',
                btnClass: 'btn-danger',
                action: function () {
                    var advertPassword = this.$content.find('.advertPassword').val();
                    if (!advertPassword) {
                        $.alert('Nezadali ste heslo');
                        return false;
                    }
                    checkEditAdvertPassword(advertPassword);
                    return false;
                }
            },
            Zrušiť: function () {
                return true;
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
}

String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

//BIND ALL DELETE EVENTS
$(window).on('load', function () {
    bindDeleteEvent('.removeAsset', removeAsset, 'Naozaj chcete zmazať ?<br><br> <b>Upozornenie:</b> Vymažú sa aj všetky súvislosti s položkou - novinky, galéria, služby, práva na stajňu, atď.')
});

$(document).on('keyup','#commentBody', function () {
    var len = $(this).val().length;
    $('#charNum').text(len + ' / 500');
})

function showCommentInputBox(){
    getLoginStateOfUser(function(response){
        if (response == 1){
            if ($('#commentBox').length > 0) {
                return;
            }
            $('.comment-list').before("<div id='commentBox'><button id='closeNewComment'>Zavrieť</button><textarea maxlength='500' id='commentBody'></textarea><a class='primary-btn' id='saveComment'>Uložiť komentár</a><div id='charNum'></div></div>");
        }else{
            $.alert({
                title: 'Prihlásenie / Registrácia',
                content: 'Pre pridanie komentára sa musíte <a href="/prihlasenie">prihlásiť</a>.',
            });
        }
    })
}

function saveComment() {
    if ($('#commentBody').val().length == 0){
        warningAnimation('Komentár nesmie byť prázdny.')
        return;
    }else{
        var formData = new FormData();
        var comment = $('#commentBody').val();
        formData.append('comment', comment);
        formData.append('newsId', findGetParameter('nazov'));
        formData.append('token', localStorage.getItem("token"));
        var url = '/api/callBackend/addNewCommentToArticle/';
        var result = loadDataFromDb(formData, url);
        result.done(function(response){
            if (!isNaN(response)) {
                confirmationAnimation('Komentár bol pridaný.');
                var newCommentId = response;
                var today = new Date();
                var month = (today.getMonth() + 1).toString();
                var date = today.getDate() + '.' + (month.length == 1 ? ("0" + month) : month) + '.' + today.getFullYear() + ' ' + today.getHours() + ":" + today.getMinutes();
                getMyInfo(function (userData) {
                    var comments = "";
                    comments += '<div class="single-comment justify-content-between d-flex pb-10 pt-10" id="single-comment' + newCommentId + '">';
                        comments += '<div class="editComment" title="Editovať komentár" id="comment' + newCommentId + '"><img src="/img/editIcon.png" alt=""></div><div class="removeComment" title="Zmazať komentár" id="comment' + newCommentId + '">X</div>';
                        comments += '<div class="user d-flex">';
                            comments += '<div class="thumb">';
                                comments += '<img src="' + (userData.userPhoto != null ? userData.userPhoto : '/img/userImages/noProfilePicture.png') + '" alt="">';
                            comments += '</div>';
                            comments += '<div class="desc">';
                                comments += '<h5><a href="uzivatel.php?ID=' + userData.ID + '">' + userData.fullName + '</a></h5>';
                                comments += '<p class="date">' + date + '</p>';
                                comments += '<p class="comment" id="commentText' + newCommentId + '">';
                                    comments += comment;
                                comments += '</p>';
                            comments += '</div>';
                        comments += '</div>';
                    comments += '</div>';
                    $('.comment-list').prepend(comments);
                });
                $('#commentBox').remove();
            }else{
                warningAnimation(response);
            }
            $('.loading').fadeOut(400);
        });
    }
}

function loadComments(){
    var formData = new FormData();
    formData.append('newsId', findGetParameter('ID'));
    formData.append('token', localStorage.getItem("token"));
    var url = '/api/callBackend/loadCommentsFromDb/';
    var result = loadDataFromDb(formData, url);
    result.done(function (response) {
        var result = isJson(response) ? jQuery.parseJSON(response) : response;
        console.log(result);
        var comments = "";
        result.forEach(function(singleComment){
            comments += '<div class="single-comment justify-content-between d-flex pb-10 pt-10" id="single-comment' + singleComment.ID + '">';
                comments += (singleComment.editable != "" ? '<div class="editComment" title="Editovať komentár" id="comment' + singleComment.ID + '"><img src="/img/editIcon.png" alt=""></div><div class="removeComment" title="Zmazať komentár" id="comment' + singleComment.ID + '">X</div>' : '');
                comments += '<div class="user d-flex">';
                    comments += '<div class="thumb">';
                        comments += '<img src="' + (singleComment.userPhoto != null ? singleComment.userPhoto : '/img/userImages/noProfilePicture.png') + '" alt="">';
                    comments += '</div>';
                    comments += '<div class="desc">';
                        comments += '<h5><a href="uzivatel.php?ID=' + singleComment.userId + '">' + singleComment.fullName + '</a></h5>';
                        comments += '<p class="date">' + singleComment.dateAdded + '</p>';
                        comments += '<p class="comment" id="commentText' + singleComment.ID + '">';
                            comments += singleComment.comment;
                        comments += '</p>';
                    comments += '</div>';
                comments += '</div>';
            comments += '</div>';
        });
        $('.comment-list').append(comments);
        $('body,html').animate({
            scrollTop: 0 // Scroll to top of body
        }, 100);
    });
}

function editComment(commentId) { 
    var commentId = $(commentId).attr('id').match(/\d+/)[0];
    var actualComment = $('#commentText' + commentId).text();
    $('#commentText' + commentId).html("<textarea maxlength='500' id='commentBody" + commentId + "'>" + actualComment + "</textarea><a class='primary-btn' id='updateComment'>Upraviť</a>");
}

function removeComment(commentId) {
    var commentId = $(commentId).attr('id').match(/\d+/)[0];
    var formData = new FormData();
    formData.append('newsId', findGetParameter('ID'));
    formData.append('token', localStorage.getItem("token"));
    formData.append('commentId', commentId);
    var url = '/api/callBackend/removeComment/';
    var result = loadDataFromDb(formData, url);
    result.done(function (response) {
        if (response.length == 1) {
            confirmationAnimation('Komentár bol vymazaný.');
            $('#single-comment' + commentId).fadeOut(1000, function(){ $(this).remove();});
        } else {
            warningAnimation(response);
        }
        $('.loading').fadeOut(400);
    });
}

function updateComment(newComment){
    var updatedComment = $(newComment).prev('textarea');
    var comment = $(updatedComment).val();
    var commentId = $(updatedComment).attr('id').match(/\d+/)[0];
    var formData = new FormData();
    formData.append('newsId', findGetParameter('ID'));
    formData.append('token', localStorage.getItem("token"));
    formData.append('commentId', commentId);
    formData.append('comment', comment);
    var url = '/api/callBackend/updateComment/';
    var result = loadDataFromDb(formData, url);
    result.done(function (response) {
        if (response.length == 1) {
            confirmationAnimation('Komentár bol upravený.');
            $('#commentText' + commentId).text(comment);
        } else {
            warningAnimation(response);
        }
        $('.loading').fadeOut(400);
    });
}


function sendMessageToAdvertiser() {
    if (!verifyCaptcha()) {
        return false;
    }
    var message = $('#messageArea').val();
    var messageEmail = $('#messageEmail').val();
    if (messageEmail.length == 0 || messageEmail.indexOf('@') < 1) {
        warningAnimation("Nevyplnili ste email alebo email nebol zadaný správne.");
        return false;
    }
    var formData = new FormData();
    formData.append('advertId', findGetParameter('ID'));
    formData.append('message', message);
    formData.append('messageEmail', messageEmail);
    var url = '/api/callBackend/sendMessageToAdvertiser/';
    var result = loadDataFromDb(formData, url);
    result.done(function (response) {
        if (response.indexOf('Sent') > -1) {
            confirmationAnimation('Správa bola odoslaná.');
        } else {
            warningAnimation(response);
        }
        grecaptcha.reset();
        $('.loading').fadeOut(400);
    });
}