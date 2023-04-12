function toggleProfileGroupList(icon) {
    const list = icon.parentElement.nextElementSibling;
    const link = list.nextElementSibling;

    if (icon.className === "fas fa-angle-down") {
        icon.className = "fas fa-angle-up";
        list.style.display = "none";
        if (link) {
            link.style.display = "none";
        }
    } else {
        icon.className = "fas fa-angle-down";
        list.style.display = "block";
        if (link) {
            link.style.display = "block";
        }
    }
}

$(function () {
    // Multiple images preview in browser
    var imagesPreview = function (input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $($.parseHTML("<img>")).attr("src", event.target.result).appendTo(placeToInsertImagePreview);
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $("#gallery-photo-add").on("change", function () {
        imagesPreview(this, ".gallery_images");
    });
});

$('.photo_upload input[type="file"]').on('change', function() {
  Object.values(this.files).forEach(function(file) {
    console.log(`Type: ${file.type}`);
    if (file.type == 'application/pdf') {
      console.log('Huzzah!')
    }
  })
})
    

// window.addEventListener("scroll", (e) => {
//     const profileGroup = document.getElementById("profile-groups");
//     const linkedinSection = document.getElementById("job-section");
//     const rightAside = document.getElementById("right-aside");
//     const advertisementSection = document.getElementById("advertisement-section");

//     if (window.scrollY > 356) {
//         profileGroup.classList.add("position-fixed");
//         linkedinSection.classList.add("position-fixed", "right-aside-fixed");
//         advertisementSection.classList.add("position-fixed", "right-aside-ad-fixed");

//     } else {
//         profileGroup.classList.remove("position-fixed");
//         linkedinSection.classList.remove("position-fixed", "right-aside-fixed");
//         advertisementSection.classList.remove("position-fixed", "right-aside-ad-fixed");

//     }
// });

document.addEventListener("DOMContentLoaded", function () {
    const toggleChatboxBtn = document.querySelector(".js-chatbox-toggle .fa-chevron-up");
    const chatbox = document.querySelector(".js-chatbox");
    const chatboxMsgDisplay = document.querySelector(".js-chatbox-display");
    const chatboxForm = document.querySelector(".js-chatbox-form");

    const createChatBubble = (input) => {
        const chatSection = document.createElement("p");
        chatSection.textContent = input;
        chatSection.classList.add("chatbox__display-chat");

        chatboxMsgDisplay.appendChild(chatSection);
    };

    toggleChatboxBtn.addEventListener("click", () => {
        chatbox.classList.toggle("chatbox--is-visible");
    });

    chatboxForm.addEventListener("submit", (e) => {
        const chatInput = document.querySelector(".js-chatbox-input").value;

        createChatBubble(chatInput);

        e.preventDefault();
        chatboxForm.reset();
    });
});

$(document).ready(function () {
    $("#fileUpload").on("change", function () {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf(".") + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof FileReader != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            src: e.target.result,
                            class: "thumb-image",
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });
    $("#editexperience").on("change", function () {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf(".") + 1).toLowerCase();
        var image_holder = $("#editimageexperience");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof FileReader != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            src: e.target.result,
                            class: "thumb-image",
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });
    $("#addexperience").on("change", function () {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf(".") + 1).toLowerCase();
        var image_holder = $("#addimageexperience");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof FileReader != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            src: e.target.result,
                            class: "thumb-image",
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });

    $("#background_imageupload").on("change", function () {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf(".") + 1).toLowerCase();
        var image_holder = $("#background_image");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof FileReader != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            src: e.target.result,
                            class: "thumb-image",
                        }).appendTo(image_holder);
                    };
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });

    $(".close").on("click", function (e) {
        $(".modal").removeClass("is-visible");
    });

    $(".menu-item-has-children a").click(function () {
        if ($(this).next("ul").hasClass("visible")) {
            $(".sub-menu").removeClass("visible");
        } else {
            $(".sub-menu").removeClass("visible");
            $(this).next("ul").toggleClass("visible");
        }
    });

    $("body").click(function () {

        if ($(this).next("span").next("ul").hasClass("visible")) {
            $(".sub-menu").removeClass("visible");
        } 
    });

    $('#search').keyup( function(event){
        var keyword = $(event.target).val();
        if(keyword.length >=3) {
            $.ajax({
                method: "POST",
                url:  window.location.origin+"/search",
                data: {keyword: keyword,_token: $('meta[name="csrf-token"]').attr('content')}
            }).done(function(response){
                
                $('#results').empty();

                $('#results').append(
                    $('<header/>').append(
                        $('<a>').attr({
                            href: '#0',
                          }).append(
                             'See All'
                          )
                    )
                )

                if(response.user.length < 1){
                    $('#results').append(
                        'No Result found'
                    )
                    return;
                }
                response.user.forEach(function(user){
                    var profile;

                    if(user.profile_pic == null){
                        profile = window.location.origin+"/assets/img/profile.png";
                    }else{
                        profile = response.profileUrl+'/'+user.profile_pic;
                    }

                    $('#results').append(
                        $('<li/>', {'class': 'messages-lists searched-user', 'data-user': user.id}).append(
                            
                            $('<figure/>', {'class': 'image-container'}).append(
                                $('<img/>', {'class': 'img-size', 'src' : profile})
                            ),
                            $('<div/>', {'class': 'box-commented'}).append(
                                $('<div/>', {'class': 'commented-description'}).append(
                                    $('<strong/>', {'class': 'post_name'}).append(
                                        user.firstname+' '+user.lastname
                                    )
                                ),
                                $('<span/>', {'class': 'des2'}).append(
                                    user.current_position
                                )
                            )
                        )
                    )
                });

                    $(".sub-menu").removeClass("visible");
                    $(event.target).next("span").next("ul").toggleClass("visible");
            });
        }
    });

    $('#sendRequest').click(function(event){
        event.preventDefault();
        var id = $('#profile').attr('data-user');
        $(event.target).html('Request Sent');
        $(event.target).addClass('disabled');
    });

    $(document).on('click', '.searched-user', function(){
        var id = $(this).attr('data-user');
        window.location.href =   profile = window.location.origin+"/user/profile/"+id;
     });

    $("#label__photo").change(function () {
        $("#preview_image").show();
        var i = $(this).prev("label").clone();
        var file = $("#label__photo")[0].files[0].name;
        $(this).prev("label").text(file);
    });

    $("#label__video").change(function () {
        $("#video").show();
        var i = $(this).prev("label").clone();
        var file = $("#label__video")[0].files[0].name;
        $(this).prev("label").text(file);
    });

    const input = document.getElementById("label__video");
    const video = document.getElementById("video");
    const videoSource = document.createElement("source");

    input.addEventListener("change", function () {
        const files = this.files || [];

        if (!files.length) return;

        const reader = new FileReader();

        reader.onload = function (e) {
            videoSource.setAttribute("src", e.target.result);
            video.appendChild(videoSource);
            video.load();
            video.play();
        };

        reader.onprogress = function (e) {
            console.log("progress: ", Math.round((e.loaded * 100) / e.total));
        };

        reader.readAsDataURL(files[0]);
    });

    $(":input").inputmask();

    $("input[name$='paymentplan']").click(function () {
        var test = $(this).val();
        $(".payment-plans-charges").hide();
        $("#" + test).show();
    });

    $(".show_physical_box").hide();
    $("input[name$='optradioconsultanting']").click(function () {
        var consultant_value = $(this).val();
        $(".show_physical_box").hide();
        $("#" + consultant_value).show();
    });

    /* 1. Visualizing things on Hover - See next part for action on click */
    $("#stars li")
        .on("mouseover", function () {
            var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this)
                .parent()
                .children("li.star")
                .each(function (e) {
                    if (e < onStar) {
                        $(this).addClass("hover");
                    } else {
                        $(this).removeClass("hover");
                    }
                });
        })
        .on("mouseout", function () {
            $(this)
                .parent()
                .children("li.star")
                .each(function (e) {
                    $(this).removeClass("hover");
                });
        });

    /* 2. Action to perform on click */
    $("#stars li").on("click", function () {
        var onStar = parseInt($(this).data("value"), 10); // The star currently selected
        var stars = $(this).parent().children("li.star");

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass("selected");
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass("selected");
        }
    });



    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

    $(".myPdf").on("change", function(e){
        var file = e.target.files[0]
        if(file.type == "application/pdf"){
            var fileReader = new FileReader();  
            fileReader.onload = function() {
                var pdfData = new Uint8Array(this.result);
                // Using DocumentInitParameters object to load binary data.
                var loadingTask = pdfjsLib.getDocument({data: pdfData});
                loadingTask.promise.then(function(pdf) {
                  console.log('PDF loaded');
                  
                  // Fetch the first page
                  var pageNumber = 1;
                  pdf.getPage(pageNumber).then(function(page) {
                    console.log('Page loaded');
                    
                    var scale = 1.5;
                    var viewport = page.getViewport({scale: scale});

                    // Prepare canvas using PDF page dimensions
                    var canvas = $("#pdfViewer")[0];
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render PDF page into canvas context
                    var renderContext = {
                      canvasContext: context,
                      viewport: viewport
                    };
                    var renderTask = page.render(renderContext);
                    renderTask.promise.then(function () {
                      console.log('Page rendered');
                    });
                  });
                }, function (reason) {
                  // PDF loading error
                  console.error(reason);
                });
            };
            fileReader.readAsArrayBuffer(file);
        }
    });


});

$(window).on("load", function () {
    // makes sure the whole site is loaded
    $(".loading-section").fadeOut(); // will first fade out the loading animation
    $("#loading-page").delay(500).fadeOut("slow"); // will fade out the white DIV that covers the website.
    $("body").delay(500).css({ overflow: "visible" });
});



function displayMediaModal(img){
    $('#imageElement').attr('src', $(img).attr('src'));
    $('#mediaDisplayModal').modal('show');
}

$(document).ready(function () {

    // Press enter key on reflection field //
    $('.reflection').on('keypress', function(event){
        if(event.which == 13) {
            var postElement = event.target.closest('.post-article');
            var post = $(postElement).attr('data-post');
            if(event.target.value == '' || event.target.value == undefined){
                return;
            }
            $.ajax({
                method: "POST",
                url: window.location.origin+'/post/reflect',
                data: {reflection: event.target.value, post: post, _token: $('meta[name="csrf-token"]').attr('content')}
            }).done(function(response){
                if(response.ResponseCode == 1){
                    var commentElement = $(postElement).find('.reflection-list');
                    var imagePath;
                    if(response.user.profile_pic != null){
                        imagePath = response.profileUrl+'/'+response.user.profile_pic;
                    }else{
                        imagePath = window.location.origin+"/assets/img/profile.png";
                    }
                    commentElement.prepend(
                        $('<li/>').append(
                            $('<div/>', {'class' : 'operations-user'}).append(
                                $('<figure/>', {'class' : 'image-container'}).append(
                                    $('<img/>', {'class' : 'img-size', 'src' : imagePath})
                                ),
                                $('<div/>', {'class' : 'box-commented'}).append(
                                    $('<div/>', {'class' : 'commented-description'}).append(
                                        $('<strong/>', {'class' : 'post_name'}).append(response.user.firstname+' '+response.user.lastname),
                                        $('<span/>', {'class' : 'post_designation'}).append(
                                            $('<span/>').append('&nbsp; · &nbsp;'),
                                                '5Y Exp'
                                            )
                                    ),
                                    $('<span/>', {'class' : 'designation'}).append(response.user.current_position),
                                    $('<span/>', {'class' : 'comment-user'}).append(response.data.reflection)
                                )
                            ),
                            $('<div/>', {'class' : 'like-reply-part'}).append(
                                $('<span/>').append(
                                    'Like',
                                    $('<span/>').append('&nbsp; . &nbsp;'),
                                    'Reply'
                                ),
                               
                            )
                          
                        )
                    );
                    event.target.value = '';
                }
            });
        }
    });

    // click on rate button //
    $('.ratePost').on('click', function(event){

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');

        $.ajax({
            method: "POST",
            url: window.location.origin+'/post/rate',
            data: {stars: 1, post: post, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
            if(response.ResponseCode == 1){

                 $(postElement).find('.far').addClass('fa fa-clicked').removeClass('far');
                 $(postElement).find('.rateCounter').html('Rate ('+response.data.stars+')');
                 $(postElement).find('.'+response.data.stars).addClass('selected');
                 $(postElement).find('.star').attr('data-rate', response.data.id);

            }else if(response.ResponseCode == 2){

                 $(postElement).find('.fa-clicked').addClass('far').removeClass('fa fa-clicked');
                 $(postElement).find('.rateCounter').html('Rate (1)');
                 $(postElement).find('.selected').removeClass('selected');

            }else{
                 alert('Unable to place stars. Please try again later');
            }
        });
    });

    // click on rating  //
    $('.star').on('click', function(event){

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');

        var parentLi = $(event.target).parent();
        var stars = $(parentLi).attr('data-value');
        var starid = $(parentLi).attr('data-rate');
            $.ajax({
            method: "POST",
            url: window.location.origin+'/post/rate',
            data: {stars: stars, post: post, id: starid, updateStars: true, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
    
            if(response.ResponseCode == 1){

                 $(postElement).find('.far').addClass('fa fa-clicked').removeClass('far');
                 $(postElement).find('.rateCounter').html('Rate ('+response.totalRates+')');
                 $(postElement).find('.'+response.data.stars).addClass('selected');
                 $(postElement).find('.star').attr('data-rate', response.data.id);


            }else if(response.ResponseCode == 2){

                 $(postElement).find('.fa-clicked').addClass('far').removeClass('fa fa-clicked');
                 $(postElement).find('.selected').removeClass('selected');

            }else{
                 alert('Unable to place stars. Please try again later');
            }
        });
    });

    // Load more comments //
    $('.load-more').on('click', function(event){
        event.preventDefault();

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');
        var count = $(event.target).attr('data-value');
     
         $.ajax({
            method: "POST",
            url: window.location.origin+'/post/reflect/more',
            data: {post: post, count: count, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
            var commentElement = $(postElement).find('.reflection-list');
            if(count == 0 ){
                commentElement.empty();
            }
            if(response.data.length == 0){
                $(event.target).html('no more reflections');
            }
            response.data.forEach(function(e){
                var imagePath;
                if(e.user.profile_pic != null){
                    imagePath = response.profileUrl+'/'+e.user.profile_pic;
                }else{
                    imagePath = window.location.origin+"/assets/img/profile.png";
                }
                commentElement.append(
                    $('<li/>').append(
                        $('<div/>', {'class' : 'operations-user'}).append(
                            $('<figure/>', {'class' : 'image-container'}).append(
                                $('<img/>', {'class' : 'img-size', 'src' : imagePath})
                            ),
                            $('<div/>', {'class' : 'box-commented'}).append(
                                $('<div/>', {'class' : 'commented-description'}).append(
                                    $('<strong/>', {'class' : 'post_name'}).append(e.user.firstname+' '+e.user.lastname),
                                    $('<span/>', {'class' : 'post_designation'}).append(
                                        $('<span/>').append('&nbsp; · &nbsp;'),
                                            '5Y Exp'
                                        )
                                ),
                                $('<span/>', {'class' : 'designation'}).append(e.user.current_position),
                                $('<span/>', {'class' : 'comment-user'}).append(e.reflection)
                            )
                        ),
                        $('<div/>', {'class' : 'like-reply-part'}).append(
                            $('<span/>').append(
                                'Like',
                                $('<span/>').append('&nbsp; . &nbsp;'),
                                'Reply'
                            ),
                           
                        )
                      
                    )
                );
            });
            $(event.target).attr('data-value', response.nextCount);
        });
    });


    // click on image to show in modal ///
    $('.postMediaContent').on('click', function(event){

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');
        $('#mediaDisplayModal').find('.post-article').attr('data-post', post);
        $.ajax({
            method: "GET",
            url: window.location.origin+'/post/show/'+post,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
            console.log(response.post);

            // if post contains single image
            if(response.post.post_media.length == 1){

                // $('#imageElement').attr('src', $(event.target).attr('src'));
                $('#showPostContent').empty();

                $('#showPostContent').append(
                    $('<img/>', {'class' : 'img-fluid', 'id' : 'imageElement', 'src' : response.urlPost+'/'+response.post.post_media[0].name})
                );
                
                var imageSource;
                if(response.post.user.profile_pic == null){
                    imageSource = 'assets/img/profile.png';
                }else{
                    imageSource = response.urlProfile +'/' + response.post.user.profile_pic;
                }
                
                var author =  $('#mediaDisplayModal').find('.post-author-info > p');
                $('#mediaDisplayModal').find('.post-description > p').html(response.post.description);
                var authorPosition = $('#mediaDisplayModal').find('.post-author-info > small');
                var authorImage = $('#mediaDisplayModal').find('.postOwnerImage');
                var commentUl = $('#mediaDisplayModal').find('.reflection-list');
                $(commentUl).empty();
                $(authorImage).empty();
                $(authorImage).append(
                    $('<img/>', {'class' : 'img-size', 'src' : imageSource})
                );
                $(author).html(response.post.user.firstname+' '+response.post.user.lastname);
                $(authorPosition).html(response.post.user.current_position + '<br> '+response.post.dateForHumans);
                
                ///////////////////////// Intraction buttons ///////////////////// 

                //creating rate button
                var rateClass;
                if(response.post.rate.length == 1){
                    rateClass = 'fa fa-star fa-clicked';
                    
                    $('#mediaDisplayModal').find('.star').attr('data-rate', response.post.rate[0].id);

                    if(response.post.rate[0].stars >= 1){
                        $('#mediaDisplayModal').find('.1').addClass('selected');
                    }
                    if(response.post.rate[0].stars >= 2){
                        $('#mediaDisplayModal').find('.2').addClass('selected');
                    }
                    if(response.post.rate[0].stars >= 3){
                        $('#mediaDisplayModal').find('.3').addClass('selected');
                    }
                    if(response.post.rate[0].stars >= 4){
                        $('#mediaDisplayModal').find('.4').addClass('selected');
                    }
                    if(response.post.rate[0].stars == 5){
                        $('#mediaDisplayModal').find('.5').addClass('selected');
                    }

                }else{
                    rateClass = 'far fa-star';
                }

                var buttons = $('#mediaDisplayModal').find('.interactions-btns').children();

                    // rate button
                    $(buttons[0]).find('.counter > i').addClass(rateClass);
                    $(buttons[0]).find('.rateCounter').html('Rate ('+response.post.rate_count+')');
                    
                    // reflection button
                    $(buttons[1]).find('.reflectionCounter').html('Reflect ('+response.post.reflections_count+')');
            

                ///////////////////////// adding reflections /////////////////////////
                response.post.reflections.forEach(function(e){
                    $(commentUl).append(
                        $('<li/>').append(
                            $('<div/>', {'class' : 'operations-user'}).append(
                                $('<figure/>', {'class' : 'image-container'}).append(
                                    $('<img/>', {'class' : 'img-size', 'src' : response.urlProfile+'/'+e.user.profile_pic})
                                ),
                                $('<div/>', {'class' : 'box-commented'}).append(
                                    $('<div/>', {'class' : 'commented-description'}).append(
                                        $('<strong/>', {'class' : 'post_name'}).append(e.user.firstname+' '+e.user.lastname),
                                        $('<span/>', {'class' : 'post_designation'}).append(
                                            $('<span/>').append('&nbsp; · &nbsp;'),
                                                '5Y Exp'
                                            )
                                    ),
                                    $('<span/>', {'class' : 'designation'}).append(e.user.current_position),
                                    $('<span/>', {'class' : 'comment-user'}).append(e.reflection)
                                )
                            ),
                            $('<div/>', {'class' : 'like-reply-part'}).append(
                                $('<span/>').append(
                                    'Like',
                                    $('<span/>').append('&nbsp; . &nbsp;'),
                                    'Reply'
                                ),
                               
                            )
                          
                        )
                    );
                });

            }else{
                
                 $('#showPostContent').empty();
                    var count = 1;
                 response.post.post_media.forEach(function(e){
                    $('#showPostContent').append(
                        $('<div/>', {'class': 'mySlides'}).append(
                            $('<div/>', {'class' : 'numbertext'}).append(
                                count + '/' + response.post.post_media.length
                            ),
                            $('<img/>', {'style' : 'width: 100%', 'src' : response.urlPost+'/'+e.name})
                        )
                    );
                 });
                 
                 $('#showPostContent').append(
                    $('<a/>', {'class' : 'prev', 'onClick' : 'plusSlides(-1)'}).append(
                        '&#10094;'
                    ),
                    $('<a/>', {'class' : 'next', 'onClick' : 'plusSlides(1)'}).append(
                        '&#10095;'
                    )
                 )


                var imageSource;
                if(response.post.user.profile_pic == null){
                    imageSource = 'assets/img/profile.png';
                }else{
                    imageSource = response.urlProfile +'/' + response.post.user.profile_pic;
                }

                var author =  $('#mediaDisplayModal').find('.post-author-info > p');
                $('#mediaDisplayModal').find('.post-description > p').html(response.post.description);
                var authorPosition = $('#mediaDisplayModal').find('.post-author-info > small');
                var authorImage = $('#mediaDisplayModal').find('.postOwnerImage');
                var commentUl = $('#mediaDisplayModal').find('.reflection-list');
                $(commentUl).empty();
                $(authorImage).empty();
                $(authorImage).append(
                    $('<img/>', {'class' : 'img-size', 'src' : imageSource})
                );
                $(author).html(response.post.user.firstname+' '+response.post.user.lastname);
                $(authorPosition).html(response.post.user.current_position + '<br> '+response.post.dateForHumans);
                
                ///////////////////////// Intraction buttons ///////////////////// 

                //creating rate button
                var rateClass;
                if(response.post.rate.length == 1){
                    rateClass = 'fa fa-star fa-clicked';
                    
                    $('#mediaDisplayModal').find('.star').attr('data-rate', response.post.rate[0].id);

                    if(response.post.rate[0].stars >= 1){
                        $('#mediaDisplayModal').find('.1').addClass('selected');
                    }
                    if(response.post.rate[0].stars >= 2){
                        $('#mediaDisplayModal').find('.2').addClass('selected');
                    }
                    if(response.post.rate[0].stars >= 3){
                        $('#mediaDisplayModal').find('.3').addClass('selected');
                    }
                    if(response.post.rate[0].stars >= 4){
                        $('#mediaDisplayModal').find('.4').addClass('selected');
                    }
                    if(response.post.rate[0].stars == 5){
                        $('#mediaDisplayModal').find('.5').addClass('selected');
                    }

                }else{
                    rateClass = 'far fa-star';
                }

                var buttons = $('#mediaDisplayModal').find('.interactions-btns').children();

                    // rate button
                    $(buttons[0]).find('.counter > i').addClass(rateClass);
                    $(buttons[0]).find('.rateCounter').html('Rate ('+response.post.rate_count+')');
                    
                    // reflection button
                    $(buttons[1]).find('.reflectionCounter').html('Reflect ('+response.post.reflections_count+')');
            

                ///////////////////////// adding reflections /////////////////////////
                response.post.reflections.forEach(function(e){
                    $(commentUl).append(
                        $('<li/>').append(
                            $('<div/>', {'class' : 'operations-user'}).append(
                                $('<figure/>', {'class' : 'image-container'}).append(
                                    $('<img/>', {'class' : 'img-size', 'src' : response.urlProfile+'/'+e.user.profile_pic})
                                ),
                                $('<div/>', {'class' : 'box-commented'}).append(
                                    $('<div/>', {'class' : 'commented-description'}).append(
                                        $('<strong/>', {'class' : 'post_name'}).append(e.user.firstname+' '+e.user.lastname),
                                        $('<span/>', {'class' : 'post_designation'}).append(
                                            $('<span/>').append('&nbsp; · &nbsp;'),
                                                '5Y Exp'
                                            )
                                    ),
                                    $('<span/>', {'class' : 'designation'}).append(e.user.current_position),
                                    $('<span/>', {'class' : 'comment-user'}).append(e.reflection)
                                )
                            ),
                            $('<div/>', {'class' : 'like-reply-part'}).append(
                                $('<span/>').append(
                                    'Like',
                                    $('<span/>').append('&nbsp; . &nbsp;'),
                                    'Reply'
                                ),
                               
                            )
                          
                        )
                    );
                });

                
                currentSlide(1)
            }
            
            $('#mediaDisplayModal').modal('show');

        });
    });

    $(".repost-button").on('click', function(event){
        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');
        $('#repost_post').val(post);
        $('#repost').modal('show');
    });

    $(document).on('click', '#join', function(event){
        var id = $('#join').attr('data-group');

        $.ajax({
            method: "POST",
            url: window.location.origin+'/group/join',
            data: {group_id: id, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
        
            if(response == 1){
                $(event.target).val('Leave Group');
                $(event.target).removeClass('btn-success');
                $(event.target).addClass('btn-danger');
                $(event.target).attr("id","leave");
            }
            
        });
    });

    $(document).on('click', '#leave', function(event){
        var id = $('#leave').attr('data-group');
    
        $.ajax({
            method: "POST",
            url: window.location.origin+'/group/leave',
            data: {group_id: id, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
        
            if(response == 1){
                $(event.target).val('Join Group');
                $(event.target).removeClass('btn-danger');
                $(event.target).addClass('btn-success');
                $(event.target).attr("id","join");
            }
            
        });
    });

    $('#quickSubmitJob').on('click', function(event){
        event.preventDefault();
        var jobId = $(event.target).attr('data-job');
        $.ajax({
            method: "POST",
            url: window.location.origin+'/job/apply',
            data: {job_id: jobId, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
        
            if(response == 1){
                $(event.target).html('Applied');
                $(event.target).addClass('disabled');
            }
            
        });
    });

    $('#repost-post').on('click', function(event){
        event.preventDefault();
        var post =  $('#repost_post').val();
        var description = $('#repost_description').val();
        var post_type = 'Shared';
        var privacy   = $('#repostPostPrivacy').val();

        $.ajax({
            method: "POST",
            url: window.location.origin+'/post/repost',
            data: {description: description, post_type: post_type, privacy: privacy, post_id: post, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function(response){
           console.log(response);
        });
    });
});

// image slider in show posts modal 

function openModal() {
    document.getElementById("myModal").style.display = "block";
  }
  
  var slideIndex = 1;
  showSlides(slideIndex);
  
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }
  
  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");

    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    
    slides[slideIndex-1].style.display = "block";
  
  }


   