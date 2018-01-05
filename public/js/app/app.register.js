$(function(){

  var fr = $("#fr");
  var loader = $('#loader1');
  var loader2 = $('#loader2');
  var loader3 = $('#loader3');
  var spinner = '<div class="progress"><div class="indeterminate"></div></div>';

  $('#typeAccount').select2({
        placeholder: 'Tipo de Cuenta'
    });

  

  $.validator.addMethod('postalCode', function (value) {
    return /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
}, lang['app_register_validation_email_format']);

  fr.validate({
    ignore: [],
    rules:{
      user:{
        required: true,
        remote:{
          url: 'validate-user',
          type: 'POST',
          data: {
            username: function(){
              return $("#user").val();
            }
          },
          beforeSend: function(){
            preloader.on();
            loader.empty().append(spinner);
          },
          complete: function(){
            preloader.off();
            loader.empty();
          }
        }
      },
      email:{
        required: true,
        email: true,
        postalCode: true,
        remote:{
          url: 'validate-mail',
          type: 'POST',
          data: {
            email: function(){
              return $("#email").val();
            }
          },
          beforeSend: function(){
            preloader.on();
            loader2.empty().append(spinner);
          },
          complete: function(){
            preloader.off();
            loader2.empty();
          }
        }
      },
      password:{
        required: true,
        minlength: 8
      },
      rpassword:{
        required: true,
        equalTo: "#password"
      },
      typeAccount:{
        required: true
      }
    },
    messages:{
      user:{
        required: lang['app_register_validation_user'],
        remote: lang['app_register_validation_user_exist']
      },
      email:{
        required: lang['app_register_validation_email'],
        email: lang['app_register_validation_email_format'],
        remote: lang['app_register_validation_email_exist']
      },
      password:{
        required: lang['app_register_validation_pass'],
        minlength: lang['app_register_validation_rpass_min']
      },
      rpassword:{
        required: lang['app_register_validation_rpass'],
        equalTo: lang['app_register_validation_rpass_confirm']
      },
      typeAccount:{
        required: lang['app_register_validation_tpaccount']
      }
    },
    submitHandler: function(){


      swal({
          title: lang["app_content_msg_confirm_register_title"],
          text: lang["app_content_msg_confirm_register_content"],
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: lang["app_content_msg_confirm_register_btconfirm"],
          cancelButtonText: lang["app_content_msg_confirm_register_btcancel"],
          closeOnConfirm: false,
          closeOnCancel: false
      }, function(isConfirm){
          if (isConfirm) {
              svReg();
          } else {
            swal(lang["app_content_msg_cancel_register_title"], lang["app_content_msg_cancel_register_content"], "warning");
          }
      });

    }
  });

  svReg = function(){
    $.ajax({
      url: fr.attr('action'),
      type: 'POST',
      data: fr.serialize(),
      beforeSend: function(){
        preloader.on();
        loader3.empty().append(spinner);
      }
    })
    .done(function(response) {
      loader3.empty();
      if(response){
        swal({
          title: lang["app_content_msg_process_register_title"],
          text: lang["app_content_msg_process_register_content"],
          type: "success",
          timer: 2000
        });

        document.getElementById('fr').reset();

        window.setTimeout(function(){
          window.location.href = "/";
        },2500);

      }
      else{
        swal(lang["app_title_msg_error_server"], lang["app_content_msg_error_server"], "warning");
      }
      preloader.off();
    })
    .fail(function() {
      preloader.off();
      loader3.empty()
    })
    .always(function() {
      preloader.off();
      loader3.empty()
    });

  };


});
