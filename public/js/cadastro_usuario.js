$(document).ready(function() {
    $("#form_cadastro").on("submit", function(e) {
        e.preventDefault();

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
                    window.location.href = "/cadastro_local";
                } else {
                    Swal.fire({ icon: 'error', title: 'Erro!', text: response.mensagem });
                }
            },
            error: function(xhr) {
                Swal.fire({ icon: 'error', title: 'Erro!', text: 'Não foi possível completar o cadastro.' });
            }
        });
    });
});