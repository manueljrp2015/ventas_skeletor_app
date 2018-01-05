$(document).ready(function() {

	 $('#_und').select2({
        placeholder: 'Unidad',
        width: '100%'
    });

	 $('#_cate').select2({
        placeholder: 'Catergoria',
        width: '100%'
    });

	 $('#_subcate').select2({
        placeholder: 'Sub-catergoria',
        width: '100%'
    });

	 $('#_line').select2({
        placeholder: 'Linea',
        width: '100%'
    });

	$('.datepicker').pickadate({
        selectMonths: true, 
        selectYears: 15,
        format: "yyyy-mm-dd",
        months_full: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octobre', 'Noviembre', 'Deciembre'],
        months_short: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdays_full: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'jueves', 'Viernes', 'Sabado'],
        weekdays_short: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'],
    });
	
	var fmprd = $("#fmprd");

	fmprd.validate({
		ignore: [],
		rules:{
			_sku:{
				required: true
			},
			_product:{
				required: true
			},
			_ean:{
				required: true,
				number: true
			},
			_eanbox:{
				required: true,
				number: true
			},
			_dun:{
				required: true,
				number: true
			},
			_und:{
				required: true
			},
			_cost:{
				required: true,
				number: true,
				min: 1
			},
			_cate:{
				required: true
			},
			_subcate:{
				required: true
			},
			_line:{
				required: true
			},
			_price1:{
				required: true,
				number: true,
				min: 1
			},
			_price2:{
				required: true,
				number: true,
				min: 1
			},
			_price3:{
				required: true,
				number: true,
				min: 1
			},
			_price4:{
				required: true,
				number: true,
				min: 1
			},
			_wieght:{
				required: true,
				number: true,
				min: 1
			},
			_height:{
				required: true,
				number: true,
				min: 1
			},
			_width:{
				required: true,
				number: true,
				min: 1
			},
			_large:{
				required: true,
				number: true,
				min: 1
			},
			_descu:{
				number: true,
				min: 1
			},
			_available_real:{
				number: true,
				min: 1
			},
			_available:{
				number: true,
				min: 1
			},
			_min_measure:{
				number: true,
				min: 1
			},
			_max_measure:{
				number: true,
				min: 1
			},
			_expire:{
				date: true
			}
		},
		messages:{
			_sku:{
				required: "Campo Requerido"
			},
			_product:{
				required: "Campo Requerido"
			},
			_ean:{
				required: "Campo Requerido",
				number: "Caracteres no permitidos solo numeros",
			},
			_eanbox:{
				required: "Campo Requerido",
				number: "Caracteres no permitidos solo numeros",
			},
			_dun:{
				required: "Campo Requerido",
				number: "Caracteres no permitidos solo numeros",
			},
			_und:{
				required: "Campo Requerido"
			},
			_cost:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_cate:{
				required: "Campo Requerido"
			},
			_subcate:{
				required: "Campo Requerido"
			},
			_line:{
				required: "Campo Requerido"
			},
			_price1:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_price2:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_price3:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_price4:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_wieght:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_height:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_width:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_large:{
				number: "Caracteres no permitidos solo numeros",
				required: "Campo Requerido",
				min: "El Valor debe ser mayor a 0"
			},
			_descu:{
				number: "Caracteres no permitidos solo numeros",
				min: "El Valor debe ser mayor a 0"
			},
			_available_real:{
				number: "Caracteres no permitidos solo numeros",
				min: "El Valor debe ser mayor a 0"
			},
			_available:{
				number: "Caracteres no permitidos solo numeros",
				min: "El Valor debe ser mayor a 0"
			},
			_min_measure:{
				number: "Caracteres no permitidos solo numeros",
				min: "El Valor debe ser mayor a 0"
			},
			_max_measure:{
				number: "Caracteres no permitidos solo numeros",
				min: "El Valor debe ser mayor a 0"
			},
			_expire:{
				date: "Ingrese una fecha valida"
			}
		},
		submitHandler: function(){
			swal({
                title: "Crear Producto",
                text: "Esta seguro de realizar este proceso!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Seguro",
                closeOnConfirm: false
            }, function() {
                putProduct();
            });
		}
	});

	$("#_sku").on({
		change: function(){
			$("#_codrela").val("C" + $("#_sku").val().toUpperCase());
			$("#_sku").val($("#_sku").val().toUpperCase());
		}
	});

	$("#_product").on({
		change: function(){
			$("#_product").val($("#_product").val().toUpperCase());
		}
	});

	putProduct =  function(){
		$.ajax({
			url: fmprd.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: fmprd.serialize(),
			beforeSend: function(){
				preloader.on();
			}
		})
		.done(function(response) {
			console.log("success");
			swal({
                    title: "Proceso Ejecutado",
                    text: "Se ha ejecutado el proceso satisfactoriamente",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ok",
                    closeOnConfirm: true
                },
                function() {
                    window.location.href = window.location.href;
                });
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	};

	$('#tbstores tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
    });


    var table = $("#tbstores").DataTable({
        "pageLength": 25,
        "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
        "order": [
            [0, "asc"]
        ]
    });

    table.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });




    getProduct = function(i){
        $.getJSON('get-product-from-id', {id: i}, function(json, textStatus) {
               $("#_sku").val(json.data._sku);
               $("#_product").val(json.data._product);
               $("#_ean").val(json.data._ean);
               $("#_eanbox").val(json.data._ean_pack);
               $("#_dun").val(json.data._ean_box);
               $("#_und").val(json.data._und).trigger('change');
               $("#_cost").val((parseInt(json.data._cost) == 0) ? "" : parseInt(json.data._cost));
               $("#_cate").val(json.data._category).trigger('change');
               $("#_subcate").val(json.data._subcategory).trigger('change');
               $("#_line").val(json.data._line).trigger('change');
               $("#_price1").val((parseInt(json.data._price_a) == 0) ? "" : parseInt(json.data._price_a));
               $("#_price2").val((parseInt(json.data._price_b) == 0) ? "" : parseInt(json.data._price_b));
               $("#_price3").val((parseInt(json.data._price_c) == 0) ? "" : parseInt(json.data._price_c));
               $("#_price4").val((parseInt(json.data._price_d) == 0) ? "" : parseInt(json.data._price_d));
               $("#_wieght").val((parseInt(json.data._weight) == 0) ? "" : parseInt(json.data._weight));
               $("#_height").val((parseInt(json.data._height) == 0) ? "" : parseInt(json.data._height));
               $("#_width").val((parseInt(json.data._width) == 0) ? "" : parseInt(json.data._width));
               $("#_large").val((parseInt(json.data._large) == 0) ? "" : parseInt(json.data._large));
               $("#_codrela").val(json.data._relacionship_package);
               $("#_descu").val((parseInt(json.data._discount) == 0) ? "" : parseInt(json.data._discount));
               $("#_available_real").val(parseInt(json.data._available_real));
               $("#_available").val(parseInt(json.data._available));
               $("#_min_measure").val(parseInt(json.data._min_measure));
               $("#_max_measure").val(parseInt(json.data._max_measure));
               $("#_expire").val(json.data._expire);
               $("#id").val(json.data.id);
               $('ul.tabs').tabs('select_tab', 'test1');
               $("#btsaveprod").text('actualizar');
               fmprd.removeAttr('action').attr('action', 'update-product');

        });
    }

});