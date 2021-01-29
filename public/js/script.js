// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    let forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

function sendAjaxFormRegistration() {
    let email = $('input[name="email"]').val();
    let password = $('input[name="password"]').val();
    let login = $('input[name="login"]').val();
    $.ajax({
        url: '/sign/up',
        type: "POST",
        data: {email: email, password: password, login: login},
        success: function (data) {
            if (data === '1') {
                window.location = '/';
            } else {
                $('#result_form').html(data);
            }
        },
        error: function (data) {
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}