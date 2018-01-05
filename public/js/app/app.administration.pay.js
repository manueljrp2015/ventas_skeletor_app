$(document).ready(function() {
	$(".modal").modal();
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    });

    moment.locale('es');

    $('#_store_pay').select2({
        placeholder: 'Seleccione Cliente...'
    });

});