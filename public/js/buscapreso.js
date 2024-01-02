$(document).ready(function () {
    var buscaPreso = (_params) => {

        var tmp = $("input[name=prontuario]." + _params).val();

        if (tmp != '') {
            var prontuario = $("input[name=prontuario]." + _params).val();
            if (prontuario != '' && prontuario != "") {
                var url = 'http://127.0.0.1/api/preso/' + prontuario;
                $.ajax({
                    url: url,
                    // data: prontuario,
                    method: 'GET',

                    dataType: 'json',
                    crossDomain: true,
                    contentType: "application/json",
                    error: function (data) {
                        if (data.status === 422) {
                            var errors = data.responseJSON;
                            $.each(errors.errors, function (key, value) {
                                if (key == 'prontuario') {
                                    $(document).Toasts('create', {
                                        class: 'bg-danger',
                                        title: 'Atenção',
                                        subtitle: 'Erro',
                                        body: value,
                                        autohide: true,
                                        close: false,
                                    });


                                }
                            });
                        }
                    },
                    success: function (json) {

                        if (json !== null && (!jQuery.isEmptyObject(json))) {

                            $("input[name=preso_id]").val(json.id);
                            $("input[name=nome_preso]").val(json.nome);
                            $("input[name=prontuario]").val(json.prontuario);
                   

                            $(document).Toasts('create', {
                                class: 'bg-warning',
                                title: 'Atenção',
                                subtitle: '#',
                                body: 'Prontuário encontrada!',
                                autohide: true,
                                close: false,
                            });

                        } else {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Atenção',
                                subtitle: 'Erro',
                                body: 'Prontuário <strong>Não Cadastrado</strong>',
                                autohide: true,
                                close: false,
                            });

                        }
                    }
                });

            } else {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Atenção',
                    subtitle: 'Erro',
                    body: 'Preencha o <strong>Prontuário</strong>',
                    autohide: true,
                    close: false,
                });

            }
        }

        

    };    

    $("#btn-buscar").on('click', function () {
        buscaPreso(_params = "create");
    });

});

