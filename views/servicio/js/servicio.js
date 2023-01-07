var table;

$(document).ready(function(){
 alert('probando jquery');
    ListaServicio();
})


function ListaServicio(){
  table= $('#tblRegistros').DataTable(
       {responsive: true,
          language: {
              processing:     "Traitement en cours...",
              search:         "Buscar por:",
              lengthMenu:    "Mostrar _MENU_ Elementos",
              info:           "Mostrando _START_ a _END_ de _TOTAL_ Elementos",
              infoEmpty:      "Mostrando 0 registros de 0 registros encontrados",
              infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
              infoPostFix:    "",
              loadingRecords: "Chargement en cours...",
              zeroRecords:    "<span class='text-danger'>No se encontro ningún elemento.</span>",
              emptyTable:     "<span class='text-danger' id='texto-rojo'>No se encontro ningún registro disponible.</span>",
              paginate: {
                  first:      "Premier",
                  previous:   "Anterior",
                  next:       "Siguiente",
                  last:       "Dernier"
              },
              aria: {
                  sortAscending:  ": activer pour trier la colonne par ordre croissant",
                  sortDescending: ": activer pour trier la colonne par ordre décroissant"
              }
          },
        "ajax":{
            "url":"servicio/ListaServicios",
            "type":"GET",
            "dataSrc":""
        },
        "columns":[
            {"data":"N°"},
            {"data":"DESCRIPCION"},
            {"defaultContent":`<div class=btn-group>
            <button class='editar btn btn-warning btn-flat'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button>
            </div>`}


        ]
          
      } );
      
}
function OpenForms(flag){
    console.log('hola');
    if(flag){
        $('#modalAgregar').modal('show');
        console.log('abriendo modal')
    }else{
        console.log('cerrando modal')
        $('#modalAgregar').modal('toggle');
        $('#modalAgregar').trigger('reset');
    }
   
}
$(document).on('submit','#frmRegistros',function(e){
    console.log("funcion submitt desde servicio.js");
    e.preventDefault();
   var datos=$('#frmRegistros').serialize();
   $.ajax({
        type:'POST',
        url:'servicio/Registrar',
        data:datos,
        dataType:'JSON',
        success:function(response){
           
            alert(response.mensaje);
        },
        error:function(response){
          
            console.log(response);
            
        }

   })
   console.log(datos);
})