<div class="modal fade show" id="alert-modal-reativar" style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h4 class="modal-title" style="color:white">Cuidado...</h4>
      </div>
      <div class="modal-body">
        <span id="enable-text" style="color: white;">A avaliação será ativada novamente e ficará disponível para ser aplicada normalmente .<br>Tem certeza que deseja reativar a avaliação?</span>
        <input id="id-reativar" hidden>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-outline-light" style="color: white; border-color: white;" 
        onclick="$('#alert-modal-reativar').hide()">Cancelar</button>
        <button id="confirmar-reativacao" class="btn btn-outline-light" style="color: white; border-color: white;" 
        >Sim, Reativar</button>
      </div>
    </div>
  </div>
</div>