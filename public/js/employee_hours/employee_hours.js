
function getWeekStartEndDate() {
    console.log($("#date").val());
    var moment_date_start = moment($("#date").val(), ["DD MMMM, YYYY", "YYYY-MM-DD"]);
    var moment_date_end = moment($("#date").val(), ["DD MMMM, YYYY", "YYYY-MM-DD"]);

    var start = moment_date_start.startOf("week");
    var end = moment_date_end.endOf("week");

    start = start.format("ddd, MMM Do YYYY");
    end = end.format("ddd, MMM Do YYYY");

    var start_end = [start, end];

    return start_end;
}

function setHTMLValues(start_end) {
    $("#week_start").text(start_end[0]);
    $("#week_end").text(start_end[1]);
    $("#week_start_input").val(start_end[0]);
}

$( document ).ready(function() {

    var today = moment().format("YYYY-MM-DD");

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    $("#date").val(new Date().toDateInputValue());
    $('#date').pickadate();

    var start_end = getWeekStartEndDate();
    setHTMLValues(start_end);

    $( "#date" ).change(function() {
        var start_end = getWeekStartEndDate();
        setHTMLValues(start_end);
    });

});
