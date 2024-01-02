$(document).ready(function () {
     var buscarCredencial = (_params) => {

        var tmp = $("input[name=credencial]." + _params).val();

        if (tmp != '') {
            var credencial = $("input[name=credencial]."+_params).val();
            if (credencial != '' && credencial != "") {
                var url = 'http://127.0.0.1/api/preso_familiar/'+credencial;
                $.ajax({
                    url: url ,
                    // data: credencial,
                    method: 'GET',

                    dataType: 'json',
                    crossDomain: true,
                    contentType: "application/json",
                    error: function (data) {
                        if (data.status === 422) {
                            var errors = data.responseJSON;
                            $.each(errors.errors, function (key, value) {
                                if (key == 'credencial') {
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
                         
                            $("input[name=preso_familiar_id]").val(json.id);
                            $("input[name=nome]").val(json.nome);
                            $("input[name=rg]").val(json.rg);
                            $("input[name=cpf]").val(json.cpf);
                            $("input[name=afinidade]").val(json.afinidade);
                            $("input[name=preso_id]").val(json.preso_id);
                            $("input[name=nome_preso]").val(json.nome_preso);
                            $("input[name=prontuario]").val(json.prontuario);


                            $(document).Toasts('create', {
                                class: 'bg-warning',
                                title: 'Atenção',
                                subtitle: '#',
                                body: 'Credencial encontrada!',
                                autohide: true,
                                close: false,
                            });

                        } else {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Atenção',
                                subtitle: 'Erro',
                                body: 'Credencial <strong>Não Cadastrado</strong>',
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
                    body: 'Preencha o <strong>CPF ou CNPJ</strong>',
                    autohide: true,
                    close: false,
                });

            }
        }

        $("input[name=nome]").val('');
        $("input[name=rg]").val('');
        $("input[name=cpf]").val('');
        $("input[name=afinidade]").val('');
        $("input[name=preso_id]").val('');

        $("form[id=form-cliente] input[name=_method]").remove()

        $("form[id=form-cliente]").attr('method', 'post');
        $("form[id=form-cliente]").attr('action', 'http://www.#.com.br/admin/cliente/store');
    };



    var buscarOrcamento = function (params = null) {
        var id = params;

        if (id != null) {
            var url = 'http://www.#.com.br/admin/orcamento/buscar/';
            $.ajax({
                url: url,
                data: {
                    'id': id
                },
                method: 'GET',

                dataType: 'json',
                crossDomain: true,
                async: false,
                contentType: "application/json",
                success: function (json) {

                    if (json !== null && (!jQuery.isEmptyObject(json))) {
                        return json;
                    } else {

                        $(document).Toasts('create', {
                            class: 'bg-danger',
                            title: 'Atenção',
                            body: 'Erro <strong>Orçamento não encontrado</strong>',
                            subtitle: 'Erro',
                        });
                    }
                }
            });
        } else {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Atenção',
                body: 'Erro <strong>Orçamento não encontrado</strong>',
                subtitle: 'Erro',
            });
        }

    };

    
    $("input[name=credencial].orcamento").change(function () {
        buscarCredencial(_params = "create");
    });



    $("#btn-buscar").on('click', function () {
        buscarCredencial(_params = "create");
    });

});

