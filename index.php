<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>API Example</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

</head>

<body id="top">
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Navbar</a>
      <a class="btn navbar-text" id="logoutbtn" href="#" onclick="fbLogout()" style="border-width: 1px; border-color: white; font-weight: 600;">Logout</a>
    </nav>
    <div class="container login" style="margin: 150px; background-color: #f5f5f5;">
      <div class="row">
        <div class="col" style="padding: 3rem; ">
            <a href="javascript:void(0);" onclick="fbLogin()" id="fbLink" class="btn" style="background-color: blue; color: white;">Login With Facebook</a>
        </div>
      </div>
    </div>

    <div class="container" id="imageshow" style="margin: 150px; background-color: #f5f5f5;">
      <div class="row">
        <div class="col" style="padding: 3rem; ">
            <img src="destination.jpg" width="800px" height="400px">
        </div>
      </div>
    </div>
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 27rem; margin-left: auto; margin-right: auto;">
                  <img class="card-img-top" src="images/category-1.jpg" alt="Card image cap">
                  <div class="card-body">
                    <button class="btn btn-outline-danger btn-lg btn-block">Try This One!!!!!!</button>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 27rem; margin-left: auto; margin-right: auto;">
                  <img class="card-img-top" src="images/category-1.jpg" alt="Card image cap">
                  <div class="card-body">
                    <button class="btn btn-outline-danger btn-lg btn-block">Try This One!!!!!!</button>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 27rem; margin-left: auto; margin-right: auto;">
                  <img class="card-img-top" src="images/category-1.jpg" alt="Card image cap">
                  <div class="card-body">
                    <button class="btn btn-outline-danger btn-lg btn-block">Try This One!!!!!!</button>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 27rem; margin-left: auto; margin-right: auto;">
                  <img class="card-img-top" src="images/category-1.jpg" alt="Card image cap">
                  <div class="card-body">
                    <button class="btn btn-outline-danger btn-lg btn-block">Try This One!!!!!!</button>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron text-center" style="margin-bottom:0; margin-top: 50px; padding: 2rem 1rem;">
      <a href="#" style="margin: 40px;">Contact</a>
      <a href="#" style="margin: 40px;">FAQ</a>
      <a href="#" style="margin: 40px;">Privacy Policy</a>
      <a href="#" style="margin: 40px;">Terms Of Services</a>
      <a href="#" style="margin: 40px;">Account Removal</a>
      <p style="margin-top: 30px;">Disclaimer: All content is provided for fun and entertainment purposes only.</p>
      <p style="font-weight: 700;">© LolSided.com 2018</p>
    </div>

    <!-- Java Script
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- facebook SDK
    ================================================== -->
    <script>
        $("#logoutbtn").hide();
        $("#imageshow").hide();
        window.fbAsyncInit = function() {
            // FB JavaScript SDK configuration and setup
            FB.init({
              appId      : '309670369845468', // FB App ID
              cookie     : true,  // enable cookies to allow the server to access the session
              xfbml      : true,  // parse social plugins on this page
              version    : 'v3.1' // use graph api version 2.8
            });
            
            // Check whether the user already logged in
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    //display user data
                    getFbUserData();
                }
            });
        };

        // Load the JavaScript SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Facebook login with JavaScript SDK
        function fbLogin() {
            FB.login(function (response) {
                if (response.authResponse) {
                    // Get and display the user profile data
                    getFbUserData();
                } else {
                    document.getElementById('status').innerHTML = 'Unable to login. Please try again.';
                }
            }, {scope: 'email'});
        }

        // Fetch the user profile data from facebook
        function getFbUserData(){
            FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
            function (response) {
                $("#logoutbtn").show();
                $.post("image_creator.php",{
                    facebook_id : response.id,
                    fb_firstname : response.first_name,
                    fb_lastname : response.last_name,
                    fb_email : response.email,
                    fb_pic : response.picture.data.url
                },function(){
                    function get(name){
                       if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
                          return decodeURIComponent(name[1]);
                    }
                    var quizid = get('quiz');
                    alert(quizid);
                    //document.getElementById('userData').innerHTML = "<img src='destination.jpg' width=1000px height=500px>";
                    //window.location="imagecreator.php?name="+response.first_name+"%20"+response.last_name+"&quiz="+quizid;

                    $(".login").hide();
                    $("#imageshow").show();
                    alert("showing");
                });
            });
        }

        // Logout from facebook
        $("#logoutbtn").click(function(){
            $("#logoutbtn").hide();
            FB.logout(function() {
                document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
                document.getElementById('fbLink').innerHTML = 'Login With Facebook User ID';
                document.getElementById('userData').innerHTML = '';
                document.getElementById('status').innerHTML = 'Logout Successfull.';
            });
        });
    </script>

</body>

</html>