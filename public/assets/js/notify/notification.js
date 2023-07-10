function notifyNormal(titulo, messagem) {
    $.notify({
        title: titulo,
        message: messagem
     },
     {
        type:'primary',
        allow_dismiss:true,
        newest_on_top:true ,
        mouse_over:false,
        showProgressbar:true,
        spacing:10,
        timer:5000,
        placement:{
          from:'bottom',
          align:'right'
        },
        offset:{
          x:30,
          y:30
        },
        delay:1000 ,
        z_index:10000,
        animate:{
          enter:'animated pulse',
          exit:'animated pulse'
        }
    });
}

function notifySuccess(titulo, messagem) {
    $.notify({
        title: '<i class="icofont icofont-ui-check"></i> '+titulo,
        message: messagem
     },
     {
        type:'success',
        allow_dismiss:true,
        newest_on_top:true ,
        mouse_over:false,
        showProgressbar:true,
        spacing:10,
        timer:5000,
        placement:{
          from:'bottom',
          align:'right'
        },
        offset:{
          x:30,
          y:30
        },
        delay:1000 ,
        z_index:10000,
        animate:{
          enter:'animated pulse',
          exit:'animated pulse'
        }
    });
}

function notifyError(titulo, messagem) {
    $.notify({
        title: '<i class="icofont icofont-error"></i> '+titulo,
        message: messagem
     },
     {
        type:'danger',
        allow_dismiss:true,
        newest_on_top:true ,
        mouse_over:false,
        showProgressbar:true,
        spacing:10,
        timer:5000,
        placement:{
          from:'bottom',
          align:'right'
        },
        offset:{
          x:30,
          y:30
        },
        delay:1000 ,
        z_index:10000,
        animate:{
          enter:'animated pulse',
          exit:'animated pulse'
        }
    });
}

function notifyWarning(titulo, messagem) {
    $.notify({
        title: '<i class="icofont icofont-warning-alt"></i> '+titulo,
        message: messagem
     },
     {
        type:'warning',
        allow_dismiss:true,
        newest_on_top:true ,
        mouse_over:false,
        showProgressbar:true,
        spacing:10,
        timer:5000,
        placement:{
          from:'bottom',
          align:'right'
        },
        offset:{
          x:30,
          y:30
        },
        delay:1000 ,
        z_index:10000,
        animate:{
          enter:'animated pulse',
          exit:'animated pulse'
        }
    });
}