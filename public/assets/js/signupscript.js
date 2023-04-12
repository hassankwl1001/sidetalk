$(document).ready(function () {
    //jQuery time
    var current_fs, next_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches
    let progress=0;
    $(".continue_button").click(async function () {
        var status = true;
        // if (animating) return false;
        // animating = true;
        // alert("hellow world");
        current_fs = $(this).parent().parent().parent().parent();
        next_fs = $(this).parent().parent().parent().parent().next();
        var field_set = current_fs[0];
        var fs_inputs = current_fs.find('input[type=text], input[type=email], input[type=password], select');
        var inputs = current_fs.find("input");
        var password = "";
        var confirm_password = "";

        function userEmailStatususerMail(userMail){
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: window.location.origin + '/register/userstatus',
                    type: 'GET',
                    data: { email: userMail, _token: $('meta[name="csrf-token"]').attr('content')},
                    success: function(response) {
                        if(response.status==true){
                            document.getElementById('emailvalidation').innerHTML = 'User already exists with this email';
                            setTimeout(function (){
                                $("#emailvalidation").fadeOut();
                            },2000);
                           
                            reject('User already exists');
                        } else {
                            resolve(response);
                        }
                    },
                    error: function(error) {
                        console.log(`Error ${error}`);
                        reject(error);
                    }
                });
            });
        }
        
        if(inputs[0].type == "email"){
            userMail=fs_inputs[0].value;
        //     calling ajax request to verify that if email exits or not.
            funccall=await userEmailStatususerMail(userMail).then(function (response){
                
            }).catch(function (error){
                status=false;
            });
           
        }

          
        
        for(var i = 0; i<inputs.length; i++){

          if(inputs[i].type == "password"){
              if(inputs[i].name =="password"){
                    password = inputs[i].value;
              }
              if(inputs[i].name =="password_confirmation"){
                  confirm_password = inputs[i].value;
              }
          }


            // if(inputs[i].type == "email"){
            //     if(inputs[i].name =="email"){
            //        var email = inputs[i].value;
            //
            //         // alert(email);
            //     if(email != ""){
            //         $.ajax({
            //            url:"https://skilledtalk.com/check-email"+"/"+email,
            //             method:"GET",
            //             success:function (data){
            //                if(data.ResponseCode == 0){
            //                    $("#alert-error").html("");
            //                    $("#alert-error").html(data.ResponseMessage);
            //                    $("#alert-error").show();
            //
            //                    setTimeout(function (){
            //                        $("#alert-error").fadeOut();
            //                    },1300);
            //
            //                }
            //             }
            //         });
            //     }
            //     }
            // }

        }




        if(password != "" && confirm_password !=""){
            if(password != confirm_password){
                // alert("password and password confirmation does not mathced !");
                $("#alert-error").html("");
                $("#alert-error").html("Both Passwords mismatch !");
                $("#alert-error").show();

                setTimeout(function (){
                    $("#alert-error").fadeOut();
                },1500);

                return;
            }
        }

        for (var z=0; z<fs_inputs.length; z++){
            if(fs_inputs[z].value == ""){

                $("#alert-error").html("");
                $("#alert-error").html("Please enter "+ fs_inputs[z].name);
                $("#alert-error").show();
                setTimeout(function (){
                    $("#alert-error").fadeOut();
                },1500);
                return;

            }
            // else{
            //     console.log('here')
            //     status = true;
            // }
        }
        // console.log(next_fs[0].id);
        if(status == true){
            next_fs.animate({
                width: [ "toggle", "swing" ],
                height: [ "toggle" ],
                opacity: "toggle"
              }, 1000, "easeInOutBack", function() {
               
              });
            // to show progress bar
            progress=progress+25;
            $('.progress-bar').width(progress + '%');
            $('.progress-bar').text(progress + '%');
        //show the next fieldset
        // next_fs.show();
        //hide the current fieldset with style
        /* current_fs.animate(
            {  },
            {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    debugger
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = now * 50 + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                     current_fs.css({
                        transform: "scale(" + scale + ")",
                        position: "absolute",
                        right: "0",
                        margin: "0 auto",
                        left: "0",
                    }); 
                    
                    next_fs.css({ left: left, opacity: opacity });
                },
                duration: 800,
                complete: function () {
                    // current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: "easeInOutBack",
            }
        );
 */
        }else{
            // console.log(status);
            // alert("Please Complete all steps to proceed.");
            $("#alert-error").html("");
            $("#alert-error").html("Please Complete all steps to proceed.");
            $("#alert-error").show();
            setTimeout(function (){
                $("#alert-error").fadeOut();
            },1300);
            return;
        }
    });


    $(".back_button").click(function () {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent().parent().parent().parent();
        next_fs = $(this).parent().parent().parent().parent().prev();

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = now * 50 + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({
                        transform: "scale(" + scale + ")",
                        position: "absolute",
                        right: "0",
                        margin: "0 auto",
                        left: "0",
                    });
                    next_fs.css({ left: left, opacity: opacity });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: "easeInOutBack",
            }
        );
    });
    $(".submit_button").click(function () {
        return false;
    });

    $('#input--employment').on('change',function(){
        console.log($('#input--employment').val());
    });
    $('#input--job').on('change',function(){
        console.log($('#input--job').val());
    })
    
    $("#input--job").select2({
        tags: true
    });
    $("#input--employment").select2({
        tags: true
    });
    $("#input--company").select2({
        tags: true
    });
});

$(document).on("submit","#signform",function (e) {
    // e.preventDefault();
    // $(".signup__content").hide();
    $(".loading-page1").show();

    // setTimeout(function () {
    //     e.currentTarget.submit();
    // },500)
});


$(window).on("load", function () {
    // makes sure the whole site is loaded
    $(".loading-section").fadeOut(); // will first fade out the loading animation
    $("#loading-page").delay(500).fadeOut("slow"); // will fade out the white DIV that covers the website.
    // $("body").delay(500).css({ overflow: "hidden" });
});

function _ajax(url, data, callback){
    return  $.ajax({
        url : url,
        data : data,
        processData: false, 
        contentType: false,
        type : "post",
        dataType: "json",
    }).done(function(resp){
        callback(resp);
    });
}