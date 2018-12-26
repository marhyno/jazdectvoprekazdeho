$(document).ready(function() {  
    $(document).on("click","#logIn",function(event) {
        event.preventDefault();
        event.stopPropagation();
        logInOrRegisterFBorGmailUserAndLogIn('regular');
    });

    $(document).on("click","#createAccount",function(event) {
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

    //if change form buttons clicked - hide all forms and show only login
    $('.login100-form').each(function () {
        $(this).hide();
    });

    if (findGetParameter('resetToken')) {
        $('#setNewPassword').show();
    }
    else if (findGetParameter('register')) {
        $('#registerform').show();
    }else{
        $('#loginform').show();
    }

    $(document).click(function (event) {
        //when change form A href is clicked - hide all forms
        if (event.target.className.indexOf("changeForm") > -1) {
            event.preventDefault();
            $('.login100-form').each(function () {
                $(this).hide(500);
            });

            //based on button, show only one form
            var formName = event.target.id.replace("show","");  
            $('#'+formName).show(500);
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

    $(document).on("change",".locationProvince, .locationRegion",function() {
        if ($('.locationLocalCity').val() == ""){
            fillLocationSelects(updateFields = true);
        }
    });

    $(document).on("click",".resetFilter",function() {
        $('.loading').show();
        fillLocationSelects();
        if ($('.multiselect').length > 0){
            $('.multiselect').multiselect( 'reset' );
        }
        $('.filter input:text').val('');
        $('.filter select').val('');
    });
});

function logInOrRegisterFBorGmailUserAndLogIn(method,data) {
    data = data || null;
    $('.loading').show();
    var formData = new FormData();
    formData.append('method',method);
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
        url: '/api/callBackend/user/login/',
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            console.log(data);
            if (data != ""){
                localStorage.setItem("token", data);
                confirmationAnimation('Úspešne prihlásený. Budete presmerovaný.');
                goBack();
            }else{
                warningAnimation('Neplatný email alebo heslo');    
            }
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
            warningAnimation('Bohužial nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function registerUser() {
    $('.loading').show();
    var firstPassWord = $('#registerform').find('#setPassword').val();
    var secondPassword = $('#registerform').find('#repeatPassword').val();
    if (firstPassWord != secondPassword){
        warningAnimation('Heslá sa nezhodujú.');
        $('.loading').hide();
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
            }else if (data == 0){
                warningAnimation('Používateľ s takýmto emailom už existuje.');
            }else{
                warningAnimation(data);
            } 
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
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
        if (document.referrer === ""){
            document.location.href="/";
        }else{
            document.location.href=document.referrer;
        }
    },timer)
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
    if (updateFields){       
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
                    generatedProvinces.push("<option class='firstLevel' value='province|"+locations[x].province+"'>"+locations[x].province+"</option>");
                    generatedRegions.push("<option class='secondLevel' value='region|"+locations[x].region+"'>"+locations[x].region+"</option>");
                    generatedLocalCities.push("<option class='thirdLevel' value='localCity|"+locations[x].localCity+"'>"+locations[x].localCity+"</option>"); 
                    previousRegion = locations[x].region;
                    previousProvince = locations[x].province;
                }else{
                    if (previousProvince == locations[x].province){
                        //pass
                    }else{
                        generatedProvinces.push("<option class='firstLevel' value='province|"+locations[x].province+"'>"+locations[x].province+"</option>");
                        previousProvince = locations[x].province;
                    }
                    if (previousRegion == locations[x].region){
                        //pass
                    }else{
                        generatedRegions.push("<option class='secondLevel' value='region|"+locations[x].region+"'>"+locations[x].region+"</option>");
                        previousRegion = locations[x].region;
                    }
                    generatedLocalCities.push("<option class='thirdLevel' value='localCity|"+locations[x].localCity+"'>"+locations[x].localCity+"</option>");
                }
                skipFirst++;
            };
            $('.locationProvince').append(generatedProvinces.join());
            generatedRegions.sort();
            generatedLocalCities.sort();
            $('.locationRegion').append("<option value=''></option>"+generatedRegions.join());
            $('.locationLocalCity').append("<option value=''></option>"+generatedLocalCities.join());

            if (updateFields){
                $('.locationProvince').val(locationProvince)
                $('.locationRegion').val(locationRegion)
                $('.locationLocalCity').val(locationLocalCity)
            }
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať lokality, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function getNumberOfNewsByCategories() {
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
                categoriesList += '<li><a href="?category=' + categories[x].categoryName + '" class="justify-content-between align-items-center d-flex"><h6>' + categories[x].categoryName + '</h6> <span>' + categories[x].newsCount + '</span></a></li>';
            }                
            $('.newsCategories').find('ul').append(categoriesList);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function getLatestNews() {
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getLatestNews/',
        xhrFields: {
        withCredentials: true
        },
        success: function (data) {
            var latestNews = isJson(data) ? jQuery.parseJSON(data) : data;
            var showLatestNews = "";
            for (var x = 0; x < latestNews.length; x++) {
                showLatestNews +=
                '<div class="single-recent-post d-flex flex-row">'+
                    '<div class="recent-thumb">'+
                        '<img class="img-fluid" src="' + latestNews[x].titleImage + '" alt="">' +
                    '</div>'+
                    '<div class="recent-details">'+
                        '<a href="clanok.php?newsId=' + latestNews[x].ID + '">' +
                            '<h4>' + latestNews[x].title + '</h4>' +
                        '</a>'+
                        '<p>' + latestNews[x].dateAdded + '</p>' +
                    '</div>'+
               '</div>';
            };
            $('.recent-posts-widget').find('.blog-list').html(showLatestNews);
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function getNewsArchiveList() {
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
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať kategórie článkov, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function sendFastContactForm() {
    var continueSending = true;
    var formData = new FormData();
    $('.fastContactForm').find('input, textarea').each(function () {
        $(this).css('border', '1px solid #ced4da');
        if ($(this).val() == ""){
            $(this).css('border','1px solid red');
            continueSending = false;
            return;
        }else{
            formData.append($(this).attr('name'), $(this).val());      
        }
    });
    if (!continueSending){
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
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
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
        url: '/api/callBackend/user/logout/',
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
    var formData = new FormData();
    formData.append('barnId', barnId);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getBarnDetails/' + barnId,
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var barnDetails = isJson(data) ? jQuery.parseJSON(data) : data;
            callBackFunction(barnDetails);    
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať stajňu, obnovte stránku a skúste to znovu.' + data.responseText);
        }
    });
}

function getServiceDetails(serviceId, callBackFunction) {
    $('.loading').show();
    var formData = new FormData();
    formData.append('serviceId', serviceId);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'GET',
        url: '/api/callBackend/getServiceDetails/' + serviceId,
        data: formData,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            var serviceDetails = isJson(data) ? jQuery.parseJSON(data) : data;
            callBackFunction(serviceDetails);
            $('.loading').hide();
        },
        error: function (data) {
            warningAnimation('Nastala chyba na našej strane a nepodarilo sa načítať stajňu, obnovte stránku a skúste to znovu.' + data.responseText);
            $('.loading').hide();
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
            $('.loading').hide();
            confirmationAnimation('Email bol pridaný do zoznamu.')
        },
        error: function (data) {
            $('.loading').hide();
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
            $('.loading').hide();
            },
        error: function (data) {
            $('.loading').hide();
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
            if (data.indexOf('token:') > -1){
                localStorage.setItem("token", data.split("token:")[1]);
                confirmationAnimation('Účet bol potvrdený, prihlasujeme vás a presmerujeme.');
                goBack(4000);
            }else{
                warningAnimation(data);
            }
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
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
        $('.loading').hide();
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
            $('.loading').hide();
        },
        error: function (data) {
            $('.loading').hide();
            warningAnimation('Nastala chyba na našej strane, obnovte stránku a skúste to znovu. ' + data.responseText);
        }
    });
}

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

