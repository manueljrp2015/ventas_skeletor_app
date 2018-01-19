<main class="mn-inner">
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Mi Carrito</span>
          <div class="row s12 m12 l12">
            <div class="input-field col s12 m6 l12">
              <h5>Consulta el carrito de compra de tu cliente o tienda asociada a su cuenta.</h5>
              <strong>Aqui se mostrara el resumen de los pedidos que has realizados en la tienda seleccionada y que estan a espera de confirmación.</strong>
            </div>
            <div class="input-field col s12 m6 l4">
              <select name="store_id_5" id="store_id_5" class="js-states browser-default" style="width: 100%">
                <option value="" disabled="" selected=""> </option>
                <?php foreach (json_decode($listStore) as $key => $value):  ?>
                <option value="<?= $value->id ?>"><?= sprintf("%05d",$value->id)." - ".$value->_store ?></option>
                <?php endforeach; ?>
              </select>
              <div id="loader9"></div>
            </div>
            <div class="input-field col s12 m6 l2">
              <a href="javascript: void(0)" id="search" class="waves-effect waves-light btn indigo"><i class="material-icons left">search</i> Buscar</a>
            </div>
            <div class="input-field col s12 m6 l12" id="cart-list">
           <?php 
           echo $this->input->get('store ') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
  $(function() {
   
      $("#store_id_5").val('<?php echo ($this->input->get('store') != null) ? $this->input->get('store') : ''; ?>').trigger('change');

      $('select').select2({
          placeholder: 'Tiendas'
      });

      getListCart = function(q) {

          $.getJSON('<?= URL_WEB ?>mi-carrito/get-list-cart', {
              store: q
          }, function(json, textStatus) {

              var tb = '';

              preloader.on();

              if (json.list == "" || json.paycond == null) {
                  $("#cart-list").empty().append('<span class="green-text text-darken-2">No tiene pedidos pendientes.');
                  preloader.off();
              } else {

                  preloader.off();

                  tb += '<h6>Pedido No Culminado de tienda Nro. ' + q + '</h6>' +
                      /*'<table class="responsive-table striped">' +
                      '<thead>' +
                      '<tr>' +
                      '<th style="text-align: right;">Credito</th>' +
                      '<th style="text-align: right;">Consumo</th>' +
                      '<th style="text-align: right;">Saldo</th>' +
                      '</tr>' +
                      '</thead>' +
                      '<tbody>' +
                      '<tr>' +
                      '<td style="text-align: right; font-size: 20px; color: green;">' + number_format(json.paycond._credit, 2, ",", ".") + '</td>' +
                      '<td style="text-align: right; font-size: 20px; color: red;">' + number_format(json.paycond._consumption, 2, ",", ".") + '</td>' +
                      '<td style="text-align: right; font-size: 20px; color: green;">' + number_format(json.paycond._balance, 2, ",", ".") + '</td>' +
                      '</tr>' +
                      '</tbody>' +*/
                      '</table><hr><br>' +
                      '<table class="display responsive-table striped" style="font-size: 12px;">' +
                      '<thead>' +
                      '<tr>' +
                      '<th style="text-align: center;">Eliminar</th>' +
                      '<th style="text-align: center;">SKU</th>' +
                      '<th style="text-align: center;">PRODUCTO</th>' +
                      '<th style="text-align: center;">CANTIDAD</th>' +
                      '<th style="text-align: CENTER;">DISP.</th>' +
                      '<th style="text-align: right;">COSTO</th>' +
                      '<th style="text-align: center;">Ajustar Carrito</th>' +
                      '</tr>' +
                      '</thead>' +
                      '<tbody>';

                  var vol = 0;
                  var wei = 0;
                  var i = 1;
                  var tc = 0;
                  var tv = 0;
                  var tp = 0;
                  var tcosto = 0;

                  $.each(json.list, function(index, val) {

                      vol = (parseFloat(val._height) * parseFloat(val._width) * parseFloat(val._height)) * parseInt(val._cant);

                      wei = parseInt(val._cant) * parseFloat(val._weight);

                      tb += '<tr>' +
                          '<td style="text-align: center"><a href="javascript: void(0)" class="btn indigo" onclick=deleteItem(' + val.id + ')>Eliminar</a></td>' +
                          '<td style="text-align: center;">' + val._producto_sku + '</td>' +
                          '<td>' + val._product + '</td>' +
                          '<td style="width: 150px;"><input style="text-align: center" type="number" name="cant" id="cant' + i + '" min="1" max="' + parseInt(val._available) + '" value=' + parseInt(val._cant) + ' style="margin: 0;"></td>' +
                          '<td style="text-align: center;">' + parseInt(val._available) + '</td>' +
                          '<td style="text-align: right;">' + number_format(val._rode, 2, ",", ".") + '</td>' +
                          '<td style="text-align: center;"><a href="javascript: void(0)"  class="btn orange darken-4" onclick="updateOrder(' + i + ',' + val._product_id + ',' + val.id + ')"> Ajustar</a></td>' +
                          '</tr>';

                      i++;

                      tc = parseInt(tc) + parseInt(val._cant);
                      tv = parseFloat(tv) + parseFloat(vol);
                      tp = parseFloat(tp) + parseFloat(Math.round(wei * 100) / 100);
                      tcosto = parseFloat(tcosto) + parseFloat(val._rode);



                  });

                  if (json.paycond._balance - tcosto < 0) {

                      swal("Atención!", "El pedido ha superado su límite de crédito por lo cual no podrá confirmarlo, reajuste su pedido para poder confirmarlo. Si necesita aumentar su límite de crédito comuníquese con nuestras oficinas o Partner asociado.")
                      var txt = "disabled='disabled'";
                  }

                  tb += '<tr><td></td><td></td><td style="text-align: right; font-size: 16px; color: green;" id="total_volumen"></td><td style="text-align: center; font-size: 16px; color: green;">' + tc + '</td><td style="text-align: right; font-size: 16px; color: green;" id="total_peso"></td><td style="text-align: right; font-size: 16px; color: green;"></td><td></td></tr><tr><td></td><td></td><td style="text-align: center; font-size: 16px; color: green;"></td><td style="text-align: right; font-size: 16px; color: green;"></td><td style="text-align: right; font-size: 16px;">Total</td><td style="text-align: right; font-size: 16px;">' + number_format(tcosto, 2, ",", ".") + '</td><td></td></tr><tr><td></td><td></td><td></td><td style="text-align: center; font-size: 16px;"></td><td style="text-align: right; font-size: 16px;">Credito</td><td style="text-align: right; font-size: 16px;></td><td style="text-align: right; font-size: 16px;">' + number_format(json.paycond._balance, 2, ",", ".") + '</td><td></td></tr><tr><td></td><td></td><td></td><td style="text-align: center; font-size: 16px;"></td><td style="text-align: right; font-size: 16px;">Balance</td><td style="text-align: right; font-size: 16px;></td><td style="text-align: right; font-size: 16px;">' + number_format(json.paycond._balance - tcosto, 2, ",", ".") + '</td><td></td></tr><tr><td></td><td></td><td></td><td style="text-align: center; font-size: 16px;"></td><td style="text-align: right; font-size: 16px;"></td><td style="text-align: right; font-size: 16px;></td><td style="text-align: right; font-size: 16px;"></td><td><button id="process" class="waves-effect waves-light btn orange m-b-xs" ' + txt + '>Confirmar Pedido</button></td></tr></tbody></table>';

                  $("#cart-list").empty().append(tb);
              }

              $("#process").click(function(event) {
                  swal({
                      title: "Ejecutar Proceso",
                      text: "Estas seguro de realizar este proceso, le informamos que luego de confirmado el pedido se requerirá información de despacho que puede alterar el monto de su pedido.",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Confirmar Pedido",
                      cancelButtonText: "No",
                      closeOnConfirm: false,
                      closeOnCancel: true
                  }, function(isConfirm) {
                      if (isConfirm) {
                          confirmCart();
                      } else {}
                  });
              });
          });
      };

      deleteItem = function(i){
        swal({
            title: "Ejecutar Proceso",
            text: "Estas seguro de eliminar este item de su pedido",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Eliminar items",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.getJSON('<?= URL_WEB ?>mi-carrito/delete-item', {id: i}, function(json, textStatus) {
                   getListCart($("#store_id_5").val());
                });
            } else {}
        });
      };

      confirmCart = function() {
          $.ajax({
                  url: '<?= URL_WEB ?>mi-carrito/process-order',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                      store: $("#store_id_5").val(),
                      peso: $("#total_peso").html(),
                      volumen: $("#total_volumen").html()
                  },
                  beforeSend: function() {
                      preloader.on();
                  }
              })
              .done(function(response) {

                preloader.off();
                  if (response.data.msg == "done") {
                      swal({
                          title: "Pedido Generado",
                          text: "Su pedido ha sido generado "+response.data.order+" sera redireccionado para establecer los detalles de despacho.",
                          type: "warning",
                          showCancelButton: false,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "Continuar",
                          closeOnConfirm: false
                      }, function() {
                          window.location.href = "<?= URL_WEB ?>mi-carrito/order-courier?order="+response.data.order;
                      });
                  }

              })
              .fail(function() {
                  console.log("error");
              })
              .always(function() {
                  console.log("complete");
              });

      };

      updateOrder = function(i, c, id) {
          preloader.on();
          $.getJSON('<?= URL_WEB ?>mi-carrito/update-cart', {
              p: c,
              cant: $("#cant" + i).val(),
              id: id,
              store: $("#store_id_5").val()
          }, function(json, textStatus) {
              getListCart($("#store_id_5").val());
              Materialize.toast('Producto actualizado al carrito...', 2000);
              preloader.off();
              loadOrder();
          });
      };

      getListCart(<?php echo ($this->input->get('store') != null) ? $this->input->get('store') : ''; ?>);


      $("#store_id_5").change(function(event) {
          getListCart($("#store_id_5").val());
      });

      $("#search").click(function(event) {
          getListCart($("#store_id_5").val());
      });
  });
</script>