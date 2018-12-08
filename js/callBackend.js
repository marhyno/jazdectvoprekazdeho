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

    //if change form buttons clicked - hide all forms and show only login
    $('.login100-form').each(function () {
        $(this).hide(500);
    });
    $('#loginform').show();

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

        //goBack
        if (event.target.id == "goBack") {
            goBack(0);
        }
    });
});

function logInOrRegisterFBorGmailUserAndLogIn(method,data = null) {
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
            if (data == 1){
                confirmationAnimation('Skontrolujte emailovú schránku kde vám bol poslaný potvrdzovací email.');
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

function goBack(timer = 2500) {
    setTimeout(function () {
        if (document.referrer === ""){
            document.location.href="/";
        }else{
            document.location.href=document.referrer;
        }
    },timer)
}