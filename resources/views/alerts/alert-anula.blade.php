<div class="modal fade show" id="alert-modal-anula" style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-warning">
      <div class="modal-header">
        <h4 class="modal-title" style="color:black">Cuidado...</h4>
      </div>
      <div class="modal-body">
        <span style="color: black;">A questão será anulada permanentemente e seus resultados descartados.<br>Tem certeza que deseja anular a questão?</span>
        <input id="id-anular" hidden>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-outline-dark" style="color: black; border-color: black;" 
        onclick="$('#alert-modal-anula').hide()">Cancelar</button>
        <button id="confirmar-anulacao" class="btn btn-outline-dark" style="color: black; border-color: black;" 
        >Sim, Anular</button>
      </div>
    </div>
  </div>
</div>