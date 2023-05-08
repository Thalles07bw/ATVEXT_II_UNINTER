<div class="modal fade show" id="alert-modal-delete" style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-warning">
      <div class="modal-header">
        <h4 class="modal-title" style="color:black">Cuidado...</h4>
      </div>
      <div class="modal-body">
        <span style="color: black;">O registro será apagado permanentemente.<br>Tem certeza que deseja excluir o registro?</span>
        <input id="id-delete" hidden>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-outline-dark" style="color: black; border-color: black;" 
        onclick="$('#alert-modal-delete').hide()">Cancelar</button>
        <button id="confirmar-exclusao" class="btn btn-outline-dark" style="color: black; border-color: black;" 
        >Sim, Excluir</button>
      </div>
    </div>
  </div>
</div>