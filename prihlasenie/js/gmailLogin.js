function checkGoogleSign(){
    var scriptTag = document.createElement("script");
    scriptTag.src = "https://apis.google.com/js/platform.js?onload=onLoadGoogleCallback";
    document.head.appendChild(scriptTag);
}
    
function onLoadGoogleCallback(){
    gapi.load('auth2', function() {
    auth2 = gapi.auth2.init({
        client_id: "238132942112-ug2du2pemhrck8hcglhltt57n2bfgfkv.apps.googleusercontent.com",
        cookiepolicy: 'single_host_origin',
        scope: 'profile'
    });

    auth2.attachClickHandler(element, {},
    function(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log(profile.getId(),profile.getEmail(),profile.getName());
        }, function(error) {
        console.log('Sign-in error', error);
        }
    );
    });

    element = document.getElementById('googleSignIn');
}

checkGoogleSign();