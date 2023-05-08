          <!-- End of Main Content -->

          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; CNPJ: 22.113.898/0001-47 desenvolvido por Minas Analytics</span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up" style="padding-top: 12px"></i>
      </a>

      <!-- Logout Modal-->
      <div
        class="modal fade"
        id="logoutModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
            <button
              class="close"
              type="button"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Selecione "Logout" abaixo se você realmente quiser finalizar a sessão atual.
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-secondary"
              type="button"
              data-dismiss="modal"
            >
              Cancelar
            </button>
            <a
              class="btn btn-primary"
              href="/teste/logout">
              Logout
            </a>
          </div>
        </div>
      </div>
    </div>
<!--Modal-Configurações-->
<div class="modal fade" id="configuracoes" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configurações</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-configuracoes">
        @csrf
        <div class="row form-row-spacing" >
          <div class="col-md-12">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="idioma-apr">
              <label class="custom-control-label" for="idioma-apr">Reprovar candidato automáticamente de acordo com os níveis de idioma solicitado</label>
            </div>
          </div>
        </div>
        <div class="row form-row-spacing" >
          <div class="col-md-12">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="habilidade-apr">
              <label class="custom-control-label" for="habilidade-apr">Reprovar candidato automáticamente de acordo com os níveis de habilidade solicitada</label>
            </div>
          </div>
        </div>         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input name="id-editar-turma" id="id-editar-turma" hidden>
        <input type="submit" class="btn btn-primary" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>
<!--Modal-Suporte-->
<div class="modal fade" id="suporte" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-configuracoes">
        @csrf
        <div class="row form-row-spacing" >
          <div class="col-md-12">
            <label>Descreva seu problema</label>
            <textarea class="form-control" id="desc-problema" name="desc-problema"></textarea>
          </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Enviar">
      </div>
      </form>
    </div>
  </div>
</div>

    <!-- JQuery 3.6-->
    <script src="resources/js/jquery/jquery.min.js"></script>
    <!--Bootstrap 4.3.1-->
    <script src="resources/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!--select2-->
    <script src="resources/js/select2/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
    <!--Sweet Alert2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Core plugin JavaScript-->
    <script src="resources/js/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="resources/js/sb-admin/sb-admin-2.min.js"></script>
    <!--Gráficos-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <!--Summernote-->
    <script src="resources/js/summernote/summernote.js"></script>
    <script src="resources/js/summernote/dist_lang_summernote-pt-BR.js"></script>
    <!--Datatables-->
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!--ChartJS local-->
    <script src="resources/js/graficos/graficos-principal.js"></script>
    <!--Máscaras-->
    <script type="text/javascript" src="vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
    <!--Local Javascript-->
    <script src="resources/js/function/function.js"></script>

<script type="text/javascript">
//ao clicar em excluir
  $("#configuracoes-open").on('click', function(e){
    e.preventDefault();
    $('#configuracoes').show();
  });
</script>
  </body>
</html>