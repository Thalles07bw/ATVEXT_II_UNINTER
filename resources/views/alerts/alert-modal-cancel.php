<div class="modal fade show" id="alert-modal-cancel" style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-warning">
      <div class="modal-header">
        <h4 class="modal-title" style="color:black">Cuidado...</h4>
      </div>
      <div class="modal-body">
        <span id="texto-cancelar" style="color: black;">Você não irá mais participar do processo seletivo para a vaga.<br>Tem certeza que deseja cancelar a candidatura?</span>
        <input id="id-cancel" hidden>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-outline-dark" style="color: black; border-color: black;" 
        onclick="$('#alert-modal-cancel').hide()">Fechar</button>
        <button id="confirmar-cancelamento" class="btn btn-outline-dark" style="color: black; border-color: black;" 
        >Sim, Cancelar</button>
      </div>
    </div>
  </div>
</div>