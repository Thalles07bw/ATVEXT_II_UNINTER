<?php

namespace App\Http\Controllers;

use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseProva;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    public function show($id_prova, Request $request){
        $ClasseAutenticacao  = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();
 

        
        $token = $request->input('token');
        $ClasseProva = new ClasseProva();
        $dados_prova = $ClasseProva->buscaDadosProva($id_prova);
        $titulo_prova = $ClasseProva->buscaNomeProva($id_prova); 
        $id_candidato = $_SESSION['id_usuario_candidato'];

        $ClasseAutenticacao->checaValidadeProva($id_prova, $token);
        $ClasseAutenticacao->checaCandidatoProva($id_candidato, $id_prova, $token);

        if($dados_prova[0]->id_tipo_tempo_prova === 2){

            $questao = $ClasseProva->buscaQuestoesProva($id_prova);
            //Quando a prova é por tempo de questão é necessário guardar na sessão o id da questão atual
            if(!isset($_SESSION['questao_atual'])){
                $n_questao = 0;
            }else{
                $n_questao = $_SESSION['questao_atual'];
            }   
            /*Lógica para o cálculo do tempo restante da questão, salvo na sessão para não resetar 
            em caso de refresh*/
            $date = date_create();
            $tempo_atual = date_timestamp_get($date);
            if(!isset($_SESSION['tempo_restante'])){
                $_SESSION['fim_questao'] = $tempo_atual+($questao[$n_questao]->tempo_pergunta_prova*60);
                $_SESSION['tempo_restante'] = ($tempo_atual+($questao[$n_questao]->tempo_pergunta_prova*60) - $tempo_atual)/60;
            }else{
                $_SESSION['tempo_restante'] = ($_SESSION['fim_questao'] - $tempo_atual)/60;
            }

            if(isset($questao[$n_questao])){
    
                $id_questao = $questao[$n_questao]->id_pergunta_prova;
                $alternativas = $ClasseProva->buscaAlternativasQuestao($id_questao);
                return view('prova-tempo-questao',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'questao_prova' => $questao[$n_questao]->pergunta_prova,
                    'tempo_questao' => $_SESSION['tempo_restante'],
                    'alternativas' => $alternativas,
                    'next_questao' => $n_questao+1,
                    'token' => $token
                ]);

            }else{
                $ClasseProva = new ClasseProva();
                $percentual = $ClasseProva->mostraPercentualAcerto($token, $id_candidato);
                $percentual = number_format($percentual, 2, '.', '');
                $ClasseProva->defineResultadoProva($id_prova, $percentual, $id_candidato, $token);
                session_destroy();
                return view('resultado-prova',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'acertos' => $percentual
                ]);
            }
        }else{
            $questao = $ClasseProva->buscaQuestoesProva($id_prova);
            foreach ($questao as $key => $value){
                $alternativas = $ClasseProva->buscaAlternativasQuestao($value->id_pergunta_prova);
                $pergunta[$key][] = array('id' => $value->id_pergunta_prova, 'pergunta'=>$value->pergunta_prova);
                foreach($alternativas as $each){
                    $pergunta[$key][] = array ('id' =>  $each->id_resposta_prova,
                    'alt' => $each->resposta_prova);
                }
                
            }
            $date = date_create();
            $tempo_atual = date_timestamp_get($date);
            if(!isset($_SESSION['tempo_restante'])){
                $_SESSION['fim_questao'] = $tempo_atual+($dados_prova[0]->tempo_total_prova*60);
                $_SESSION['tempo_restante'] = ($tempo_atual+($dados_prova[0]->tempo_total_prova*60) - $tempo_atual)/60;
            }else{
                $_SESSION['tempo_restante'] = ($_SESSION['fim_questao'] - $tempo_atual)/60;
            }
           
           
            return view('prova-tempo-total',[
                'nome_pagina' => 'Avaliação',
                'titulo_prova' => $titulo_prova,
                'tempo_prova' => $_SESSION['tempo_restante'],
                'perguntas' => $pergunta,
                'token' => $token,
                'n_questoes' => sizeof($questao)
            ]);
            
        }
    }

    public function next($id_prova, Request $request){

        $ClasseProva = new ClasseProva();
        $tipo_tempo_prova = $ClasseProva->buscaDadosProva($id_prova);
        $id_candidato = $_SESSION['id_usuario_candidato'];

        if($tipo_tempo_prova[0]->id_tipo_tempo_prova == 2){
            $n_questao = $request->input('n-questao');
            $_SESSION['questao_atual'] = $n_questao; 

            $token = $request->input('token');
            $alternativa = $request->input('alternativa');
            $ClasseProva = new ClasseProva();
            $titulo_prova = $ClasseProva->buscaNomeProva($id_prova); 
            $questao = $ClasseProva->buscaQuestoesProva($id_prova);
            

            $id_questao = $questao[$n_questao-1]->id_pergunta_prova;
            
            if(isset($questao[$n_questao])){            
                $ClasseProva = new ClasseProva();
              
                $ClasseProva->salvaQuestao($token, $id_questao, $alternativa, $id_candidato);
                unset($_SESSION['tempo_restante']);             //unset no cronometro para a próxima questão
                $id_nova_questao = $questao[$n_questao]->id_pergunta_prova;
                $alternativas = $ClasseProva->buscaAlternativasQuestao($id_nova_questao);
                return view('prova-tempo-questao',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'questao_prova' => $questao[$n_questao]->pergunta_prova,
                    'alternativas' => $alternativas,
                    'tempo_questao' => $questao[$n_questao]->tempo_pergunta_prova,
                    'next_questao' => $n_questao+1,
                    'token' => $token
                ]);
            }else{
                $ClasseProva = new ClasseProva();
                $id_candidato = $_SESSION['id_usuario_candidato'];
                $ClasseProva->salvaQuestao($token, $id_questao, $alternativa, $id_candidato);
                $percentual = $ClasseProva->mostraPercentualAcerto($token, $id_candidato);
                $percentual = number_format($percentual, 2, '.', '');
                $ClasseProva->defineResultadoProva($id_prova, $percentual, $id_candidato, $token);
                session_destroy();
                return view('resultado-prova',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'acertos' => $percentual
                ]);
            }
        }else{
            $token = $request->input('token');
            $n_questoes = $request->input('n-questoes');
            $titulo_prova = $ClasseProva->buscaNomeProva($id_prova); 

            for($i = 1; $i <= $n_questoes; $i++){
                $pergunta = $request->input('pergunta-'.$i);
                $alternativa = $request->input('alternativa-'.$i);
                $ClasseProva->salvaQuestao($token, $pergunta, $alternativa, $id_candidato);
            }
            
            $percentual = $ClasseProva->mostraPercentualAcerto($token, $id_candidato);
            $percentual = number_format($percentual, 2, '.', '');
            $ClasseProva->defineResultadoProva($id_prova, $percentual, $id_candidato, $token);
            session_destroy();
            return view('resultado-prova',[
                'nome_pagina' => 'Avaliação',
                'titulo_prova' => $titulo_prova,
                'acertos' => $percentual
            ]);
        }
    }
    public function showStudentTest($id_prova, Request $request){
        $ClasseAutenticacao  = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoaluno();
 

        
        $token = $request->input('token');
        $ClasseProva = new ClasseProva();
        $dados_prova = $ClasseProva->buscaDadosProva($id_prova);
        $titulo_prova = $ClasseProva->buscaNomeProva($id_prova); 
        $id_aluno = $_SESSION['id_usuario_aluno'];

        $ClasseAutenticacao->checaValidadeProva($id_prova, $token);
        $ClasseAutenticacao->checaalunoProva($id_aluno, $id_prova, $token);

        if($dados_prova[0]->id_tipo_tempo_prova === 2){

            $questao = $ClasseProva->buscaQuestoesProva($id_prova);
            //Quando a prova é por tempo de questão é necessário guardar na sessão o id da questão atual
            if(!isset($_SESSION['questao_atual'])){
                $n_questao = 0;
            }else{
                $n_questao = $_SESSION['questao_atual'];
            }   
            /*Lógica para o cálculo do tempo restante da questão, salvo na sessão para não resetar 
            em caso de refresh*/
            $date = date_create();
            $tempo_atual = date_timestamp_get($date);
            if(!isset($_SESSION['tempo_restante'])){
                $_SESSION['fim_questao'] = $tempo_atual+($questao[$n_questao]->tempo_pergunta_prova*60);
                $_SESSION['tempo_restante'] = ($tempo_atual+($questao[$n_questao]->tempo_pergunta_prova*60) - $tempo_atual)/60;
            }else{
                $_SESSION['tempo_restante'] = ($_SESSION['fim_questao'] - $tempo_atual)/60;
            }

            if(isset($questao[$n_questao])){
    
                $id_questao = $questao[$n_questao]->id_pergunta_prova;
                $alternativas = $ClasseProva->buscaAlternativasQuestao($id_questao);
                return view('prova-tempo-questao',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'questao_prova' => $questao[$n_questao]->pergunta_prova,
                    'tempo_questao' => $_SESSION['tempo_restante'],
                    'alternativas' => $alternativas,
                    'next_questao' => $n_questao+1,
                    'token' => $token
                ]);

            }else{
                $ClasseProva = new ClasseProva();
                $percentual = $ClasseProva->mostraPercentualAcerto($token, $id_aluno);
                $percentual = number_format($percentual, 2, '.', '');
                $ClasseProva->defineResultadoProva($id_prova, $percentual, $id_aluno, $token);
                session_destroy();
                return view('resultado-prova',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'acertos' => $percentual
                ]);
            }
        }else{
            $questao = $ClasseProva->buscaQuestoesProva($id_prova);
            foreach ($questao as $key => $value){
                $alternativas = $ClasseProva->buscaAlternativasQuestao($value->id_pergunta_prova);
                $pergunta[$key][] = array('id' => $value->id_pergunta_prova, 'pergunta'=>$value->pergunta_prova);
                foreach($alternativas as $each){
                    $pergunta[$key][] = array ('id' =>  $each->id_resposta_prova,
                    'alt' => $each->resposta_prova);
                }
                
            }
            $date = date_create();
            $tempo_atual = date_timestamp_get($date);
            if(!isset($_SESSION['tempo_restante'])){
                $_SESSION['fim_questao'] = $tempo_atual+($dados_prova[0]->tempo_total_prova*60);
                $_SESSION['tempo_restante'] = ($tempo_atual+($dados_prova[0]->tempo_total_prova*60) - $tempo_atual)/60;
            }else{
                $_SESSION['tempo_restante'] = ($_SESSION['fim_questao'] - $tempo_atual)/60;
            }
           
           
            return view('prova-tempo-total',[
                'nome_pagina' => 'Avaliação',
                'titulo_prova' => $titulo_prova,
                'tempo_prova' => $_SESSION['tempo_restante'],
                'perguntas' => $pergunta,
                'token' => $token,
                'n_questoes' => sizeof($questao)
            ]);
            
        }
    }

    public function nextStudentQuestion($id_prova, Request $request){

        $ClasseProva = new ClasseProva();
        $tipo_tempo_prova = $ClasseProva->buscaDadosProva($id_prova);
        $id_aluno = $_SESSION['id_usuario_aluno'];

        if($tipo_tempo_prova[0]->id_tipo_tempo_prova == 2){
            $n_questao = $request->input('n-questao');
            $_SESSION['questao_atual'] = $n_questao; 

            $token = $request->input('token');
            $alternativa = $request->input('alternativa');
            $ClasseProva = new ClasseProva();
            $titulo_prova = $ClasseProva->buscaNomeProva($id_prova); 
            $questao = $ClasseProva->buscaQuestoesProva($id_prova);
            

            $id_questao = $questao[$n_questao-1]->id_pergunta_prova;
            
            if(isset($questao[$n_questao])){            
                $ClasseProva = new ClasseProva();
              
                $ClasseProva->salvaQuestao($token, $id_questao, $alternativa, $id_aluno);
                unset($_SESSION['tempo_restante']);             //unset no cronometro para a próxima questão
                $id_nova_questao = $questao[$n_questao]->id_pergunta_prova;
                $alternativas = $ClasseProva->buscaAlternativasQuestao($id_nova_questao);
                return view('prova-tempo-questao',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'questao_prova' => $questao[$n_questao]->pergunta_prova,
                    'alternativas' => $alternativas,
                    'tempo_questao' => $questao[$n_questao]->tempo_pergunta_prova,
                    'next_questao' => $n_questao+1,
                    'token' => $token
                ]);
            }else{
                $ClasseProva = new ClasseProva();
                $id_aluno = $_SESSION['id_usuario_aluno'];
                $ClasseProva->salvaQuestao($token, $id_questao, $alternativa, $id_aluno);
                $percentual = $ClasseProva->mostraPercentualAcerto($token, $id_aluno);
                $percentual = number_format($percentual, 2, '.', '');
                $ClasseProva->defineResultadoProva($id_prova, $percentual, $id_aluno, $token);
                session_destroy();
                return view('resultado-prova',[
                    'nome_pagina' => 'Avaliação',
                    'titulo_prova' => $titulo_prova,
                    'acertos' => $percentual
                ]);
            }
        }else{
            $token = $request->input('token');
            $n_questoes = $request->input('n-questoes');
            $titulo_prova = $ClasseProva->buscaNomeProva($id_prova); 

            for($i = 1; $i <= $n_questoes; $i++){
                $pergunta = $request->input('pergunta-'.$i);
                $alternativa = $request->input('alternativa-'.$i);
                $ClasseProva->salvaQuestao($token, $pergunta, $alternativa, $id_aluno);
            }
            
            $percentual = $ClasseProva->mostraPercentualAcerto($token, $id_aluno);
            $percentual = number_format($percentual, 2, '.', '');
            $ClasseProva->defineResultadoProva($id_prova, $percentual, $id_aluno, $token);
            session_destroy();
            return view('resultado-prova',[
                'nome_pagina' => 'Avaliação',
                'titulo_prova' => $titulo_prova,
                'acertos' => $percentual
            ]);
        }
    }

    public function viewCreate(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseProva = new ClasseProva();

            $niveis_avaliacao = $ClasseProva->buscaNivelProva();
            $categorias_avaliacao = $ClasseProva->buscaCategoriaProva();
            $tipo_tempo_prova = $ClasseProva->buscaTipoTempoProva();
            $tabela = $ClasseProva->buscaProvasCadastradas();

            return view('criar-prova',[
                'nome_pagina' => 'Cadastrar Prova',
                'nome' => $_SESSION['nome_usuario'],
                'niveis_avaliacao' => $niveis_avaliacao,
                'categorias_avaliacao' => $categorias_avaliacao,
                'tipo_tempo' => $tipo_tempo_prova,
                'tabela' => $tabela
            ]);
        }else{
            header("Location: /login");
            exit;
        }
    }
    public function viewDisabled(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseProva = new ClasseProva();

            $niveis_avaliacao = $ClasseProva->buscaNivelProva();
            $categorias_avaliacao = $ClasseProva->buscaCategoriaProva();
            $tipo_tempo_prova = $ClasseProva->buscaTipoTempoProva();
            $tabela = $ClasseProva->buscaProvasDesabilitadas();

            return view('provas-desativadas',[
                'nome_pagina' => 'Cadastrar Prova',
                'nome' => $_SESSION['nome_usuario'],
                'niveis_avaliacao' => $niveis_avaliacao,
                'categorias_avaliacao' => $categorias_avaliacao,
                'tipo_tempo' => $tipo_tempo_prova,
                'tabela' => $tabela
            ]);
        }else{
            header("Location: /login");
            exit;
        }
    }
    public function executeCreate(Request $request){
        $nome_prova = $request->input('nome-prova');
        $nivel_prova = $request->input('nivel-prova');
        $categoria_prova = $request->input('categoria-prova');
        $tipo_tempo_prova = $request->input('tempo-prova');
        $duracao = $request->input('duracao');
        $id_empresa = $_SESSION['empresa_usuario'];


        $ClasseProva = new ClasseProva();
        $resposta = $ClasseProva->criaNovaAvaliacao($nome_prova, $nivel_prova, $categoria_prova,
         $tipo_tempo_prova, $duracao, $id_empresa);
        
        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);

    }

    public function copy($id){
        $ClasseProva = new ClasseProva();
        $resposta = $ClasseProva->criaCopiaProva($id);

        if($resposta == 1){

            $mensagem = 'Uma cópia da avaliação foi feita com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
    
        echo json_encode($mensagem);
    }

    public function disable($id){
        $ClasseProva = new ClasseProva();
        $resposta = $ClasseProva->desativarProva($id);

        if($resposta == 1){

            $mensagem =  "A avaliação foi desativada !!!";
            
        }else{

            $mensagem = "Falha na desativação";

        }
        $arrayResposta = array('mensagem' => $mensagem);
        echo json_encode($arrayResposta);
    }
    public function enable($id){
        $ClasseProva = new ClasseProva();
        $resposta = $ClasseProva->ativarProva($id);

        if($resposta == 1){

            $mensagem =  "A avaliação foi ativada novamente!!!";
            
        }else{

            $mensagem = "Falha na ativação";

        }
        $arrayResposta = array('mensagem' => $mensagem);
        echo json_encode($arrayResposta);
    }

    public function view($id){
        $ClasseProva = new ClasseProva();
        $dadosEdicaoProva = $ClasseProva->buscaDadosProva($id);

        echo json_encode($dadosEdicaoProva);
    }

    public function edit(Request $request){
        $ClasseProva = new ClasseProva();

        $nome = $request->input('renomear');
        $nivel = $request->input('nivel-prova-editar');
        $id = $request->input('id-editar');

        $resposta = $ClasseProva->atualizarProva($id, $nome, $nivel);

        if($resposta == 1){

            $mensagem =  "As alterações foram salvas !!!";
            
        }else{

            $mensagem = "Falha ao atualizar os dados";

        }
        $arrayResposta = array('mensagem' => $mensagem);
        echo json_encode($arrayResposta);
        
    }

}