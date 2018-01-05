$(document).ready(function() {
	

	var fmodbc = $("#fmodbc");



	fmodbc.validate({
		ignore: [],
		rules:{
			query:{
				required: true
			}
		},
		messages:{
			query:{
				required: "Ingrese query a ejecutar"
			}
		},
		submitHandler: function(){
			processQuery();
		}
	});


	processQuery = function(){
		$.ajax({
			url: 'process-query',
			type: 'POST',
			dataType: 'html',
			data: {query: $("#query").val()},
			beforeSend: function(){
				preloader.on();
			}
		})
		.done(function(response) {
			console.log("success");
			preloader.off();

			$("#response").empty().append(response);

			$("#table-warehouse").DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	};
});