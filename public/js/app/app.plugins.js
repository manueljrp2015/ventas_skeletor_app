$(function() {
	$('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 100,
        today: lang["app_pickadate_btn_today"],
        clear: lang["app_pickadate_btn_clear"],
        close: lang["app_pickadate_btn_close"],
        closeOnSelect: true,
        closeOnClear: true,
        format: 'dd-mm-yyyy',
    });

    loaderCustom = function(w, msg){
        return  '<span style="text-align: center;"><img class="center-align" src="../public/images/drawable-xxxhdpi-icon.gif" width="'+w+'px" alt=""><br>'+msg+'...</span>';
    }
});