$(document).ready(function() {
    $("#form_cadastro_local").on("submit", function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: {
                _token: $(this).find("input[name='_token']").val(),
                bloco_id: $("#bloco_id").val(),
                tipo_local_id: $("#tipo_local_id").val(),
                nome: $("#nome").val(),
                identificador: $("#identificador").val(),
            },
            success: function(response) {
                if (response.erro == 'n') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: response.mensagem
                    }).then(function() {
                        window.location.href = "/home";
                    });
                } else {
                    Swal.fire({ icon: 'error', title: 'Erro!', text: response.mensagem });
                }
            },
            error: function(xhr) {
                Swal.fire({ icon: 'error', title: 'Erro!', text: 'Não foi possível cadastrar a sala.' });
            }
        });
    });
});