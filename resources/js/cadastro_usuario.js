$(document).ready(function() {
    $("#form_cadastro").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: {
                _token: $(this).find("input[name='_token']").val(),
                nome: $("#nome").val(),
                email: $("#email").val(),
                senha: $("#senha").val(),
                data_nascimento: $("#data_nascimento").val(),
                cpf: $("#cpf").val(),
            },
            success: function(response) {
                if (response.erro == 'n') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Token gerado!',
                        text: response.mensagem + '. Você será redirecionado...',
                        timer: 1800,
                        showConfirmButton: false
                    });

                    setTimeout(function () {
                        window.location.href = "/home";
                    }, 1800);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: response.mensagem,
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro inesperado',
                    text: 'Não foi possível processar o cadastro. Tente novamente.',
                });
            }
        });
    });
});