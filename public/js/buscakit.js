$(document).ready(function () {
    var buscakit = (_params) => {
        var tmp = $("input[name=kit]." + _params).val();
        if (tmp != '') {
            var kit = $("input[name=kit]." + _params).val();
            if (kit != '' && kit != "") {
                var url = 'http://127.0.0.1/api/presokit/' + kit;
                        // http://127.0.0.1/api/presokit/115
                console.log(kit);
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    crossDomain: true,
                    contentType: "application/json",
                    error: function (data) {
                        if (data.status === 422) {
                            var errors = data.responseJSON;
                            $.each(errors.errors, function (key, value) {
                                if (key == 'kit') {
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
                            $("input[name=kit]").val(json.kit);
                  

                            /*Alerts Toasts*/
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
        buscakit(_params = "create");
    });
});

