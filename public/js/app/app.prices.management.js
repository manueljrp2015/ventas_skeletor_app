$(function() {

    runScript = function(e, p, columns, i) {
        if (e.keyCode == 13) {
            e.preventDefault();
            preloader.on();
            $.getJSON('update-price', {
                price: p,
                col: columns,
                idp1: i
            }, function(json, textStatus) {
                if (json.data == true) {
                    preloader.off();
                    swal("Precio Actualizado.");

                }
            });
        }
    }

    $("#upload-button").click(function(event) {

        if ($("#store_id_5").val() == null || $("#file").val() == "") {
            swal("Proceso Fallido!", "complete la informacion requerida probablemente a omitido alguno!", "warning");
            return false
        } else {
            uploadFile();
        }

    });

    $('#store_id_5').select2({
        placeholder: 'Seleccione Clientes...',
        width: '100%'
    });

    $('#store_id_6').select2({
        placeholder: 'Seleccione Clientes...',
        width: '100%'
    });

    $('#store_id_7').select2({
        placeholder: 'Origen',
        width: '100%'
    });

    $('#lprod, #store_id_10, #store_id_11').select2({
        placeholder: 'Productos',
        width: '100%'
    });

    $('#store_id_8').select2({
        placeholder: 'Destino',
        width: '100%'
    });

    $('#store_id_9').select2({
        placeholder: 'Seleccione Clientes...',
        width: '100%'
    });


    $("#print-price-list").click(function(event) {

    	var product = $("#store_id_11").val().toString();

    	if(product == null){
    		return false;
    	}
    	else{
    		window.open("precios-lista?product="+product, '_blank');
    	}
    	
    });


    $("#print-price").click(function(event) {

    	var client  = $("#store_id_9").val().toString();
    	var product = $("#store_id_10").val().toString();

    	if(client == null || product == null){
    		return false;
    	}
    	else{
    		window.open("precios-cliente?client="+client+"&product="+product, '_blank');
    	}
    	
    });


    var fmfile = $("#fmfile");
    var process = $("#process");

    onLoadFile = function(event) {
        var input = event.target;
        var file = input.files[0];


        var tbp = '<table class="display responsive-table datatable-example highlight striped">' +
            '<thead>' +
            '<tr>' +
            '<th align="center">Archivo</th>' +
            '<th align="center">Tamaño</th>' +
            '<th align="center">Tipo</th>' +
            '<th align="center">F/modificación</th>' +
            '</tr></thead><tbody>' +
            '<tr>' +
            '<td align="center">' + file.name + '</td>' +
            '<td align="center">' + Math.ceil(parseFloat(file.size / 1024)) + ' Kb</td>' +
            '<td align="center">' + file.type + '</td>' +
            '<td align="center">' + moment(file.lastModified).format('LLLL') + '</td>' +
            '</tr></body></table>';

        $("#info-file").empty().append(tbp);

    }


    uploadFile = function() {

        var file = document.getElementById("file");
        var formData = new FormData();
        formData.append('fileexcel', file.files[0]);
        formData.append('id_store', $("#store_id_5").val());

        $.ajax({
                url: 'upload-files-excel',
                type: 'POST',
                processData: false,
                contentType: false,
                async: true,
                dataType: 'json',
                data: formData,
                beforeSend: function() {
                    preloader.on();
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('#porcent').empty().html(Math.round(percentComplete * 100) + "%");
                            process.attr("style", "width:" + Math.round(percentComplete * 100) + "%");
                        }

                    }, false);
                    return xhr;
                }
            })
            .done(function(response) {
                preloader.off();
                console.log("success");

                var tbp = '<table class="display responsive-table datatable-example highlight striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th align="center">Respuesta</th>' +
                    '</tr></thead><tbody>' +
                    '<tr>' +
                    '<td align="center"><a href="' + response.data.file + '" download="log-response.txt" >Click aqui para descargar la respuesta</a></td>' +
                    '</tr><tr><td>' + file_get_contents(response.data.file) + '</td></tr></body></table>';

                $("#info-file").empty().append(tbp);



                swal({
                        title: "Proceso Ejecutado",
                        text: "Se ha cargado la lista de precios con exito, puede descargar el log de resultado",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {
                        //window.location.href = window.location.href;
                    });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    };

    $("#store_id_5").change(function(event) {
        getPriceStore();
    });


    getListPrice = function() {
        $.ajax({
                url: 'get-list-price',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {

                }
            })
            .done(function(response) {
                var tb;

                tb += '<table id="tbprices" class="display responsive-table datatable-example" >' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">ID#</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">SKU</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">ESTADO</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">PRODUCTO</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">LINEA</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">PRECIO A</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">PRECIO B</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">PRECIO C</th>' +
                    '<th style="border-right: 1px solid #cfd8dc; text-align: center;">PRECIO D</th>	' +
                    '</tr>' +
                    '</thead>' +
                    '<tfoot>' +
                    '<tr>' +
                    '<th>ID#</th>' +
                    '<th>SKU</th>' +
                    '<th>ESTADO</th>' +
                    '<th>PRODUCTO</th>' +
                    '<th>LINEA</th>' +
                    '<th>PRECIO A</th>' +
                    '<th>PRECIO B</th>' +
                    '<th>PRECIO C</th>' +
                    '<th>PRECIO D</th>' +
                    '</tr>' +
                    '</tfoot>' +
                    '<tbody>';

                $.each(response.data, function(index, val) {
                    tb += '<tr>' +
                        '<td style="border-right: 1px solid #cfd8dc; text-align: center;">' + val.id + '</td>' +
                        '<td style="border-right: 1px solid #cfd8dc; text-align: center;">' + val._sku + '</td>' +
                        '<td style="border-right: 1px solid #cfd8dc; text-align: center;">' + val._status + '</td>' +
                        '<td style="border: 1px solid #cfd8dc;">' + val._product + '</td>' +
                        '<td style="border-right: 1px solid #cfd8dc; text-align: center;">' + val._line + '</td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;"><form><input type="hidden" name="id" value="' + val.id + '"><input type="text" value="' + val._price_a + '" name="price" id="price" style="width: 120px; text-align: right;" onkeypress="return runScript(event, this.form.price.value, 0, this.form.id.value)"></form></td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;"><form><input type="hidden" name="id" value="' + val.id + '"><input type="text" value="' + val._price_b + '" name="price" id="price" style="width: 120px; text-align: right;" onkeypress="return runScript(event, this.form.price.value, 1, this.form.id.value)"></form></td></td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;"><form><input type="hidden" name="id" value="' + val.id + '"><input type="text" value="' + val._price_c + '" name="price" id="price" style="width: 120px; text-align: right;" onkeypress="return runScript(event, this.form.price.value, 2, this.form.id.value)"></form></td></td>' +
                        '<td style="border: 1px solid #cfd8dc; text-align: right;"><form><input type="hidden" name="id" value="' + val.id + '"><input type="text" value="' + val._price_d + '" name="price" id="price" style="width: 120px; text-align: right;" onkeypress="return runScript(event, this.form.price.value, 3, this.form.id.value)"></form></td></td>' +
                        '</tr>';
                });
                tb += '</tbody></table>';

                $("#div-price").empty().append(tb);

                $('#tbprices tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
                });


                var table = $("#tbprices").DataTable({
                    "pageLength": 30,
                    "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
                    "order": [
                        [3, "asc"]
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

            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    getListPrice();

    getPriceStore = function() {


        if ($("#store_id_5").val() == null) {
            $("#tb-prices").empty().append('<h4>Consulte los clientes para visualizar su listado de precios.</h4>');
            return false;
        }
        var client = $("#store_id_5").val().toString();
        $.ajax({
                url: 'get-prices-for-client',
                type: 'POST',
                dataType: 'json',
                data: {
                    client: client
                },
                beforeSend: function() {
                    preloader.on();
                    $("#tb-prices").empty().append(loaderCustom(70, "Buscando Lista de Precios"));
                }
            })
            .done(function(response) {
                preloader.off();

                var tb;

                tb += '<table id="table-prices" class="display responsive-table datatable-example">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>STS</th>' +
                    '<th>ID</th>' +
                    '<th>SKU</th>' +
                    '<th>PRODUCT</th>' +
                    '<th>LINEA</th>' +
                    '<th>PRICE</th>' +
                    '<th>DESCUENTO</th>' +
                    '<th>PROCENTAJE</th>' +
                    '<th>CLIENTE</th>' +
                    '<th>#</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tfoot>' +
                    '<tr>' +
                    '<th>STS</th>' +
                    '<th>ID</th>' +
                    '<th>SKU</th>' +
                    '<th>PRODUCT</th>' +
                    '<th>LINEA</th>' +
                    '<th>PRICE</th>' +
                    '<th>DESCUENTO</th>' +
                    '<th>PROCENTAJE</th>' +
                    '<th>CLIENTE</th>' +
                    '<th>#</th>' +
                    '</tr>' +
                    '</tfoot>' +
                    '<tbody>';

                $.each(response.data, function(index, val) {

                    if (val._status_product == "a") {
                        var st = '<div class="chip green white-text">ACTIVO</div>';
                    } else {
                        var st = '<div class="chip red white-text">BOQUEADO</div>';
                    }

                    tb += '<tr>' +
                        '<td style="text-align: center">' + st + '</td>' +
                        '<td align="center">' + val.idproduc + '</td>' +
                        '<td align="right">' + val._sku + '</td>' +
                        '<td align="right">' + val._product + '</td>' +
                        '<td align="right">' + val.linea + '</td>' +
                        '<td><form><input type="hidden" name="id" value="' + val.id + '"><input type="hidden" name="store" value="' + val._store_id + '"><input type="hidden" name="product" value="' + val._producto_id + '"><input type="hidden" name="price_old" value="' + val._price + '"><input type="text" value="' + number_format(val._price, 2, ",", ".") + '" name="price" id="price" style="width: 120px; text-align: right; " onkeypress="return updatePriceClient(event, this.form.price.value, this.form.id.value,0, this.form.store.value, this.form.product.value, this.form.price_old.value)" ></form></td>' +
                        '<td><form><input type="hidden" name="id" value="' + val.id + '"><input type="hidden" name="store" value="' + val._store_id + '"><input type="hidden" name="product" value="' + val._producto_id + '"><input type="hidden" name="price_old" value="' + val._price + '"><input type="text" value="' + number_format(val._discount, 2, ",", ".") + '" name="price" id="price" style="width: 120px; text-align: right; " onkeypress="return updatePriceClient(event, this.form.price.value, this.form.id.value, 1, this.form.store.value, this.form.product.value, this.form.price_old.value)"" ></form></td>' +
                        '<td><form><input type="hidden" name="id" value="' + val.id + '"><input type="hidden" name="store" value="' + val._store_id + '"><input type="hidden" name="product" value="' + val._producto_id + '"><input type="hidden" name="price_old" value="' + val._price + '"><input type="text" value="' + val._percentage + '" name="price" id="price" style="width: 120px; text-align: right; " onkeypress="return updatePriceClient(event, this.form.price.value, this.form.id.value, 2, this.form.store.value, this.form.product.value, this.form.price_old.value, 1)" ></form></td>' +
                        '<td>' + val._store + '</td>' +
                        '<td><a href="javascript: void(0)" onclick="openModal(' + val.id + ',' + val.idproduc + ')" class="waves-effect waves-light" title="transferir"><i class="material-icons medium">send</i></a></td>' +
                        '</tr>';
                });


                tb += '</tbody></table>';

                $("#tb-prices").empty().append(tb);



                $('#table-prices tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
                });


                var table = $("#table-prices").DataTable({
                    "pageLength": 30,
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
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };

    $("#store_id_7").change(function(event) {
        getPriceStoreSelect();
    });


    getPriceStoreSelect = function() {
        var client = $("#store_id_7").val().toString();
        $.ajax({
                url: 'get-prices-for-client',
                type: 'POST',
                dataType: 'json',
                data: {
                    client: client
                },
                beforeSend: function() {
                    preloader.on();
                    $("#load2").empty().append(loaderCustom(60, "Buscando Lista de Precios"));
                }
            })
            .done(function(response) {
                preloader.off();
                $("#load2").empty();
                var select;

                $.each(response.data, function(index, val) {
                    select += '<option value="' + val.idproduc + '">' + val._sku + ' - ' + val._product + '</option>';
                });

                $("#lprod").empty().append(select).trigger('change');

            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
    };


    updatePriceClient = function(e, p, i, c, store, product, price_old, percent = 0) {

        if (e.keyCode == 13) {
            e.preventDefault();
            preloader.on();
            $.getJSON('update-price-client', {
                price: p,
                id: i,
                column: c,
                store: store,
                product: product,
                price_old: price_old,
                percent: percent
            }, function(json, textStatus) {
                if (json.data == true) {
                    preloader.off();
                    swal("Precio Actualizado.");
                }
            });
        }
    };

    $(".modal").modal();
    $('.modal').modal({
        dismissible: false,
        opacity: .3,
        inDuration: 300,
        outDuration: 200,
        startingTop: '100%',
        endingTop: '10%',
    });

    $("#modal1").modal({
        complete: function() {
            $("#store_id_6").val('').trigger('change');
        }
    });

    $("#modal2").modal({
        complete: function() {
            $("#store_id_7").val(' ').trigger('change');
            $("#store_id_8").val('').trigger('change');
            $("#lprod").val('').trigger('change');
        }
    });

    $("#modal3").modal({
        complete: function() {
            $("#store_id_9").val(' ').trigger('change');
            $("#store_id_10").val('').trigger('change');
        }
    });


     $("#modal4").modal({
        complete: function() {
            $("#store_id_11").val('').trigger('change');
        }
    });

    openModal = function(id, idp) {
        $("#modal1").modal("open");
        $("#id2").val(id);
        $("#id3").val(idp);
    };


    openModalMulti = function() {
        $("#modal2").modal("open");
    };

    printPrice = function() {
        $("#modal3").modal("open");
    };

    printPriceList = function() {
        $("#modal4").modal("open");
    };

    $("#tranfer").click(function(event) {
        event.preventDefault();
        if ($("#store_id_6").val() == null) {
            return false;
        }
        var client = $("#store_id_6").val().toString();
        $.ajax({
                url: 'transfer-prices',
                type: 'POST',
                dataType: 'json',
                data: {
                    client: client,
                    id: $("#id2").val(),
                    idpro: $("#id2").val()
                },
                beforeSend: function() {
                    $("#load").empty().append(loaderCustom(60, "Transfiriendo Precios"));
                }
            })
            .done(function(response) {
                $("#load").empty();
                swal({
                        title: "Proceso Ejecutado",
                        text: "Se ha transferido el producto a los clientes seleccionados, resultado: " + response.data.res,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {

                    });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    });

    $("#tranfer-multiple").click(function(event) {
        event.preventDefault();

        var origen = $("#store_id_7").val();
        var product = $("#lprod").val().toString();
        var destino = $("#store_id_8").val();

        $.ajax({
                url: 'transfer-prices-multiple',
                type: 'POST',
                dataType: 'json',
                data: {
                    origen: origen,
                    product: product,
                    destino: destino
                },
                beforeSend: function() {
                    $("#load2").empty().append(loaderCustom(60, "transfiriendo productos"));
                }
            })
            .done(function(response) {
                $("#load2").empty()
                swal({
                        title: "Proceso Ejecutado",
                        text: "Se han transferido los producto al clientesl seleccionado, resultado: " + response.data.res,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ok",
                        closeOnConfirm: true
                    },
                    function() {

                    });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    });
});