$( document ).ready(function() {

    //show/hide form
    $( "#add_store_btn" ).click(function() {
        $("#add_store_form").toggle();
    });

    //add state options to select
    $.ajax({
        method: "GET",
        url: "js/states.json",
        dataType: 'json'
    }).done(function( data ) {
        //console.log(data);
        $.each(data, function( index, value ) {
            $("#state").append('<option value="' + value['abbreviation'] + '">' + value['name'] + '</option>');
        });
    }).fail(function( data ) {
        console.error('Error:', data);
    });

});