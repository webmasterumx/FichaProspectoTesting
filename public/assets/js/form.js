$("#formReferido").validate({
    rules: {
        nombreReferido: {
            required: true,
        },
        apellidoPaternoReferido: {
            required: true,
        },
        apellidoMaternoReferido: {
            required: true,
        },
        telefonoReferido: {
            required: true,
        },
        emailReferido: {
            required: true,
            email: true
        }
    },
    messages: {
        nombreReferido: {
            required: "campo requerido"
        },
        apellidoPaternoReferido: {
            required: "campo requerido"
        },
        apellidoMaternoReferido: {
            required: "campo requerido"
        },
        telefonoReferido: {
            required: "campo requerido"
        },
        emailReferido: {
            required: "campo requerido",
            email: "correo no valido"
        },
    },
    submitHandler: function (form) {
        form.submit();
    }
});