<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseCurriculo;
use App\Classes\ClasseVagas;
use App\Classes\ClasseTreinamento;



class VagaController extends Controller
{
    public function show(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseVagas = new ClasseVagas();
        $cargos = $ClasseVagas->buscaCargosCadastrados();
        $status = $ClasseVagas->buscaStatusVaga();
        $tabela = $ClasseVagas->preencheTabelaVagas($_SESSION['empresa_usuario']);

        return view('cadastro-vagas',[
            'nome_pagina' => 'Cadastro de Vagas',
            'nome' => $_SESSION['nome_usuario'],
            'cargos' => $cargos,
            'status' => $status,
            'tabela' => $tabela
        ]);    
    }
    public function execute(Request $request){
        $ClasseVagas = new ClasseVagas();

        $titulo = $request->input('titulo-vaga');
        $cargo = $request->input('id-cargo');
        $qtde_vagas = $request->input('qtde-vagas');
        $link_video = $request->input('link-video-vaga');
        $data_limite= $request->input('data-limite-inscricao');
        $desc_vaga = $request->input('desc-vaga');
        $status = $request->input('status');

        $requestVagas = array($titulo, $cargo,$qtde_vagas, $link_video, $data_limite, 
        $desc_vaga, $status);
        
        $resposta = $ClasseVagas->inserirTabelaVagas($requestVagas);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
    
    public function view($id){
        $ClasseVagas = new ClasseVagas();
        $row = $ClasseVagas->verVagas($id);
        
        echo json_encode($row);
    }

    public function delete($id){

        $ClasseVagas= new ClasseVagas();
        $resposta = $ClasseVagas->excluirVaga($id);
        if($resposta == 1){

            $mensagem = 'O registro foi excluido com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao excluir o registro. Você não pode excluir uma vaga onde já existam candidatos.';
        }

        echo json_encode($mensagem);

    }

    public function edit(Request $request){
        $ClasseCargos = new ClasseVagas();
        
        $id = $request->input('id-editar');
        $titulo = $request->input('titulo-vaga');
        $cargo = $request->input('id-cargo');
        $qtde_vagas = $request->input('qtde-vagas');
        $link_video = $request->input('link-video-vaga');
        $data_limite= $request->input('data-limite-inscricao');
        $desc_vaga = $request->input('desc-vaga');
        $status = $request->input('status');

        $requestEditVagas = array($titulo, $cargo, $qtde_vagas, $link_video, $data_limite, 
        $desc_vaga, $status, $id);
        

 
        
        $resposta = $ClasseCargos->editarTabelaVagas($requestEditVagas);

        if($resposta == 1){

            $mensagem = 'O registro foi alterado com sucesso !!!';
            
        }else{

            $mensagem = 'Nenhuma alteração feita, registro salvo com sucesso !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }

    public function customize(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseVagas = new ClasseVagas();
        $tabela = $ClasseVagas->buscaPersonalizacaoAtual($_SESSION['empresa_usuario']);

        return view('customizacao-mural',[
            'nome_pagina' => 'Customização do Mural',
            'nome' => $_SESSION['nome_usuario'],
            'tabela' => $tabela
        ]);

    }

    public function customizeExecute(Request $request){

        if($request->hasFile('logo')){
            if($request->file('logo')->isValid()){
                $extension = $request->logo->extension();
                if($extension == 'png'){
                    $filename = strtotime(date('Y-M-d H:i:s'));          
                    $path = $request->logo->storeAs('images', $filename.'.'.$extension);        
                    
                }else{
                    echo json_encode('Formato de Logo inválido');
                }
            
            }else{
                echo json_encode('Arquivo Inválido');
            }
        }else{
            $path = NULL;
        }
        $cor = $request->input('cor');
        $linkedin = $request->input('linkedin');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $instagram = $request->input('instagram');
        $youtube = $request->input('youtube');
        $cor_icone = $request->input('cor-icone');
        $empresa = $_SESSION['empresa_usuario'];
        
        $requestPersonalizacao = array($cor, $path, $linkedin, $facebook , $twitter,
        $instagram, $youtube, $cor_icone ,$empresa);

        $ClasseVagas = new ClasseVagas();
        $resposta = $ClasseVagas->personalizarMural($requestPersonalizacao);

        if($resposta == 1){
            $mensagem = ('Definições iniciais cadastradas com sucesso !!!');
        }else{
            $mensagem = 'Falha ao cadastrar definições !!!';
        }
        $resultado = array('flag' => $resposta,  'mensagem' => $mensagem);

        echo json_encode($resultado);
    }
    public function customizeEdit(Request $request){
        
        $ClasseVagas = new ClasseVagas();
        if($request->hasFile('logo-edit')){

            if($request->file('logo-edit')->isValid()){
 
                $extension = $request->file('logo-edit')->extension();

                if($extension == 'png'){
                    $filename = strtotime(date('Y-M-d H:i:s'));          
                    $path = $request->file('logo-edit')->storeAs('images', $filename.'.'.$extension); 
                }else{
                    echo json_encode('Formato de Logo inválido');
                }
            
            }else{
                echo json_encode('Arquivo Inválido');
            }
        }else{
            $logo = $ClasseVagas->buscaPersonalizacaoAtual($_SESSION['empresa_usuario']);
            $logo = $logo[0]->logo;
            $path = $logo;
        }

        $cor = $request->input('cor-edit');
        $linkedin = $request->input('linkedin-edit');
        $facebook = $request->input('facebook-edit');
        $twitter = $request->input('twitter-edit');
        $instagram = $request->input('instagram-edit');
        $youtube = $request->input('youtube-edit');
        $cor_icone = $request->input('cor-icone-edit');
        $empresa = $_SESSION['empresa_usuario'];    
        $requestPersonalizacao =  array($cor, $path, $linkedin, $facebook, $twitter, $instagram, $youtube,$cor_icone, $empresa);

        $resposta = $ClasseVagas->editarPersonalizarMural($requestPersonalizacao);


        if($resposta == 1){
            $mensagem = ('Alteração na personalização feita com sucesso !!!');
        }else{
            $mensagem = 'Falha ao editar sua personalização !!!';
        }
        $resultado = array('flag' => $resposta,  'mensagem' => $mensagem);

        echo json_encode($resultado);
    }

    public function showCompanyPage($id){
        $ClasseVagas = new ClasseVagas();

        $visual = $ClasseVagas->buscaPersonalizacaoAtual($id);
        $vagas = $ClasseVagas->listaVagasPorEmpresa($id);
        
        if(!isset($_SESSION['id_usuario_candidato'])){
            $_SESSION['id_usuario_candidato'] = NULL;
        }
        return view('mural-vagas',[
            'nome_pagina' => 'Mural de Vagas',
            'visual' => $visual,
            'vagas' => $vagas,
            'id_usuario_candidato' => $_SESSION['id_usuario_candidato']
        ]);
    }

    public function application(Request $request){
        $id_vaga = $request->input('id_vaga');
        $id_candidato = $request->input('id_candidato');
        
        if($id_candidato == NULL){
            $falha_autenticacao = array('autenticacao' => false, 'redirect' => "/teste/login-candidato");
            echo json_encode($falha_autenticacao);
            exit;
        }

        

        $ClasseCurriculo = new ClasseCurriculo();
        $curriculo = $ClasseCurriculo->buscaDadosCurriculo($id_candidato);

        if($curriculo != NULL){

            $arrayInsert = array($id_vaga, $id_candidato);
            $ClasseVagas = new ClasseVagas();
            $resposta = $ClasseVagas->candidatura($arrayInsert);

            if($resposta == true){
                $mensagem = "Você se candidatou a essa vaga, mantenha os dados do curriculo atualizados para ter uma chance maior no processo seletivo";
                $inserido = array('autenticacao' => true, 'resposta' => $resposta, 'mensagem' => $mensagem);
                echo json_encode($inserido);
            
            }else{
                $mensagem = "Você já se candidatou a essa vaga, veja mais detalhes no painel do candidato";
                $nao_inserido = array('autenticacao' => true,'resposta' => $resposta, 'mensagem' => $mensagem);
                echo json_encode($nao_inserido);
            
            }
        }else{
            $mensagem = "Você não possui os dados do currículo cadastrados, vá ao portal do candidato e cadastre no mínimo os dados principais para poder se candidatar a uma vaga";
            $sem_curriculo = array('autenticacao' => true,'resposta' => false, 'mensagem' => $mensagem);
            echo json_encode($sem_curriculo);
        }
    }

  
    

}

