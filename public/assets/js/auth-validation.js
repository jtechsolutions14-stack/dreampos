$(document).ready(function () {
    // Extend validation messages
    $.extend($.validator.messages, {
        required: "This field is required.",
        email: "Please enter a valid email address.",
        minlength: $.validator.format("Please enter at least {0} characters."),
        equalTo: "Please enter the same value again."
    });

    if ($('#login-form').length > 0) {
        $('#login-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: "Please enter your email.",
                    email: "Enter a valid email address."
                },
                password: {
                    required: "Please enter your password.",
                    minlength: "Password must be at least 6 characters."
                }
            },
            errorClass: 'invalid-feedback',
            errorElement: 'div',
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    }

    // Forgot password form
    if ($('#forgot-password-form').length > 0) {
        $('#forgot-password-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    required: "Please enter your email.",
                    email: "Enter a valid email address."
                }
            },
            errorClass: 'invalid-feedback',
            errorElement: 'div',
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    }

    // Reset password form
    if ($('#reset-password-form').length > 0) {
        $.validator.addMethod('strongPassword', function (value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{8,}$/.test(value);
        }, 'Password must include uppercase, lowercase, number, and special character.');

        $('#reset-password-form').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                    strongPassword: true
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#new-password'
                }
            },
            messages: {
                password: {
                    required: "Please enter a new password.",
                    minlength: "Password must be at least 8 characters.",
                    strongPassword: "Password must have uppercase, lowercase, number, and special symbol."
                },
                password_confirmation: {
                    required: "Please confirm your new password.",
                    equalTo: "Confirmation does not match password."
                }
            },
            errorClass: 'invalid-feedback',
            errorElement: 'div',
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    }
});
