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

    $('#comment_form').on('submit', function (event) {
        event.preventDefault();
        let data_form = $("#comment_content").val();
        let articleId = $('.post_id').attr('id')
        console.log(data_form, articleId)
        $.ajax({
            url: "/posts/comment",
            method: "POST",
            data: {comment_content: data_form, articleId: articleId},
            dataType: "JSON",
            success: function () {
                if (data.error != '') {
                    $('#comment_form')[0].reset();
                    $('#comment_message').html(data.error);
                }
            }
        })
        $('#comment_content').val('');
    })

})

function getAllComment(start, max) {
    $.ajax({
        url: '/posts/'+ id +'/show',
        method: 'POST',
        dataType: 'text',
    })

}


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
                console.log(result)
            }
        });
        $('.title').val('');
        $('.text').val('');
    })
}
