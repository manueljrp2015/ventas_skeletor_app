$(function() {

    var tbw1 = $("#table-warehouse");
    tbw1.DataTable({
        "pageLength": 20,
        "order": [
            [0, "desc"]
        ]
    });

    $(".modal").modal();
    $('.modal').modal({
        dismissible: false,
        opacity: .3,
        inDuration: 300,
        outDuration: 200,
        startingTop: '100%',
      	endingTop: '10%', 
    });

    

    addInfo =  function(id){
    	preloader.on();
    	$.getJSON('get-information-add', {id: id}, function(json, textStatus) {
            preloader.off();
    			$("#rut").val("").val(json.infoadd._rut_short);
                $("#infof").val("").val(json.infoadd._razon_social);
                $("#infora").val("").val(json.infoadd._razon_social_real);
                $("#inforutc").val("").val(json.infoadd._rut_long);
                $("#codgiro").val("").val(json.infoadd._giro_id);
                $("#codpais").val("").val(json.infoadd._pais_id);
                $("#codreg").val("").val(json.infoadd._region_id);
                $("#codciu").val("").val(json.infoadd._ciudad_id);
                $("#codcom").val("").val(json.infoadd._comuna_id);
                $("#dird").val("").val(json.infoadd._dirdesp);
                $("#dirfac").val("").val(json.infoadd._dirfact);
                $("#emcon").val("").val(json.infoadd._emailc);
                $("#emaildte").val("").val(json.infoadd._emaildte);
                
                $("#modal1").modal('open');
    	});
    };

});