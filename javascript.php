<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">

<head>
    <title>php-sdk</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <!--
      fb-root is needed for javascript SDK
    -->
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '{your-app-id}', // TODO: EDIT HERE
                cookie: true,
                xfbml: true,
                version: 'v3.1'
            });

            myLoginSuccess();
            FB.AppEvents.logPageView();

            FB.Event.subscribe('auth.login', function (response) {
                // TODO: add event login here
            });
            FB.Event.subscribe('auth.logout', function (response) {
                // TODO: add event logout here
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function myLoginSuccess() {
            FB.getLoginStatus(function (response) {
                console.log(response);
                console.log(response.authResponse.accessToken);
                document.getElementById('profilePicture').src = "https://graph.facebook.com/me/picture?access_token=" + response.authResponse.accessToken;
                if (response.status == 'connected')
                    console.log('User already logged in!');
                else
                    console.log('Have not logged in yet');
            });
        }

        function facebookLogin() {
            FB.login(function (response) {
                if (response.authResponse) {
                    console.log('login success! access token is: ' + response.authResponse.accessToken);
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {
                scope: 'public_profile,email'
            });
        }

        function facebookLogout() {
            FB.logout(function (response) {
                if (response.authResponse) {
                    console.log('logout success!');
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });
        }
    </script>
    
    <fb:login-button scope="public_profile,email,user_friends" onlogin=" myLoginSuccess();">
    </fb:login-button>
    <button onclick="facebookLogin()">Facebook Login</button>
    <button onclick="facebookLogout()">Facebook Logout</button>
    <div>
        <img id="profilePicture">
    </div>
</body>

</html>