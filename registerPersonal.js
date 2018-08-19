$('document').ready(function()
{    
  $.ajaxSetup({
    headers: {'x-csrf-token': $('input[name="_tokenPersonal"]').attr('content')
  }
  });

  $("#change-personal").validate({
    rules:
    {
      nombres: {
        required: false,
        minlength: 2,
        maxlength: 50
      },
      appaterno: {
        required: false,
        minlength: 2,
        maxlength: 50
      },
      apmaterno: {
        required: false,
        minlength: 2,
        maxlength: 50
      },
      apmaterno: {
        required: false,
        minlength: 2,
        maxlength: 50
      },  
      correo: {
        required: false,
        minlength: 6,
        maxlength: 100,
        email: true
      }, 
      nombreusu: {
        required: false,
        minlength: 2,
        maxlength: 30
      },   
      genero: {
        required: false
      }, 
      fechanac:{
        required: false,
        format: "yyyy-mm-dd"
      },
      telefono:{
        required: false,
        maxlength: 15
      },
      celular:{
        required: false,
        maxlength: 15
      }      
    },
    messages:
    {
      nombres:{        
        minlength: "Password at least have 8 characters",
        maxlength: "maxlength"
      },
      appaterno:{        
        minlength: "Password at least have 8 characters",
        maxlength: "maxlength"
      },
      apmaterno:{        
        minlength: "Password at least have 8 characters",
        maxlength: "maxlength"
      },
      correo:{        
        minlength: "Password at least have 8 characters",
        maxlength: "maxlength",
        email: "email incorrecto"
      },
      fechanac:{
        format: "incorrecto"
      },           
      telefono:{
        maxlength: "maxlength"
      },
      celular:{
        maxlength: "maxlength"
      }
     },
     //errorElement: "span";
     submitHandler: function(form) {
        form.submit();
        alert('ok');
      }
  });

  /*$("#passwordActual").change(function(){
    var pc = $("#passwordConfirm").val();
    var pn = $("#passwordnueva").val();
    //console.log(pa);
    if(pc != null || pn != null){
      $("#actualizarPassword").attr('disabled', false);
    }
  });

  $("#passwordnueva").change(function(){
    var pc = $("#passwordConfirm").val();
    var pa = $("#passwordActual").val();
    //console.log(pa);
    if(pc != null || pa != null){
      $("#actualizarPassword").attr('disabled', false);
    }
  });  

  $("#passwordConfirm").change(function(){
    var pa = $("#passwordActual").val();
    var pn = $("#passwordnueva").val();
    //console.log(pa);
    if(pa != null || pn != null){
      $("#actualizarPassword").attr('disabled', false);
    }
  });*/

  $("#nombreusu").focusout(function (e) {
    e.preventDefault();
    var nombreusu = $('#nombreusu').val();

    $.ajax({
      type: "post",
      url: "/verificarusername",
      data: {
        nombreusu: nombreusu
      }, 
        success: function(data){
          if (data == -1) {
            $('#error-username').removeAttr("style");            
          }else{
            $('#error-username').removeAttr("style");
          }
        //alert("Se ha realizado el POST con exito "+ data);
      }
    });
  });

  $("#actualizarPersonal").click(function (e) {
    e.preventDefault();
    var fotoperfil = $('input#fotoperfil').prop('files')[0];
    var nombres = $('#nombres').val();
    var appaterno = $('#appaterno').val();
    var apmaterno = $('#apmaterno').val();
    var correo = $('#correo').val();
    var nombreusu = $('#nombreusu').val();
    var genero = $('input:radio[name=genero]:checked').val();
    var fechanac = $('#datepicker').val();
    var telefono = $('#telefono').val();
    var celular = $('#celular').val();
    var token = $('input[name="_tokenPersonal"]').val();

    $.ajax({
      type: "post",
      url: "/actualizardatosturista",
      data: {
        _token: token,
        fotoperfil: fotoperfil,
        appaterno: appaterno,
        apmaterno: apmaterno,
        nombres: nombres,
        genero: genero,
        fechanac: fechanac,
        celular: celular,
        telefono: telefono,
        nombreusu: nombreusu
      }, 
        success: function(data){
          var loc = window.location;
          var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
          var recurso = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
          var recurso = recurso.replace(new RegExp('editarperfil/', 'g'),"");
        $('#titulo-modal').empty();
        $('#titulo-modal').append('Datos Personales Actualizados');
        $('#result-img').empty;
        if(data==1){
          $('#result-img').attr('src', recurso+"images/good.png");
          /*$('#foto_perfil').fadeOut(1000);
          $('#foto_perfil').load('#foto_perfil');
          $('#foto_perfil').fadeIn(1000);*/
          $('#usuario-in').fadeOut(1000);
          $('#usuario-in').load(' #usuario-in');
          $('#usuario-in').fadeIn(1000);
        }else
          $('#result-img').attr('src', recurso+"images/wrong.png");
        $('#datoInsercion').empty();  
        $('#datoInsercion').append(data);
        $('#myModal').insertAfter($('body'));
        $("#myModal").modal();
      }
    });
  });
 });