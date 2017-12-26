$( document ).ready(function() {
    console.log( "ready!" );

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    $("#date").val(new Date().toDateInputValue());
    $('#date').pickadate();

    $('#price_history_table').DataTable({
        "pageLength": 10
    });

    $.ajax({
        method: "GET",
        url: "price_history/graph",
        dataType: 'json',
    }).done(function( data ) {
        console.log("success");
        console.log(data);
        var formatted_date = [];

        $.each(data.date, function( index, value ) {
            formatted_date.push(moment(value).toDate());
        });

        console.log(data.price_1);
        console.log(data.price_2);
        console.log(formatted_date);

        var ctx = document.getElementById("myChart").getContext('2d');
        var timeFormat = 'MM/DD/YYYY';

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: "Price 1",
                    data: data.price_1,
                    backgroundColor: "#00baff",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    label: "Price 2",
                    data: data.price_2,
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
        console.log("error");
        console.log('Error:', data);
    });

});