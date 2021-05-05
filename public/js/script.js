$(function () {
    $.ajax({
        url: '/posts/'+ 1 + '/comments',
        method: 'GET',
        dataType: 'JSON',
        success: function (response) {
            renderAllComment(response);

        }
    })

    createPost();



    $('#signupSubmit').on('click', function () {
        let login = $("#login").val();
        let email = $("#email").val();
        let password = $("#password").val();

        // $(".signup").validate({
        //     rules: {
        //         login: "required",
        //         email: {
        //             required: true,
        //             email: true
        //         }
        //     },
        //     messages: {
        //         name: "Please specify your name",
        //         email: {
        //             required: "We need your email address to contact you",
        //             email: "Your email address must be in the format of name@domain.com"
        //         }
        //     }
        // });

        $.ajax({
            url: '/user/signup',
            method: 'POST',
            dataType: 'text',
            data: {
                login: login,
                email: email,
                password: password
            },
            success: function (response) {
                if (response === 'Поздравляю с успешной регистрацией') {
                    $(location).attr('href', '/user/login')
                }
                $('#msgbox').css('display', 'block').html(response);
                $('#password').val('');

            }
        })



        let id = $(".articleId").attr('id');

        let commentId = 0;
        $('.reply').on('click', function () {
            reply(this);
            commentId = $(this).attr('id');
            console.log(commentId)
        })
        $("#addComment, #addReply").on('click', function () {
            let comment;
            if (!isReply) {
                comment = $("#commentField").val();
            } else {
                comment = $("#replyComment").val();
            }

            let countComment = $('#countComment').val();
            $.ajax({
                url: "/posts/comments",
                method: "POST",
                dataType: 'text',
                data: {
                    comment_content: comment,
                    articleId: id,
                    parentId: commentId
                },
                success: function (response) {
                    let json = JSON.parse(response)
                    $("#countComment").html(json['count']);
                    if (!isReply) {
                        $("#commentField").val('');
                        successFetchComment(json['comments']);
                    } else {
                        $('.rowReply').hide();
                        $('.rowReply').val('');
                        $('.replies').append(` <div class="comment">
                            <div class="user"><b>${json['login']}</b> <span class="time">2019-07-15</span></div>
                            <div class="userComment"></div>
                        </div>`)

                    }


                }
            })
            // getAllComment(0, countComment)
        })

        // function getAllComment(start, max) {
        //     if (start > max) {
        //         return;
        //     }
        //     $.ajax({
        //         url: "/posts/" + id + "/comments",
        //         method: "GET",
        //         dataType: 'JSON',
        //         data: {getAllComments: 1, start: start},
        //         success: function (response) {
        //             successFetchComment(response);
        //         }
        //     })
        // }

        function successFetchComment(response) {
            $('.userComments').prepend(`<div class="comment">
                    <div class="user"><b>${response[0]['login']}</b> <span class="time">${response[0]['time']}</span></div>
                    <div class="userComment">${response[0]['comment_text']}</div>
                    <div class="reply" id="${response[0]['id']}"><a href="javascript:void(0)">ответить</a></div>`)
        }

    })
    let isReply = false;

    function reply(caller) {
        $('.rowReply').insertAfter($(caller))
        $('.rowReply').show();
    }

    console.log(isReply)


    function createPost() {
        $('button.create').on('click', function (e) {
            e.preventDefault();
            let title = $('.title').val();
            let text = $('.text').val();
            $.ajax({
                type: "POST",
                url: "/posts/store",
                data: {title: title, text: text},
                success: function (result) {
                    let response = JSON.parse(result);
                    $('.count').html(response['count']);
                    console.log(response)
                }
            });
            $('.title').val('');
            $('.text').val('');
        })
    }
})

function renderAllComment (array, parent_id = 0) {
    // console.log(array[parent_id])
    if (array[parent_id] === undefined){
        return ;
    }
 let keyCount = Object.keys(array).length
    // console.log(keyCount)
    // console.log(array)

    for(i = 0; i < keyCount-1; i++) {
        console.log(array[i])
        if (array[parent_id][i] !== undefined) {
            $('.userComments').prepend(`<div class="comment">
                    <div class="user"><b>${array[parent_id][i]['login']}</b> <span class="time">${array[parent_id][i]['time']}</span></div>
                    <div class="userComment">${array[parent_id][i]['comment_text']}</div>
                    <div class="reply" id="${array[parent_id][i]['id']}"><a href="javascript:void(0)">ответить</a></div>`)
            renderAllComment(array, array[parent_id][i]['id']);
        }


    }
}
