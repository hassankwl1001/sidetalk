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

//Delete Button


$(document).on('click','.delbtn',function (e) {

    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#057642',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            // Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            // )
            window.location.href = link;
        }else{
            return
        }
    })
});




//Copy Link


$(document).on("click",".copyLink",function () {
    var link = $(this).attr("link")

    navigator.clipboard.writeText(link).then(function () {
        toastr["success"]("Link Copied Successfully ! ");
    }, function () {
        alert('Failure to copy. Check permissions for clipboard')
    });
});



//Report Post

$(document).on("click",".reportPost",function () {

    var post_id = $(this).attr("data-post");

    $.ajax({
        method: "POST",
        url: window.location.origin + "/post/report",
        data: {post_id: post_id, _token: $('meta[name="csrf-token"]').attr('content')}
    }).done(function (response) {
        console.log(response);
        toastr["success"]("Post Reported Successfully !");
    });

});



$(function () {

    var files = "";

    // Multiple images preview in browser
    var imagesPreview = function (input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            $(".gallery_images").html("");
            files = input.files;
            // var newFileList = Array.from(input.files);

            // var files = Array.from(input.files);

            // for (i = 0; i < filesAmount; i++) {
            //     var reader = new FileReader();
            //     reader.onload = function (event) {
            //         $($.parseHTML("<img>")).attr({"src":event.target.result, "class":"img-to-upload"}).appendTo(placeToInsertImagePreview);
            //     };
            //     reader.readAsDataURL(input.files[i]);
            // }
            $(".file_inputs_div").html("");
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                var file_name = input.files[i].name;
                reader.file_name = file_name;

                // $(".file_inputs_div").append('<input class="files_input" type="hidden" name="files_input[]" value="'+file_name+'">');

                reader.onload = function (event) {

                    // console.log(event);

                    $("<span class=\"pip\">" +
                        "<img class=\"img-to-upload\" src=\"" + event.target.result + "\" title=\"" + '' + "\"/>" +
                        "<br/><span image="+event.target.result+" img-name="+event.target.file_name+" class=\"remove\">Remove image</span>" +
                        "</span>").appendTo(placeToInsertImagePreview);
                    $(".remove").click(function () {

                        $(this).parent(".pip").remove();
                        var file_to_delete = $(this).attr("img-name");
                        var index = file_to_delete;
                        // alert(file_to_delete);
                        var input_element =  $('input[value="'+file_to_delete+'"]');

                        var dt = new DataTransfer()
                        var input2 = document.getElementById('gallery-photo-add')
                        var { files } = input2

                        for (let j = 0; j < files.length; j++) {
                            if(file_to_delete != files[j].name){
                                dt.items.add(files[j])
                            }
                        }

                          input2.files = dt.files // Assign the updates list

                    });
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };





    $("#gallery-photo-add").on("change", function () {
        imagesPreview(this, ".gallery_images");
        // console.log(files);
    });


    // $(document).on("click",".img-to-upload",function (){
    //     alert($(this).attr("src"));
    // });




});

$('.photo_upload input[type="file"]').on('change', function () {
    Object.values(this.files).forEach(function (file) {
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
                        $('#background_profile_pic_delete').css('display','block');
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

    $(".vertical-icons").click(function () {
        if ($(this).find(".notifications-signs").hasClass("is-visible")) {
            $(".notifications-signs").removeClass("is-visible");
        } else {
            $(".notifications-signs").removeClass("is-visible");
            $(this).find(".notifications-signs").toggleClass("is-visible");
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
                        $('#background_image_delete').css('display','block');
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
    $("#background_image_delete").on("click", function () {
        $('#background_image_delete').css('display','none');
        $("#background_image").empty();
        $("#background_imageupload").empty();
        document.getElementById("background_imageupload").value=null;
    });
    $("#background_profile_pic_delete").on("click", function () {
        $('#background_profile_pic_delete').css('display','none');
        $("#image-holder").empty();
        $("#fileUpload").empty();
        document.getElementById("fileUpload").value=null;
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

    $('#search').keyup(function (event) {
        var keyword = $(event.target).val();
        if (keyword.length >= 3) {
            $.ajax({
                method: "POST",
                url: window.location.origin + "/search",
                data: {keyword: keyword, _token: $('meta[name="csrf-token"]').attr('content')}
            }).done(function (response) {

                $('#results').empty();
                if (response.user.length > 0) {
                    $('#results').append(
                        $('<li/>').append(
                            $('<b/>').append(
                                'Users'
                            )
                        )
                    )
                    response.user.forEach(function (user) {
                        var profile;
                        console.log(user)
                        if (user.profile_pic == null) {
                            profile = window.location.origin + "/public/assets/img/profile.png";
                        } else {
                            profile = response.profileUrl + '/' + user.profile_pic;
                        }

                        $('#results').append(
                            $('<li/>', {'class': 'messages-lists searched-user', 'data-user': user.id,'style':'cursor:pointer;'}).append(
                                $('<figure/>', {'class': 'image-container'}).append(
                                    $('<img/>', {'class': 'img-size', 'src': profile})
                                ),
                                $('<div/>', {'class': 'box-commented'}).append(
                                    $('<div/>', {'class': 'commented-description'}).append(
                                        $('<strong/>', {'class': 'post_name'}).append(
                                            user.firstname + ' ' + user.lastname
                                        )
                                    ),
                                    $('<span/>', {'class': 'des2'}).append(
                                        user.current_position
                                    )
                                )
                            )
                        )
                    });
                }
                if (response.pages.length > 0) {

                    $('#results').append(
                        $('<li/>').append(
                            $('<b/>').append(
                                'Pages'
                            )
                        )
                    )

                    response.pages.forEach(function (page) {
                        var logo;
                        console.log(page)

                        if (page.logo == null) {
                            logo = window.location.origin + "/public/assets/img/profile.png";
                        } else {
                            logo = response.pageUrl + '/' + page.logo;
                        }

                        $('#results').append(
                            $('<li/>', {'class': 'messages-lists searched-page', 'data-page': page.id,'style':'cursor:pointer;'}).append(
                                $('<figure/>', {'class': 'image-container'}).append(
                                    $('<img/>', {'class': 'img-size', 'src': logo})
                                ),
                                $('<div/>', {'class': 'box-commented'}).append(
                                    $('<div/>', {'class': 'commented-description'}).append(
                                        $('<strong/>', {'class': 'post_name'}).append(
                                            page.name
                                        )
                                    ),
                                    // $('<span/>', {'class': 'des2'}).append(
                                    //     user.current_position
                                    // )
                                )
                            )
                        )
                    });
                }
                if (response.groups.length > 0) {

                    $('#results').append(
                        $('<li/>').append(
                            $('<b/>').append(
                                'Groups'
                            )
                        )
                    )

                    response.groups.forEach(function (group) {
                        var logo;
                        if (group.profile_pic == null) {
                            logo = window.location.origin + "/public/assets/img/profile.png";
                        } else {
                            logo = response.pageUrl + '/' + group.profile_pic;
                        }

                        $('#results').append(
                            $('<li/>', {'class': 'messages-lists searched-group', 'data-group': group.id,'style':'cursor:pointer;'}).append(
                                $('<figure/>', {'class': 'image-container'}).append(
                                    $('<img/>', {'class': 'img-size', 'src': logo})
                                ),
                                $('<div/>', {'class': 'box-commented'}).append(
                                    $('<div/>', {'class': 'commented-description'}).append(
                                        $('<strong/>', {'class': 'post_name'}).append(
                                            group.name
                                        )
                                    ),
                                    // $('<span/>', {'class': 'des2'}).append(
                                    //     user.current_position
                                    // )
                                )
                            )
                        )
                    });
                }

                $(".sub-menu").removeClass("visible");
                $(event.target).next("span").next("ul").toggleClass("visible");
            });
        }
    });

    $('#skills_input_field').keyup(function (event) {
        var keyword = $(event.target).val();
        if (keyword.length >= 3) {
            $.ajax({
                method: "POST",
                url: window.location.origin + "/search/skills",
                data: {keyword: keyword, _token: $('meta[name="csrf-token"]').attr('content')}
            }).done(function (response) {
                $('#skills_search_result').empty();
                response.forEach(function (e) {
                    $('#skills_search_result').append(
                        $('<li/>').append(
                            $('<a>').attr({
                                href: '#0',
                                class: 'skill_tag'
                            }).append(
                                e.name
                            )
                        )
                    )
                })
            });
        }
    });
    $('.discover_posts1').on('click',function (event) {
           event.preventDefault();

           var discover=$('#discover').val();
           var filter_type=$('input[name="filter_type"]:checked').val();
           window.location.href=window.location.origin + "/discover?discover="+discover+'&filter_type='+filter_type
    });  $('.discover_posts').on('click',function (event) {


           var discover=$('#discover').val();
           var filter_type=$('input[name="filter_type"]:checked').val();
           window.location.href=window.location.origin + "/discover?discover="+discover+'&filter_type='+filter_type
    });

    $(document).on('click', '.skill_tag', function (event) {
        event.preventDefault();
        var skill = $(event.target).html();

            $.ajax({
                method: "POST",
                url: window.location.origin + "/user/addSkill",
                data: {skill: skill, _token: $('meta[name="csrf-token"]').attr('content')}
            }).done(function (response) {
                $('#skills_search_result').empty();
                $('#skills_input_field').empty();
                toastr["success"]("New skill added successfully");
                $('#skills_search_result').empty();
                $('#skills_input_field').empty();
                var skillButton = '<a class="btn btn-secondary btn-xs d-inline removeSkill " href="javascript:;" skill_id="'+response+'">'+skill+'&nbsp; <i class="fas fa-times"></i></a>'
                $("#mySkills").append(skillButton);
            });

    });

    var addedSkillId = "";

    $('#addNewSkillButton').on('click', function (event) {
        var skill = $('#skills_input_field').val();
        $('#skills_input_field').val("");

            $.ajax({
                method: "POST",
                url: window.location.origin + "/user/addSkill",
                data: {skill: skill, _token: $('meta[name="csrf-token"]').attr('content')}
            }).done(function (response) {
                $('#skills_search_result').empty();
                $('#skills_input_field').empty();
                toastr["success"]("New skill added successfully");

                var skillButton = '<a class="btn btn-secondary btn-xs d-inline removeSkill " href="javascript:;" skill_id="'+response+'">'+skill+'&nbsp; <i class="fas fa-times"></i></a>'
                $("#mySkills").append(skillButton);
            });
    });


    function saveSkill(skill) {
        $.ajax({
            method: "POST",
            url: window.location.origin + "/user/addSkill",
            data: {skill: skill, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            $('#skills_search_result').empty();
            $('#skills_input_field').empty();
            toastr["success"]("New skill added successfully");
        });
    }

    $(document).on('click', '#sendRequest', function (event) {
        event.preventDefault();
        var id = $('#profile').attr('data-user');
        $.ajax({
            method: "POST",
            url: window.location.origin + '/sendRequest',
            data: {user_id: id, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            console.log(response);
        });

        $(event.target).html('Request Sent');
        $(event.target).addClass('disabled');
    });


    $(document).on('click',".removeSkill",function () {
        // console.log($(this));
        var skill_id = $(this).attr("skill_id");
        $(this).remove();

        $.ajax({
            method: "POST",
            url: window.location.origin + "/user/removeSkill",
            data: {skill: skill_id, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            // $('#skills_search_result').empty();
            // $('#skills_input_field').empty();
            toastr["success"]("skill removed successfully");
        });
    });





    $('#Unfriend').click(function (event) {
        event.preventDefault();
        var id = $('#profile').attr('data-user');
        $.ajax({
            method: "POST",
            url: window.location.origin + '/friend/unfriend',
            data: {user_id: id, _token: $('meta[name="csrf-token"]').attr('content')}

        }).done(function (response) {
            if (response) {
                $(event.target).html('Send Request <i class="fas fa-user-friends" aria-hidden="true"></i>');
                $(event.target).attr('id', 'sendRequest');

                toastr["success"]("You have successfully unfriend");
            }

        });
    });

    $(document).on('click', '.searched-user', function () {
        var id = $(this).attr('data-user');
        window.location.href = profile = window.location.origin + "/user/profile/" + id;
    });
    $(document).on('click', '.searched-page', function () {
        var id = $(this).attr('data-page');
        window.location.href = window.location.origin + "/page/detail/" + id;
    });
    $(document).on('click', '.searched-group', function () {
        var id = $(this).attr('data-group');
        window.location.href = window.location.origin + "/group/detail/" + id;
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

        $(input).parent().append('<a href="javascript:void(0);" class="btn btn-outline-secondary btn-block removeVideo">Remove video</a>');


    });

    $(document).on("click",".removeVideo",function () {
       $("#label__video").val(null);
       $("#video").html("");
       $("#video").hide();
        $("#label__video").parent().find('label').html("Select video to share");
       $(this).hide();
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

    $(".myPdf").on("change", function (e) {
        var file = e.target.files[0]
        if (file.type == "application/pdf") {
            var fileReader = new FileReader();
            fileReader.onload = function () {
                var pdfData = new Uint8Array(this.result);
                // Using DocumentInitParameters object to load binary data.
                var loadingTask = pdfjsLib.getDocument({data: pdfData});
                loadingTask.promise.then(function (pdf) {
                    console.log('PDF loaded');

                    // Fetch the first page
                    var pageNumber = 1;
                    pdf.getPage(pageNumber).then(function (page) {
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
    $("body").delay(500).css({overflow: "visible"});

});


function displayMediaModal(img) {
    $('#imageElement').attr('src', $(img).attr('src'));
    $('#mediaDisplayModal').modal('show');
}

$(document).ready(function () {

    // Press enter key on reflection field //
    $('.reflection').on('keypress', function (event) {

        if (event.which == 13) {
            reflection = event.target.value;
            commentField = this;
            submitComment(this, reflection, commentField);
        }
    });

    $('.submit-reflection').on('click', function (event) {
            reflection = $(this).parent().find('.reflection').val();
            commentField = $(this).parent().find('.reflection');
            submitComment(this, reflection, commentField);
    });

    function submitComment(elementClicked, reflection, commentField){
        var postElement = $(elementClicked).closest('.post-article');
        var reflectionlist = $(postElement).find('.reflection-list');
        var post = $(postElement).attr('data-post');
        if (reflection == '' || reflection == undefined) {
            return;
        }
        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/reflect',
            data: {reflection: reflection, post: post, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {

            // console.log(response)
            $(commentField).val('');
            var profile_pic = "";
            if (response.user.profile_pic != null) {
                profile_pic = response.profileUrl + '/' + response.user.profile_pic
            } else {
                profile_pic = 'https://skilledtalk.com/public/assets/img/profile.png';
            }
            reflectionlist.prepend(
                $('<li/>').append(
                    $('<div/>', {'class': 'operations-user'}).append(
                        $('<figure/>', {'class': 'image-container'}).append(
                            $('<img/>', {src: profile_pic, 'class': 'img-size'})
                        ),
                        $('<div/>', {'class': 'box-commented'}).append(
                            $('<div/>', {'class': 'commented-description'}).append(
                                $('<strong/>', {'class': 'post_name'}).append(
                                    response.user.firstname + ' ' + response.user.lastname + '<span>&nbsp;·&nbsp;</span>'
                                ),
                                $('<span/>', {'class': 'post_designation'}).append(

                                    response.user.experience > 0 ?(
                                    $('<span/>').append('.'),
                                    response.user.experience + 'Y Exp'
                                        )
                                    : ""
                                )
                            ),
                            $('<span/>', {'class': 'designation'}).append(
                                response.user.current_position
                            ),
                            $('<span/>', {'class': 'comment-user'}).append(
                                response.data.reflection
                            )
                        )
                    )
                    ,'<div class="edit-del-part">\n' +
                    '<span><a href="javascript:;" onclick="return editComment(this)" data-comment-id="'+response.data.id+'" class="edit-comment">Edit</a><span>&nbsp;·&nbsp;</span><a href="javascript:;" onclick="return deleteComment(this)"  class="delete-comment"  data-comment-id="'+response.data.id+'">Delete</a> </span>\n' +
                    '</div>'
                )
            )

        });
    }

    // click on rate button //
    $('.ratePost').on('click', function (event) {

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');

        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/rate',
            data: {stars: 1, post: post, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            if (response.ResponseCode == 1) {

                $(postElement).find('.far').addClass('fa fa-clicked').removeClass('far');
                $(postElement).find('.rateCounter').html('Rate [' + response.data.stars + ']');
                $(postElement).find('.' + response.data.stars).addClass('selected');
                $(postElement).find('.star').attr('data-rate', response.data.id);

            } else if (response.ResponseCode == 2) {

                $(postElement).find('.fa-clicked').addClass('far').removeClass('fa fa-clicked');
                $(postElement).find('.rateCounter').html('Rate [1]');
                $(postElement).find('.selected').removeClass('selected');

            } else {
                alert('Unable to place stars. Please try again later');
            }
        });
    });

    // click on rating  //
    $('.star').on('click', function (event) {

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');

        var parentLi = $(event.target).parent();
        var stars = $(parentLi).attr('data-value');
        var starid = $(parentLi).attr('data-rate');
        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/rate',
            data: {
                stars: stars,
                post: post,
                id: starid,
                updateStars: true,
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (response) {

            if (response.ResponseCode == 1) {

                $(postElement).find('.far').addClass('fa fa-clicked').removeClass('far');
                $(postElement).find('.rateCounter').html('Rate [' + response.totalRates + ']');
                $(postElement).find('.' + response.data.stars).addClass('selected');
                $(postElement).find('.star').attr('data-rate', response.data.id);


            } else if (response.ResponseCode == 2) {

                $(postElement).find('.fa-clicked').addClass('far').removeClass('fa fa-clicked');
                $(postElement).find('.selected').removeClass('selected');

            } else {
                alert('Unable to place stars. Please try again later');
            }
        });
    });

    // Load more comments //
    $('.load-more').on('click', function (event) {
        event.preventDefault();

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');
        var count = $(event.target).attr('data-value');

        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/reflect/more',
            data: {post: post, count: count, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            var commentElement = $(postElement).find('.reflection-list');
            if (count == 0) {
                commentElement.empty();
            }
            if (response.data.length == 0) {
                $(event.target).html('no more reflections');
            }
            response.data.forEach(function (e) {
                var imagePath = "";
                if (e.user.profile_pic != null) {
                    imagePath = response.profileUrl + '/' + e.user.profile_pic;
                } else {
                    imagePath = window.location.origin + "/public/assets/img/profile.png";
                }
                commentElement.append(
                    $('<li/>').append(
                        $('<div/>', {'class': 'operations-user'}).append(
                            $('<figure/>', {'class': 'image-container'}).append(
                                $('<img/>', {'class': 'img-size', 'src': imagePath})
                            ),
                            $('<div/>', {'class': 'box-commented'}).append(
                                $('<div/>', {'class': 'commented-description'}).append(
                                    $('<strong/>', {'class': 'post_name'}).append(e.user.firstname + ' ' + e.user.lastname),
                                    $('<span/>', {'class': 'post_designation'}).append(

                                        e.user.experience > 0 ? (
                                        $('<span/>').append('&nbsp; · &nbsp;'),
                                        '5Y Exp'
                                        ) : ""

                                    )
                                ),
                                $('<span/>', {'class': 'designation'}).append(e.user.current_position),
                                $('<span/>', {'class': 'comment-user'}).append(e.reflection)
                            )
                        ),
                        $('<div/>', {'class': 'like-reply-part'}).append(
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
    $('.postMediaContent').on('click', function (event) {

        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');
        $('#mediaDisplayModal').find('.post-article').attr('data-post', post);
        $.ajax({
            method: "GET",
            url: window.location.origin + '/post/show/' + post,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            console.log(response.post);

            // if post contains single image
            if (response.post.post_media.length == 1) {

                // $('#imageElement').attr('src', $(event.target).attr('src'));
                $('#showPostContent').empty();

                $('#showPostContent').append(
                    $('<img/>', {
                        'class': 'img-fluid',
                        'id': 'imageElement',
                        'src': response.urlPost + response.post.post_media[0].name
                    })
                );

                var imageSource = "";
                if (response.post.user.profile_pic == null) {
                    // imageSource = 'assets/img/profile.png';
                    imageSource = "public/assets/img/profile.png";
                } else {
                    imageSource = response.urlProfile + '/' + response.post.user.profile_pic;
                }

                var author = $('#mediaDisplayModal').find('.post-author-info > p');
                $('#mediaDisplayModal').find('.post-description > p').html(response.post.description);
                var authorPosition = $('#mediaDisplayModal').find('.post-author-info > small');
                var authorImage = $('#mediaDisplayModal').find('.postOwnerImage');
                var commentUl = $('#mediaDisplayModal').find('.reflection-list');
                $(commentUl).empty();
                $(authorImage).empty();
                $(authorImage).append(
                    $('<img/>', {'class': 'img-size', 'src': imageSource})
                );
                $(author).html(response.post.user.firstname + ' ' + response.post.user.lastname);
                $(authorPosition).html(response.post.user.current_position + '<br> ' + response.post.dateForHumans);

                ///////////////////////// Intraction buttons /////////////////////

                //creating rate button
                var rateClass;
                if (response.post.rate.length == 1) {
                    rateClass = 'fa fa-star fa-clicked';

                    $('#mediaDisplayModal').find('.star').attr('data-rate', response.post.rate[0].id);

                    if (response.post.rate[0].stars >= 1) {
                        $('#mediaDisplayModal').find('.1').addClass('selected');
                    }
                    if (response.post.rate[0].stars >= 2) {
                        $('#mediaDisplayModal').find('.2').addClass('selected');
                    }
                    if (response.post.rate[0].stars >= 3) {
                        $('#mediaDisplayModal').find('.3').addClass('selected');
                    }
                    if (response.post.rate[0].stars >= 4) {
                        $('#mediaDisplayModal').find('.4').addClass('selected');
                    }
                    if (response.post.rate[0].stars == 5) {
                        $('#mediaDisplayModal').find('.5').addClass('selected');
                    }

                } else {
                    rateClass = 'far fa-star';
                }

                var buttons = $('#mediaDisplayModal').find('.interactions-btns').children();

                // rate button
                $(buttons[0]).find('.counter > i').addClass(rateClass);
                $(buttons[0]).find('.rateCounter').html('Rate (' + response.post.rate_count + ')');

                // reflection button
                $(buttons[1]).find('.reflectionCounter').html('Reflect (' + response.post.reflections_count + ')');


                ///////////////////////// adding reflections /////////////////////////
                response.post.reflections.forEach(function (e) {
                    $(commentUl).append(
                        $('<li/>').append(
                            $('<div/>', {'class': 'operations-user'}).append(
                                $('<figure/>', {'class': 'image-container'}).append(
                                    $('<img/>', {
                                        'class': 'img-size',
                                        'src': (e.user.profile_pic != null ?  response.urlProfile + '/' + e.user.profile_pic : '/public/assets/img/profile.png')
                                    })
                                ),
                                $('<div/>', {'class': 'box-commented'}).append(
                                    $('<div/>', {'class': 'commented-description'}).append(
                                        $('<strong/>', {'class': 'post_name'}).append(e.user.firstname + ' ' + e.user.lastname),
                                        $('<span/>', {'class': 'post_designation'}).append(

                                            e.user.experience > 0 ? (
                                            $('<span/>').append('&nbsp; · &nbsp;'),
                                            '5Y Exp'
                                            ) : ""
                                        )
                                    ),
                                    $('<span/>', {'class': 'designation'}).append(e.user.current_position),
                                    $('<span/>', {'class': 'comment-user'}).append(e.reflection)
                                )
                            ),
                            '<div class="edit-del-part">\n' +
                            '<span><a href="javascript:;" onclick="return editComment(this)" data-comment-id="'+e.reflection.id+'" class="edit-comment">Edit</a><span>&nbsp;·&nbsp;</span><a href="javascript:;" onclick="return deleteComment(this)"  class="delete-comment"  data-comment-id="'+e.reflection.id+'">Delete</a> </span>\n' +
                            '</div>'
                        )
                    );
                });

            } else {

                $('#showPostContent').empty();
                var count = 1;
                response.post.post_media.forEach(function (e) {
                    $('#showPostContent').append(
                        $('<div/>', {'class': 'mySlides'}).append(
                            $('<div/>', {'class': 'numbertext'}).append(
                                count + '/' + response.post.post_media.length
                            ),
                            $('<img/>', {'style': 'width: 100%; height:100%;', 'src': response.urlPost + e.name})
                        )
                    );
                });

                $('#showPostContent').append(
                    $('<a/>', {'class': 'prev', 'onClick': 'plusSlides(-1)'}).append(
                        '&#10094;'
                    ),
                    $('<a/>', {'class': 'next', 'onClick': 'plusSlides(1)'}).append(
                        '&#10095;'
                    )
                )


                var imageSource;
                if (response.post.user.profile_pic == null) {
                    imageSource = 'public/assets/img/profile.png';
                    // imageSource = 'public/assets/img/profile.png';
                } else {
                    imageSource = response.urlProfile + '/' + response.post.user.profile_pic;
                }

                var author = $('#mediaDisplayModal').find('.post-author-info > p');
                $('#mediaDisplayModal').find('.post-description > p').html(response.post.description);
                var authorPosition = $('#mediaDisplayModal').find('.post-author-info > small');
                var authorImage = $('#mediaDisplayModal').find('.postOwnerImage');
                var commentUl = $('#mediaDisplayModal').find('.reflection-list');
                $(commentUl).empty();
                $(authorImage).empty();
                $(authorImage).append(
                    $('<img/>', {'class': 'img-size', 'src': imageSource})
                );
                $(author).html(response.post.user.firstname + ' ' + response.post.user.lastname);
                $(authorPosition).html(response.post.user.current_position + '<br> ' + response.post.dateForHumans);

                ///////////////////////// Intraction buttons /////////////////////

                //creating rate button
                var rateClass;
                if (response.post.rate.length == 1) {
                    rateClass = 'fa fa-star fa-clicked';

                    $('#mediaDisplayModal').find('.star').attr('data-rate', response.post.rate[0].id);

                    if (response.post.rate[0].stars >= 1) {
                        $('#mediaDisplayModal').find('.1').addClass('selected');
                    }
                    if (response.post.rate[0].stars >= 2) {
                        $('#mediaDisplayModal').find('.2').addClass('selected');
                    }
                    if (response.post.rate[0].stars >= 3) {
                        $('#mediaDisplayModal').find('.3').addClass('selected');
                    }
                    if (response.post.rate[0].stars >= 4) {
                        $('#mediaDisplayModal').find('.4').addClass('selected');
                    }
                    if (response.post.rate[0].stars == 5) {
                        $('#mediaDisplayModal').find('.5').addClass('selected');
                    }

                } else {
                    rateClass = 'far fa-star';
                }

                var buttons = $('#mediaDisplayModal').find('.interactions-btns').children();

                // rate button
                $(buttons[0]).find('.counter > i').addClass(rateClass);
                $(buttons[0]).find('.rateCounter').html('Rate (' + response.post.rate_count + ')');

                // reflection button
                $(buttons[1]).find('.reflectionCounter').html('Reflect (' + response.post.reflections_count + ')');


                ///////////////////////// adding reflections /////////////////////////
                response.post.reflections.forEach(function (e) {
                    $(commentUl).append(
                        $('<li/>').append(
                            $('<div/>', {'class': 'operations-user'}).append(
                                $('<figure/>', {'class': 'image-container'}).append(
                                    $('<img/>', {
                                        'class': 'img-size',
                                        'src': response.urlProfile + '/' + e.user.profile_pic
                                    })
                                ),
                                $('<div/>', {'class': 'box-commented'}).append(
                                    $('<div/>', {'class': 'commented-description'}).append(
                                        $('<strong/>', {'class': 'post_name'}).append(e.user.firstname + ' ' + e.user.lastname),
                                        $('<span/>', {'class': 'post_designation'}).append(

                                            e.user.experience > 0 ?(
                                            $('<span/>').append('&nbsp; · &nbsp;'),
                                            '5Y Exp'
                                            ) : ""
                                        )
                                    ),
                                    $('<span/>', {'class': 'designation'}).append(e.user.current_position),
                                    $('<span/>', {'class': 'comment-user'}).append(e.reflection)
                                )
                            ),
                            $('<div/>', {'class': 'like-reply-part'}).append(
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

    $(".repost-button").on('click', function (event) {
        var postElement = event.target.closest('.post-article');
        var post = $(postElement).attr('data-post');
        $('#repost_post').val(post);
        $('#repost').modal('show');
    });

    $(document).on('click', '#join', function (event) {
        var id = $('#join').attr('data-group');

        $.ajax({
            method: "POST",
            url: window.location.origin + '/group/join',
            data: {group_id: id, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {

            if (response == 1) {
                $(event.target).val('Leave Group');
                $(event.target).removeClass('btn-success');
                $(event.target).addClass('btn-danger');
                $(event.target).attr("id", "leave");
                window.location = window.location.pathname;

            }

        });
    });

    $(document).on('click', '#leave', function (event) {
        var id = $('#leave').attr('data-group');

        $.ajax({
            method: "POST",
            url: window.location.origin + '/group/leave',
            data: {group_id: id, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {

            if (response == 1) {
                $(event.target).val('Join Group');
                $(event.target).removeClass('btn-danger');
                $(event.target).addClass('btn-success');
                $(event.target).attr("id", "join")
                window.location = "/group/list";
            }

        });
    });

    $('#quickSubmitJob').on('click', function (event) {
        event.preventDefault();
        var jobId = $(event.target).attr('data-job');
        $.ajax({
            method: "POST",
            url: window.location.origin + '/job/apply',
            data: {job_id: jobId, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {

            if (response == 1) {
                $(event.target).html('Applied');
                $(event.target).addClass('disabled');
            }

        });
    });

    $('#repost-post').on('click', function (event) {
        event.preventDefault();
        var post = $('#repost_post').val();
        var description = $('#repost_description').val();
        var post_type = 'Shared';
        var privacy = $('#repostPostPrivacy').val();

        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/repost',
            data: {
                description: description,
                post_type: post_type,
                privacy: privacy,
                post_id: post,
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (response) {
            toastr["success"]("Post Shared Successfully");
            console.log(response);
            window.location.href = window.location.href;
            // location.reload();
        });
    });

    $('.open_consultation').on('click', function (event) {
        event.preventDefault();
        var user = $(this).attr('data-user');

        $.ajax({
            method: "POST",
            url: window.location.origin + '/user/get',
            data: {id: user, _token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            console.log(response);
            if (response.session_price == null) {
                $('#cost_per_session').html('Not Set');
                $('#physical_cost_per_house').html('Not Set');
            } else {
                $('#cost_per_session').html(response.session_price + ' (upto 1 hour)');
                $('#physical_cost_per_house').html(response.session_price + ' (upto 1 hour)');
            }

            $('#consult_with').val(user);
            $('#consultation').modal('show');

        });

    });

    //fellow list
    $('#myFellowList').on('click', function (event) {
        var ul = $(this).next();

        $.ajax({
            method: "POST",
            url: window.location.origin + '/friend/requests',
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            $(ul).empty();
            $(ul).append(
                $('<header/>').append(
                    $('<span/>').append(
                        'New connection requests'
                    ),
                    $('<a>').attr({
                        href: window.location.origin + '/friend/list',
                    }).append(
                        'See All'
                    )
                )
            )
            if (response.requests.length > 0) {
                response.requests.forEach(function (request) {
                    var profilePic;
                    if(request.sender.profile_pic){
                        profilePic = response.url + '/' + request.sender.profile_pic;
                    }else{
                        profilePic='http://skilledtalk.com/public/assets/img/profile.png';

                    }
                    // var profilePic = response.url + '/' + request.sender.profile_pic;
                    $(ul).append(
                        $('<li/>').append(
                            $('<figure/>', {'class': 'image-container'}).append(
                                $('<img/>', {'class': 'img-size', 'src': profilePic})
                            ),
                            $('<div/>', {'class': 'box-commented'}).append(
                                $('<div/>', {'class': 'commented-description'}).append(
                                    $('<strong/>').attr({class: 'post_name'}).append(
                                        request.sender.firstname+' '+request.sender.lastname
                                    )
                                ),
                                $('<span/>', {'class': 'designation'}).append(
                                    request.sender.current_position
                                ),
                                // $('<span/>', {'class': 'designation'}).append(
                                //     '10 mutual connections'
                                // )
                            ),
                            $('<div/>', {'class': 'btn-global'}).append(
                                $('<button/>', {'data-user': request.sender.id}).attr({class: 'btn-primary requestConfirm'}).append(
                                    'Confirm'
                                ),

                                $('<button/>', {'data-user': request.sender.id}).attr({class: 'btn-secondary requestDelete'}).append(
                                    'Delete'
                                )
                            )
                        )
                    )
                });
            }

            if (response.follows.length > 0) {
                response.follows.forEach(function (request) {
                    // var profilePic = response.url + '/' + request.sender.profile_pic;
                    var profilePic;
                    if(request.sender.profile_pic){
                        profilePic = response.url + '/' + request.sender.profile_pic;
                    }else{
                        profilePic='http://skilledtalk.com/public//assets/img/profile.png';

                    }
                    $(ul).append(
                        $('<li/>').append(
                            $('<figure/>', {'class': 'image-container'}).append(
                                $('<img/>', {'class': 'img-size', 'src': profilePic})
                            ),
                            $('<div/>', {'class': 'box-commented'}).append(
                                $('<div/>', {'class': 'commented-description'}).append(
                                    $('<strong/>').attr({class: 'post_name'}).append(
                                        request.sender.firstname+' '+request.sender.lastname
                                    )
                                ),
                                $('<span/>', {'class': 'designation'}).append(
                                    request.sender.current_position
                                ),
                                // $('<span/>', {'class': 'designation'}).append(
                                //     '10 mutual connections'
                                // )
                            )
                        )
                    )
                });
            }

        });
    });

    //confirm fellow request

    $(document).on('click', '.requestConfirm', function () {
        var id = $(this).attr('data-user');
        var element = this;
        $.ajax({
            method: "POST",
            url: window.location.origin + '/friend/requests/action',
            data: {user_id: id, action: 1, _token: $('meta[name="csrf-token"]').attr('content')}

        }).done(function (response) {
            if (response) {
                $(element).closest('li').remove();
                toastr["success"]("Friend request Accepted");
            }
        });
    });

    //reject fellow request

    $(document).on('click', '.requestDelete', function () {
        var id = $(this).attr('data-user');
        var element = this;
        $.ajax({
            method: "POST",
            url: window.location.origin + '/friend/requests/action',
            data: {user_id: id, action: 0, _token: $('meta[name="csrf-token"]').attr('content')}

        }).done(function (response) {
            if (response) {
                $(element).closest('li').remove();
            }
        });
    });


    //notification list
    $('#myNotifications').on('click', function (event) {
        var ul = $(this).next();
        $.ajax({
            method: "GET",
            url: window.location.origin + '/notifications/list',
            data: {_token: $('meta[name="csrf-token"]').attr('content')}
        }).done(function (response) {
            console.log(response);
            $(ul).empty();
            $(ul).append(
                $('<header/>').append(
                    $('<span/>').append(
                        'All Notifications'
                    ),
                    $('<a>').attr({
                        href: window.location.origin +"/notifications",
                        style:"margin:0; padding:0;",
                    }).append(
                        'See All'
                    ),
                    $('<a>').attr({
                        href: '#0',
                        style:"margin:0; padding:0;",
                        id:"clearAllNotifications",
                    }).append(
                        'Clear All'
                    )
                )
            )
            if (response.notifications.length > 0) {
                response.notifications.forEach(function (request) {

                    var profilePic;
                    if(request.other_user.profile_pic){
                        profilePic = response.url + '/' + request.other_user.profile_pic;
                    }else{
                        profilePic='http://skilledtalk.com/public/assets/img/profile.png';

                    }

                    $(ul).append(
                        $('<li/>').append(
                            $('<a/>',{href:request.url,style:"display:flex; align-items:start; flex-direction:row;"}).append(
                                $('<figure/>', {'class': 'image-container'}).append(
                                    $('<img/>', {'class': 'img-size', 'src': profilePic})
                                ),
                                $('<div/>', {'class': 'sub-menu-notifications'}).append(
                                    $('<p/>').append(
                                        $('<b/>').append(
                                            request.other_user.firstname+' '+request.other_user.lastname+' '+request.other_user.experience+'Y'
                                        ),$('<br/>'),
                                        request.text
                                    ),
                                    $('<br/>'),
                                    $('<span/>').append(
                                        request.notification_time
                                    )
                                )
                            )
                        )
                    )
                });
            }

        });
    });


    //Clearing All Notifications

    $(document).on("click","#clearAllNotifications",function (){

        var parent_html = $(this).parent().html();
        var grand_parent_html = $(this).parent().parent();

        $.ajax({
            method: "POST",
            url: window.location.origin + '/notifications/clearAllNotifications',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            }
        }).done(function (response) {
            grand_parent_html.html(parent_html);
            toastr.success('Notification cleared successfully!');
        });


    });




//     experience edit

    $(document).on('click', '.experienced-edit', function () {
        var id = $(this).attr('data-experienced');
        $.ajax({
            method: "GET",
            url: window.location.origin + '/experience/edit/' + id,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}

        }).done(function (response) {
            if (response) {
                $('#EditExperienceModal').empty();
                $('#EditExperienceModal').append(response);
                $('#edit-experience').modal('show');
            }
        });
    });

    $(document).on('click', '.follow_page', function () {
        var id = $(this).attr('data-page');
        var buttonClicked = this;
        $.ajax({
            method: "GET",
            url: window.location.origin + '/page/follow/' + id,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}

        }).done(function (response) {
            toastr.success('Page Follow Successfully')
            $(buttonClicked).html('Followed');
            $(buttonClicked).addClass('disabled');
        });


    });

    $(document).on('click', '.unfollow_page', function () {
        var id = $(this).attr('data-page');
        // var buttonClicked = this;
        $.ajax({
            method: "GET",
            url: window.location.origin + '/page/unfollow/' + id,
            data: {_token: $('meta[name="csrf-token"]').attr('content')}

        }).done(function (response) {
            toastr.success('Page Un-Followed Successfully')
            // $(buttonClicked).html('Followed');
            // $(buttonClicked).addClass('disabled');
            window.location.href = window.location.href;
        });


    });


    $(document).on('click', '.post-send', function () {
        var postElement = event.target.closest('.post-article');
        var reflectionlist = $(postElement).find('.reflection-list');
        var post = $(postElement).attr('data-post');
        console.log(post)
        $.ajax({
            method: "GET",
            url: window.location.origin + '/friend/list/ajax',
            data: {_token: $('meta[name="csrf-token"]').attr('content')}

        }).done(function (response) {
            $('#friendList').empty();
            console.log(response);
            if (response.friends.length > 0) {
                response.friends.forEach(function (friend) {

                    if(response.auth_id == friend.request_from){
                        $('#friendList').append(
                            $('<li/>', {'class': 'messages-lists'}).append(
                                $('<figure/>', {'class': 'image-container'}).append(

                                    (friend.receiver.profile_pic != null ?  $('<img/>', {'class': 'img-size', src: response.url + friend.receiver.profile_pic}) : $('<img/>', {'class': 'img-size', src: '/public/assets/img/profile.png'}))


                                ),
                                $('<div/>', {'class': 'box-commented'}).append(
                                    $('<div/>', {'class': 'commented-description'}).append(
                                        $('<strong/>', {'class': 'post_name'}).append(friend.receiver.firstname)
                                    ),
                                    $('<span/>', {'class': 'designation'}).append(friend.receiver.sub_industry)
                                ),
                                $('<div/>', {'class': 'vertical-icons'}).append(
                                    $('<a/>', {
                                        'class': 'btn btn-primary share-post',
                                        style: 'color:white',
                                        'data-userId': friend.receiver.id,
                                        'data-post': post
                                    }).append('send')
                                )
                            )
                        )
                    }else{
                        $('#friendList').append(
                            $('<li/>', {'class': 'messages-lists'}).append(
                                $('<figure/>', {'class': 'image-container'}).append(
                                    (friend.sender.profile_pic != null ?  $('<img/>', {'class': 'img-size', src: response.url + friend.sender.profile_pic}) : $('<img/>', {'class': 'img-size', src: '/public/assets/img/profile.png'}))
                                ),
                                $('<div/>', {'class': 'box-commented'}).append(
                                    $('<div/>', {'class': 'commented-description'}).append(
                                        $('<strong/>', {'class': 'post_name'}).append(friend.sender.firstname)
                                    ),
                                    $('<span/>', {'class': 'designation'}).append(friend.sender.sub_industry)
                                ),
                                $('<div/>', {'class': 'vertical-icons'}).append(
                                    $('<a/>', {
                                        'class': 'btn btn-primary share-post',
                                        style: 'color:white',
                                        'data-userId': friend.sender.id,
                                        'data-post': post
                                    }).append('send')
                                )
                            )
                        )
                    }

                })

            } else {
                $('#friendList').append('You have no friend in your FriendList')
            }

            $('#sendPost').modal('show');
        });
    });

    $(document).on('click', '.share-post', function () {
        var send_to = $(this).attr('data-userId');
        var post = $(this).attr('data-post');
        var getlink = window.location.origin + '/post/detail/' + post;
        $.ajax({
            method: "POST",
            url: window.location.origin + '/sendMessage',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),

                send_to: send_to,
                type: 'LINK',
                text: getlink,
            }

        }).done(function (response) {
            toastr.success('post shared')
        });
    });

    $(document).on('click', '.save-post', function () {
        var post = $(this).attr('data-post');
        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/save',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post: post,
            }

        }).done(function (response) {
            toastr.success('post save')
        });
    });

    $(document).on('click', '.delete-post', function () {
        var post = $(this).attr('data-post');
        var elementClicked = this;
        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/delete',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post: post,
            }

        }).done(function (response) {
            if(response == 1){
                $(elementClicked).closest('.post-article').remove();
                toastr.success('Post Deleted Successfully');
            }else if(response == 0){
                toastr.success('Unable to delete post.');
            }

        });
    });


    $(document).on('click', '.edit-post', function () {
        var post = $(this).attr('data-post');
        $.ajax({
            method: "POST",
            url: window.location.origin + '/post/edit',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post: post,
            }

        }).done(function (response) {
            if(response.post_type.name == 'Photo' || response.post_type.name == 'Video' || response.post_type.name == 'Shared'){
                $('#edit-post-description-field-photo').val(response.description);
                $('#edit-post-photo-post').val(response.id);
                $('#edit-photo-video').modal('show');
            }else if(response.post_type.name == 'Article'){
                if(response.heading == null){
                    $('#edit-post-article-heading').remove();
                }else{
                    $('#edit-post-heading-field-article').val(response.heading);
                }
                $('#edit-post-description-field-article').val(response.description);
                $('#edit-post-article-post').val(response.id);
                $('#edit-article').modal('show');
            }else if(response.post_type.name == 'Job'){
                console.log(response);

                $('#edit-job-title').val(response.jobs.job_title);
                $('#edit-job-company').val(response.jobs.company);
                $('#edit-job-location').val(response.jobs.location);
                $('#edit-job-skills').val(response.jobs.skills);
                $("#edit-experience-from").val(response.jobs.exp_from);
                $("#edit-experience-to").val(response.jobs.exp_to);
                $("#edit-employment-type").val(response.jobs.employee_type_id);
                $("#edit-salary-from").val(response.jobs.salary_from);
                $("#edit-salary-to").val(response.jobs.salary_to);
                $('#edit-job-qualification').val(response.jobs.qualification);
                $('#eidt-post-job-description').val(response.jobs.description);
                $('#edit-post-job-post').val(response.id);
                $('#edit-job').modal('show');
            }
        });
    });


});

// $(document).on("click","body",function (){
//    var element = $(".sub-menu").attr("")
// });


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

    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slides[slideIndex - 1].style.display = "block";

}


// function maxlength(form_data){

    // var data = $(form_data).serializeArray();
    // let obj = data.find(o => o.name === 'description');
    // // console.log(obj);
    //
    // var maxvalue = 250;
    // var element = obj.value;
    // var total_words = element.split(/[\s]+/).length;
    //
    // if(total_words < maxvalue){
    //     alert("Please enter minimum 250 words in description.Your have entered "+total_words+" words!");
    //     return false;
    // }else{
    //     return true;
    // }
// }


// $(".delete-comment").on("click",function (e) {
//     e.preventDefault();
//
//     var comment_id = $(this).attr("data-comment-id");
//     alert(comment_id);
// })


function deleteComment(element) {
    // console.log(element);

    var comment_id = $(element).attr("data-comment-id");
    // alert(comment_id);

    if (!confirm('Are you sure?')) return false;

    $.ajax({
        method: "POST",
        url: window.location.origin + '/post/delete-comment',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            comment_id: comment_id,
        },
        success:function (data) {
            // console.log(data);

            if(data.ResponseCode == 1){
                $(element).parent().parent().parent().remove();
            }else{
                return
            }

        }

    });

}



function editComment(element) {

    // console.log();
    var comment_id = $(element).attr("data-comment-id");
    var parent_element = $(element).parent().parent().parent().find(".comment-user");

    // console.log(parent_element);
    // $(element).hide();

    $(element).parent().hide();
    var comment_text = parent_element.html();
    parent_element.html("");
    parent_element.html("<input type='text' name='comment_to_edit' value='"+comment_text+"' class='comment_to_edit' comment_id='"+comment_id+"' >  <a href='javascript:;' class='submit_edited_comment' onclick='return submitEditedComment(this)' ><i class=\"fas fa-paper-plane\" aria-hidden=\"true\"></i></a> <a href='javascript:;' class='ml-2 cancel-comment' onclick='return cancelComment(this)'><i class=\"fas fa-times\" aria-hidden=\"true\"></i></a>");


}

function cancelComment(element) {

    // console.log();

    var edit_button = $(element).parent().parent().parent().parent().find(".edit-comment");
    $(edit_button).parent().show();


    var comment_text = $(element).parent().parent().parent().find(".comment-user").find(".comment_to_edit").val();
    var parent_element = $(element).parent().parent().parent().find(".comment-user");
    $(parent_element).html("");
    $(parent_element).html(comment_text);

}

function submitEditedComment(element) {

    var comment_box = $(element).parent().parent().parent().find(".comment-user");

    var edit_btn = $(element).parent().parent().parent().parent().find(".edit-comment");

    // console.log(edit_btn);
    //
    // return


    var comment_to_submit = $(element).parent().find('.comment_to_edit').val();
    var comment_id = $(element).parent().find('.comment_to_edit').attr("comment_id");

    $.ajax({
        method: "POST",
        url: window.location.origin + '/post/update-comment',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            comment_id: comment_id,
            updated_comment: comment_to_submit
        },
        success:function (data) {
            // console.log(data);

            if(data.ResponseCode == 1){
                // $(element).parent().parent().parent().remove();
                // console.log("done");
                $(edit_btn).parent().show();
                $(comment_box).html("");
                $(comment_box).html(data.comment);
            }else{
                return
            }

        }

    });

}








