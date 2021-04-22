// $('button.ans__comment').click(function (e) {
//     let $clicked_el = $(e.currentTarget);
//     let clicked_class = e.currentTarget.className;
//     // alert(this.id)
//     let id = this.id
//     console.log(id)
//     $.ajax({
//         type: "POST",
//         url: "/posts/comment",
//         data: {id: id, parrent_id: parrent},
//         success: function (result) {
//             console.log(result)
//         }
//     });
// });
$(function () {
    let id = 1;


    $("#addComment").on('click', function () {
        let comment = $("#commentField").val();
        let countComment = $('#countComment').val();
        console.log(countComment)

        $.ajax({
            url: "/posts/comment",
            method: "POST",
            dataType: 'text',
            data: {
                comment_content: comment,
                articleId: 1
            },
            success: function (response) {
                $("#countComment").html(response);
            }
        })
        getAllComment(0, countComment)
    })

    function getAllComment(start, max) {
        if (start > max) {
            return;
        }
        $.ajax({
            url: "/posts/" + id + "/comments",
            method: "GET",
            dataType: 'JSON',
            data: {getAllComments: 1, start: start},
            success: function (response) {
                // let json = JSON.parse(response)
                console.log(response[0])
                // $('#usr').each(function(index, item) {
                //     $('#table').append('<tr><td>' + item.username + '</td><td>' + item.userid + '</td></tr>');
                // });
                $('.comment').prepend(response[0].comment_text);
                getAllComment(start + 20, max);
            }
        })
    }

})
//
// function getAllComment(start, max) {
//     $.ajax({
//         url: '/posts/' + id + '/show',
//         method: 'POST',
//         dataType: 'text',
//     })
//
// }
//
//
// function createPost() {
//     $('button.create').on('click', function (e) {
//         e.preventDefault();
//         let title = $('.title').val();
//         let text = $('.text').val();
//         $.ajax({
//             type: "POST",
//             url: "/posts/store",
//             data: {title: title, text: text},
//             success: function (result) {
//                 console.log(result)
//             }
//         });
//         $('.title').val('');
//         $('.text').val('');
//     })
// }
//
// $('#comment_form').on('submit', function (event) {
//     event.preventDefault();
//     let data_form = $("#comment_content").val();
//     let articleId = $('.post_id').attr('id')
//     console.log(data_form, articleId)
//     $.ajax({
//         url: "/posts/comment",
//         method: "POST",
//         data: {comment_content: data_form, articleId: articleId},
//         dataType: "JSON",
//         success: function () {
//             if (data.error != '') {
//                 $('#comment_form')[0].reset();
//                 $('#comment_message').html(data.error);
//             }
//         }
//     })
//     $('#comment_content').val('');
// })