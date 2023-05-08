<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Classes\ClasseCurriculo;
use App\Classes\ClasseLocais;


class PdfController extends Controller
{
    public function generatePdfCurriculo($id)
    {   
        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseLocais = new ClasseLocais();
        
        $id_candidato = $ClasseCurriculo->buscaIdUsuarioCandidato($id);
        $id_candidato = $id_candidato->id_usuario_candidato;
    

        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($id_candidato);
        $dados_curriculo = $ClasseCurriculo->buscaDadosCurriculo($id_candidato);
        $generos = $ClasseCurriculo->buscaGeneros();
        $estados_civis = $ClasseCurriculo->buscaEstadoCivil();
        $cnh = $ClasseCurriculo->buscaCNHcandidato($id_candidato);
        $categorias_cnh = $ClasseCurriculo->buscaCategoriasCNH();
        $cidade = $ClasseLocais->buscaCidadePorId($dados_curriculo->id_cidade);
        $estado = $ClasseLocais->buscaEstadoPorId($dados_curriculo->id_estado);
        $academicos = $ClasseCurriculo->buscaFormacoesCandidato($id_candidato);
        $habilidades = $ClasseCurriculo->buscaHabilidadesCandidato($id_candidato);
        $idiomas = $ClasseCurriculo->buscaIdiomasCandidato($id_candidato);
       
        $arrDados = [
            'nome' => $dados_usuario->nome_usuario_candidato,
            'email' => $dados_usuario->email_usuario_candidato,
            'rua' => $dados_curriculo->logradouro_candidato,
            'numero_end' => $dados_curriculo->numero_endereco_candidato,
            'telefone' => $dados_curriculo->numero_whatsapp,
            'bairro' => $dados_curriculo->bairro_candidato,
            'genero_usr' => $dados_curriculo->id_genero,
            'estado_civil_usr' => $dados_curriculo->id_estado_civil,
            'cnh' => $cnh,
            'generos' => $generos,
            'cidade' => $cidade[0]->nome_cidade,
            'estado' => $estado[0]->nome_estado,
            'estados_civis' => $estados_civis,
            'categorias_cnh' => $categorias_cnh,
            'academicos' => $academicos,
            'idiomas' => $idiomas,
            'habilidades' => $habilidades,
            'foto' => $dados_curriculo->foto_candidato
        ];

        $pdf = PDF::loadView('curriculo', $arrDados);
        return $pdf->stream();
    }
}
