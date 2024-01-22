
$(function() {
  'use strict';
   let config = {
        toolbar: [
            [ 'Bold','Italic','Strike','JustifyLeft','JustifyCenter', 'JustifyRight','NumberedList', 'BulletedList','Outdent','Indent'],
        ]
    };
    CKEDITOR.addCss(".cke_editable{color:#6e6b7b; font-size: 1rem;font-weight: 400; font-family: 'Public Sans', sans-serif;}");
    CKEDITOR.config.allowedContent = true;
    //CKEDITOR.replace('post_content', config);

    $('.fb-comments').each(function(i,obj) {
            $(this).attr('data-href',window.location.href+'/'+$(this).attr('data-id'));
        });

    $(document).on('keyup','.member-list',function () {
       let search_key = $('.member-list').val().toLowerCase();
       if(search_key.length > 0) {
          $(".member-name").each(function (i, obj) {
               let member_name = $(this).text().toLowerCase();
               console.log('search key',search_key,'member name',member_name);
               if(! member_name.includes(search_key)){
                   $(this).closest('.member-list-item').addClass('display-none');
                   matchingBold(search_key);
               } else {
                   $(this).closest('.member-list-item').removeClass('display-none');
               }
            });
       } else {
           $('.member-list-item').removeClass('display-none');
       }
    });

    function matchingBold(target_string) {
        $(".member-name").each(function () {
            let text = $(this).text();
            let highlightedText = text.replace(new RegExp(target_string, "gi"), "<b>$&</b>");
            $(this).html(highlightedText);
        });
    }
    $(document).ready(function () {
       loadPost(1);
    });
    $(document).on('click','.load-more',function(e) {
        e.preventDefault();
       let nextPage = $('.post-element').length / 10 + 1; // Calculate the next page
        loadPost(nextPage);
    });

    let isLoading = false;
    function loadPost(page) {
        isLoading = false; // Flag to prevent multiple simultaneous requests
        let member_id = $('#member-id').val();
        $.ajax({
            url: '/load-post',
            method: 'GET',
            data: {
                page: page,
                member: member_id
            },
            success: function(response) {
                $('#post-submit-div').append(response);
                isLoading = false;
            },
            error: function(xhr, status, error) {
                // Handle the error
                console.error(error);
            }
        });
    }




    $(window).on('scroll', function() {
        let windowHeight = $(window).height();
        let documentHeight = $(document).height();
        let scrollTop = $(window).scrollTop();
        // Check if the user has scrolled to the maximum height of the window
        if (scrollTop + windowHeight >= documentHeight && !isLoading) {
            isLoading = true; // Set the flag to prevent additional requests while loading
            let nextPage = $('.post-element').length / 10 + 1; // Calculate the next page
            setTimeout(function (){
                loadPost(nextPage);
            },5000);
        }
    });

});
