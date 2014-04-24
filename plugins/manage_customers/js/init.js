String.prototype.ucwords = function()
{
    return this.charAt(0).toUpperCase() + this.slice(1);
};

var TDA = (function($) {

    $("#customers_listing").multipleSelect({
        filter: true,
        placeholder: "Select customers",
        onClick: function(view) {
            if (view.checked) {
                $('#customers_listing').find('option[value="' + view.value + '"]').attr('selected', 'selected');
            } else {
                $('#customers_listing').find('option[value="' + view.value + '"]').removeAttr('selected');
            }
        },
        onCheckAll: function() {
            $('#customers_listing option').each(function() {
                $(this).attr('selected', 'selected');
            });
        },
        onUncheckAll: function() {
            $('#customers_listing option').each(function() {
                $(this).removeAttr('selected');
            });
        }
    });

    $(".datepicker").datepicker();

    $(document).on('click', '#CGo', function() {
        var parent = $(this).parents('#customer_form'),
            nonce = parent.find('input[name=customer_nonce]').val(),
            from = parent.find('#customer_from').val(),
            to = parent.find('#customer_to').val();

        parent.find('#customer_from').removeClass('error');

        if (!from) {
            parent.find('#customer_from').addClass('error');
            return;
        }

        $.ajax({
            type: 'POST',
            url: TDAConfig.ajax_url,
            data: {
                action: 'customer_go',
                nonce: nonce,
                from: from,
                to: to
            },
            beforeSend: function() {
                $('#CGo').prop('disabled', true);
                $("#customers_listing").empty().multipleSelect('disable');
            },
            success: function(data) {
                $('#CGo').prop('disabled', false);

                var result = JSON.parse(data);

                for (var i in result) {
                    if (result.hasOwnProperty(i)) {
                        $("#customers_listing").append('<option value="' + result[i].id + '">' + result[i].f.ucwords() + ' ' + result[i].l.ucwords() +'</option>');
                    }
                }

                $("#customers_listing").multipleSelect('enable').multipleSelect('refresh');
            }
        });
    });

})(jQuery);