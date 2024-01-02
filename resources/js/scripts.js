    function maskMercosul(selector) {
        var MercoSulMaskBehavior = function (val) {
            var myMask = 'AAA0A00';
            var mercosul = /([A-Za-z]{3}[0-9]{1}[A-Za-z]{1})/;
            var normal = /([A-Za-z]{3}[0-9]{2})/;
            var replaced = val.replace(/[^\w]/g, '');
            if (normal.exec(replaced)) {
                myMask = 'AAA-0000';
            } else if (mercosul.exec(replaced)) {
                myMask = 'AAA-0A00';
            }
            return myMask;
        },
        mercoSulOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(MercoSulMaskBehavior.apply({}, arguments), options);
            }
        };
        $(function() {
            $(selector).bind('paste', function(e) {
                $(this).unmask();
            });
            $(selector).bind('input', function(e) {
                $(selector).mask(MercoSulMaskBehavior, mercoSulOptions);
            });
        });
    }