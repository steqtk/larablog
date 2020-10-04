$(document).ready(function () {
    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            loadMoreData(page);
        }
    });

    function loadMoreData(page) {

        $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                beforeSend: function () {
                    $('.ajax-load').show();
                }
            })
            .done(function (data) {
                if (data.html == "") {
                    $('.ajax-load').html("The end.");
                    return;
                }
                $('.ajax-load').hide();
                $("#post-data").append(data.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('error...');
            });
    }

    $('.delete-post-image').on('click', function () {
        if (confirm('sure what you want delete?')) {
            $(this).parent().remove();
        }
    })
    $('[title=Delete]').on('click', function (e) {
        e.preventDefault();
        if (confirm('sure what you want delete?')) {
            url = $(this).attr('href');
            var id = url.split('/')[4];
            $(this).parent().parent().parent().fadeOut(function () {
                $(this).remove();
            });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/posts/"+id,
                    type: "DELETE",
                    data: {id: id},
                    success: function(){
                        count_of_posts = $('.dropdown-item').first().html().match(/\d+/)[0];
                        $('.dropdown-item').first().html('My posts (' + (count_of_posts-1) +')');
                    }
                });

        }
    });
});
