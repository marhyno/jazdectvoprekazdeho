window.fbAsyncInit = function() {
    FB.init({
      appId      : '425429784657516',
      cookie     : true,
      xfbml      : true,
      version    : 'v3.2'
    });
      
    FB.AppEvents.logPageView();   
      
  };

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



function checkLoginState() {
    FB.getLoginStatus(function(response) {
            console.log(response);
            if (response.status == "connected") {
                fetchUserDetail();   
            }else{
                warningAnimation('Prihlásenie pomocou Facebook-u zlyhalo, skúste znovu.'); 
            }
    });
};

function fetchUserDetail()
{
    FB.api('/me',{fields: 'id,name,email'},function(response) {
        //send data to login
        logInOrRegisterFBorGmailUserAndLogIn('facebook',response);
    });
}