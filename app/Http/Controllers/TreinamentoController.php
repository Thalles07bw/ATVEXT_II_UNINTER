<?php

namespace App\Http\Controllers;

use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseColaborador;
use App\Classes\ClasseContrato;
use App\Classes\ClasseCurriculo;
use App\Classes\ClasseLocais;
use App\Classes\ClasseProva;
use App\Classes\ClasseTreinamento;
use App\Classes\ClasseUsuario;
use Illuminate\Http\Request;

class TreinamentoController extends Controller
{
    public function showTimeline()
    {
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        
        $ClasseTreinamento = new ClasseTreinamento();
        $data = date("Y-m-d");
        $aulas_instrutor = $ClasseTreinamento->buscaAulasInstrutor($_SESSION['id_instrutor'], $data);
       
        return view('agenda-treinamentos', [
            'nome_pagina' => 'Linha do tempo',
            'nome' => $_SESSION['nome_usuario'],
            'aulas' => $aulas_instrutor,
            'data' => $data
            
        ]);
    }
    public function showTimelineSearch(Request $request)
    {
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        
        $ClasseTreinamento = new ClasseTreinamento();
        if($request->input("data") != NULL){
            $data = $request->input("data");
        }else{
            date_default_timezone_set('America/Sao_Paulo');
            $data = Date("Y-m-d");
        }
        $aulas_instrutor = $ClasseTreinamento->buscaAulasInstrutor($_SESSION['id_instrutor'], $data);
       
        return view('agenda-treinamentos', [
            'nome_pagina' => 'Linha do tempo',
            'nome' => $_SESSION['nome_usuario'],
            'aulas' => $aulas_instrutor,
            'data' => $data
            
        ]);
    }

    public function showGeneralTimelineSearch(Request $request){

        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        
        $ClasseTreinamento = new ClasseTreinamento();

        if($request->input("data-inicio") != NULL){
            $data_inicio = $request->input("data-inicio");
        }else{
            date_default_timezone_set('America/Sao_Paulo');
            $data_inicio = Date("Y-m-d");
        }

        if($request->input("data-fim") != NULL){
            $data_fim = $request->input("data-fim");
        }else{
            date_default_timezone_set('America/Sao_Paulo');
            $data_fim = Date("Y-m-d");
        }

        if($request->input("instrutor") != NULL){
            $nome_instrutor = $request->input("instrutor");
        }else{
            date_default_timezone_set('America/Sao_Paulo');
            $nome_instrutor = "";
        }

        if($request->input("curso") != NULL){
            $nome_curso = $request->input("curso");
        }else{
            date_default_timezone_set('America/Sao_Paulo');
            $nome_curso = "";
        }



        $aulas_instrutor = $ClasseTreinamento->buscaAulasGeral($nome_curso,$nome_instrutor, $data_inicio, $data_fim);
        $instrutores = $ClasseTreinamento->buscaInstrutores($_SESSION['empresa_usuario']);
        $cursos = $ClasseTreinamento->buscaCursos($_SESSION['empresa_usuario']);
        return view('agenda-geral-treinamentos', [
            'nome_pagina' => 'Linha do tempo',
            'nome' => $_SESSION['nome_usuario'],
            'aulas' => $aulas_instrutor,
            'data_inicio' => $data_inicio,
            'data_fim' => $data_fim,
            'nome_instrutor' => $nome_instrutor,
            'nome_curso' => $nome_curso,
            'instrutores' => $instrutores,
            'cursos' => $cursos           
        ]);
    }

    public function showCourses(){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $validade_curso = $ClasseTreinamento->prazosTreinamentos();
        $tabela = $ClasseTreinamento->buscaCursos($_SESSION['empresa_usuario']);

        return view('cursos', [
            'nome_pagina' => 'Cursos',
            'nome' => $_SESSION['nome_usuario'],
            'validades' => $validade_curso,
            'tabela' => $tabela
        ]);
    }

    public function executeCourses(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $nome = $request->input('nome-curso');
        $carga_pratica = $request->input('carga-pratica');
        $carga_teorica = $request->input('carga-teorica');
        $descricao = $request->input('descricao');
        $descricao_pratica = $request->input('descricao-pratica');
        $descricao_teoria = $request->input('descricao-teoria');
        $validade = $request->input('validade');
        $unidade = $request->input('unidade');
        $empresa = $_SESSION['empresa_usuario'];
        

        $arrCursos = array($nome,$carga_pratica ,$carga_teorica,$descricao,$descricao_pratica,
        $descricao_teoria, $validade, $unidade, $empresa);

        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->cadastraCurso($arrCursos);

        echo json_encode($resposta);
    }

    public function viewCourses($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->buscaCursoPorId($id);

        echo json_encode($resposta);
    }

    public function editCourses(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $nome = $request->input('nome-curso');
        $carga_pratica = $request->input('carga-pratica');
        $carga_teorica = $request->input('carga-teorica');
        $descricao = $request->input('descricao');
        $descricao_pratica = $request->input('descricao-pratica');
        $descricao_teoria = $request->input('descricao-teoria');
        $validade = $request->input('validade');
        $unidade = $request->input('unidade');
        $id = $request->input('id-editar');
        

        $arrCursos = array($nome,$carga_pratica ,$carga_teorica,$descricao,$descricao_pratica,
        $descricao_teoria, $validade, $unidade, $id);
        
        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->editaCurso($arrCursos);
        echo json_encode($resposta);

    }

    public function deleteCourses($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->deletaCurso($id);

        echo json_encode($resposta);
    }
    


    public function showTeachers(){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();
        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseLocais = new ClasseLocais();
        $ClasseUsuario = new ClasseUsuario();
        $ClasseContrato = new ClasseContrato();
        $ClasseTreinamento = new ClasseTreinamento();
        

        
        $saudacoes = $ClasseColaborador->buscaSaudacoes();
        $generos = $ClasseCurriculo->buscaGeneros();
        $estados_civis = $ClasseCurriculo->buscaEstadoCivil();
        $usuarios_ativos = $ClasseUsuario->preencheTabelaUsuarios($_SESSION['empresa_usuario']);
        $tipos_contrato = $ClasseContrato->buscaTiposContrato();
        $escolaridades = $ClasseCurriculo->buscaNiveisFormacao();
        $paises = $ClasseLocais->buscaPaises();
        $tabela = $ClasseTreinamento->buscaInstrutores($_SESSION['empresa_usuario']);

        return view('instrutor', [
            'nome' => $_SESSION['nome_usuario'],
            'nome_pagina' => 'Instrutores',
            'saudacoes' => $saudacoes,
            'generos' => $generos,
            'estados_civis' => $estados_civis,
            'paises' => $paises,
            'usuarios_ativos' => $usuarios_ativos,
            'tipos_contrato' => $tipos_contrato,
            'escolaridades' => $escolaridades,
            'tabela' => $tabela

        ]);
  
    }
    public function executeTeachers(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $nome = $request->input('nome-instrutor');
        $data_nasc = $request->input('data-nasc');
        $email = $request->input('email-instrutor');
        $telefone = $request->input('telefone');
        $genero = $request->input('genero');
        $saudacao = $request->input('saudacao');
        $estado_civil = $request->input('estado-civil');
        $cpf = $request->input('cpf');
        $cnpj = $request->input('cnpj');
        $escolaridade = $request->input('escolaridade');
        $tipo_contrato = $request->input('tipo-contrato');
        $usuario = $request->input('usuario-instrutor');
        $especialidade = $request->input('especialidade');  
        $necessidade_especial = $request->input('necessidade-especial');
        $desc_necessidade_especial = $request->input('desc-necessisade');
        $id_empresa = $_SESSION['empresa_usuario'];
        $ativo = 1;
    

        $arrInstrutores = array($nome, $data_nasc, $email, $telefone, $genero, $saudacao,
                                $estado_civil, $cpf, $cnpj, $escolaridade, $tipo_contrato,
                                $usuario, $especialidade, $necessidade_especial, $desc_necessidade_especial,
                                $id_empresa, $ativo
                               );
 
        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->cadastraInstrutor($arrInstrutores);
        echo json_encode($resposta);
    }

    public static function updatePhoto(Request $request){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        if($request->hasFile('photo')){
            if($request->file('photo')->isValid()){
                $extension = $request->photo->extension();
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpge'){
                    $filename = strtotime(date('Y-M-d H:i:s'));          
                    $request->photo->storeAs('images/teachers', $filename.'.'.$extension);  
                    $id = $request->input('id');
                    $ClasseTreinamento->atualizaFoto($id, $filename.'.'.$extension);
                }else{
                    echo json_encode('Formato de Foto inválido');
                }
            
            }else{
                echo json_encode('Arquivo Inválido');
            }
        }
    }

    public function viewTeachers($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        
        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->buscaInstrutorPorId($id);

        echo json_encode($resposta);
    }

    public function editTeachers(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $nome = $request->input('nome-instrutor');
        $data_nasc = $request->input('data-nasc');
        $email = $request->input('email-instrutor');
        $telefone = $request->input('telefone');
        $genero = $request->input('genero');
        $saudacao = $request->input('saudacao');
        $estado_civil = $request->input('estado-civil');
        $cpf = $request->input('cpf');
        $cnpj = $request->input('cnpj');
        $escolaridade = $request->input('escolaridade');
        $tipo_contrato = $request->input('tipo-contrato');
        $usuario = $request->input('usuario-instrutor');
        $especialidade = $request->input('especialidade');
        $necessidade_especial = $request->input('necessidade-especial');
        $desc_necessidade_especial = $request->input('desc-necessidade');
        $id_editar = $request->input('id');

        $arrInstrutores = array($nome, $data_nasc, $email, $telefone, $genero, $saudacao,
        $estado_civil, $cpf, $cnpj, $escolaridade, $tipo_contrato,
        $usuario, $especialidade, $necessidade_especial, $desc_necessidade_especial,
        $id_editar
       );
       
       $ClasseTreinamento = new ClasseTreinamento();
       $resposta = $ClasseTreinamento->editaInstrutor($arrInstrutores);

       echo json_encode($resposta);
    }

    public function disableTeacher($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->desativaInstrutor($id);

        echo json_encode($resposta);
    }

    public function showTraining(){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $ClasseColaborador = new ClasseColaborador();
        
        $status = $ClasseTreinamento->buscaStatusTreinamento();
        $status_edit =  $ClasseTreinamento->buscaStatusTreinamento();
        $colaboradores = $ClasseColaborador->buscaColaboradores();
        $instrutores = $ClasseTreinamento->buscaInstrutores($_SESSION['empresa_usuario']);
        $cursos = $ClasseTreinamento->buscaCursos($_SESSION['empresa_usuario']);
        $tabela = $ClasseTreinamento->buscaTreinamentos($_SESSION['empresa_usuario']);

        return view('treinamentos', [
            'nome_pagina' => 'Treinamentos',
            'nome' => $_SESSION['nome_usuario'],
            'status' => $status,
            'colaboradores' => $colaboradores,
            'instrutores' => $instrutores,
            'cursos' => $cursos,
            'tabela' => $tabela,
            'status_edit' => $status_edit
     
        ]);
    }

    public function executeTraining(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        
        $data_inicio = $request->input('data-inicio');
        $data_fim = $request->input('data-fim');
        $qtd_vagas = $request->input('qtd-vagas');
        $curso = $request->input('curso');
        $qtd_vagas = $request->input('qtd-vagas');
        $diretor = $request->input('diretor');
        $status = $request->input('status');
        $descricao = $request->input('descricao');
        
        $arrTreinamento = array($curso, $data_inicio, $data_fim, $qtd_vagas, 
        $diretor, $status, $descricao);

        $arrInstrutores = $request->input('instrutores');
        $arrParticipantes = $request->input('participantes');

 

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->inserirTreinamento($arrTreinamento, 
        $arrInstrutores, $arrParticipantes);

        echo json_encode($resposta);

    }

    public function viewTraining($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->buscaTreinamentoPorId($id);

        echo json_encode($resposta);
    }

    public function viewTrainingClass($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $instrutores = $ClasseTreinamento->buscaInstrutoresTreinamento($id);
        $alunos = $ClasseTreinamento->buscaAlunosTreinamento($id);
        $arrInstrutores = array();
        $arrAlunos = array();
        foreach($instrutores as $key => $value){
            $arrInstrutores[] = $instrutores[$key]->id_instrutor; 
        }
        foreach($alunos as $key => $value){
            $arrAlunos[] = $alunos[$key]->id_aluno; 
        }
        $arrResposta = array('instrutores' => $arrInstrutores,'alunos' => $arrAlunos);

        echo json_encode($arrResposta);
    }

    public function editTraining(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        
        $data_inicio = $request->input('data-inicio');
        $data_fim = $request->input('data-fim');
        $qtd_vagas = $request->input('qtd-vagas');
        $curso = $request->input('curso');
        $qtd_vagas = $request->input('qtd-vagas');
        $diretor = $request->input('diretor');
        $status = $request->input('status');
        $descricao = $request->input('descricao');
        $id_editar = $request->input('id-editar');     
        $arrTreinamento = array($curso, $data_inicio, $data_fim, $qtd_vagas, 
        $diretor, $status, $descricao, $id_editar);
 

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->editarTreinamento($arrTreinamento);

        echo json_encode($resposta);

    }

    public function editTrainingClass(Request $request){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $arrInstrutores = $request->input('instrutores-editar');
        $arrParticipantes = $request->input('participantes-editar');
        $id_treinamento = $request->input("id-editar-turma");

        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->editaParticipantes($arrInstrutores, $arrParticipantes, $id_treinamento);

        echo json_encode($resposta);

    }

    public function showClassrooms(){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $ClasseLocais = new ClasseLocais();

        $paises = $ClasseLocais->buscaPaises();
        $salas_aula = $ClasseTreinamento->buscaLocais($_SESSION['empresa_usuario']);
  
        return view('locais', [
            'nome_pagina' => 'Locais',
            'nome' => $_SESSION['nome_usuario'],
            'paises' => $paises,
            'tabela' => $salas_aula   
        ]);
    }

    public function executeClassrooms(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $nome_local = $request->input('nome-local');
        $nome_sala = $request->input('nome-sala');
        $cep = $request->input('num-cep');
        $rua = $request->input('logradouro');
        $numero = $request->input('numero-endereco');
        $bairro = $request->input('bairro');
        $cidade = $request->input('cidade');
        $estado = $request->input('estado');
        $pais = $request->input('pais');
        $id_empresa = $_SESSION['empresa_usuario'];

        $arrLocaisAula = array($nome_local, $nome_sala , $cep , $rua , $numero, 
        $bairro , $cidade , $estado, $pais, $id_empresa);

        $ClasseTreinamento =  new ClasseTreinamento();

        $resposta = $ClasseTreinamento->cadastraLocaisAula($arrLocaisAula);

        echo json_encode($resposta);
     
    }

    public function viewClassrooms($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->buscaLocalPorId($id);

        echo json_encode($resposta);
    }

    public function editClassrooms(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $nome_local = $request->input('nome-local');
        $nome_sala = $request->input('nome-sala');
        $cep = $request->input('num-cep');
        $rua = $request->input('logradouro');
        $numero = $request->input('numero-endereco');
        $bairro = $request->input('bairro');
        $cidade = $request->input('cidade');
        $estado = $request->input('estado');
        $pais = $request->input('pais');
        $id = $request->input("id-editar");

        $arrLocaisAula = array($nome_local, $nome_sala , $cep , $rua , $numero, 
        $bairro , $cidade , $estado, $pais, $id);

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->editaLocaisAula($arrLocaisAula);

        echo json_encode($resposta);
    }

    public function deleteClassrooms($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->excluirLocal($id);

        echo json_encode($resposta);
    }

    public function showLessons(){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $ClasseLocais = new ClasseLocais();
        $ClasseProva = new ClasseProva();

        $paises = $ClasseLocais->buscaPaises();
        $salas_aula = $ClasseTreinamento->buscaLocais($_SESSION['empresa_usuario']);
        $treinamentos = $ClasseTreinamento->buscaTreinamentosInstrutor($_SESSION['empresa_usuario'], $_SESSION['id_instrutor']);
        $tabela = $ClasseTreinamento->buscarAulas($_SESSION["id_instrutor"]);
        $provas = $ClasseProva->buscaProvasEmpresa($_SESSION['empresa_usuario']);
        
  
        return view('aulas', [
            'nome_pagina' => 'Aulas',
            'nome' => $_SESSION['nome_usuario'],
            'paises' => $paises,
            'salas_aula' => $salas_aula,
            'id_instrutor' => $_SESSION['id_instrutor'],
            'treinamentos' => $treinamentos,
            'tabela' => $tabela,
            'provas' => $provas   
        ]);
    }

    public function executeLessons(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $instrutor = $_SESSION['id_instrutor'];
        $local = $request->input('local');
        $treinamento = $request->input('treinamento');
        $nome = $request->input("nome");
        $descricao = $request->input('descricao');
        $prova = $request->input('prova');
        $inicio = str_replace("T", " ", $request->input("inicio"));
        $fim = str_replace("T", " ", $request->input("fim"));

        $arrAula = array ($instrutor, $treinamento, $local, $nome, $descricao, $inicio, $fim);

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->cadastrarAula($arrAula, $prova);

        echo json_encode($resposta);
    }

    public function viewLessons($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->buscarAulasPorId($id);

        echo json_encode($resposta);
    }


    public function editLessons(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $local = $request->input('local');
        $treinamento = $request->input('treinamento');
        $nome = $request->input("nome");
        $descricao = $request->input('descricao');
        $inicio = str_replace("T", " ", $request->input("inicio"));
        $fim = str_replace("T", " ", $request->input("fim"));
        $id = $request->input("id-editar");

        $arrAula = array($treinamento, $local, $nome, $descricao, $inicio, $fim, $id);

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->editarAula($arrAula);

        echo json_encode($resposta);
    }

    public function deleteLessons($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->excluirAula($id);

        echo json_encode($resposta);
    }

    public function showParticipantList($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $alunos = $ClasseTreinamento->buscaListaPresença($id);

        return view('lista-chamada', [
            'nome_pagina' => 'Lista de Chamada',
            'nome' => $_SESSION['nome_usuario'],
            'alunos' => $alunos
        ]);
    }

    public function showGuideline(){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $tabela = $ClasseTreinamento->buscaDiretrizes($_SESSION['empresa_usuario']);
        return view('diretrizes', [
            'nome_pagina' => 'Locais',
            'nome' => $_SESSION['nome_usuario'],
            'tabela' => $tabela
        ]);
    }

    public function executeGuideline(Request $request){

        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $form = $request->all();

        $arrDiretriz = array($form['titulo'], $form['descricao'], $_SESSION['empresa_usuario']);
        $ClasseTreinamento = new ClasseTreinamento();
        
        $resposta = $ClasseTreinamento->cadastraDiretriz($arrDiretriz);

        echo json_encode($resposta);
    }

    public function viewGuideline($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->buscaDiretrizPorId($id);

        echo json_encode($resposta);

    }

    public function editGuideline(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $form = $request->all();

        $arrDiretriz = array($form['titulo'], $form['descricao'], $form['id-editar']);
        $ClasseTreinamento = new ClasseTreinamento();
        
        $resposta = $ClasseTreinamento->editaDiretriz($arrDiretriz);

        echo json_encode($resposta);

    }

    public function deleteGuideline($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $resposta = $ClasseTreinamento->excluirDiretriz($id);

        if($resposta == 1){
            $arrResposta = array('flag' => $resposta, 'mensagem' => 'Registro excluido com sucesso');
        }else{
            $arrResposta = array('flag' => $resposta, 'mensagem' => 'Falha ao excluir registro');
        }
        echo json_encode($arrResposta);

    }

    public function showAttendanceList($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();
        $dados_aula =  $ClasseTreinamento->buscarAulasPorId($id);

        $alunos = $ClasseTreinamento->buscaListaPresençaStatus($dados_aula[0]->id_treinamento, $id);

        return view('registro-presenca', [
            'nome_pagina' => 'Lista de Chamada',
            'nome' => $_SESSION['nome_usuario'],
            'alunos' => $alunos
        ]);
    }

    public function executeAttendanceList(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $form = $request->all();

        $arrPresenca = array($form['id_aluno'], $form['id_aula'], $form['status']);

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->registrarPresenca($arrPresenca);
        echo json_encode($resposta);
    }

    public function showPercentual(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        
        $ClasseTreinamento = new ClasseTreinamento();


        if($request->input("vaga") != NULL){
            $id_vaga = $request->input("vaga");
        }else{
   
            $id_vaga = "";
        }

        if($request->input("treinamento") != NULL){
            $id_treinamento = $request->input("treinamento");
        }else{
   
            $id_treinamento = "";
        }

        $treinamentos = $ClasseTreinamento->buscaTreinamentos($_SESSION['empresa_usuario']);
        $percentual_treinamento = $ClasseTreinamento->percentualTreinamentoConcluido($id_treinamento);
        $participantes = $ClasseTreinamento->situacaoDosAlunos($id_treinamento);
        $certificado = $ClasseTreinamento->buscaCertificadoUsuario($id_treinamento);

        return view('percentual-treinamento', [
            'nome_pagina' => 'Percentual de Treinamentos',
            'nome' => $_SESSION['nome_usuario'],
            'id_vaga' => $id_vaga,
            'percentual_treinamento' => $percentual_treinamento,
            'id_treinamento' => $id_treinamento,
            'treinamentos' => $treinamentos,
            'participantes' => $participantes,
            'certificado' => $certificado           
        ]);
    }

    public function showFiles(){
        
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento =  new ClasseTreinamento();

        $treinamentos = $ClasseTreinamento->buscaTreinamentos($_SESSION['empresa_usuario']);
        $tipo_arquivo = $ClasseTreinamento->buscaTipoArquivo();
        $tabela = $ClasseTreinamento->buscaArquivosTreinamento($_SESSION['empresa_usuario']);

        return view('inserir-arquivos', [
            'nome_pagina' => 'Arquivos de Treinamentos',
            'nome' => $_SESSION['nome_usuario'],
            'treinamentos' => $treinamentos,
            'tipos' => $tipo_arquivo,
            'tabela' => $tabela           
        ]);
    }

    public function filterParticipants(Request $request){
        
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $treinamento = $request->input('treinamento');

        $resposta = $ClasseTreinamento->buscaAlunosTreinamento($treinamento);
        echo json_encode($resposta);

    }

    public function executeFiles(Request $request){

        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        if($request->hasFile('arquivo')){
            if($request->file('arquivo')->isValid()){
                $extension = $request->arquivo->extension();
                if($extension == 'pdf'){
                    $filename = strtotime(date('Y-M-d H:i:s'));          
                    $path = $request->arquivo->storeAs('public/files', $filename.'.'.$extension);        
                }else{
                    echo json_encode('Formato deve ser .pdf');
                }
            
            }else{
                echo json_encode('Arquivo Inválido');
            }
        }else{
            $path = NULL;
        }
        
        $treinamento = $request->input('treinamento');
        $participante = $request->input('participante');
        $tipo_arquivo = $request->input('tipo_arquivo');

        
        $arrArquivos = array($treinamento,$participante,$tipo_arquivo,$path);

        $ClasseTreinamento = new ClasseTreinamento();
        $resposta = $ClasseTreinamento->cadastrarArquivos($arrArquivos);

        if($resposta == 1){
            $mensagem = ('Arquivo cadastrado com sucesso !!!');
        }else{
            $mensagem = 'Falha ao cadastrar arquivos !!!';
        }
        $resultado = array('flag' => $resposta,  'mensagem' => $mensagem);

        echo json_encode($resultado);
    }

    public function showAvaliation($id){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseTreinamento = new ClasseTreinamento();

        $questoes = $ClasseTreinamento->buscaQuestoesPesquisaSatisfacao();

        return view('pesquisa-satisfacao', [
            'nome_pagina' => 'Pesquisa de Satisfação',
            'nome' => $_SESSION['nome_usuario'],
            'questoes' => $questoes
        ]);
    }
}
