<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/beneficios/visualizar/*',
        '/beneficios/deletar/*',
        '/departamentos/visualizar/*',
        '/departamentos/deletar/*',
        '/motivo-demissao/visualizar/*',
        '/motivo-demissao/deletar/*',
        '/tipo-contrato/visualizar/*',
        '/tipo-contrato/deletar/*',
        '/cadastro-parentesco/visualizar/*',
        '/cadastro-parentesco/deletar/*',
        '/cadastro-exame-procedimento/visualizar/*',
        '/cadastro-exame-procedimento/deletar/*',
        '/cadastrar-questoes/anular/*',
        '/cadastrar-questoes/ver-alternativas/*',
        '/cadastrar-avaliacao/copia/*',
        '/cadastrar-avaliacao/desativar/*',
        '/cadastrar-avaliacao/visualizar/*',
        '/cadastrar-avaliacao/reativar/*',
        '/cadastro-cargos/visualizar/*',
        '/cadastro-cargos/deletar/*',
        '/cadastro-vagas/visualizar/*',
        '/cadastro-vagas/deletar/*',
        '/personalizar-mural',
        '/personalizar-mural/editar',
        '/candidatar-se',
        '/atualizar-drag-n-drop',
        '/salvar-alteracoes-idioma',
        '/idiomas/deletar/*',
        '/salvar-alteracoes-habilidade',
        '/habilidades/deletar/*',
        '/formacao/visualizar/*',
        '/formacao/deletar/*',
        '/atualiza-foto',
        '/modificar-etapas',
        '/modificar-etapas/deletar',
        '/candidaturas/cancelar/*',
        '/cadastra-prova-candidato',
        'usuarios/*',
        '/atualiza-foto-colaborador',
        '/colaborador/visualizar-*',
        '/demissoes/cancelar/*',
        '/atualiza-foto-instrutor',
        '/instrutores/visualizar/*',
        '/instrutores/desativar/*',
        '/cadastrar-cursos/visualizar/*',
        '/cadastrar-cursos/deletar/*',
        '/cadastrar-treinamento/visualizar/*',
        '/cadastrar-treinamento/turma/*',
        '/salas-de-aula/visualizar/*',
        '/salas-de-aula/deletar/*',
        '/cadastrar-aula/visualizar/*',
        '/cadastrar-aula/deletar/*',
        '/agenda-treinamentos*',
        '/cadastrar-empresa/alterar/*',
        '/cadastrar-empresa/visualizar/*',
        '/diretrizes/visualizar/*',
        '/diretrizes/deletar/*',
        '/registro-presenca/*',
        '/filtrar-participantes-treinamento',
        '/inserir-arquivos-treinamento'
    ];
}
