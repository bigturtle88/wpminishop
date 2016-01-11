jQuery(document).ready(function () {

    jQuery("#bay-form").validate({

        rules: {

            uname: {
                required: true,
                minlength: 4,
                maxlength: 16
            },

            email: {
                required: true,
                email: true,
                minlength: 6,
                maxlength: 40
            }
        },

        messages: {

            uname: {
                required: "Это поле обязательно для заполнения",
                minlength: "Логин должен быть минимум 4 символа",
                maxlength: "Максимальное число символо - 16"
            },

            email: {
                required: "Это поле обязательно для заполнения"
            }

        },

        highlight: function (element) {
            jQuery(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            jQuery(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {

            form.submit();


        }

    });

});