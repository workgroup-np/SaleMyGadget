// menu dropdown link clickable
jQuery( document ).ready( function ( $ ) {
    $( '.navbar .dropdown > a, .dropdown-menu > li > a, .navbar .dropdown-submenu > a, .widget-menu .dropdown > a, .widget-menu .dropdown-submenu > a' ).click( function () {
        location.href = this.href;
    } );
} );
// scroll to top button
jQuery( document ).ready( function ( $ ) {
    $( "#back-top" ).hide();
    $( function () {
        $( window ).scroll( function () {
            if ( $( this ).scrollTop() > 100 ) {
                $( '#back-top' ).fadeIn();
            } else {
                $( '#back-top' ).fadeOut();
            }
        } );
// scroll body to 0px on click
$( '#back-top a' ).click( function () {
    $( 'body,html' ).animate( {
        scrollTop: 0
    }, 800 );
    return false;
} );
} );
} );
// Tooltip
jQuery( document ).ready( function ( $ ) {
    $( function () {
        $( '[data-toggle="tooltip"]' ).tooltip()
    } )
} );
// Tooltip to compare and wishlist
jQuery( document ).ready( function ( $ ) {
    $( ".compare.button" ).attr( 'data-toggle', 'tooltip' );
    $( ".compare.button" ).attr( 'title', objectL10n.compare );
    $( ".yith-wcqv-button.button" ).attr( 'data-toggle', 'tooltip' );
    $( ".yith-wcqv-button.button" ).attr( 'title', objectL10n.qview );
} );
// Wishlist count ajax update
jQuery( document ).ready( function ( $ ) {
    $( 'body' ).on( 'added_to_wishlist', function () {
        $( '.top-wishlist .count' ).load( yith_wcwl_plugin_ajax_web_url + ' .top-wishlist span', { action: 'yith_wcwl_update_single_product_list' } );
    } );
} );
// FlexSlider homepage
jQuery( document ).ready( function ( $ ) {
    var $window = $( window ),
    flexslider;
// tiny helper function to add breakpoints
function getGridSize() {
    return ( window.innerWidth < 450 ) ? 1 :
    ( window.innerWidth < 745 ) ? 2 :
    ( window.innerWidth < 1120 ) ? 3 :
    ( window.innerWidth < 1450 ) ? 4 : 5;
}
$( window ).load( function () {
    $( '#carousel-home' ).flexslider( {
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: true,
        itemWidth: 270,
        itemMargin: 40,
        minItems: getGridSize(),
        maxItems: getGridSize(),
        start: function ( slider ) {
flexslider = slider; //Initializing flexslider here.
slider.removeClass( 'loading-hide' );
}
} );
    $window.resize( function () {
        var gridSize = getGridSize();
        if ( flexslider ) {
            flexslider.vars.minItems = gridSize;
            flexslider.vars.maxItems = gridSize;
        }
    } );
} );
// set the timeout for the slider resize
$( function () {
    var resizeEnd;
    $( window ).on( 'resize', function () {
        clearTimeout( resizeEnd );
        resizeEnd = setTimeout( function () {
            flexsliderResize();
        }, 100 );
    } );
} );
function flexsliderResize() {
    if ( $( '#carousel-home' ).length > 0 ) {
        $( '#carousel-home' ).data( 'flexslider' ).resize();
    }
}
} );
// Header after pseudo element height fix
jQuery( document ).ready( function ( $ ) {
    updateContainer();
    $( window ).resize( function () {
        updateContainer();
    } );
} );
function updateContainer() {
    currentHeight = jQuery( '.header-right' ).outerHeight() + 1;
    if ( jQuery( window ).width() > 991 ) {
        jQuery( ".header-right-triangle" ).css( { "border-top-width": currentHeight } );
    }
}
/*
* CUSTOM JS WRITTEN BY RAFIN    
*/
/*----------------------------------- Remove Query String -----------------------------------------------------*/
function getPathFromUrl(url,toremove) {
    return url.split(toremove)[0];
}
/*----------------------------------- Show Profile Image Instantly-----------------------------------------------------*/
function readURL(input ,id) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          jQuery(id)
          .attr('src', e.target.result)
          .width(30)
          .height(30);
      };
      reader.readAsDataURL(input.files[0]);
  }
}
/*----------------------------------- AutoComplete Location -----------------------------------------------------*/
 
  //     google.maps.event.addDomListener(window, 'load', initAutocomplete);
  //     var placeSearch, autocomplete;
  //     function initAutocomplete() {
     
  //       autocomplete = new google.maps.places.Autocomplete(
  //           /** @type {!HTMLInputElement} */(document.getElementById('address')),
  //           {types: ['geocode']});
       
  //       autocomplete.addListener('place_changed', fillInAddress);
  //   }
   
  //     function geolocate() {
  //       if (navigator.geolocation) {
  //         navigator.geolocation.getCurrentPosition(function(position) {
  //           var geolocation = {
  //             lat: position.coords.latitude,
  //             lng: position.coords.longitude
  //         };
  //         var circle = new google.maps.Circle({
  //             center: geolocation,
  //             radius: position.coords.accuracy
  //         });
  //         autocomplete.setBounds(circle.getBounds());
  //     });
  //     }
  // }
  // function fillInAddress() {}
  /*----------------------------------- Validate Registration From-----------------------------------------------------*/
    var mainUrl=objectL10n.site_url;
    var dirUrl=objectL10n.directory_url;
    function recaptchaCallback() {
      jQuery('#hiddenRecaptcha').valid();
    };
    jQuery( document ).ready( function ( $ ) {
        $("#mobile").keydown(function (e) {
            if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
               (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
               (e.keyCode >= 35 && e.keyCode <= 40)) {
               return;
       }
       if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
        }
    });
    $("#registration_form").validate({
        ignore: ".ignore",
        errorElement: "span",
        errorClass: 'col s12 error-label',
        rules: {
            fname:{
                required:true
            },
            lname:{
                required:true
            },
            username:{
                required:true,
                remote: {
                    url: dirUrl+"/includes/ajax/username_emailCheck.php",
                    type: "post",
                    data: {
                        email: function() {
                            return $('#username').val();
                        },
                        action:'usernamecheck',
                    }
                }
            },
            email:{
                required:true,
                email:true,
                remote: {
                    url: dirUrl+"/includes/ajax/username_emailCheck.php",
                    type: "post",
                    data: {
                        email: function() {
                            return $('#email').val();
                        },
                        action:'mailcheck',
                    }
                }
            },
            mobile:{
                required:true,
                number:true,
                minlength: 8,
                maxlength: 10
            },
            password:{
                required:true,
            },
            cpassword:{
                required:true,
                equalTo: "#password"
            },address:{
                required:true,
            },city:{
                required:true,
            },
            profile_image:  {
                required: true,
            //extension:"png|jpe?g",
            //filesize:"7000000"
            },
             hiddenRecaptcha: {
                
            required: function () {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
        },

    },
    messages:{
        fname:{
            required:"Please fill in this field",
        },
        lname:{
            required:"Please fill in this field",
        },
        username:{
            required:"Please fill in this field",
            remote:"Email Already exist"
        },
        email:{
            required:"Please fill in this field",
            email:"Please enter valid email",
            remote:"Email Already exist"
        },
        mobile:{
            required:"Please fill in this field",
        },
        password:
        {
            required:"Please fill in this field",
        },
        cpassword:{
            required:"Please fill in this field",
        }, address:{
            required:"Please fill in this field",
        },city:{
            required:"Please fill in this field",
        },
        profile_image:{
            required:"Profile Image please",
            //extension:"invalid Image Format",
            //filesize:"file exceed 7mb"
        },
        hiddenRecaptcha: {
                
            required:"Enter Captcha",
        },
       
    },
    submitHandler:function(form){
        var registrationFormValue = $('#registration_form').serialize();
        var profile_image=$("#profile_image").get(0).files[0];
        var formData = new FormData();
        formData.append('profile_image', profile_image);
        formData.append('fname', $("#fname").val());
        formData.append('lname', $("#lname").val());
        formData.append('username', $("#username").val());
        formData.append('email', $("#email").val());
        formData.append('password', $("#password").val());
        formData.append('mobile', $("#mobile").val());
        formData.append('address', $("#address").val());
        formData.append('city', $("#city").val());
        formData.append('action','registrationForm');
        $.ajax({
            url: dirUrl+'/includes/ajax/registrationForm.php',
            type: 'POST',
            data:formData,
            contentType: false,
            processData: false,
            beforeSend:function()
            {
                    //$('#registerSubmit').css('pointer-events','none');
                    $('#loader').show();
                    $('#loader').html('<img src="'+dirUrl+'/assets/img/loading.gif">');
                }
            })
        .done(function(msg) {
            msg = JSON.parse(msg);
            if(msg.msg==='success')
            {
                $('.success_message').removeClass('redzone');
                $('.success_message').html("Activation link has been sent to your inbox.");
                $('.success_message').show();
                document.getElementById("registration_form").reset();
            }
            else
            {
                $('.success_message').addClass('redzone');
                $('.success_message.redzone').html("Message couldnot sent");
            }
            $('#loader').html('');
            $('#loader').hide();
           // $('#registerSubmit').css('pointer-events','auto');
           console.log(msg);
           return false;
       })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
});
/*----------------------------------- Validate Login From-----------------------------------------------------*/
    jQuery("#LoginForm").validate({
        errorElement: "span",
        errorClass: 'col s12 error-label',
        rules: {
            username:{
                required:true
            },
            password:{
                required:true
            }
        },
        messages:{
            username:
            {
                required:"Please fill in this field",
            },
            password:
            {
                required:"Please fill in this field",
            }
        },
       
        submitHandler:function(form){
            var loginDetails = $('#LoginForm').serialize();
            $.ajax({
                url: dirUrl+'/includes/ajax/loginForm.php',
                type: 'POST',
                data:loginDetails+'&action=login',
                beforeSend:function()
                {
                // $('#jobadder_submit').css('pointer-events','none');
                  $('#loader').show();
                  $('#loader').html('<img src="'+dirUrl+'/assets/img/loading.gif">');
                }
            })
            .done(function(msg) {
                msg = JSON.parse(msg);
                if(msg.msg==='success')
                {
                   
                   window.location.href = mainUrl+"my-account/";
                    
                }
                else
                {
                    $('#loginerror').html(msg.message);
                    $('#loader').hide();
                }
                return false;
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

        }
    });//validate
/*----------------------------------- Forgot Password Form Validation --------------------------------------------------*/
 
    $('#resetPassword').validate({
        errorElement: "span",
        errorClass: 'col s12 error-label',
        rules: {
            user_email: {
                required: true,
                email: true
            }
        },
        messages: {
            user_email: {
                required: 'Email is required.',
                email: 'Your email must be valid.'
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo( element.parent("div") );
        },
        submitHandler: function () {
            //call ajax here
            jQuery('#forget_submit').attr('disabled', true);
            var str = $('#resetPassword').serialize();
            xurl = dirUrl+'/includes/ajax/forgetPassword.php';
            $.ajax({
                type: 'POST',
                url: xurl,
                data: str
            }).done(function (msg) {
                msg = JSON.parse(msg);
                if(msg.msg==='success')
                {
                    $(".login-block").hide();
                    $("#sent_mail").show();
                    window.setTimeout(function() {
                    window.location.href = mainUrl+"login/";
                    }, 5000);
                }
            });
        }
    });
/*----------------------------------- Change Password  --------------------------------------------------*/
 
    $('#newPassword').validate({
        errorElement: "span",
        errorClass: 'col s12 error-label',
        rules: {
            password:{
                required:true,
            },
            cpassword:{
                required:true,
                equalTo: "#password"
            },
        },
        messages: {
             password:
            {
                required:"Please fill in this field",
            },
            cpassword:{
                required:"Please fill in this field",
            },
        },
        errorPlacement: function (error, element) {
            error.appendTo( element.parent("div") );
        },
        submitHandler: function () {
            //call ajax here
            jQuery('#resetPassword').attr('disabled', true);
            var str = $('#newPassword').serialize();
            xurl = dirUrl+'/includes/ajax/changePassword.php';
            $.ajax({
                type: 'POST',
                url: xurl,
                data: str
            }).done(function (msg) {
                msg = JSON.parse(msg);
                if(msg.msg==='success')
                {
                    $(".login-block").hide();
                    $("#sent_mail").show();
                    window.setTimeout(function() {
                    window.location.href = mainUrl+"login/";
                    }, 5000);
                }
            });
        }
    });

/*----------------------------------- Generic Fuction for Ajax Category --------------------------------------------------*/
function getRequest(url, type, typeName, typeValue, beforeSend) {
    beforeSend();
    $.get(url, function(html){
        var result=JSON.parse(html);
        if(type=="postType"){
            var postType=typeName;
            var postTypeValue=typeValue;
            if(result.status==="success"){
                /* Show Selected Option*/
                $( "ul.selected-option" ).append(( $( "ul" ).has( "li.postType" ).length ? $("li.postType").html(postType) : "<li class='postType'>"+postType+"</li>"));
                $('ul.selected-option li:not(.postType)').remove();

                /*Display Category*/
                if($(".catOption").is(":visible")==true || $(".subcatOption").is(":visible")==true|| $(".subcatOption2").is(":visible")==true )
                        $(".catOption, .subcatOption,.subcatOption2").css('display','none');
                if(result.returnOption!=""){
                    $("select[name='categorySelect']").html(result.returnOption);
                    $(".catOption").css('display','block');
                }
                else{
                    $("#proceed").removeClass('disabled');
                }
                /*Update href Value*/
                $( '#proceed' ).attr( 'href', function(index, value) {
                    value = getPathFromUrl(value,'?');                        
                    return value + '?posttype='+postTypeValue;
                });
                $('#loader').hide();
            }
        }
        else if(type=="category"){
            var category=typeName;
            var categoryValue=typeValue;
            if(result.status==="success"){
                /* Show Selected Option*/
                $( "ul.selected-option" ).append(( $( "ul" ).has( "li.category" ).length ? $("li.category").html(category) : "<li class='category'>"+category+"</li>"));
                $('ul.selected-option li:not(.category,.postType)').remove();
                /*Display Category*/
                $("#proceed").addClass('disabled');
                if($(".subcatOption").is(":visible")==true || $(".subcatOption2").is(":visible")==true ){
                    $(".subcatOption,.subcatOption2").css('display','none');
                    
                }
                if(result.returnOption!=""){
                    $("select[name='subcategorySelect']").html(result.returnOption);
                    $(".subcatOption").css('display','block');
                }
                else{
                    $("#proceed").removeClass('disabled');
                }
                localStorage.setItem('taxName',result.taxName);
                /*Update href Value*/
                $( '#proceed' ).attr( 'href', function(index, value) {
                    value = getPathFromUrl(value,'&taxName');                        
                    return value + '&taxName='+result.taxName+'&cat='+categoryValue;
                });
                $('#loader').hide();
            }
        }
        else if(type=="subcategory"){
            var subcategory=typeName;
            var subcategoryValue=typeValue;
            if(result.status==="success"){
                /* Show Selected Option*/
                $( "ul.selected-option" ).append(( $( "ul" ).has( "li.subcategory" ).length ? $("li.subcategory").html(subcategory) : "<li class='subcategory'>"+subcategory+"</li>"));
                $('ul.selected-option li:not(.category,.postType,.subcategory)').remove();
                /*Display Category*/
                $("#proceed").addClass('disabled');
                if($(".subcatOption2").is(":visible")==true ){
                    $(".subcatOption2").css('display','none');
                    
                }
                if(result.returnOption!=""){
                    $("select[name='subcategory2Select']").html(result.returnOption);
                    $(".subcatOption2").css('display','block');
                }
                else{
                    $("#proceed").removeClass('disabled');
                }
                /*Update href Value*/
                $( '#proceed' ).attr( 'href', function(index, value) {
                    value = getPathFromUrl(value,'&subcat');                        
                    return value + '&subcat='+subcategoryValue;
                });
                $('#loader').hide();
            }
        }
        else{
            var subcategory2=typeName;
            var subcategoryValue2=typeValue;
            if(result.status==="success"){
                /* Show Selected Option*/
                $( "ul.selected-option" ).append(( $( "ul" ).has( "li.subcategory2" ).length ? $("li.subcategory2").html(subcategory2) : "<li class='subcategory2'>"+subcategory2+"</li>"));

                /*Display Category*/
                $("#proceed").addClass('disabled');
                // if($(".subcatOption2").is(":visible")==true ){
                //     $(".subcatOption2").css('display','none');
                    
                // }
                // if(result.returnOption!=""){
                //     $("select[name='subcategory2Select']").html(result.returnOption);
                //     $(".subcatOption2").css('display','block');
                // }
                // else{
                    $("#proceed").removeClass('disabled');
                //}
                /*Update href Value*/
                $( '#proceed' ).attr( 'href', function(index, value) {
                    value = getPathFromUrl(value,'&subcat1');                        
                    return value + '&subcat1='+subcategoryValue2;
                });
                $('#loader').hide();
            } 
        }
    });
}

/*----------------------------------- Pick PostType JS  --------------------------------------------------*/
$("select[name='postTypeSelect']").change(function() {
    var postType = $(this).find(':selected').text();
    var postTypeValue = $(this).val();
    if(postTypeValue !='none'){
        getRequest(dirUrl+'/includes/ajax/Ads/pickCategory.php?action=post-select&type='+postTypeValue, 'postType',postType,postTypeValue, function() {
            $('#loader').show();
        });           
    }
    else{
        $(".catOption, .subcatOption").css('display','none');
        $( "ul.selected-option" ).html('');
    }
});
/*----------------------------------- Pick Category JS  --------------------------------------------------*/
    $("select[name='categorySelect']").change(function() {
        var category = $(this).find(':selected').text();
        var categoryValue = $(this).val();
        if(category !='none'){
            getRequest(dirUrl+'/includes/ajax/Ads/pickCategory.php?action=cat-select&type='+categoryValue, 'category',category,categoryValue, function() {
                $('#loader').show();
            });           
        }
    });
/*----------------------------------- Pick Sub Category JS  --------------------------------------------------*/
    $("select[name='subcategorySelect']").change(function() {
        var subcategory = $(this).find(':selected').text();
        var subcategoryValue = $(this).val();
        if(subcategory !='none'){
            var taxName=localStorage.getItem('taxName');
            getRequest(dirUrl+'/includes/ajax/Ads/pickCategory.php?action=cat-select&type='+subcategoryValue+'&taxName='+taxName, 'subcategory',subcategory,subcategoryValue, function() {
                $('#loader').show();
            });          
        }
    });
    /*----------------------------------- Pick Sub Category JS  --------------------------------------------------*/
    $("select[name='subcategory2Select']").change(function() {
        var subcategory2 = $(this).find(':selected').text();
        var subcategoryValue2 = $(this).val();
        if(subcategory2 !='none'){
            var taxName=localStorage.getItem('taxName');
            getRequest(dirUrl+'/includes/ajax/Ads/pickCategory.php?action=cat-select&type='+subcategoryValue2+'&taxName='+taxName, 'subcategory2',subcategory2,subcategoryValue2, function() {
                $('#loader').show();                
            });             
        }
    });
    /*----------------------------------- Post Ads JS  --------------------------------------------------*/

    /*
    * Check if user entered title already exists
    */
  
    $('#AdTitle').bind('blur', function () {
        function getRequest(url, beforeSend) {
             beforeSend();
             $.get(url, function(response){
                 if(response !== '0'){
                      $(".AdtitleMessage").html(response+ 'Post(s)');
                  }
                  else{
                      $(".AdtitleMessage").html('Unique Post');
                  }
             });
        }
        getRequest(dirUrl+'/includes/ajax/Ads/titleCount.php?title='+$('#AdTitle').val()+'&posttype='+$('#AdpostType').val(), function() {
            $(".AdtitleMessage").html('Loading...');
            $(".AdtitleMessage").show();
        });

    });
    /*
    * Validate Post Ad Form and Ajax Submit
    */
    $("#postAd").validate({
        errorElement: "span",
        errorClass: 'error',
        rules: {
            Adtitle:{
                required:true,
            },
            Addescription:{
                required:true,
            },AditemImage:{
                required:true,
            }
        },
        messages: {
            Adtitle:
            {
                required:"Title is required",
            },
            Addescription:{
                required:"Please write some description about your item.",
            },AditemImage:{
                required:"Please upload image.",
            },
        },

        submitHandler:function(form){
            var registrationFormValue = $('#postAd').serialize();
            var AditemImage=$("#AditemImage").get(0).files[0];
            var formData = new FormData();
            formData.append('AditemImage', AditemImage);
            formData.append('title', $("#Adtitle").val());
            formData.append('description', $("#dAdescription").val());
            formData.append('queryString', $("#queryString").val());
            formData.append('action','postAd');
            $.ajax({
                url: dirUrl+'/includes/ajax/postAd.php',
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                beforeSend:function()
                    {
                        //$('#registerSubmit').css('pointer-events','none');
                        $('#loader').show();
                    }
                })
            .done(function(msg) {
                msg = JSON.parse(msg);
                if(msg.msg==='success')
                {
                    $('.success_message').removeClass('redzone');
                    $('.success_message').html("Your Ad has been submitted");
                    $('.success_message').show();
                    document.getElementById("registration_form").reset();
                }
                else
                {
                    $('.success_message').addClass('redzone');
                    $('.success_message.redzone').html("Ad couldnot be submitted");
                }
                $('#loader').html('');
                $('#loader').hide();
               // $('#registerSubmit').css('pointer-events','auto');
               return false;
           })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

        }
    });

});