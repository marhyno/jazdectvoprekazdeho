<script>
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
            fetchUserDetail();
    });
   };

    function fetchUserDetail()
    {
        FB.api('/me', function(response) {
                console.log(response);
                
            });
    }
</script>

<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>