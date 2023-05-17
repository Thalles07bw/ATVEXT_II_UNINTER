<?php

namespace App\Http\Controllers;

use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseBeneficios;
use App\Classes\ClasseCargos;
use App\Classes\ClasseColaborador;
use App\Classes\ClasseContrato;
use App\Classes\ClasseCurriculo;
use App\Classes\ClasseDepartamento;
use App\Classes\ClasseLocais;
use App\Classes\ClasseUsuario;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function show(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseColaborador = new ClasseColaborador();
            $ClasseCurriculo = new ClasseCurriculo();
            $ClasseLocais = new ClasseLocais();
            $ClasseUsuario = new ClasseUsuario();
            $ClasseContrato = new ClasseContrato();
            $ClasseCargos = new ClasseCargos();
            $ClasseDepartamento = new ClasseDepartamento();
            $ClasseBeneficios = new ClasseBeneficios();
            

            $tabela = $ClasseColaborador->buscaColaboradores();
            $saudacoes = $ClasseColaborador->buscaSaudacoes();
            $generos = $ClasseCurriculo->buscaGeneros();
            $estados_civis = $ClasseCurriculo->buscaEstadoCivil();
            $usuarios_ativos = $ClasseUsuario->preencheTabelaUsuarios($_SESSION['empresa_usuario']);
            $tipos_contrato = $ClasseContrato->buscaTiposContrato();
            $escolaridades = $ClasseCurriculo->buscaNiveisFormacao();
            $graus_hierarquicos = $ClasseCargos->buscaSenioridades();
            $cargos = $ClasseCargos->preencheTabelaCargos();
            $departamentos = $ClasseDepartamento->preencheTabelaDepartamentos();
            $paises = $ClasseLocais->buscaPaises();
            $beneficios = $ClasseBeneficios->buscaBeneficios($_SESSION['empresa_usuario']);
            return view('colaborador', [
                'nome' => $_SESSION['nome_usuario'],
                'nome_pagina' => 'Colaboradores',
                'tabela' => $tabela,
                'saudacoes' => $saudacoes,
                'generos' => $generos,
                'estados_civis' => $estados_civis,
                'paises' => $paises,
                'usuarios_ativos' => $usuarios_ativos,
                'tipos_contrato' => $tipos_contrato,
                'escolaridades' => $escolaridades,
                'senioridades' => $graus_hierarquicos,
                'cargos' => $cargos,
                'departamentos' => $departamentos,
                'beneficios' => $beneficios

            ]);
        }else{
            header("Location: /login");
            exit;
        }
    }

    public function execute(Request $request){
        
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();

        $nome = $request->input("nome-colaborador");
        $email = $request->input("email-colaborador");
        $data_nasc = $request->input('data-nasc');
        $telefone = $request->input("telefone");
        $genero = $request->input("genero");
        $saudacao = $request->input("saudacao");
        $estado_civil = $request->input("estado-civil");
        $cpf = $request->input("cpf");
        $escolaridade = $request->input("escolaridade");
        $contrato = $request->input("tipo-contrato");
        $nescessidade_especial = $request->input("necessidade-especial");
        $desc_necessidade = $request->input("desc-necessidade");
        $cargo = $request->input("cargo");
        $departamento = $request->input("depto");
        $senioridade = $request->input("grau-hierarquico");
        $usuario_colaborador = $request->input("usuario-colaborador");
        $cep = $request->input("num-cep");
        $num_endereco = $request->input("numero-endereco");
        $rua = $request->input("logradouro");
        $bairro = $request->input("bairro");
        $cidade = $request->input("cidade");
        $estado = $request->input("estado");
        $pais = $request->input("pais");


        $dadosColaborador = array($nome, $email, $data_nasc,
        $telefone, $genero, $saudacao, $estado_civil, $cpf,
        $escolaridade, $contrato, $nescessidade_especial, $desc_necessidade,
        $cargo, $departamento, $senioridade, $usuario_colaborador, $cep,
        $rua, $num_endereco, $bairro, $cidade, $estado, $pais);
        
        $resposta = $ClasseColaborador->cadastraColaborador($dadosColaborador);

        echo json_encode($resposta);

        
    }

    public static function updatePhoto(Request $request){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();
        if($request->hasFile('photo')){
            if($request->file('photo')->isValid()){
                $extension = $request->photo->extension();
                if($extension == 'png' || $extension == 'jpg' || $extension == 'jpge'){
                    $filename = strtotime(date('Y-M-d H:i:s'));          
                    $request->photo->storeAs('images/employees', $filename.'.'.$extension);  
                    $id = $request->input('id');
                    $ClasseColaborador->atualizaFoto($id, $filename.'.'.$extension);
                }else{
                    echo json_encode('Formato de Foto inválido');
                }
            
            }else{
                echo json_encode('Arquivo Inválido');
            }
        }
    }

    public function viewEmployeeInfo($id){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseLocais = new ClasseLocais();
        $ClasseColaborador = new ClasseColaborador();

        $resposta = $ClasseColaborador->buscaDadosColaborador($id);

        $cidade = $ClasseLocais->buscaCidadePorId($resposta->id_cidade);
        $estado = $ClasseLocais->buscaEstadoPorId($resposta->id_estado);

        $resposta->cidade_colaborador = $cidade[0]->nome_cidade;
        $resposta->estado_colaborador = $estado[0]->nome_estado;
        echo json_encode($resposta);

    }

    public function updateEmployeeInfo(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();

        $nome = $request->input("nome-colaborador");
        $email = $request->input("email-colaborador");
        $data_nasc = $request->input('data-nasc');
        $telefone = $request->input("telefone");
        $genero = $request->input("genero");
        $saudacao = $request->input("saudacao");
        $estado_civil = $request->input("estado-civil");
        $cpf = $request->input("cpf");
        $escolaridade = $request->input("escolaridade");
        $contrato = $request->input("tipo-contrato");
        $nescessidade_especial = $request->input("necessidade-especial");
        $desc_necessidade = $request->input("desc-necessidade");
        $cargo = $request->input("cargo");
        $departamento = $request->input("depto");
        $senioridade = $request->input("grau-hierarquico");
        $usuario_colaborador = $request->input("usuario-colaborador");
        $cep = $request->input("num-cep");
        $num_endereco = $request->input("numero-endereco");
        $rua = $request->input("logradouro");
        $bairro = $request->input("bairro");
        $cidade = $request->input("cidade");
        $estado = $request->input("estado");
        $pais = $request->input("pais");
        $id = $request->input("id");


        $dadosColaborador = array($nome, $email, $data_nasc,
        $telefone, $genero, $saudacao, $estado_civil, $cpf,
        $escolaridade, $contrato, $nescessidade_especial, $desc_necessidade,
        $cargo, $departamento, $senioridade, $usuario_colaborador, $cep,
        $rua, $num_endereco, $bairro, $cidade, $estado, $pais, $id);

        $resposta = $ClasseColaborador->editarPrincipaisColaborador($dadosColaborador);

        echo json_encode($resposta);
    }

    public function viewBenefitInfo($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseBeneficios = new ClasseBeneficios();

        $resposta = $ClasseBeneficios->buscaBeneficiosColaborador($id);
        
        
        if(sizeof($resposta) > 0){ 
            foreach($resposta as  $value){
                $arrBeneficios[] = $value->id_beneficio; 
            }
        }else{
            $arrBeneficios = $resposta;
        }

        echo json_encode($arrBeneficios);
    }

    public function updateEmployeeDocuments(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();

        $rg = $request->input("rg");
        $data_rg = $request->input("data-expedicao-rg");
        $orgao_rg = $request->input("orgao-expedidor-rg");
        $inscricao_titulo = $request->input("num-titulo");
        $zona_eleitoral = $request->input("zona-eleitoral");
        $secao_eleitoral = $request->input("secao-eleitoral");
        $num_ctps = $request->input("num-ctps");
        $serie_ctps = $request->input("serie-ctps");
        $pis = $request->input("pis");
        $cnh = $request->input("num-cnh");
        $doc_reservista = $request->input("num-reservista");
        $id = $request->input("id");


        $dadosColaborador = array($rg,$data_rg, $orgao_rg,$inscricao_titulo,
        $zona_eleitoral,$secao_eleitoral,$num_ctps, $serie_ctps, $pis, $cnh,
        $doc_reservista, $id);

        $resposta = $ClasseColaborador->editarDocumentosColaborador($dadosColaborador);

        echo json_encode($resposta);
    }

    public function updateEmployeeBank(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();

        $banco = $request->input("banco");
        $agencia = $request->input("agencia");
        $num_conta = $request->input("num-conta");
        $id = $request->input("id");


        $dadosColaborador = array($banco, $agencia, $num_conta, $id);

        $resposta = $ClasseColaborador->editarBancoColaborador($dadosColaborador);

        echo json_encode($resposta);
    }
    
    public function updateEmployeeBenefits(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();

        $beneficios = $request->input("beneficios");
        $id = $request->input("id");


        $resposta = $ClasseColaborador->editarBeneficiosColaborador($beneficios, $id);

        echo json_encode($resposta);
    }
    
    public function updateEmployeeOther(Request $request){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseColaborador = new ClasseColaborador();

        $salario = $request->input('salario');
        $cnpj = $request->input('cnpj');
        $nome_mae = $request->input('nome-mae');
        $nome_pai = $request->input('nome-pai');
        $turno = $request->input('turno');
        $data_contratacao = $request->input('data-contratacao');
        $data_fim_contrato = $request->input('data-fim-contrato');
        $periodo_experiencia = $request->input('periodo-experiencia');
        $naturalidade = $request->input('naturalidade');
        $nacionalidade= $request->input('nacionalidade');
        $id = $request->input('id');


        $dadosColaborador = array($salario, $cnpj,$nome_mae, $nome_pai, $turno, $data_contratacao,
        $data_fim_contrato,$periodo_experiencia,$naturalidade, $nacionalidade ,$id);

        $resposta = $ClasseColaborador->editarOutrosColaborador($dadosColaborador);

        echo json_encode($resposta);
    }


}
