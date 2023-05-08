<div class="modal fade show" id="alert-modal-gerenciar" style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content bg-info">
      <div class="modal-header">
        <h4 class="modal-title" style="color:black">Troca de Empresa</h4>
      </div>
      <div class="modal-body">
        <span id="texto-cancelar" style="color: black;">Você irá ser redirecionado para a página principal.<br>Tem certeza que deseja alterar a empresa gerenciada?</span>
        <input id="id-gerenciamento" hidden>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-outline-dark" style="color: black; border-color: black;" 
        onclick="$('#alert-modal-gerenciar').hide()">Fechar</button>
        <button id="confirmar-gerenciamento" class="btn btn-outline-dark" style="color: black; border-color: black;" 
        >Sim, Alterar</button>
      </div>
    </div>
  </div>
</div>