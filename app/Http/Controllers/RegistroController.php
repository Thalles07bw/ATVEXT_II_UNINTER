<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Classes\ClasseRegistro;
use App\Classes\ClasseLocais;
use App\Classes\ClasseLogin;


class RegistroController extends Controller
{
    public function show(){
        $tipo_registro = new ClasseRegistro();
        $import_locais = new ClasseLocais();
        $tipos = $tipo_registro->buscaTiposCliente();
        $tamanhos_empresas = $tipo_registro->buscaTamanhoEmpresa();
        $paises = $import_locais->buscaPaises();
        $estados = $import_locais->buscaEstados();
        $cidades = $import_locais->buscaCidades(); 
        
        return view('registro', [
            'arrayTipos' => $tipos,
            'arrayPaises' => $paises,
            'arrayEstados' => $estados,
            'arrayCidades' => $cidades,
            'arrayTamanhoEmpresas' => $tamanhos_empresas
        ]);
    }
    public function execute(Request $request){
        $import_registro = new ClasseRegistro();
        $login_cadastrado = new ClasseLogin();

        $nome_cliente = $request->input('nome-cliente');
        $email_cliente = $request->input('email-cliente');
        $telefone_cliente = $request->input('telefone-cliente');
        $tipo_cliente = $request->input('tipo-cliente');
        $id_tamanho_empresa = $request->input('id-tamanho-empresa');
        $nome = $request->input('nome-empresa');
        $telefone = $request->input('telefone-empresa');
        $pais = $request->input('pais');
        $estado = $request->input('estado');
        $cidade = $request->input('cidade');
   
        
        if($login_cadastrado->buscaUsuario($email_cliente) == NULL){
            $last_insert_id_empresa = $import_registro->cadastroInicialEmpresa($nome,$telefone,$pais,$cidade,
            $estado,$id_tamanho_empresa, $tipo_cliente);

            $import_registro->cadastroInicialCliente($nome_cliente,$telefone_cliente,
            $last_insert_id_empresa,$email_cliente);
        }else{
            $mensagem = "O e-mail já foi cadastrado";
            echo json_encode(["flag" => false, "mensagem" => $mensagem]);
        }

        


    }
}
