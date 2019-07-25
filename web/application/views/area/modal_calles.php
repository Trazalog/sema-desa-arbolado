<div class="modal" id="modal_calles" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Calles</h4>
      </div>

      <div class="modal-body" id="modalBodyArticle">
         <div class="row">
             <div class="col-xs-12 table-responsive" id="modalcalles">
             </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
 $(document).off('click','.tablacalles_nuevo').on('click', '.tablacalles_nuevo', function()
  {
    
    var calle = $(this).closest('tr').data('json')[0];
    console.log(TrActual.attr('data-calles'));
    if(TrActual.attr('data-calles') != ''){
    calles=JSON.parse(TrActual.attr('data-calles'));
    }else{
      calles=[];
    }
    calles.push(calle);
    calles = JSON.stringify(calles);
    TrActual.attr('data-calles',calles);
    $("#modal_calles").modal('hide');
  });
</script>