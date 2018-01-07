$( document ).ready(function() {

    //add state options to select
    $.ajax({
        method: "GET",
        url: "../../js/states.json",
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