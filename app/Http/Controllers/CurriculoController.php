<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseCurriculo;
use App\Classes\ClasseCargos;
use App\Classes\ClasseProva;

class CurriculoController extends Controller
{
    public function show(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseCargos = new ClasseCargos();
        $ClasseProva = new ClasseProva();

        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
        $dados_curriculo_candidato = $ClasseCurriculo->buscaDadosCurriculo($_SESSION['id_usuario_candidato']);
        $generos = $ClasseCurriculo->buscaGeneros();
        $estados_civis = $ClasseCurriculo->buscaEstadoCivil();
        $senioridades = $ClasseCargos->buscaSenioridades();
        $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);

        if(!isset($dados_curriculo_candidato)){
            return view('cadastro-curriculo-candidato',[
                'nome_pagina' => 'Meu Currículo',
                'nome' => $dados_usuario->nome_usuario_candidato,
                'email' => $dados_usuario->email_usuario_candidato,
                'cpf' => $dados_usuario->cpf_usuario_candidato,
                'generos' => $generos,
                'estado_civil' => $estados_civis,
                'senioridades' => $senioridades,
                'provas_pendentes' => $avaliacoes
            ]);
        }else{
            return view('cadastro-curriculo-candidato',[
                'nome_pagina' => 'Meu Currículo',
                'nome' => $dados_usuario->nome_usuario_candidato,
                'email' => $dados_usuario->email_usuario_candidato,
                'cpf' => $dados_usuario->cpf_usuario_candidato,
                'generos' => $generos,
                'estado_civil' => $estados_civis,
                'senioridades' => $senioridades,
                'dados_candidato' => $dados_curriculo_candidato,
                'provas_pendentes' => $avaliacoes
            ]);
        }
    }

    public function execute(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $dial_code = 1;
        $email = $request->input('email-candidato');
        $telefone = $request->input('telefone-candidato');
        $whatsapp = $request->input('whatsapp-candidato');
        $data_nascimento = $request->input('dn-candidato');
        $genero = $request->input('genero');
        $estado_civil = $request->input('estado-civil');
        $senioridade = $request->input('senioridade');
        $necessidade_especial = $request->input('necessidade-especial');
        $desc_necessidade_especial = $request->input('desc-necessidade');
        $id_pais = 1;
        $cep = $request->input('num-cep');
        $logradouro = $request->input('logradouro');
        $numero_endereco = $request->input('numero-endereco');
        $bairro = $request->input('bairro');
        $cidade = $request->input('cidade');
        $estado = $request->input('estado');
        $id_usuario_candidato = $_SESSION['id_usuario_candidato'];

        $dados_curriculo_candidato = array($dial_code, $telefone, $dial_code, $whatsapp, $email, $genero,
        $data_nascimento, $estado_civil, $senioridade, $necessidade_especial, $desc_necessidade_especial, 
        $id_pais, $cep, $logradouro, $numero_endereco, $bairro, $estado, $cidade, $id_usuario_candidato);

   
        $ClasseCurriculo = new ClasseCurriculo();
        $resposta = $ClasseCurriculo->salvaPrincipaisCurriculo($dados_curriculo_candidato);
        
        if($resposta['resposta'] == true){
            if($resposta['primeiro_cadastro'] == true){
                $array = array('flag' => $resposta,
                'mensagem' => 'Dados Salvos com sucesso', 'primeiro_cadastro' => true);
                echo json_encode($array);
            }else{
                $array = array('flag' => $resposta,
                'mensagem' => 'Dados Salvos com sucesso', 'primeiro_cadastro' => false);
                echo json_encode($array); 
            }
        }else{
            $array = array('flag' => $resposta,'mensagem' => 'Dados Não Alterados');
            echo json_encode($array);
        }
    }

    public function showLanguages(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseProva = new ClasseProva();    

        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
        $idiomas_cadastrados = $ClasseCurriculo->buscaIdiomas();
        $idiomas_usuario_candidato = $ClasseCurriculo->buscaIdiomasCandidato($_SESSION['id_usuario_candidato']);
        $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);

        return view('cadastro-idiomas-candidato',[
            'nome_pagina' => 'Meu Currículo | Idiomas',
            'nome' => $dados_usuario->nome_usuario_candidato,
            'idiomas_cadastrados' => $idiomas_cadastrados,
            'idiomas_candidato' => $idiomas_usuario_candidato,
            'dados_candidato' => $dados_usuario,
            'provas_pendentes' => $avaliacoes
        ]);

    }

    public function executeLanguages(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();

        $id_usuario_candidato = $_SESSION['id_usuario_candidato'];
        $idioma = $request->input('idioma');
        $nivel = $request->input('nivel');

        $dadosIdioma = array($id_usuario_candidato, $idioma, $nivel);

        $resposta = $ClasseCurriculo->cadastraIdiomaCandidato($dadosIdioma);

     
        if($resposta == true){
            $array = array('flag' => $resposta,'mensagem' => 'Dados Salvos com sucesso');
            echo json_encode($array);
        }else{
            $array = array('flag' => $resposta,'mensagem' => 'Você já cadastrou este idioma, use a tabela para editar o nível');
            echo json_encode($array);
        }
    }
    public function saveLanguageChanges(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();
        $id = $request->input('id_idioma_candidato');
        $nivel = $request->input('nivel_idioma_candidato');

        $ClasseCurriculo = new ClasseCurriculo();

        $resposta = $ClasseCurriculo->salvarAlteracoesNivelIdioma($id, $nivel);

        if($resposta == true){
            $array = array('flag' => $resposta,'mensagem' => 'Dados Salvos com sucesso');
            echo json_encode($array);
        }else{
            $array = array('flag' => $resposta,'mensagem' => 'Nenhuma alteração foi salva');
            echo json_encode($array);
        }
    }
    public function deleteLanguage($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();
        
        $ClasseCurriculo = new ClasseCurriculo();

        $ClasseCurriculo->deletaIdiomaCandidato($id);

        echo json_encode('Dados Excluídos com sucesso');

    }

    public function showAbilities(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo(); 
        $ClasseProva = new ClasseProva();   

        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
      
        $habilidades_usuario_candidato = $ClasseCurriculo->buscaHabilidadesCandidato($_SESSION['id_usuario_candidato']);

        $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);

        return view('cadastro-habilidades-candidato',[
            'nome_pagina' => 'Meu Currículo | Habilidades',
            'nome' => $dados_usuario->nome_usuario_candidato,
            'habilidades_candidato' => $habilidades_usuario_candidato,
            'dados_candidato' => $dados_usuario,
            'provas_pendentes' => $avaliacoes
        ]);

    }

    public function executeAbilities(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();

        $id_usuario_candidato = $_SESSION['id_usuario_candidato'];
        $habilidade = $request->input('habilidade');
        $nivel = $request->input('nivel');

        $dadosIdioma = array($id_usuario_candidato, $habilidade, $nivel);

        $resposta = $ClasseCurriculo->cadastraHabilidadeCandidato($dadosIdioma);

     
        if($resposta == true){
            $array = array('flag' => $resposta,'mensagem' => 'Dados Salvos com sucesso');
            echo json_encode($array);
        }else{
            $array = array('flag' => $resposta,'mensagem' => 'Você já cadastrou a habilidade descrita, use a tabela para editar o nível');
            echo json_encode($array);
        }
    }

    public function saveAbilityChanges(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();
        $id = $request->input('id_habilidade_candidato');
        $nivel = $request->input('nivel_habilidade_candidato');

        $ClasseCurriculo = new ClasseCurriculo();

        $resposta = $ClasseCurriculo->salvarAlteracoesNivelHabilidade($id, $nivel);

        if($resposta == true){
            $array = array('flag' => $resposta,'mensagem' => 'Dados Salvos com sucesso');
            echo json_encode($array);
        }else{
            $array = array('flag' => $resposta,'mensagem' => 'Nenhuma alteração foi salva');
            echo json_encode($array);
        }
    }

    public function deleteAbility($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();
        
        $ClasseCurriculo = new ClasseCurriculo();

        $ClasseCurriculo->deletaHabilidadeCandidato($id);

        echo json_encode('Dados Excluídos com sucesso');

    }

    public function showAcademical(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseProva = new ClasseProva();    

        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
        $niveis_formacao = $ClasseCurriculo->buscaNiveisFormacao();
        $formacoes_candidato = $ClasseCurriculo->buscaFormacoesCandidato($_SESSION['id_usuario_candidato']);
        $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);

        return view('cadastro-formacao-candidato',[
            'nome_pagina' => 'Meu Currículo | Formação',
            'nome' => $dados_usuario->nome_usuario_candidato,
            'niveis_formacao' => $niveis_formacao,
            'formacoes_candidato' => $formacoes_candidato,
            'dados_candidato' => $dados_usuario,
            'provas_pendentes' => $avaliacoes
        ]);

    }

    public function executeAcademical(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $nome_curso = $request->input('nome-curso');
        $nome_instituicao = $request->input('nome-instituicao');
        $nivel_curso = $request->input('nivel-curso');
        $data_inicio = $request->input('data-inicio');
        $data_conclusao = $request->input('data-conclusao');
        $desc_curso = $request->input('desc-curso');
        $id_usuario_candidato = $_SESSION['id_usuario_candidato'];

        $dadosCurso = array($nome_curso, $nome_instituicao,$nivel_curso,
        $data_inicio,$data_conclusao, $desc_curso, $id_usuario_candidato);

        $ClasseCurriculo = new ClasseCurriculo();    

        $resposta = $ClasseCurriculo->cadastraNovaFormacao($dadosCurso);

        if($resposta == true){
            $array = array('flag' => $resposta,'mensagem' => 'Dados Salvos com sucesso');
            echo json_encode($array);
        }else{
            $array = array('flag' => $resposta,'mensagem' => 'Nenhuma alteração foi salva');
            echo json_encode($array);
        }
       
    }

    public function viewAcademical($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();

        $row = $ClasseCurriculo->buscaDadosFormacao($id);

        echo json_encode($row);
    }

    public function deleteAcademical($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();
        
        $ClasseCurriculo = new ClasseCurriculo();

        $ClasseCurriculo->deletaFormacaoCandidato($id);

        echo json_encode('Dados Excluídos com sucesso');

    }

    public function editAcademical(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $id = $request->input('id-editar');
        $nome_curso = $request->input('nome-curso-edit');
        $nome_instituicao = $request->input('nome-instituicao-edit');
        $nivel_curso = $request->input('nivel-curso-edit');
        $data_inicio = $request->input('data-inicio-edit');
        $data_conclusao = $request->input('data-conclusao-edit');
        $desc_curso = $request->input('desc-curso-edit');


        $requestEditFormacao = array($nome_curso, $nome_instituicao, $nivel_curso, $data_inicio, 
        $data_conclusao, $desc_curso, $id);

        $ClasseCurriculo = new ClasseCurriculo();
        
        $resposta = $ClasseCurriculo->editarFormacaoCandidato($requestEditFormacao);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }

    public static function updatePhoto(Request $request){
        $ClasseCurriculo = new ClasseCurriculo();
        if($request->hasFile('photo')){
            if($request->file('photo')->isValid()){
                $extension = $request->photo->extension();
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpge'){
                    $filename = strtotime(date('Y-M-d H:i:s'));          
                    $path = $request->photo->storeAs('public/images/users', $filename.'.'.$extension);  
                    
                    $path = str_replace('public','/storage', $path);
                    
                    $ClasseCurriculo->atualizaFoto($path);
                }else{
                    echo json_encode('Formato de Foto inválido');
                }
            
            }else{
                echo json_encode('Arquivo Inválido');
            }
        }
    }

    public function showCNH(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseProva = new ClasseProva();    

        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
        $categorias_cnh = $ClasseCurriculo->buscaCategoriasCNH();
        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
        $dados_cnh = $ClasseCurriculo->buscaCNHcandidato($_SESSION['id_usuario_candidato']);
        $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);

        return view('cadastro-cnh-candidato',[
            'nome_pagina' => 'Meu Currículo | CNH',
            'nome' => $dados_usuario->nome_usuario_candidato,
            'dados_cnh' => $dados_usuario,
            'categorias_cnh' => $categorias_cnh,
            'dados_candidato' => $dados_usuario,
            'dados_cnh' => $dados_cnh,
            'provas_pendentes' => $avaliacoes
        ]);

    }

    public function executeCNH(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $categoria = $request->input('categoria');
        $num_registro = $request->input('numero-cnh');
        $data_cnh = $request->input('data-cnh');
        $id_usuario_candidato = $_SESSION['id_usuario_candidato'];

        $dados_cnh_candidato = array($categoria, $num_registro, $data_cnh, $id_usuario_candidato);
    

   
        $ClasseCurriculo = new ClasseCurriculo();
        $resposta = $ClasseCurriculo->salvaCNHCandidato($dados_cnh_candidato);
        
        if($resposta== true){

            $array = array('flag' => $resposta,
            'mensagem' => 'Dados Salvos com sucesso', 'primeiro_cadastro' => false);
            echo json_encode($array); 
            
        }else{
            $array = array('flag' => $resposta,'mensagem' => 'Dados Não Alterados');
            echo json_encode($array);
        }
    }

}
