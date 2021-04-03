// $(document).ready(function () {
//     $('#signup:button').on('click', function () {
//         ajax();
//     });
//
// });
//
// function ajax() {
//     let login = $('#signup input[name="login"]').val();
//     let email = $('#signup input[name="email"]').val();
//     let password = $('#signup input[name="password"]').val();
//
//     $.ajax({
//         url: '/user/signup',
//         type: 'POST',
//         data: {login: login, email: email, password: password}
//
//     })
//
// }

// $(document).ready(function (){
//     $('#button').on('click', function (){
//         event.preventDefault();
//         let title = $('input #title').val();
//         let text = $('input #text').val();
//         $.ajax({
//             method: 'POST',
//             url: '/posts/store',
//             data: {title: title, text: text},
//             cache: false
//         })
//             .done(function (){
//
//             })
//         $('input.title').val('');
//         $('input.text').val('');
//
//     })
// })


$(function () {
    $('button').on('click', function (e) {
        e.preventDefault();
        let title = $('.title').val();
        let text = $('.text').val();
        $.ajax({
            method: 'POST',
            url: '/posts/store',
            data: {title: title, text: text},
            cache: false,
            success: function () {

            }
        })
        $('.title').val('');
        $('.text').val('');
    })
})
