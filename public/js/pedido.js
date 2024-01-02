$(document).ready(function ($) {


    $("#itenspedido").createRepeater({
        showFirstItemToDefault: true,
        classRepeat: ".items",
        classBtnAdd: ".repeater-add-btn",
        classBtnRemove: ".remove-btn",
        resetValue: false,
        afterInsert: function () {
            $('.float').mask('9999999999,99');
            $('.money').mask('9999999999,99');
            $('.number').mask('9999');
            calculaPedido();
        },
        afterRemove: 'calculaPedido(true);'

    });
    calculaPedido(true);

    $("#btn-save").click(function (e) {
        e.preventDefault()
        var form = $("#form-cliente");

        $.ajax({
            method: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            timeout: 9000,
            error: function (data) {
                if (data.status === 422) {
                    var errors = data.responseJSON;
                    $.each(errors.errors, function (key, value) {
                        errorHtml.append('<li>' + value + '</li>');
                    });
                    $('#display-errors').removeClass('d-none');
                    $('#display-errors').addClass('d-block');
                } else {
                    $('#modalClientes').modal('hide');
                }
            },
        });
    });

    function calculaPedido(flag = false) {

        /*FLAG*/
        if (flag == false) {
            $('.qtd').on('change blur keyup', function () {
                var tmp_total = parseFloat('0.0');
                $('.items').each(function () {
                    // percorre todos os campos de quantidade quantidade
                    var qtd = parseFloat(($(this).find('.qtd').val() == '') ? 0.00 : $(this).find('.qtd').val().toString().replace(/\./g, '').replace(/\,/g, '.'));
                });
            });
        } else {
            var tmp_total = parseFloat('0.0');
            $('.items').each(function () {//percorre todos os campos de quantidade
                //quantidade
                var qtd = parseFloat(($(this).find('.qtd').val() == '') ? 0.00 : $(this).find('.qtd').val().toString().replace(/\./g, '').replace(/\,/g, '.'));
            });
        }
    }

    $('#modalClientes').on('shown.bs.modal', function () {
        $("input[name=nome]").val('');
        $("input[name=rg]").val('');
        $("input[name=cpf]").val('');
        $("input[name=afinidade]").val('');
    });

    $('#modalClientes').on('hidden.bs.modal', function (e) {
        $("input[name=credencial].create").val($("input[name=credencial][data-class=cliente]").val());
        $("input[name=credencial].create").change();
        $("#form-cliente").each(function () {
            this.reset();
        });
    });
});
