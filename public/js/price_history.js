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

            if (data.hasOwnProperty('cash') && data.hasOwnProperty('credit_card')) {
                $("#cash").val(data['cash']);
                $("#credit_card").val(data['credit_card']);
            } else {
                $("#cash").val("0");
                $("#credit_card").val("0");
            }
        });
    });

    $('#price_history_table').DataTable({
        "pageLength": 10
    });

    //get graph data
    $.ajax({
        method: "GET",
        url: $("#myChart").attr("data-url"), //"../price_history/graph",
        data: {
            store_id: store_id
        },
        dataType: 'json'
    }).done(function( data ) {
        var formatted_date = [];

        $.each(data.date, function( index, value ) {
            formatted_date.push(moment(value).toDate());
        });

        var ctx = document.getElementById("myChart").getContext('2d');
        var timeFormat = 'MM/DD/YYYY';

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: "Cash",
                    data: data.cash,
                    backgroundColor: "#00baff",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    label: "Credit Card",
                    data: data.credit_card,
                    backgroundColor: "#ff4f62",
                    borderColor: "#c13b47",
                    fill: false
                }],
                labels: formatted_date,
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:"Price History Graph"
                },
                tooltips: {
                    /*position: position,*/
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    xAxes: [{
                        type: "time",
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        },
                        time: {
                            unit: 'day',
                            tooltipFormat: 'MMMM D YYYY'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Dollars'
                        }
                    }]
                }
            }
        });
    }).fail(function( data ) {
        console.error('Error:', data);
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
