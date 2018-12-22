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
    userDetails += '<label class="userInput"><span class="userDetailText">SJF Odkaz</span><input type="text" name="sjfLink" value="' + (userData.sjfLink ? userData.sjfLink : '') + '"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">FEI Odkaz</span><input type="text" name="feiLink" value="' + (userData.feiLink ? userData.feiLink : '') + '"></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">O používateľovi</span><br><textarea name="userDescription">' + (userData.userDescription ? userData.userDescription : '') + '</textarea></label>' + '<br>';
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
    
        default:
            break;
    }
}