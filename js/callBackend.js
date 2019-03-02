$(document).ready(function () {
    $(document).on("click", "#logIn", function (event) {
        event.preventDefault();
        event.stopPropagation();
        logInOrRegisterFBorGmailUserAndLogIn('regular');
    });

    $(document).on("click", "#createAccount", function (event) {
        event.preventDefault();
        event.stopPropagation();
        registerUser();
    });

    $(document).on("click", "#sendNewPassword", function (event) {
        event.preventDefault();
        event.stopPropagation();
        resetPassword();
    });

    $(document).on("click", "#saveNewPassword", function (event) {
        event.preventDefault();
        event.stopPropagation();
        saveNewPassword();
    });

    $(document).on("click", "#resendRegisterLink", function (event) {
        event.preventDefault();
        event.stopPropagation();
        resendRegisterLink();
    });

    $(document).on('click','.addNewArticle', function () { 
        addNewArticle();
    });

    $(document).on('click', '.updateArticle', function () {
        updateArticle();
    });

    $(document).on('click', '.approveArticle', function () {
        approveArticle(this);
    });

    $('.removeArticle').confirm({
        title: 'Naozaj chcete vyzmazať ?',
        content: '',
        buttons: {
            áno: function () {
                removeArticleFromList(this);
            },
            nie: function () {
                return true;
            },
        }
    });

    //if change form buttons clicked - hide all forms and show only login
    $('.login100-form').each(function () {
        $(this).hide();
    });

    if (window.location.href.indexOf('prihlasenie') != -1) {
        if (findGetParameter('resetToken')) {
            $('#setNewPassword').show();
        } else if (findGetParameter('register')) {
            $('#registerform').show();
        } else {
            $('#loginform').show();
        }
    }

    $(document).click(function (event) {
        //when change form A href is clicked - hide all forms
        if (event.target.className.indexOf("changeForm") > -1) {
            event.preventDefault();
            $('.login100-form').each(function () {
                $(this).hide(500);
            });

            //based on button, show only one form
            var formName = event.target.id.replace("show", "");
            $('#' + formName).show(500);
        }

        if (event.target.id == "sendFastContactForm") {
            sendFastContactForm();
        }

        if (event.target.id == "logout") {
            logout();
        }

        if (event.target.className.indexOf("addToNewsLetter") > -1) {
            addToNewsLetter();
        }

        //goBack
        if (event.target.id == "goBack") {
            goBack(10);
        }
    });

    fillLocationSelects();

    $(document).on("change", ".locationProvince, .locationRegion", function (event) {
        if ($('.locationLocalCity').val() == "") {
            fillLocationSelects(updateFields = true);
        }
        //if province was changed, reset form
        if (event.target.className.indexOf("locationProvince") > -1) {
            if ($(this).val() == ""){
               $('.locationLocalCity').val('');
               $('.locationRegion').val('');
               fillLocationSelects(updateFields = true);
            }
        }

        //if locationRegion was changed, reset localCity
        if (event.target.className.indexOf("locationRegion") > -1) {
            if ($(this).val() == "") {
                $('.locationLocalCity').val('');
                fillLocationSelects(updateFields = true);
            }
        }
        
    });

    $(document).on("click", ".resetFilter", function () {
        $('.loading').show();
        fillLocationSelects();
        if ($('.multiselect').length > 0) {
            $('.multiselect').multiselect('reset');
        }
        $('.filter input:text').val('');
        $('.filter select').val('');
        $('.marketOfferOrSearch').prop('checked',false);
        $('.navigation').find('.active').removeClass('active');
        $('.navigation').find('.submenu').hide(50);
        $('.navigation').find('i').removeClass('up').addClass('down');

    });
});

function logInOrRegisterFBorGmailUserAndLogIn(method, data) {
    data = data || null;
    $('.loading').show();
    var formData = new FormData();
    formData.append('method', method);
    switch (method) {
        case 'regular':
            formData.append('email', $('#loginform').find('#email').val());
            formData.append('password', $('#loginform').find('#password').val());
            break;
        case 'facebook':
            formData.append('email', data.email);
            formData.append('facebookOrGmailId', data.id);
            formData.append('fullName', data.name);
            break;
        case 'gmail':
            formData.append('email', data.getEmail());
            formData.append('facebookOrGmailId', data.getId());
            formData.append('fullName', data.getName());
            break;
        default:
            break;
    }

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/logInUser/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data != "") {
                localStorage.setItem("token", data);
                confirmationAnimation('Úspešne prihlásený. Budete presmerovaný.');
                goBack();
            } else {
                warningAnimation('Neplatný email alebo heslo');
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Bohužial nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function registerUser() {
    $('.loading').show();
    var firstPassWord = $('#registerform').find('#setPassword').val();
    var secondPassword = $('#registerform').find('#repeatPassword').val();
    if (firstPassWord != secondPassword) {
        warningAnimation('Heslá sa nezhodujú.');
        $('.loading').fadeOut(400);
        return;
    }
    var formData = new FormData();
    formData.append('email', $('#registerform').find('#email').val());
    formData.append('password', secondPassword);
    formData.append('fullName', $('#registerform').find('#fullName').val());

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data.indexOf('Email Sent') != -1) {
                confirmationAnimation('Skontrolujte emailovú schránku kde vám bol zaslaný potvrdzovací email.');
            } else if (data == 0) {
                warningAnimation('Používateľ s takýmto emailom už existuje.');
            } else {
                warningAnimation(data);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function updateUserData() {
    var data = {};
    data['username'] = 'stefan';
    var myJSON = JSON.stringify(data);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'PUT',
        url: '/api/callBackend/user/',
        headers: {
            'token': '123465789',
            'data': myJSON,
        },
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            document.write(data);
            /*var result = isJson(data) ? jQuery.parseJSON(data) : data;
            //run function by name in variable
            console.log(result);
            window[callerFunction](result);
            $('#loading').hide();*/
        },
        error: function (data) {
            /*$('#loading').hide();
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);*/
        }
    });
}

function goBack(timer) {    
    timer = timer || 2500;
    setTimeout(function () {
        if (document.referrer === "") {
            document.location.href = "/";
        } else {
            document.location.href = document.referrer;
        }
    }, timer)
}

function fillLocationSelects(updateFields) {
    updateFields = updateFields || false;
    if ($('.locationLocalCity').length < 1) {
        return;
    }
    var formData = null;
    var locationProvince = $('.locationProvince').val();
    var locationRegion = $('.locationRegion').val();
    var locationLocalCity = $('.locationLocalCity').val();
    if (updateFields) {
        var formData = new FormData();
        formData.append('province', locationProvince);
        formData.append('region', locationRegion);
        formData.append('localCity', locationLocalCity);
        $('.loading').show();
    }

    $('.locationProvince').find('option').remove();
    $('.locationRegion').find('option').remove();
    $('.locationLocalCity').find('option').remove();

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/getLocations',
        data: formData,
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var locations = isJson(data) ? jQuery.parseJSON(data) : data;
            var previousRegion = "";
            var previousProvince = "";
            var generatedProvinces = new Array();
            var generatedRegions = new Array();
            var generatedLocalCities = new Array();
            generatedProvinces.push("<option value=''></option>");
            var skipFirst = 0;
            for (var x = 0; x < locations.length; x++) {
                if (skipFirst == 0) {
                    generatedProvinces.push("<option class='firstLevel' value='province|" + locations[x].province + "'>" + locations[x].province + "</option>");
                    generatedRegions.push("<option class='secondLevel' value='region|" + locations[x].region + "'>" + locations[x].region + "</option>");
                    generatedLocalCities.push("<option class='thirdLevel' value='localCity|" + locations[x].localCity + "'>" + locations[x].localCity + "</option>");
                    previousRegion = locations[x].region;
                    previousProvince = locations[x].province;
                } else {
                    if (previousProvince == locations[x].province) {
                        //pass
                    } else {
                        generatedProvinces.push("<option class='firstLevel' value='province|" + locations[x].province + "'>" + locations[x].province + "</option>");
                        previousProvince = locations[x].province;
                    }
                    if (previousRegion == locations[x].region) {
                        //pass
                    } else {
                        generatedRegions.push("<option class='secondLevel' value='region|" + locations[x].region + "'>" + locations[x].region + "</option>");
                        previousRegion = locations[x].region;
                    }
                    generatedLocalCities.push("<option class='thirdLevel' value='localCity|" + locations[x].localCity + "'>" + locations[x].localCity + "</option>");
                }
                skipFirst++;
            };
            $('.locationProvince').append(generatedProvinces.join());
            generatedRegions.sort();
            generatedLocalCities.sort();
            $('.locationRegion').append("<option value=''></option>" + generatedRegions.join());
            $('.locationLocalCity').append("<option value=''></option>" + generatedLocalCities.join());

            if (updateFields) {
                $('.locationProvince').val(locationProvince)
                $('.locationRegion').val(locationRegion)
                $('.locationLocalCity').val(locationLocalCity)
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať lokality, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function sendFastContactForm() {
    var continueSending = true;
    var formData = new FormData();
    $('.fastContactForm').find('input, textarea').each(function () {
        $(this).css('border', '1px solid #ced4da');
        if ($(this).val() == "") {
            $(this).css('border', '1px solid red');
            continueSending = false;
            return;
        } else {
            formData.append($(this).attr('name'), $(this).val());
        }
    });
    if (!continueSending) {
        warningAnimation('Nevyplnili ste všetky polia');
        return;
    }

    $('.loading').show();
    formData.append('sentFrom', window.location.href);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/sendFastEmail/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            confirmationAnimation('Ďakujeme za Vašu správu. Budeme Vás kontaktovať v dohľadnej dobe.');
            $('.loading').fadeOut(400);
            $('.fastContactForm').find('input, textarea').each(function (){
                $(this).val('');
            })
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function logout(params) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/logOutUser/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            localStorage.removeItem('token');
            document.location.href = "/";
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function getBarnDetails(barnId, callBackFunction) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getBarnDetails/' + barnId,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var barnDetails = isJson(data) ? jQuery.parseJSON(data) : data;
            callBackFunction(barnDetails);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať stajňu, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function getServiceDetails(serviceId, callBackFunction) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getServiceDetails/' + serviceId,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var serviceDetails = isJson(data) ? jQuery.parseJSON(data) : data;
            callBackFunction(serviceDetails);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať stajňu, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function getEventDetails(eventId, callBackFunction) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getEventDetails/' + eventId,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var serviceDetails = isJson(data) ? jQuery.parseJSON(data) : data;
            callBackFunction(serviceDetails);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať stajňu, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function getAdvertDetails(advertId, callBackFunction) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getAdvertInfo/' + advertId,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var serviceDetails = isJson(data) ? jQuery.parseJSON(data) : data;
            callBackFunction(serviceDetails);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať inzerát, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function increaseViewCountAdvert(advertId) {
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/increaseViewCountAdvert/' + advertId,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať inzerát, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}


function addToNewsLetter() {

    var newsLetterEmail = $('#newsLetterEmail').val();
    if (newsLetterEmail.indexOf("@") == -1) {
        warningAnimation('Neplatný email.');
        return;
    }
    $('.loading').show();
    var formData = new FormData();
    formData.append('newsLetterEmail', $('#newsLetterEmail').val());
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/addToNewsLetter/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            $('.loading').fadeOut(400);
            confirmationAnimation('Email bol pridaný do zoznamu.')
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa vás pridať do zoznamu, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function resetPassword() {
    $('.loading').show();
    var formData = new FormData();
    formData.append('email', $('#resetform').find('#email').val());

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/resetPassword/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data.indexOf('Email Sent') != -1) {
                confirmationAnimation('Skontrolujte emailovú schránku kde vám bol zaslaný link na obnovu hesla.');
            } else {
                warningAnimation(data);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function completeRegistrationAndLogIn(registrationToken) {
    $('.loading').show();
    var formData = new FormData();
    formData.append('registrationToken', registrationToken);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/completeRegistration/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data.indexOf('token:') > -1) {
                localStorage.setItem("token", data.split("token:")[1]);
                confirmationAnimation('Účet bol potvrdený, prihlasujeme vás a presmerujeme.');
                goBack(4000);
            } else {
                warningAnimation(data);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function saveNewPassword() {
    $('.loading').show();
    var firstPassWord = $('#setNewPassword').find('#setPassword').val();
    var secondPassword = $('#setNewPassword').find('#repeatPassword').val();
    if (firstPassWord != secondPassword) {
        warningAnimation('Heslá sa nezhodujú.');
        $('.loading').fadeOut(400);
        return;
    }

    var formData = new FormData();
    formData.append('resetToken', findGetParameter('resetToken'));
    formData.append('newPassword', firstPassWord);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/saveNewPassword/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data == 'updated') {
                confirmationAnimation('Nové heslo bolo uložené, môžte sa prihlásiť.');
                $('#setNewPassword').hide();
                $('#loginform').show();
            } else {
                warningAnimation(data);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function resendRegisterLink() {
    $('.loading').show();
    var formData = new FormData();
    formData.append('email', $('#ResendRegistrationLink').find('#email').val());

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/resendRegisterLink/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data.indexOf('Email Sent') != -1) {
                confirmationAnimation('Registračný link bol preposlaný na uvedený email.');
            } else {
                warningAnimation(data);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function getNumberOfNewsByCategories() {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getNumberOfNewsByCategories/',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var categories = isJson(data) ? jQuery.parseJSON(data) : data;
            var categoriesList = "";
            for (var x = 0; x < categories.length; x++) {
                if (categories[x].categoryName == "") {
                    categoriesList += '<li><a href="novinky-clanky.php" class="justify-content-between align-items-center d-flex"><h6>Všetky</h6> <span>' + categories[x].newsCount + '</span></a></li>';
                } else {
                    categoriesList += '<li><a href="/novinky-clanky.php?category=' + categories[x].categoryName + '" class="justify-content-between align-items-center d-flex"><h6>' + categories[x].categoryName + '</h6> <span>' + categories[x].newsCount + '</span></a></li>';
                }
            }
            $('.newsCategories').find('ul').append(categoriesList);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function getLatestNewsSideBar() {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getLatestNewsSideBar/',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var latestNews = isJson(data) ? jQuery.parseJSON(data) : data;
            var showLatestNews = "";
            for (var x = 0; x < latestNews.length; x++) {
                showLatestNews +=
                    '<div class="single-recent-post d-flex flex-row">' +
                    '<a href="clanok.php?ID=' + latestNews[x].ID + '">' +
                    '<div class="recent-thumb">' +
                    '<img class="img-fluid" src="' + latestNews[x].titleImage + '" alt="">' +
                    '</div>' +
                    '<div class="recent-details">' +
                    '<h4>' + latestNews[x].title + '</h4>' +
                    '</a>' +
                    '<p>' + latestNews[x].dateAdded + '</p>' +
                    '</div>' +
                    '</div>';
            };
            $('.recent-posts-widget').find('.blog-list').html(showLatestNews);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function getAllNewsList() {
    $('.loading').show();
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/getAllNewsList/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var allNewsList = isJson(data) ? jQuery.parseJSON(data) : data;
            var showAllNewsList = "<table class='compact' id='allNewsTable'><thead><tr><th>ID</th><th>Dátum pridania</th><th>Názov</th><th>Kategórie</th><th>Napísal</th><th>Stav</th><th>Manipulácia</th></tr></thead><tbody>";
            for (var x = 0; x < allNewsList.length; x++) {
                showAllNewsList +=
                    '<tr>'+
                        '<td class="ID">' + allNewsList[x].ID + '</td>' +
                        '<td class="dateAdded">' + allNewsList[x].dateAdded + '</td>' +
                        '<td class="title"><a href="clanok.php?ID=' + allNewsList[x].ID + '" title="Editovať článok" target="_blank">' + allNewsList[x].title + '</a></td>' +
                        '<td class="categories">' + allNewsList[x].categories + '</td>' +
                        '<td class="writtenBy">' + allNewsList[x].writtenBy + '</td>' +
                        '<td class="writtenBy">' + allNewsList[x].published + '</td>' +
                        '<td>'+
                        '<a href="editovat-clanok.php?ID=' + allNewsList[x].ID + '" title="Editovať článok"><img src="/img/editIcon.png" alt="Editovať"></a>'+
                        (allNewsList[x].approve != null ? '<a href="#a" class="approveArticle" id="' + allNewsList[x].ID + '" title="Publikovať článok"><img src="/img/approve.png" alt="Publikovať článok"></a>' : "")+
                        '<a href="#" class="deleteArticleFromList" ID="' + allNewsList[x].ID + '" title="Zmazať článok"><img src="/img/deleteIcon.png" alt="Zmazať"></a>' +
                        '</td>'+
                    '</tr>'
            };
            showAllNewsList += "</tbody></table>";
            $('#allNews').html(showAllNewsList);
            enableDataTable('#allNewsTable');
            bindDeleteEvent('.deleteArticleFromList', removeArticleFromList, 'Naozaj chcete vymazať článok ?');
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

/*function getNewsArchiveList() {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getNewsArchiveList/',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var newsArchives = isJson(data) ? jQuery.parseJSON(data) : data;
            var categoriesList = "";
            for (var x = 0; x < newsArchives.length; x++) {
                categoriesList += '<li><a href="?archive=' + newsArchives[x].monthYearAdded + '" class="justify-content-between align-items-center d-flex"><h6>' + newsArchives[x].monthYearAdded + '</h6> <span>' + newsArchives[x].newsNumber + '</span></a></li>';
            };
            $('.archiveList').find('ul').append(categoriesList);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}*/

function getTwoLastNewsForIndexPage() {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getTwoLastNewsForIndexPage/',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var latestNews = isJson(data) ? jQuery.parseJSON(data) : data;
            var showLatestNews = "";
            for (var x = 0; x < latestNews.length; x++) {
                showLatestNews +=
                    '<div class="col-lg-6 single-blog">' +
                        '<a href="clanok.php?ID=' + latestNews[x].ID + '" title="Prejsť na článok"><img class="img-fluid" src="' + latestNews[x].titleImage + '" alt=""></a>' +
                        '<ul class="tags">' + formatCategories(latestNews[x].categories) + '</ul>' +
                        '<a href="clanok.php?ID=' + latestNews[x].ID + '"><h4>' + latestNews[x].title + '</h4></a>' +
                        '<p class="title">' + latestNews[x].body.replace(/<\/?[^>]+(>|$)+/g, "").replace('&nbsp;','').trim() + ' </p>' +
                        '<div class="bottom-meta">' +
                            '<div class="user-details row align-items-center">' +
                                '<div class="social-wrap col-lg-12" style="text-align:'+ (x == 0 ? 'left':'right') +'">' +
                                    '<ul>' +
                                    '<li><i>' + latestNews[x].dateAdded + '</i></li>' +
                                    '<li><a class="facebookShare" href="https://www.facebook.com/sharer/sharer.php?u=https://' + window.location.hostname + '/clanok.php?ID=' + latestNews[x].ID + '" title="Zdielať na Facebooku"><i class="fa fa-facebook"></i></a></li>' +
                                    '</ul>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
            };
            $('.twoLastNews').html(showLatestNews);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať posledné články, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}


function getFiveEvents(formData, callBack) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/getFiveEvents/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var latestNews = isJson(data) ? jQuery.parseJSON(data) : data;
            callBack(latestNews);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať posledné články, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}


function getFiveNewsInNewsPage() {
    $('.loading').show();
    var currentPage = findGetParameter('page') == undefined ? 0 : findGetParameter('page');
    var category = findGetParameter('category') == undefined ? 0 : findGetParameter('category');
    var hladat = findGetParameter('hladat') == undefined ? 0 : findGetParameter('hladat');
    
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getFiveNewsInNewsPage/' + category + '/' + currentPage + '/' + hladat + '/',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var latestNews = isJson(data) ? jQuery.parseJSON(data) : data;
            displayNews(latestNews);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať posledné články, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function getSingleNewsArticle() {
    $('.loading').show();
    var newsID = findGetParameter('ID');
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getSingleNewsArticle/' + newsID,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var singleArticle = isJson(data) ? jQuery.parseJSON(data) : data;
            //displayed Article
            document.title = singleArticle[0].title + ' - ' + document.title;
            $('#title').html(singleArticle[0].title);
            $('.content-wrap').html(singleArticle[0].body);
            $('.tags').html(formatCategories(singleArticle[0].categories));
            $('.single-post').find('.img-fluid').attr('src', singleArticle[0].titleImage);
            $('#dateAdded').html(singleArticle[0].dateAdded);

            //previousArticle Article
            if (singleArticle[1].previousArticle.length > 0){          
                $('.previousArticle').find('p').html("Predchádzajúci článok");
                $('.previousArticle').find('img').attr('src', singleArticle[1].previousArticle[0].titleImage);
                $('.previousArticle').find('a').attr('href', 'clanok.php?ID=' + singleArticle[1].previousArticle[0].ID);
                $('.previousArticle').find('h5').html(singleArticle[1].previousArticle[0].title);
            }else{
                $('.previousArticle').remove();
            }
            //nextArticle Article
            if (singleArticle[1].nextArticle.length > 0) {
                $('.nextArticle').find('p').html("Nasledujúci článok");
                $('.nextArticle').find('img').attr('src', singleArticle[1].nextArticle[0].titleImage);
                $('.nextArticle').find('a').attr('href', 'clanok.php?ID=' + singleArticle[1].nextArticle[0].ID);
                $('.nextArticle').find('h5').html(singleArticle[1].nextArticle[0].title);
            }else{
                $('.nextArticle').remove();
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať posledné články, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function getSingleNewsArticleEdit() {
    $('.loading').show();
    var newsID = findGetParameter('ID');
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getSingleNewsArticle/' + newsID,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var singleArticle = isJson(data) ? jQuery.parseJSON(data) : data;
            singleArticle[2].forEach(function (category) {
                $('#categories').append($("<option></option>").attr("value", category.categoryName).text(category.categoryName));
            });
            $('#newsTitle').val(singleArticle[0].title);
            var articleCategories = singleArticle[0].categories.split(',');
            for (i = 0; i < articleCategories.length; i++) {
                $("#categories option[value='" + articleCategories[i] + "']").attr('selected', 'selected');
            }
            $('#body').val(singleArticle[0].body);
            $('.removeArticle').attr('id',newsID);
            $('#categories').multiselect('reload');
            initiateTinyMCE('#body');
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať úpravu článku, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function formatCategories(categoryList) {
    if (categoryList == null) {
        return;
    }
    var returnCategories = "";
    var categoryList = categoryList.split(',');
    for (var index = 0; index < categoryList.length; index++) {
        returnCategories += '<li><a href="novinky-clanky.php?category=' + categoryList[index] + '">' + categoryList[index] + '</a></li>';
    }
    return returnCategories;
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function enableDataTable(table) {
    $(table).DataTable({
        "order": [
            [0, "desc"]
        ],
        dom: 'lBfip',
        buttons: [{
            text: 'Napísať článok',
            action: function (e, dt, node, config) {
                document.location.href = "/novy-clanok.php";
            }
        }],
        "language": {
            "decimal": "",
            "emptyTable": "Žiadne dáta na zobrazenie",
            "info": "Zobrazené _START_ - _END_ z _TOTAL_ záznamov",
            "infoEmpty": "Zobrazené od 0 do 0 z 0 záznamov",
            "infoFiltered": "(vyfiltrované z _MAX_ záznamov)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Zobraziť _MENU_ záznamov",
            "loadingRecords": "Načítavam...",
            "processing": "Spracuvávam...",
            "search": "Hľadať:",
            "zeroRecords": "Zadanému filtru nevyhovujú žiadne záznamy",
            "paginate": {
                "first": "Prvá",
                "last": "Posledná",
                "next": "Ďalšia",
                "previous": "Predchádzajúca"
            },
            "aria": {
                "sortAscending": ": zoradiť vzostupne",
                "sortDescending": ": zoradiť zostupne"
            }
        }
    });   
}

function sendNewDataToDb(formData) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/updateUserData/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            if (result == ""){
                confirmationAnimation('Informácie boli aktualizované.');
            }else{
                warningAnimation(result);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function addNewArticle() {  
    var formData = new FormData();
    if ($('#titleImage').prop('files')[0] == undefined){
        warningAnimation('Chýba titulný obrázok');
        return;
    }
    formData.append('title', $('#newsTitle').val());
    formData.append('body', tinymce.activeEditor.getContent());
    formData.append('titleImage[]', $('#titleImage').prop('files')[0]);
    formData.append('categories', $('#categories').val());
    formData.append('token', localStorage.getItem("token"));
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/addNewArticle/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            if (result.indexOf(1) > 0){
                confirmationAnimation('Nový článok bol pridaný.');
            }else{
                warningAnimation('Niekde sa stala chyba, duplikátny článok alebo niečo ostalo nevyplnené.');
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function updateArticle() {
    var formData = new FormData();
    formData.append('newsID', findGetParameter('ID'));
    formData.append('title', $('#newsTitle').val());
    formData.append('body', tinymce.activeEditor.getContent());
    formData.append('titleImage[]', $('#titleImage').prop('files')[0]);
    formData.append('categories', $('#categories').val());
    formData.append('token', localStorage.getItem("token"));
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/updateArticle/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            if (result == 1) {
                confirmationAnimation('Článok bol upravený. Budete presmerovaný');
                setTimeout(function () {
                    window.location.href = "/clanok.php?ID=" + findGetParameter('ID');
                }, 2500);
            } else {
                warningAnimation('Niekde sa stala chyba, úpravy sa neuložili.');
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function bindDeleteEvent(identifier,callBack,title) {
    title = title || 'Naozaj chcete zmazať ?';
    $(identifier).confirm({
        title: title,
        escapeKey: 'close',
        content: '',
        columnClass: 'col-md-5',

        buttons: {
            áno: function () {
                callBack(this);
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

function removeArticleFromList(button) {
    var articleId = button.$target[0].id;
    var formData = new FormData();
    formData.append('articleId', articleId);
    formData.append('token', localStorage.getItem("token"));
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/removeArticle/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            if (result == 1) {
                confirmationAnimation('Článok bol odstránený.');
            } else {
                warningAnimation('Článok nebolo možné odstrániť. Nemáte dostatočné práva.');
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function initiateTinyMCE(selector) {
    tinymce.init({
        selector: selector,
        language: 'sk',
        resize: 'both',
        theme: 'modern',
        plugins: 'print preview fullpage searchreplace autolink directionality  visualblocks visualchars fullscreen image link media template table charmap hr pagebreak nonbreaking anchor insertdatetime lists textcolor wordcount imagetools contextmenu colorpicker textpattern paste youtube',
        toolbar1: 'formatselect | undo redo | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat youtube',
        paste_data_images: true,
        media_live_embeds: true,
        force_br_newlines: true,
        force_p_newlines: false,
        forced_root_block: '', // Needed for 3.x
        indent: false,
        min_height: 400,
        extended_valid_elements: "+iframe[src|width|height|name|align|class]",
    });
}

function fillCategories(){
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getCategories/',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var categories = isJson(data) ? jQuery.parseJSON(data) : data;
            categories.forEach(function (category) {
                $('#categories').append($("<option></option>").attr("value", category.categoryName).text(category.categoryName));
            });
            $('#categories').multiselect('reload');
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať úpravu článku, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function approveArticle(button) {
    var articleId = $(button)[0].id;
    var formData = new FormData();
    formData.append('articleId', articleId);
    formData.append('token', localStorage.getItem("token"));
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/approveArticle/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            if (result == 1) {
                confirmationAnimation('Článok bol publikovaný.');
            } else {
                warningAnimation('Článok nebolo možné publikovať. Nemáte dostatočné práva.');
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function displayNews(latestNews) {
    var showLatestNews = "";
    var listThroughNews = latestNews.foundNews;
    for (var x = 0; x < listThroughNews.length; x++) {
        showLatestNews +=
            '<div class="single-post">' +
            '<a href="clanok.php?ID=' + listThroughNews[x].ID + '" title="Prejsť na článok"><img class="img-fluid postMainImage" src="' + listThroughNews[x].titleImage + '" alt=""></a>' +
            '<ul class="tags">' + formatCategories(listThroughNews[x].categories) + '</ul>' +
            '<a href="clanok.php?ID=' + listThroughNews[x].ID + '">' + '<h3 class="pb-10">' + listThroughNews[x].title + '</h3>' + '</a>' +
            '<p class="title">' + listThroughNews[x].body.replace(/<\/?[^>]+(>|$)/g, "").replace('&nbsp;', '').trim() + ' </p>' +
            '<div class="bottom-meta">' +
            '<div class="user-details row align-items-center">' +
            '<div class="comment-wrap col-lg-6">' +
            '<ul>' +
            '</ul>' +
            '</div>' +
            '<div class="social-wrap col-lg-6">' +
            '<ul>' +
            '    <li><i>' + listThroughNews[x].dateAdded + '</i></li>' +
            '    <li><a class="facebookShare" href="https://www.facebook.com/sharer/sharer.php?u=https://' + window.location.hostname + '/clanok.php?ID=' + listThroughNews[x].ID + '" title="Zdielať na Facebooku"><i class="fa fa-facebook"></i></a></li>' +
            '</ul>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<hr>';
    };

    //pagination
    if (latestNews.foundNews.length > 0){
        $('#assetsFound').html('Zobrazených <span id="resultRange"></span> článkov z <span id="resultNumber"></span>');
    }
    $('#resultRange').html(rangeSearch(listThroughNews.length));
    $('#resultNumber').html(latestNews.allNews);
    showLatestNews = showLatestNews == "" ? "<div id='noMoreArticles'>Žiadne články sa nenašli</div>" : showLatestNews;
    $('#newsList').html(showLatestNews).hide().fadeIn();(500);
    $('#newsList').prepend(navigation());
    if (showLatestNews != "<div id='noMoreArticles'>Žiadne články sa nenašli</div>") {
        $('#newsList').append(navigation());
    }

    $('embed,iframe').hide();
    $('.loading').fadeOut(400);
}

function navigation() {
    if ($('.mainNavigation').length > 1){
        $('.mainNavigation').each(function () {
            $(this).remove();
        })
    };
    if (findGetParameter('page') == undefined) {
        var previous = "";
        var next = window.location.href.split('?').length > 1 ? window.location.href + '&page=1' : window.location.href + '?page=1';
    }else{
        var alteredURL = removeParam("page", window.location.href);
        if ((parseInt(findGetParameter('page')) - 1) < 0){
            var previous = '';
        }else{
            var previous = '<a href="' + (alteredURL.split('?').length > 1 ? alteredURL + '&page=' + (parseInt(findGetParameter('page')) - 1) : alteredURL + '?page=' + (parseInt(findGetParameter('page')) - 1)) + '">< Novšie</a>';
        }
        var next = alteredURL.split('?').length > 1 ? alteredURL + '&page=' + (parseInt(findGetParameter('page')) + 1) : alteredURL + '?page=' + (parseInt(findGetParameter('page')) + 1);
    }

    //if both empty dont return pagination 
    
    /*if (previous == '' && !showNextResults()){
        return;
    }*/

    var showNavigation = "<div class='mainNavigation'>";
        showNavigation += '<div id="mainLeftNavigation">';
        showNavigation += previous;
        showNavigation += '</div>';
        showNavigation += '<div id="mainRightNavigation">';
        if (showNextResults()){
        showNavigation += '<a href="' + next +'">Ďalšie ></a>';
        }
        showNavigation += '</div>';
    showNavigation += '</div>';

    return showNavigation;
}

function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

function getSpecialServiceCriteria() {
    $('.loading').show();
    var formData = new FormData();
    formData.append('type', $('#type').val());
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: formData,
        async: false,
        url: '/api/callBackend/getSpecialServiceCriteria/',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var specialCriteria = isJson(data) ? jQuery.parseJSON(data) : data;
            $('#specialServiceCriteria').find('option').remove();
            specialCriteria.forEach(function (category) {
                $('#specialServiceCriteria').append($("<option></option>").attr("value", category.specificCriteria[0] + '|' + category.specificValue[0]).text(category.specificValue[0]));
            });
            $('#specialServiceCriteria').multiselect('reload');
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať detaily služby, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function fillOrganizerDropdown(userBarns) {
    userBarns.forEach(function (barn) {
        $('.inTheNameOf,#serviceProvider').append($("<option></option>").attr("value", barn.ID).text(barn.barnName));
    });
}

function sendNewAssetToDB(formData, apiEndPoint) {
        $('.loading').show();
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            data: formData,
            url: '/api/callBackend' + apiEndPoint,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var resultFromAdding = isJson(data) ? jQuery.parseJSON(data) : data;
                if (resultFromAdding != "") {
                    confirmationAnimation(decodeURIComponent(findGetParameter('what')).capitalize() + " ste pridali. Budete presmerovaný.");
                    setTimeout(function () {
                        switch (decodeURIComponent(findGetParameter('what'))) {
                            case 'stajňu':
                                window.location.href = "/stajna.php?ID=" + resultFromAdding;
                                break;
                            case 'službu':
                                window.location.href = "/sluzba.php?ID=" + resultFromAdding;
                                break;
                            case 'udalosť':
                                window.location.href = "/udalost.php?ID=" + resultFromAdding;
                                break;
                            case 'inzerát':
                                window.location.href = "/inzerat.php?ID=" + resultFromAdding;
                                break;
                            default:
                                break;
                        }
                    }, 2500);
                } else {
                    warningAnimation("Nastal problém a nebolo možné " + decodeURIComponent(findGetParameter('what')) + " pridať");
                }
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať detaily služby, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').fadeOut(400);
            }
        });
}

function saveEditAssetToDB(formData, apiEndPoint) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: formData,
        url: '/api/callBackend' + apiEndPoint,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var resultFromAdding = isJson(data) ? jQuery.parseJSON(data) : data;
            
            if (resultFromAdding.indexOf('bol') > -1) {
                confirmationAnimation(resultFromAdding + " Budete presmerovaný.");
                setTimeout(function(){
                    switch (decodeURIComponent(findGetParameter('what'))) {
                        case 'stajňu':
                            window.location.href = "/stajna.php?ID=" + findGetParameter('ID');
                            break;
                        case 'službu':
                            window.location.href = "/sluzba.php?ID=" + findGetParameter('ID');
                            break;
                        case 'udalosť':
                            window.location.href = "/udalost.php?ID=" + findGetParameter('ID');
                            break;
                        case 'inzerát':
                            window.location.href = "/inzerat.php?ID=" + findGetParameter('ID');
                            break;
                        default:
                            break;
                    }
                }, 2500);
            }else{
                warningAnimation(resultFromAdding);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať detaily služby, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function getSubcategoriesFromMain(params) {
            $('.loading').show();
            $.ajax({
                processData: false,
                contentType: false,
                type: 'GET',
                async: false,
                url: '/api/callBackend/getSubcategoriesFromMain/' + $("#mainCategory").val(),
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                    var resultFromAdding = isJson(data) ? jQuery.parseJSON(data) : data;
                    $('#subCategory').html(resultFromAdding);
                    $('.loading').fadeOut(400);
                },
                error: function (data) {
                    warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať detaily služby, obnovte stránku a skúste to znovu.' + data.responseText);
                    $('.loading').fadeOut(400);
                }
            });
}


function getLoginStateOfUser(evaluationFunction) {
    if (localStorage.getItem("token") == null) {
        evaluationFunction(false);
    } else {
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
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            }
        });
    }
}

function getUserRights(evaluationFunction) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/user/isUserAdmin/',
        data: formData,
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


function getMyInfo(callBackFunction) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    if (localStorage.getItem("token") == null) {
        window.location.replace("/prihlasenie");
    } else {
        $('.loading').show();
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            url: '/api/callBackend/user/getMyInfo/',
            data: formData,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
                $('.loading').fadeOut(400);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').fadeOut(400);
            }
        });
    }
}


function getMyBarns(callBackFunction) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    if (localStorage.getItem("token") == null) {
        $('#servicesBarnsEvents').hide();
        return false;
    } else {
        $('.loading').show();
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            async: false,
            url: '/api/callBackend/getMyBarns/',
            data: formData,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
                $('.loading').fadeOut(400);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').fadeOut(400);
            }
        });
    }
}

function getMyServices(callBackFunction) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    if (localStorage.getItem("token") == null) {
        $('#servicesBarnsEvents').hide();
        return false;
    } else {
        $('.loading').show();
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            url: '/api/callBackend/getMyServices/',
            data: formData,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
                $('.loading').fadeOut(400);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').fadeOut(400);
            }
        });
    }
}

function getMyEvents(callBackFunction) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    if (localStorage.getItem("token") == null) {
        $('#servicesBarnsEvents').hide();
        return false;
    } else {
        $('.loading').show();
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            url: '/api/callBackend/getMyEvents/',
            data: formData,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
                $('.loading').fadeOut(400);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').fadeOut(400);
            }
        });
    }
}

function getMyMarketItems(callBackFunction) {
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    if (localStorage.getItem("token") == null) {
        $('#servicesBarnsEvents').hide();
        return false;
    } else {
        $('.loading').show();
        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            url: '/api/callBackend/getMyMarketItems/',
            data: formData,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(result);
                $('.loading').fadeOut(400);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').fadeOut(400);
            }
        });
    }
}

function removeAsset(button) {
    var assetId = button.$target[0].id.match(/\d+/)[0];
    var assetType = button.$target[0].id.replace(assetId,"");
    var formData = new FormData();
    formData.append('token', localStorage.getItem("token"));
    formData.append('assetId', assetId);
    formData.append('assetType', assetType);
    //advert must have password
    if (window.location.href.indexOf('editovat') > 0 && decodeURIComponent(findGetParameter('what') == 'inzerát')){
        if ($("#advertPassword").val() == ""){
            warningAnimation('Musíte zadať heslo pre zmazanie inzerátu');
            return;
        }
    formData.append('advertPassword', $("#advertPassword").val());
    }

    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/removeAssetFromDB/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;      
            if (result == "deleted"){
                switch (assetType) {
                    case 'barn':
                        var what = "Stajňa bola vymazaná";
                        break;
                    case 'service':
                        var what = "Služba bola vymazaná";
                        break;
                    case 'event':
                        var what = "Udalosť bola vymazaná";
                        break;
                    case 'advert':
                        var what = "Inzerát bol vymazaný";
                        break;
                    default:
                        break;
                }
                confirmationAnimation(what);
            }else{
                warningAnimation('Nepodarilo sa odstrániť. ' + result)
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
    
}

function getLocationFromBacked(callerId, callBackFunction) {
        $('.loading').show();
        var whosLocation = $('#'+callerId).val();
        $.ajax({
            processData: false,
            contentType: false,
            type: 'GET',
            url: '/api/callBackend/getLocationFromBacked/' + whosLocation,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                var result = isJson(data) ? jQuery.parseJSON(data) : data;
                callBackFunction(callerId,result);
                $('.loading').fadeOut(400);
            },
            error: function (data) {
                warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
                $('.loading').fadeOut(400);
            }
        });
}

function getAssetDataForEdit(what) {
    $('.loading').show();
    var ID = findGetParameter('ID');
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/' + what + '/' + ID,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            showEditableData(result);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function removeSingleImageFromAssetGallery(formData, image) {
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: formData,
        url: '/api/callBackend/removeSingleImageFromAssetGallery',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var resultFromDeletion = isJson(data) ? jQuery.parseJSON(data) : data;
            if (resultFromDeletion == true){
                image.parent().fadeOut(400, function() { $(this).remove(); });
                confirmationAnimation('Obrázok bol vymazaný');
            }else{
                warningAnimation(resultFromDeletion);
            }
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať detaily služby, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function sendSearchCriteria(formData, apiLink) {
    $('.loading').show(); 
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        url: '/api/callBackend/' + apiLink,
        data: formData,
        xhrFields: {
        withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
                if (window.location.href.indexOf('vyhladat') > 0) {
                    $('#serviceSearchResults').html('');
                    $('#assetsFound').html('');
                    if (result.results.length > 0) {
                        $('#assetsFound').html('Zobrazených <span id="resultRange"></span> ponúk z <span id="resultNumber"></span>');
                        $('#resultRange').html(rangeSearch(result.results.length));
                        $('#resultNumber').html(result.completeNumber);
                        $('#serviceSearchResults').prepend(navigation());
                        $('#serviceSearchResults').append(showFoundServices(result)).css({'opacity':0}).animate({'opacity':1});
                        $('#serviceSearchResults').append(navigation());
                    }else{
                        $('#serviceSearchResults').html('');
                        $('#serviceSearchResults').append('<p><br>Zadaným kritériam nevyhovujú žiadne výsledky. Skúste menej detailov alebo pridajte <a href="pridat.php?what=službu">novú službu</a>.</p>');
                    }
                } else if (window.location.href.indexOf('bazar') > 0) {
                    $('#resultsOfMarketSearch').html('');
                    $('#assetsFound').html('');
                    if (result.results.length > 0) {
                        $('#assetsFound').html('Zobrazených <span id="resultRange"></span> ponúk z <span id="resultNumber"></span>');
                        $('#resultRange').html(rangeSearch(result.results.length));
                        $('#resultNumber').html(result.completeNumber);
                        $('#resultsOfMarketSearch').prepend(navigation());
                        $('#resultsOfMarketSearch').append(showFoundMarketItems(result.results)).css({'opacity':0}).animate({'opacity':1});
                        $('#resultsOfMarketSearch').append(navigation());
                    } else {
                        $('#resultsOfMarketSearch').append('<p>Zadaným kritériam nevyhovujú žiadne výsledky. Skúste menej alebo pridajte <a href="pridat.php?what=inzerát">nový inzerát</a>.</p>');
                    }
                } else if (window.location.href.indexOf('stajne-a-rance') > 0) {
                    $('#serviceSearchResults').html('');
                    $('#assetsFound').html('');
                    if (result.results.length > 0) {
                        $('#assetsFound').html('Zobrazených <span id="resultRange"></span> stajní / rančov z <span id="resultNumber"></span>');
                        $('#resultRange').html(rangeSearch(result.results.length));
                        $('#resultNumber').html(result.completeNumber);
                        $('#serviceSearchResults').prepend(navigation());
                        $('#serviceSearchResults').append(showFoundBarns(result)).css({'opacity':0}).animate({'opacity':1});
                        $('#serviceSearchResults').append(navigation());
                    }else{
                        $('#serviceSearchResults').html('');
                        $('#serviceSearchResults').append('<p><br>Zadaným kritériam nevyhovujú žiadne výsledky. Skúste menej detailov alebo pridajte <a href="pridat.php?what=stajňu">novú stajňu / ranč</a>.</p>');
                    }
                }

            $('.loading').fadeOut(400);
        },
        error: function (data) {
            $('.loading').fadeOut(400);
            warningAnimation('Bohužial nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function getSpecificUserInfo(callBackFunction) {
    var ID = findGetParameter('ID');
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/user/getSpecificUserInfo/' + ID,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var result = isJson(data) ? jQuery.parseJSON(data) : data;
            callBackFunction(result);
            $('.loading').fadeOut(400);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function checkEditAdvertPassword(advertPassword){
    var formData = new FormData();
    formData.append('advertPassword', advertPassword);
    formData.append('ID', findGetParameter('ID'));
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: formData,
        url: '/api/callBackend/checkEditAdvertPassword',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data == 1){
                window.location.href = "/editovat.php?what=inzerát&ID=" + findGetParameter('ID');
            }else{
                warningAnimation(data);
            }
            $('.loading').fadeOut(400);
            return;
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať detaily služby, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}

function showNextResults() {
    var allResults = parseInt($('#resultNumber').text().match(/\d+/)[0]);
    var rangeStart = parseInt($('#rangeStart').text());
    var rangeEnd = parseInt($('#rangeEnd').text());
    
    if (window.location.href.indexOf('vyhladat') > 0){
        var displayedResults = 5;
    }
    if (window.location.href.indexOf('bazar') > 0){
        var displayedResults = 10;
    }
    if (window.location.href.indexOf('novinky-clanky') > 0){
        var displayedResults = 5;
    }
    if (window.location.href.indexOf('kalendar') > 0) {
        var displayedResults = 5;
    }
    if (((rangeEnd - rangeStart) + 1) < displayedResults){
        return false;
    }
    if (rangeEnd == allResults){
        return false;
    }
    return true;
}

function rangeSearch(foundResults){
    if (window.location.href.indexOf('vyhladat') > 0) {
        var displayedResults = 5;
    }
    if (window.location.href.indexOf('bazar') > 0) {
        var displayedResults = 10;
    }
    if (window.location.href.indexOf('novinky-clanky') > 0) {
        var displayedResults = 5;
    }
    if (window.location.href.indexOf('kalendar') > 0) {
        var displayedResults = 5;
    }
    if (window.location.href.indexOf('stajne-a-rance') > 0) {
        var displayedResults = 5;
    }
    var currentPage = findGetParameter('page') == null ? 0 : findGetParameter('page');
    var startNumber = (displayedResults * currentPage);
    return "<span id='rangeStart'>" + (startNumber + 1) + "</span> - <span id='rangeEnd'>" + (startNumber + foundResults) + "</span>";
}

function deleteFromNewsletter(){
    var formData = new FormData();
    formData.append('newsLetterEmail', findGetParameter('email'));
    $('.loading').show();
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: formData,
        url: '/api/callBackend/removeFromNewsletter',
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať detaily služby, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').fadeOut(400);
        }
    });
}