@include('partials.header')
  <!--Alerts-->
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Colaborador</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de novo colaborador</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-colaborador" method="POST">
            @csrf  
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Nome do colaborador:</label>
                <input class="form-control" type="text" name="nome-colaborador" id="nome-colaborador">
              </div>
              <div class="col-md-4">
                <label>Data de Nascimento:</label>
                <input class="form-control" type="date" name="data-nasc" id="data-nasc">
              </div>           
              <div class="col-md-4">
                <label>E-mail:</label>
                <input class="form-control" type="email" name="email-colaborador" id="email-colaborador">
              </div> 
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-3">
                <label>Telefone:</label>
                <input class="form-control" type="text" name="telefone" id="telefone">
              </div> 
              <div class="col-md-3">
                <label>Gênero:</label>
                <select class="form-control" name="genero" id="genero">
                  <option value="0">Selecione o genêro</option>
                  @foreach($generos as $genero)
                  <option value="{{$genero->id_genero}}">{{$genero->nome_genero}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label>Saudação:</label>
                <select class="form-control"  name="saudacao" id="saudacao">
                  <option value="0">Selecione a Saudação</option>
                  @foreach($saudacoes as $saudacao)
                  <option value="{{$saudacao->id_saudacao}}">{{$saudacao->nome_saudacao}}</option>
                  @endforeach
                </select>
              </div>  
              <div class="col-md-3">
              <label>Estado Civil:</label>
                <select class="form-control" name="estado-civil" id="estado-civil">
                  <option value="0">Selecione o estado civil</option>
                  @foreach($estados_civis as $estado_civil)
                  <option value="{{$estado_civil->id_estado_civil}}">{{$estado_civil->nome_estado_civil}}</option>
                  @endforeach
                </select>
              </div> 
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-2">
                <label>CPF:</label>
                <input class="form-control" type="text" name="cpf" id="cpf">
              </div>
              <div class="col-md-4">
                <label>Grau de escolaridade:</label>
                <select class="form-control" type="text" name="escolaridade" id="escolaridade">
                  <option value="0">Escolha o grau de escolaridade</option>
                  @foreach($escolaridades as $escolaridade)
                  <option value="{{$escolaridade->id_escolaridade}}">{{$escolaridade->nome_escolaridade}}</option>
                  @endforeach
                </select>
              </div> 
              <div class="col-md-3">
                <label>Tipo do contrato:</label>
                <select class="form-control" type="text" name="tipo-contrato" id="tipo-contrato">
                  <option value="0">Escolha o tipo de contrato</option>
                  @foreach($tipos_contrato as $contrato)
                  <option value="{{$contrato->id_tipo_contrato}}">{{$contrato->nome_tipo_contrato}}</option>
                  @endforeach
                </select>
              </div>  
              <div class="col-md-3">
                <label>Possui Necessidade Especial: </label>
                <select class="form-control" id="necessidade-especial" name="necessidade-especial">
                  <option value="0">Não</option>
                  <option value="1">Sim</option>                  
                </select>               
              </div>
            </div>     
            <div class="row" id="input-desc-necessidade" style="display: none; padding-bottom: 10px;" >
              <div class="col-md-12" >
                <label>Descreva sua necessidade especial: </label>
                <textarea class="form-control" id="desc-necessidade" name="desc-necessidade"></textarea>
              </div>        
            </div> 
            <div class="row form-row-spacing">
            <div class="col-md-3">
                <label>Cargo:</label>
                <select class="form-control" id="cargo" name="cargo">
                  <option value="0">Selecione o cargo</option>
                  @foreach($cargos as $each)
                  <option value="{{$each->id_cargo}}">{{$each->nome_cargo}} - {{$each->nome_senioridade}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label>Deapartamento:</label>
                <select class="form-control" id="depto" name="depto">
                  <option value="0">Selecione o departamento</option>
                  @foreach($departamentos as $each)
                  <option value="{{$each->id_departamento}}">{{$each->nome_departamento}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label>Grau Hierárquico:</label>
                <select class="form-control" id="grau-hierarquico" name="grau-hierarquico">
                  <option value="0">Selecione o grau hierárquico</option>
                  @foreach($senioridades as $each)
                  <option value="{{$each->id_senioridade}}">{{$each->nome_senioridade}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label>Usuário:</label>
                <select class="form-control" id="usuario-colaborador" name="usuario-colaborador">
                  <option value="0">Selecione o email de acesso</option>
                  @foreach($usuarios_ativos as $each)
                  <option value="{{$each->id_usuario}}">{{$each->email_usuario}}</option>
                  @endforeach
                </select>
              </div>
            </div>   
            <div class="row form-row-spacing">                      
              <div class="col-md-5">
                <label>Digite seu CEP para busca automática do endereço</label>
                <input class="form-control" id="num-cep" name="num-cep" maxlength="9">
                <input id="cep-erro" value="1" hidden>   
                <span><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"> Não sei o CEP</a></span> 
              </div>
              <div class="col-md-6">
                <label>Rua:</label>
                <input class="form-control" id="logradouro"  name="logradouro" >    
              </div>
              <div class="col-md-1">
                <label>Número:</label>
                <input class="form-control" id="numero-endereco" name="numero-endereco">    
              </div>
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Bairro:</label>
                <input class="form-control" id="bairro" name="bairro" >    
              </div>
              <div class="col-md-5">
                <label>Cidade:</label>
                <input class="form-control" id="cidade" name="cidade" >    
              </div>
              <div class="col-md-1">
                <label>Estado:</label>
                <input class="form-control" id="estado" name="estado" maxlength="2">    
              </div>
              <div class="col-md-2">
                <label>País:</label>
                <select class="form-control" name="pais" id="pais">
                  @foreach($paises as $pais)
                  <option value="{{$pais->id_pais}}">{{$pais->nome_pais}}</option>
                  @endforeach
                </select>
              </div>
            </div>            
          </div>
          <div class="card-footer">
            <input class="btn btn-primary" type="submit">
          </div>
        </form>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Colaboradores cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-parentescos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Ver/Editar Dados</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $each)
             
              <tr style="text-align: center;">
                <td style="width: 10%;"><img id="foto-click-{{$each->id_colaborador}}" 
                src="/storage/images/employees/{{$each->foto_colaborador}}" 
                width="70px" height="70px" style="border-radius: 50%; cursor: pointer"
                onmouseover="this.src='/storage/images/employees/change.png'; this.style.opacity=0.5"
								onmouseout="this.src='/storage/images/employees/{{$each->foto_colaborador}}'; this.style.opacity=1"
                >
                <form id="troca-foto-{{$each->id_colaborador}}">
										@csrf
										<input type="file" id="FileInput{{$each->id_colaborador}}" style="display: none"/>
										<input type="submit" id="Up{{$each->id_colaborador}}" style="display: none;" />
								</form>   
                </td>
                <td style="width: 30%;">{{$each->nome_colaborador}}</td>
                <td style="width: 60%;">
                <a id="botao-editar-principais-{{$each->id_colaborador}}" class="btn btn-info" style="margin-left: 2px; margin-bottom: 2px;">Principais</a>
                <a id="botao-editar-documentos-{{$each->id_colaborador}}" class="btn btn-info" style="margin-left: 2px; margin-bottom: 2px;">Documentos</a>
                <a id="botao-editar-bancarios-{{$each->id_colaborador}}"  class="btn btn-info" style="margin-left: 2px; margin-bottom: 2px;">Bancários</a>
                <a id="botao-editar-beneficios-{{$each->id_colaborador}}"  class="btn btn-info" style="margin-left: 2px; margin-bottom: 2px;">Benefícios</a>
                  <a id="botao-editar-outros-{{$each->id_colaborador}}"   class="btn btn-info" style="margin-left: 2px; margin-bottom: 2px;">Outros</a>
                </td>
              </tr>
              @endforeach
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<!--Modal-editar-principais-->
<div class="modal fade" id="editar-principais" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Principais</h5>
        <button type="button" class="close" onclick="formControlReset()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-principais">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Nome do colaborador:</label>
            <input class="form-control" type="text" name="nome-colaborador" id="nome-colaborador-editar">
          </div>
          <div class="col-md-4">
            <label>Data de Nascimento:</label>
            <input class="form-control" type="date" name="data-nasc" id="data-nasc-editar">
          </div>           
          <div class="col-md-4">
            <label>E-mail:</label>
            <input class="form-control" type="email" name="email-colaborador" id="email-colaborador-editar">
          </div> 
        </div>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Telefone:</label>
            <input class="form-control" type="text" name="telefone" id="telefone-editar">
          </div> 
          <div class="col-md-3">
            <label>Gênero:</label>
            <select class="form-control" name="genero" id="genero-editar">
              <option value="0">Selecione o genêro</option>
              @foreach($generos as $genero)
              <option value="{{$genero->id_genero}}">{{$genero->nome_genero}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>Saudação:</label>
            <select class="form-control"  name="saudacao" id="saudacao-editar">
              <option value="0">Selecione a Saudação</option>
              @foreach($saudacoes as $saudacao)
              <option value="{{$saudacao->id_saudacao}}">{{$saudacao->nome_saudacao}}</option>
              @endforeach
            </select>
          </div>  
          <div class="col-md-3">
          <label>Estado Civil:</label>
            <select class="form-control" name="estado-civil" id="estado-civil-editar">
              <option value="0">Selecione o estado civil</option>
              @foreach($estados_civis as $estado_civil)
              <option value="{{$estado_civil->id_estado_civil}}">{{$estado_civil->nome_estado_civil}}</option>
              @endforeach
            </select>
          </div> 
        </div>
        <div class="row form-row-spacing">
          <div class="col-md-2">
            <label>CPF:</label>
            <input class="form-control" type="text" name="cpf" id="cpf-editar">
          </div>
          <div class="col-md-4">
            <label>Grau de escolaridade:</label>
            <select class="form-control" type="text" name="escolaridade" id="escolaridade-editar">
              <option value="0">Escolha o grau de escolaridade</option>
              @foreach($escolaridades as $escolaridade)
              <option value="{{$escolaridade->id_escolaridade}}">{{$escolaridade->nome_escolaridade}}</option>
              @endforeach
            </select>
          </div> 
          <div class="col-md-3">
            <label>Tipo do contrato:</label>
            <select class="form-control" type="text" name="tipo-contrato" id="tipo-contrato-editar">
              <option value="0">Escolha o tipo de contrato</option>
              @foreach($tipos_contrato as $contrato)
              <option value="{{$contrato->id_tipo_contrato}}">{{$contrato->nome_tipo_contrato}}</option>
              @endforeach
            </select>
          </div>  
          <div class="col-md-3">
            <label>Possui Necessidade Especial: </label>
            <select class="form-control" id="necessidade-especial-editar" name="necessidade-especial">
              <option value="0">Não</option>
              <option value="1">Sim</option>                  
            </select>               
          </div>
        </div>     
        <div class="row" id="input-desc-necessidade-editar" style="display: none; padding-bottom: 10px;" >
          <div class="col-md-12" >
            <label>Descreva sua necessidade especial: </label>
            <textarea class="form-control" id="desc-necessidade-editar" name="desc-necessidade"></textarea>
          </div>        
        </div> 
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Cargo Ocupado:</label>
            <select class="form-control" id="cargo-editar" name="cargo">
              <option value="0">Selecione o cargo</option>
              @foreach($cargos as $each)
              <option value="{{$each->id_cargo}}">{{$each->nome_cargo}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>Departamento:</label>
            <select class="form-control" id="depto-editar" name="depto">
              <option value="0">Selecione o departamento</option>
              @foreach($departamentos as $each)
              <option value="{{$each->id_departamento}}">{{$each->nome_departamento}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>Grau Hierárquico:</label>
            <select class="form-control" id="grau-hierarquico-editar" name="grau-hierarquico">
              <option value="0">Selecione o grau hierárquico</option>
              @foreach($senioridades as $each)
              <option value="{{$each->id_senioridade}}">{{$each->nome_senioridade}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>Usuário:</label>
            <select class="form-control" id="usuario-colaborador-editar" name="usuario-colaborador">
              <option value="0">Selecione o email de acesso</option>
              @foreach($usuarios_ativos as $each)
              <option value="{{$each->id_usuario}}">{{$each->email_usuario}}</option>
              @endforeach
            </select>
          </div>
        </div>   
        <div class="row form-row-spacing">                      
          <div class="col-md-5">
            <label>Digite seu CEP para busca automática do endereço</label>
            <input class="form-control" id="num-cep-editar" name="num-cep" maxlength="9">
            <input id="cep-erro-editar" value="1" hidden>   
            <span><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"> Não sei o CEP</a></span> 
          </div>
          <div class="col-md-6">
            <label>Rua:</label>
            <input class="form-control" id="logradouro-editar"  name="logradouro" >    
          </div>
          <div class="col-md-1">
            <label>Número:</label>
            <input class="form-control" id="numero-endereco-editar" name="numero-endereco">    
          </div>
        </div>
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Bairro:</label>
            <input class="form-control" id="bairro-editar" name="bairro">    
          </div>
          <div class="col-md-5">
            <label>Cidade:</label>
            <input class="form-control" id="cidade-editar" name="cidade">    
          </div>
          <div class="col-md-1">
            <label>Estado:</label>
            <input class="form-control" id="estado-editar" name="estado" maxlength="2">    
          </div>
          <div class="col-md-2">
            <label>País:</label>
            <select class="form-control" name="pais" id="pais-editar">
              @foreach($paises as $pais)
              <option value="{{$pais->id_pais}}">{{$pais->nome_pais}}</option>
              @endforeach
            </select>
          </div>
        </div>             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="formControlReset()" data-dismiss="modal">Fechar</button>
        <input name="id" id="id-editar" hidden>
        <input type="submit" class="btn btn-primary" onclick="formControlReset()" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>
<!--Modal-editar-documentos-->
<div class="modal fade" id="editar-documentos" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
        <button type="button" class="close" onclick="formControlReset()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-documentos">
        @csrf
        <label><h5>Identidade</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>RG:</label>
            <input type="text" class="form-control" id="rg" name="rg">
          </div>
          <div class="col-md-3">
            <label>Data de expedição:</label>
            <input type="date" class="form-control" id="data-expedicao-rg" name="data-expedicao-rg">
          </div>
          <div class="col-md-3">
            <label>Orgão expedidor:</label>
            <input type="text" class="form-control" id="orgao-expedidor-rg" name="orgao-expedidor-rg">
          </div>
        </div>
        <label><h5>Título de Eleitor</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Nº Inscrição:</label>
            <input type="text" class="form-control" id="num-titulo" name="num-titulo">
          </div>
          <div class="col-md-3">
            <label>Zona Eleitoral:</label>
            <input type="text" class="form-control" id="zona-eleitoral" name="zona-eleitoral">
          </div>
          <div class="col-md-3">
            <label>Seção Eleitoral:</label>
            <input type="text" class="form-control" id="secao-eleitoral" name="secao-eleitoral">
          </div>
        </div>
        <label><h5>Carteira de Trabalho</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Número:</label>
            <input type="text" class="form-control" id="num-ctps" name="num-ctps">
          </div>
          <div class="col-md-3">
            <label>Série:</label>
            <input type="text" class="form-control" id="serie-ctps" name="serie-ctps">
          </div>
          <div class="col-md-3">
            <label>PIS/PASEP:</label>
            <input type="text" class="form-control" id="pis" name="pis">
          </div>
        </div>
        <label><h5>Carteira de Habilitação</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Número da CNH:</label>
            <input type="text" class="form-control" id="num-cnh" name="num-cnh">
          </div>
        </div>  
        <label><h5>Certificado de Reservista</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Número do Certificado:</label>
            <input type="text" class="form-control" id="num-reservista" name="num-reservista">
          </div>
        </div>           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="formControlReset()" data-dismiss="modal">Fechar</button>
        <input name="id" id="id-editar-documentos" hidden>
        <input type="submit" class="btn btn-primary" onclick="formControlReset()" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>
<!--Modal-editar-bancarios-->
<div class="modal fade" id="editar-bancarios" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dados Bancários</h5>
        <button type="button" class="close" onclick="formControlReset()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-bancarios">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Banco:</label>
            <input type="text" class="form-control" id="banco" name="banco">
          </div>
          <div class="col-md-3">
            <label>Agência:</label>
            <input type="text" class="form-control" id="agencia" name="agencia">
          </div>
          <div class="col-md-3">
            <label>Número da Conta:</label>
            <input type="text" class="form-control" id="num-conta" name="num-conta">
          </div>
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="formControlReset()" data-dismiss="modal">Fechar</button>
        <input name="id" id="id-editar-bancarios" hidden>
        <input type="submit" class="btn btn-primary" onclick="formControlReset()" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>
<!--Modal-editar-beneficios-->
<div class="modal fade" id="editar-beneficios" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Benefícios do Colaborador</h5>
        <button type="button" class="close" onclick="formControlReset()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-beneficios">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Lista de Benefícios:</label>
            <select class="form-control" id="beneficios" name="beneficios[]" multiple="multiple">
            @foreach($beneficios as $beneficio)  
            <option value="{{$beneficio->id_beneficio}}">{{$beneficio->nome_beneficio}}</option>
            @endforeach
            </select>
          </div>
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="formControlReset()" data-dismiss="modal">Fechar</button>
        <input name="id" id="id-editar-beneficios" hidden>
        <input type="submit" class="btn btn-primary" onclick="formControlReset()" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>
<!--Modal-editar-outros-->
<div class="modal fade" id="editar-outros" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Outros Dados</h5>
        <button type="button" class="close" onclick="formControlReset()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-outros">
        @csrf
        <label><h5>Vencimentos</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Valor do salário:</label>
            <input type="text" class="form-control" id="salario" name="salario">
          </div>
        </div>
        <label><h5>Pessoa Jurídica</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>CNPJ:</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj">
          </div>
        </div>  
        <label><h5>Filiação</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Nome da Mãe:</label>
            <input type="text" class="form-control" id="nome-mae" name="nome-mae">
          </div>
          <div class="col-md-6">
            <label>Nome do Pai:</label>
            <input type="text" class="form-control" id="nome-pai" name="nome-pai">
          </div>
        </div>
        <label><h5>Turno</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Turno de trabalho:</label>
            <select type="text" class="form-control" id="turno" name="turno">
              <option value="Manhã">Manhã</option>
              <option value="Tarde">Tarde</option>
              <option value="Noite">Noite</option>
              <option value="Flexível">Flexível</option>
            </select>
          </div>
        </div>
        <label><h5>Contrato</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Data da Contratação</label>
            <input class="form-control" type="date" name="data-contratacao" id="data-contratacao">
          </div>
          <div class="col-md-4">
            <label>Data do fim do contrato</label>
            <input class="form-control" type="date" name="data-fim-contrato" id="data-fim-contrato">
          </div>
          <div class="col-md-4">
          <label>Periodo de experiência</label>
            <select class="form-control" name="periodo-experiencia" id="periodo-experiencia">
              <option value="0">Não</option>
              <option value="1">Sim</option>
            </select>
          </div>
        </div>
        <label><h5>Local de Nascimento</h5></label>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Naturalidade:</label>
            <input type="text" class="form-control" id="naturalidade" name="naturalidade">
          </div>
          <div class="col-md-6">
            <label>Nacionalidade:</label>
            <input type="text" class="form-control" id="nacionalidade" name="nacionalidade">
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="formControlReset()" data-dismiss="modal">Fechar</button>
        <input name="id" id="id-editar-outros" hidden>
        <input type="submit" class="btn btn-primary" onclick="formControlReset()" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>

@include('partials.footer')
<script>
$(document).ready(function(){

  $("#telefone").mask("(00) 00000-0000");
  $("#telefone-editar").mask("(00) 00000-0000");
  $("#cpf").mask("000.000.000-00");
  $("#cpf-editar").mask("000.000.000-00");
  $('#rg').mask('SS-00.000.000');
  $("#pis").mask('000.00000.00-00')

  $('#usuario-colaborador').selectize({ 
    placeholder: 'Selecione o e-mail de acesso'
  });
  $('#depto').selectize({ 
    placeholder: 'Selecione o departamento'
  });
  $('#cargo').selectize({ 
    placeholder: 'Selecione o cargo'
  });

  $("#beneficios").selectize({
    placeholder: "Selecione os benefícios"
  });


  $("#necessidade-especial").on('change', function(){
    if($("#necessidade-especial").val() == 1){
      $("#input-desc-necessidade").show();
    }else{
      $("#desc-necessidade").val('');
      $("#input-desc-necessidade").hide();
    }
  })

  //CEP
  $("#num-cep").on('keyup', function(){
      var maxLength = $(this).attr("maxlength");
      if(maxLength == $(this).val().length){
      var cep = $("#num-cep").val();
      var url = 'https://viacep.com.br/ws/'+cep+'/json/';
      $.ajax({
        url: url,
        dataType: 'json',
        type: 'get'
      }).done(function(data){
        if(data.erro){
          $("#cep-erro").val(1);
        }else{
          $("#cep-erro").val(0);
          $("#cidade").val(data.localidade);
          $("#estado").val(data.uf);
          $("#bairro").val(data.bairro);
          $("#logradouro").val(data.logradouro);
        }
      });
    }else{
      $("#cep-erro").val(1);
      $("#cidade").val('');
      $("#estado").val('');
      $("#bairro").val('');
      $("#logradouro").val('');
    }
  });
  //Editar CEP
  $("#num-cep-editar").on('keyup', function(){
      var maxLength = $(this).attr("maxlength");
      if(maxLength == $(this).val().length){
      var cep = $("#num-cep-editar").val();
      var url = 'https://viacep.com.br/ws/'+cep+'/json/';
      $.ajax({
        url: url,
        dataType: 'json',
        type: 'get'
      }).done(function(data){
        if(data.erro){
          $("#cep-erro").val(1);
        }else{
          $("#cep-erro-editar").val(0);
          $("#cidade-editar").val(data.localidade);
          $("#estado-editar").val(data.uf);
          $("#bairro-editar").val(data.bairro);
          $("#logradouro-editar").val(data.logradouro);
        }
      });
    }else{
      $("#cep-erro-editar").val(1);
      $("#cidade-editar").val('');
      $("#estado-editar").val('');
      $("#bairro-editar").val('');
      $("#logradouro-editar").val('');
    }
  });
  //Cadastro
  $("#cadastro-colaborador").on('submit', function(e){
      e.preventDefault();
      let data = $("#cadastro-colaborador").serialize();

      if($("#nome-colaborador").val() == "" || 
         $("#dn-colaborador").val() == "" ||
         $("#email").val() == "" ||
         $("#telefone").val() == "" ||
         $("#genero").val() == 0 ||
         $("#saudacao").val() == 0 ||
         $("#estado-civil").val() == 0 ||
         $("#cpf").val() == "" ||
         $("#escolaridade").val() == 0 ||
         $("#tipo-contrato").val() == 0 ||
        ($("#necessidade-especial").val() == 1 && $("#desc-necessidade").val() == "" )||
         $("#cargo").val() == 0 ||
         $("#depto").val() == 0 ||
         $("#senioridade").val() == 0  ||
         $("#num-cep").val() == "" ||
         $("#numero-endereco").val() == ""       
        ){

        if($('#nome-colaborador').val() == ""){
          $("#nome-colaborador").css('border-color','red');
        }else{
          $('#nome-colaborador').css('border-color', '#ced4da');
        }

        if($('#data-nasc').val() == ""){
          $("#data-nasc").css('border-color','red');
        }else{
          $('#data-nasc').css('border-color', '#ced4da');
        }

        if($('#email-colaborador').val() == ""){
          $("#email-colaborador").css('border-color','red');
        }else{
          $('#email-colaborador').css('border-color', '#ced4da');
        }

        if($('#telefone').val() == ""){
          $("#telefone").css('border-color','red');
        }else{
          $('#telefone').css('border-color', '#ced4da');
        }

        if($('#telefone').val() == ""){
          $("#telefone").css('border-color','red');
        }else{
          $('#telefone').css('border-color', '#ced4da');
        }

        if($('#genero').val() == 0){
          $("#genero").css('border-color','red');
        }else{
          $('#genero').css('border-color', '#ced4da');
        }
        
        if($('#saudacao').val() == 0){
          $("#saudacao").css('border-color','red');
        }else{
          $('#saudacao').css('border-color', '#ced4da');
        }

        if($('#estado-civil').val() == 0){
          $("#estado-civil").css('border-color','red');
        }else{
          $('#estado-civil').css('border-color', '#ced4da');
        }

        if($('#cpf').val() == ""){
          $("#cpf").css('border-color','red');
        }else{
          $('#cpf').css('border-color', '#ced4da');
        }

        if($("#escolaridade").val() == 0){
          $("#escolaridade").css('border-color','red');
        }else{
          $("#escolaridade").css('border-color', '#ced4da');
        }

        if($("#tipo-contrato").val() == 0){
          $("#tipo-contrato").css('border-color','red');
        }else{
          $("#tipo-contrato").css('border-color', '#ced4da');
        }

        if(($("#necessidade-especial").val() == 1 && $("#desc-necessidade").val() == "")){
          $("#desc-necessidade").css('border-color','red');
        }else{
          $('#desc-necessidade').css('border-color', '#ced4da');
        }

        if($("#cargo").val() == 0){
          $("#cargo").css('border-color','red');
        }else{
          $("#cargo").css('border-color', '#ced4da');
        }

        if($("#depto").val() == 0){
          $("#depto").css('border-color','red');
        }else{
          $("#depto").css('border-color', '#ced4da');
        
        }
        if($("#grau-hierarquico").val() == 0){
          $("#grau-hierarquico").css('border-color','red');
        }else{
          $("#grau-hierarquico").css('border-color', '#ced4da');
        }

        if($("#num-cep").val() == ""){
          $("#num-cep").css('border-color','red');
        }else{
          $("#num-cep").css('border-color', '#ced4da');
        }

        if($("#numero-endereco").val() == ""){
          $("#numero-endereco").css('border-color','red');
        }else{
          $("#numero-endereco").css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }
      else{
        $.ajax({
          url: "/colaborador",
          type: 'post',
          data: data
          
        }).done(function(data){
          data = JSON.parse(data);
          if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/colaborador");
            $('#alert-ok').show();
          }else{
            $('.error-alert-text').html('');
            $('.error-alert-text').html(data['mensagem']);
            $('#alert-modal-error').show();
          }
        })
      }
  });

  //Edição Principais
  $("#form-editar-principais").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-editar-principais").serialize();

    if($("#nome-colaborador-editar").val() == "" || 
       $("#dn-colaborador-editar").val() == "" ||
       $("#email-editar").val() == "" ||
       $("#telefone-editar").val() == "" ||
       $("#genero-editar").val() == 0 ||
       $("#saudacao-editar").val() == 0 ||
       $("#estado-civil-editar").val() == 0 ||
       $("#cpf-editar").val() == "" ||
       $("#escolaridade-editar").val() == 0 ||
       $("#tipo-contrato-editar").val() == 0 ||
      ($("#necessidade-especial-editar").val() == 1 && $("#desc-necessidade").val() == "" )||
       $("#cargo-editar").val() == 0 ||
       $("#depto-editar").val() == 0 ||
       $("#senioridade-editar").val() == 0  ||
       $("#num-cep-editar").val() == "" ||
       $("#numero-endereco-editar").val() == ""       
    ){
        if($('#nome-colaborador-editar').val() == ""){
          $("#nome-colaborador-editar").css('border-color','red');
        }else{
          $('#nome-colaborador-editar').css('border-color', '#ced4da');
        }

        if($('#data-nasc-editar').val() == ""){
          $("#data-nasc-editar").css('border-color','red');
        }else{
          $('#data-nasc-editar').css('border-color', '#ced4da');
        }

        if($('#email-colaborador-editar').val() == ""){
          $("#email-colaborador-editar").css('border-color','red');
        }else{
          $('#email-colaborador-editar').css('border-color', '#ced4da');
        }

        if($('#telefone-editar').val() == ""){
          $("#telefone-editar").css('border-color','red');
        }else{
          $('#telefone-editar').css('border-color', '#ced4da');
        }

        if($('#telefone-editar').val() == ""){
          $("#telefone-editar").css('border-color','red');
        }else{
          $('#telefone-editar').css('border-color', '#ced4da');
        }

        if($('#genero-editar').val() == 0){
          $("#genero-editar").css('border-color','red');
        }else{
          $('#genero-editar').css('border-color', '#ced4da');
        }
        
        if($('#saudacao-editar').val() == 0){
          $("#saudacao-editar").css('border-color','red');
        }else{
          $('#saudacao-editar').css('border-color', '#ced4da');
        }

        if($('#estado-civil-editar').val() == 0){
          $("#estado-civil-editar").css('border-color','red');
        }else{
          $('#estado-civil-editar').css('border-color', '#ced4da');
        }

        if($('#cpf-editar').val() == ""){
          $("#cpf-editar").css('border-color','red');
        }else{
          $('#cpf-editar').css('border-color', '#ced4da');
        }

        if($("#escolaridade-editar").val() == 0){
          $("#escolaridade-editar").css('border-color','red');
        }else{
          $("#escolaridade-editar").css('border-color', '#ced4da');
        }

        if($("#tipo-contrato-editar").val() == 0){
          $("#tipo-contrato-editar").css('border-color','red');
        }else{
          $("#tipo-contrato-editar").css('border-color', '#ced4da');
        }

        if(($("#necessidade-especial-editar").val() == 1 && $("#desc-necessidade-editar").val() == "")){
          $("#desc-necessidade-editar").css('border-color','red');
        }else{
          $('#desc-necessidade-editar').css('border-color', '#ced4da');
        }

        if($("#cargo-editar").val() == 0){
          $("#cargo-editar").css('border-color','red');
        }else{
          $("#cargo-editar").css('border-color', '#ced4da');
        }

        if($("#depto-editar").val() == 0){
          $("#depto-editar").css('border-color','red');
        }else{
          $("#depto-editar").css('border-color', '#ced4da');
        
        }
        if($("#grau-hierarquico-editar").val() == 0){
          $("#grau-hierarquico-editar").css('border-color','red');
        }else{
          $("#grau-hierarquico-editar").css('border-color', '#ced4da');
        }

        if($("#num-cep-editar").val() == ""){
          $("#num-cep-editar").css('border-color','red');
        }else{
          $("#num-cep-editar").css('border-color', '#ced4da');
        }

        if($("#numero-endereco-editar").val() == ""){
          $("#numero-endereco-editar").css('border-color','red');
        }else{
          $("#numero-endereco-editar").css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();
    }
    else{
      $.ajax({
        url: "/colaborador/editar-principais",
        type: 'post',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
        $('#alert-ok').show();
      })
    }
  });

    //Edição Documentos
    $("#form-editar-documentos").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-editar-documentos").serialize();

      $.ajax({
        url: "/colaborador/editar-documentos",
        type: 'post',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
        $('#alert-ok').show();
      })

  });

    //Edição dados bancários
    $("#form-editar-bancarios").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-editar-bancarios").serialize();

      $.ajax({
        url: "/colaborador/editar-bancarios",
        type: 'post',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
        $('#alert-ok').show();
      })

  });

  //Edição outros dados
  $("#form-editar-outros").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-editar-outros").serialize();

      $.ajax({
        url: "/colaborador/editar-outros",
        type: 'post',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
        $('#alert-ok').show();
      })

  });

    //Edição dados benefícios
    $("#form-editar-beneficios").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-editar-beneficios").serialize();

      $.ajax({
        url: "/colaborador/editar-beneficios",
        type: 'post',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
        $('#alert-ok').show();
      })

  });
  
  //Exclusão
  $('#confirmar-exclusao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-delete').val();
    $.ajax({
      url: '/cadastro-parentesco/deletar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });
  
  //Fazendo upload da foto
  $('input[id^="FileInput"]').change(function() {
      let id = this.id;
      id = id = id.slice(9); 
      $("#Up"+id).click();
  });

  $('form[id^="troca-foto-"]').on('submit', function(e){
		e.preventDefault();
    let id = this.id;  
    id = id.slice(11);
    var photo = $('#FileInput'+id).prop('files')[0];    //Arquivo
  
    var form_data = new FormData(); 
    form_data.append("id", id);
    form_data.append("photo", photo);
		
			$.ajax({
				url:'/atualiza-foto-colaborador',
				method: 'post',
				dataType: 'script',
      	cache: false,
      	contentType: false,
      	processData: false,
      	data: form_data
			}).done(function(data){
				window.location.reload();
			})
		})

})

//funções

function formControlReset(){
  $(".form-control").css("border-color", "#ced4da");
}
</script>

<script type="text/javascript">
    $('#tabela-parentescos').DataTable({
      "drawCallback":function(){

      //ao clicar para alterar a foto  
      $('img[id^="foto-click-"]').on('click', function() {
          let id = this.id;
          id = id.slice(11);
          $("#FileInput"+id ).click();
      });

      //ao clicar em excluir
      $('a[id^="botao-excluir-"]').on('click', function(e){
        e.preventDefault();
        $('#alert-modal-delete').show();
        let id = this.id;
        id = id.slice(14);
        $('#id-delete').val(id);
      });

      //ao clicar em editar principais
      $('a[id^="botao-editar-principais"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(24);
        console.log(id);
        $('#id-editar').val(id);
        $('#editar-principais').modal('show');
        $.ajax({
          url: '/colaborador/visualizar-principais/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);

          $("#num-cep-editar").val(data.cep_colaborador);
          $("#logradouro-editar").val(data.logradouro_colaborador);
          $("#numero-endereco-editar").val(data.numero_endereco_colaborador);
          $("#bairro-editar").val(data.bairro_colaborador);
          $("#cidade-editar").val(data.cidade_colaborador);
          $("#estado-editar").val(data.estado_colaborador);
          $("#pais-editar").val(data.id_estado);
          let $select = $("#cargo-editar").selectize();
          $select[0].selectize.setValue(data.id_cargo);
          $select = $("#depto-editar").selectize();
          $select[0].selectize.setValue(data.id_departamento);
          $("#nome-colaborador-editar").val(data.nome_colaborador);
          $("#data-nasc-editar").val(data.dn_colaborador);
          $("#email-colaborador-editar").val(data.email_empresarial);
          $("#telefone-editar").val(data.numero_telefone);
          $("#genero-editar").val(data.id_genero);
          $("#saudacao-editar").val(data.id_saudacao);
          $("#estado-civil-editar").val(data.id_estado_civil);
          $("#cpf-editar").val(data.cpf_colaborador);
          $("#escolaridade-editar").val(data.id_escolaridade);
          $("#tipo-contrato-editar").val(data.id_tipo_contrato);
          $("#necessidade-especial-editar").val(data.possui_deficiencia);
          if(data.possui_deficiencia == 1){
            $("#input-desc-necessidade-editar").show();
            $("#desc-necessidade-editar").val(data.tipo_necessidade_especial);
          }
          $("#grau-hierarquico-editar").val(data.id_grau_hierarquico);
          $select = $("#usuario-colaborador-editar").selectize();
          $select[0].selectize.setValue(data.id_usuario);
          $("#pais-editar").val(data.id_pais);
          $("#id-editar").val(data.id_colaborador);
          
        })
      });

      //ao clicar em editar documentos
      $('a[id^="botao-editar-documentos"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(24);
        console.log(id);
        $('#id-editar').val(id);
        $('#editar-documentos').modal('show');
        $.ajax({
          url: '/colaborador/visualizar-documentos/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);

          $("#rg").val(data.rg_colaborador);
          $("#data-expedicao-rg").val(data.data_expedicao_rg_colaborador);         
          $("#orgao-expedidor-rg").val(data.orgao_expedidor_rg_colaborador);
          $("#num-titulo").val(data.titulo_eleitor_colaborador);
          $("#zona-eleitoral").val(data.zona_eleitoral_colaborador);
          $("#secao-eleitoral").val(data.secao_eleitoral_colaborador);
          $("#num-ctps").val(data.num_ctps_colaborador);
          $("#serie-ctps").val(data.serie_ctps_colaborador);
          $("#pis").val(data.pis_colaborador);
          $("#num-cnh").val(data.cnh_colaborador);
          $("#num-reservista").val(data.doc_reservista_colaborador);
          $("#id-editar-documentos").val(data.id_colaborador);
          
        })
      });


      //ao clicar em editar bancários
      $('a[id^="botao-editar-bancarios"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(23);
        console.log(id);
        $('#id-editar-bancarios').val(id);
        $('#editar-bancarios').modal('show');
        $.ajax({
          url: '/colaborador/visualizar-bancarios/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);

          $("#banco").val(data.banco_colaborador);
          $("#agencia").val(data.agencia_conta_colaborador);
          $("#num-conta").val(data.conta_corrente_colaborador);
          $("#id-editar-bancarios").val(data.id_colaborador);
          
        })
      });

      //ao clicar em editar beneficios
      $('a[id^="botao-editar-beneficios"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(24);
        console.log(id);
        $('#id-editar-beneficios').val(id);
        $('#editar-beneficios').modal('show');
        $.ajax({
          url: '/colaborador/visualizar-beneficios/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){

          data = JSON.parse(data);
          console.log(data)
          $select = $("#beneficios").selectize();
          $select[0].selectize.setValue(data);
        })
      });

      //ao clicar em editar outros
      $('a[id^="botao-editar-outros"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(20);
        console.log(id);
        $('#id-editar-outros').val(id);
        $('#editar-outros').modal('show');
        $.ajax({
          url: '/colaborador/visualizar-outros/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);

          $("#salario").val(data.salario);
          $("#cnpj").val(data.cnpj_colaborador);
          $("#nome-mae").val(data.nome_mae_colaborador);
          $("#nome-pai").val(data.nome_pai_colaborador);
          $("#turno").val(data.turno_trabalho);
          $("#data-contratacao").val(data.data_contrato);
          $("#data-fim-contrato").val(data.vencimento_contrato);
          $("#periodo-experiencia").val(data.periodo_experiencia);
          $("#naturalidade").val(data.naturalidade_colaborador);
          $("#nacionalidade").val(data.nacionalidade_colaborador);
        })
      });

      },
      "language": {
            "lengthMenu": "Mostrando _MENU_ resultado por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Não há registros nessas condições",
            "infoFiltered": "(Filtrando de  _MAX_ registros)",
            "search":         "Busca:",
            "paginate": {
              "first":      "Primeira página",
              "last":       "Última página",
              "next":       "Próxima",
              "previous":   "Anterior"
          }
        }
      });
</script>