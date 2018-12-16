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
    userDetails += '<label class="userInput"><span class="userDetailText"><b>Chcem byť vyhľadateľný</b></span><input type="checkbox" name="searchable" ' + (userData.searchable == 'yes' ? 'checked' : '') + '></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Vlastník stajňe</span><input type="checkbox" name="isBarnAdmin" ' + (userData.isBarnAdmin == 'yes' ? 'checked' : '') + '></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Tréner</span><input type="checkbox" name="isTrainer" ' + (userData.isTrainer == 'yes' ? 'checked' : '') + '></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Veterinár</span><input type="checkbox" name="isVeterinary" ' + (userData.isVeterinary == 'yes' ? 'checked' : '') + '></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Rozhodca</span><input type="checkbox" name="isReferee" ' + (userData.isReferee == 'yes' ? 'checked' : '') + '></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Kováč</span><input type="checkbox" name="isShoer" ' + (userData.isShoer == 'yes' ? 'checked' : '') + '></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Sedlár</span><input type="checkbox" name="isSaddler" ' + (userData.isSaddler == 'yes' ? 'checked' : '') + '></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Pôsobisko</span><select name="fullName" class="locationLocalCity"></select></label>' + '<br>';
    userDetails += '<label class="userInput"><span class="userDetailText">Okruh pôsobenia</span><input type="text" name="range" value="' + (userData.range ? userData.range : '') + '"></label>' + '<br>';
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