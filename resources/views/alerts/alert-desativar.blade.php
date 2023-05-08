<div class="modal fade show" id="alert-modal-desativar" style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-warning">
      <div class="modal-header">
        <h4 class="modal-title" style="color:black">Cuidado...</h4>
      </div>
      <div class="modal-body">
        <span id="disable-text" style="color: black;">A avaliação será desativada e não ficará disponível para a aplicação enquanto não for ativada novamente.<br>Tem certeza que deseja desativar a avaliação?</span>
        <input id="id-desativar" hidden>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-outline-dark" style="color: black; border-color: black;" 
        onclick="$('#alert-modal-desativar').hide()">Cancelar</button>
        <button id="confirmar-desativacao" class="btn btn-outline-dark" style="color: black; border-color: black;" 
        >Sim, Desativar</button>
      </div>
    </div>
  </div>
</div>