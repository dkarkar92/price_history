$( document ).ready(function() {

    var today = moment().format("YYYY-MM-DD");
    var store_id = $("#main_store_select").val();

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    $("#date").val(new Date().toDateInputValue());
    $('#date').pickadate();

    $('#date').change(function() {
        var picked_date = moment(this.value).format("YYYY-MM-DD");

        $.ajax({
            method: "GET",
            url: $("#date").attr("data-url"),  //"../price_history/price_for_day",
            data: {
                date: this.value,
                store_id: store_id
            },
            dataType: 'json'
        }).done(function( data ) {
            if (moment(picked_date).isSame(today)) {
                $("#submit_btn").removeClass("disabled");
            } else {
                console.log("here");
                $("#submit_btn").addClass("disabled");
            }

            if (data.hasOwnProperty('amount') && data.hasOwnProperty('description') && data.hasOwnProperty('payment_type')) {
                $("#amount").val(data['amount']);
                $("#description").val(data['description']);
                $("#payment_type").val(data['payment_type']);
            } else {
                $("#amount").val("0");
                $("#description").val("None");
                $("#payment_type").val("None");
            }
        });
    });

    $('#expanses_table').DataTable({
        "pageLength": 10
    });


    // on store select change url
    $( "#main_store_select" ).change(function() {
        var store_id = $(this).val();

        $( "#main_store_select option:selected" ).each(function() {
            window.location = $(this).attr("data-url");
            return false;
        });

    });
});
