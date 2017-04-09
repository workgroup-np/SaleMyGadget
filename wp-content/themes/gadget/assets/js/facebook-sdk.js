
/*
* CUSTOM JS WRITTEN BY RAFIN    
*/
/*----------------------------------- Signin With Facebook -----------------------------------------------------*/
/**
 * Facebook Connect
 * Load the SDK asynchronously
 * Connect/Get Response
 * Call Ajax to login/register if response success
 */
 (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

 window.fbAsyncInit = function() {
    FB.init({
     appId      : '1267178606729665',
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use version 2.2
 });

    FB.getLoginStatus(function(response) {
     statusChangeCallback(response);
     console.log(response.status);
  });
 };
 function statusChangeCallback(response) {
    if (response.status === 'connected' && !jQuery('body').hasClass('logged-in')) {
     FB.api('/me?fields=first_name,last_name,email,location,hometown,picture', function(response) {
       console.log('Good to see you picture, ' + response.picture.data.url + '.');
       console.log('Full response, ' + response);
       if(!response.email){
        if(!response.id){
          fbLogin();
       }
               else{//call login/register ajax
                jQuery('input[name=fname]').val(response.first_name);
                jQuery('input[name=lname]').val(response.last_name);
                jQuery('input[name=email]').val(response.email);
                jQuery('input[name=address]').val(response.hometown);
                jQuery('input[name=city]').val(response.location);
                localStorage.setItem('image_src', response.picture.data.url);
                jQuery('#pp_image').attr('src',response.picture.data.url);
                    //facebookLoginRegister(response);
                 }
            } else{//call login/register ajax
              jQuery('input[name=fname]').val(response.first_name);
              jQuery('input[name=lname]').val(response.last_name);
              jQuery('input[name=email]').val(response.email);
              jQuery('input[name=address]').val(response.hometown);
              jQuery('input[name=city]').val(response.location);
              localStorage.setItem('image_src', response.picture.data.url);
              jQuery('#pp_image').attr('src',response.picture.data.url);
                //facebookLoginRegister(response);
             }
          });
  }
}
function fbLogin(){
 FB.login(function(response) {
  if (response.authResponse) {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=first_name,last_name,email,location,hometown,picture', function(response) {
     console.log('Good to see you picture, ' + response.picture.data.url + '.');
     console.log( response);
     if(!response.email){
      if(!response.id){
        fbLogin();
     }
               else{//call login/register ajax
                jQuery('input[name=fname]').val(response.first_name);
                jQuery('input[name=lname]').val(response.last_name);
                jQuery('input[name=email]').val(response.email);
                jQuery('input[name=address]').val(response.hometown);
                jQuery('input[name=city]').val(response.location);
                localStorage.setItem('image_src', response.picture.data.url);
                jQuery('#pp_image').attr('src',response.picture.data.url);
                   //facebookLoginRegister(response);
                }
            } else{//call login/register ajax
              jQuery('input[name=fname]').val(response.first_name);
              jQuery('input[name=lname]').val(response.last_name);
              jQuery('input[name=email]').val(response.email);
              jQuery('input[name=address]').val(response.hometown);
              jQuery('input[name=city]').val(response.location);
              localStorage.setItem('image_src', response.picture.data.url);
              jQuery('#pp_image').attr('src',response.picture.data.url);
                //facebookLoginRegister(response);
             }
          });
 } else {
    console.log('Sorry! Connection Unsuccesful');

 }
}, {scope: 'public_profile,email'});
}
