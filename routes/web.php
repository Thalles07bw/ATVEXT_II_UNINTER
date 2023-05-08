<?php

//inicio de sessão

session_start();

//uso de controllers

use App\Http\Controllers\AvaliacaoCandidatoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SenhaController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\BeneficioController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DemissaoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ExameProcedimentoController;
use App\Http\Controllers\ParentescoController;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\QuestoesController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\LoginCandidatoController;
use App\Http\Controllers\PortalCandidatoController;
use App\Http\Controllers\RegistroCandidatoController;
use App\Http\Controllers\SenhaCandidatoController;
use App\Http\Controllers\CurriculoController;
use App\Http\Controllers\ProcessoSeletivoController;
use App\Http\Controllers\CandidaturaController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\TreinamentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    if(isset($_SESSION['id_usuario'])){
        header("Location: /teste/principal");
        exit;
    }else{
        header("Location: /teste/login");
        exit;
    }
});
Route::get('/another', function(){
    if(isset($_SESSION['id_usuario'])){
        return view("another",["nome_pagina" => "Another",
        'id_usuario' => $_SESSION['id_usuario'] ,
        'nome' => $_SESSION['nome_usuario'] ,
        'empresa' => $_SESSION['empresa_usuario'] ,
        'permissao' => $_SESSION['permissao']
    ]);
    }
});
//Rotas Login
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'execute']);

//Rotas Principal
Route::get('/principal', [PrincipalController::class,'auth']);

//Rotas Recuperação de Senha
Route::get('/recuperar-senha', [SenhaController::class,'showRecover']);
Route::post('/recuperar-senha', [SenhaController::class,'executeRecover']);


//Rotas Para Criação de Nova Senha
Route::get('/nova-senha', [SenhaController::class,'showNew']);
Route::post('/nova-senha', [SenhaController::class,'executeNew']);

//Rotas Para registro de usuário
Route::get('/registrar', [RegistroController::class, 'show']);
Route::post('/registrar',[RegistroController::class, 'execute']);

//Rotas Para editor de texto
Route::get('/editor', function(){
    return view('editortexto', [
        'nome_pagina' => 'Editor',
        'nome' => $_SESSION['nome_usuario']
    ]);
});

/**************************Rotas Para CRUD Benefícios ***********************************************/

Route::get('/beneficios', [BeneficioController::class, 'show']);
Route::post('/beneficios', [BeneficioController::class, 'execute']);
Route::post('/beneficios/visualizar/{id}', function($id){
    $visualizacao = new BeneficioController();
    $visualizacao->view($id);
});
Route::post('/beneficios/deletar/{id}', function($id){
    $exclusao = new BeneficioController();
    $exclusao->delete($id);
});
Route::post('/beneficios/editar', [BeneficioController::class, 'edit']);

/**************************Rotas Para CRUD Departamentos***********************************************/

Route::get('/departamentos', [DepartamentoController::class, 'show']);
Route::post('/departamentos', [DepartamentoController::class, 'execute']);
Route::post('/departamentos/visualizar/{id}', function($id){
    $visualizacao = new DepartamentoController();
    $visualizacao->view($id);
});
Route::post('/departamentos/deletar/{id}', function($id){
    $exclusao = new DepartamentoController();
    $exclusao->delete($id);
});
Route::post('/departamentos/editar', [DepartamentoController::class, 'edit']);

/**************************Rotas Para CRUD Demissão***********************************************/

Route::get('/motivo-demissao', [DemissaoController::class, 'showReason']);
Route::post('/motivo-demissao', [DemissaoController::class, 'executeReason']);
Route::post('/motivo-demissao/visualizar/{id}', function($id){
    $visualizacao = new DemissaoController();
    $visualizacao->viewReason($id);
});
Route::post('/motivo-demissao/deletar/{id}', function($id){
    $exclusao = new DemissaoController();
    $exclusao->deleteReason($id);
});
Route::post('/motivo-demissao/editar', [DemissaoController::class, 'editReason']);


/**************************Rotas Para CRUD Contrato*************************************************/

Route::get('/tipo-contrato', [ContratoController::class, 'show']);
Route::post('/tipo-contrato', [ContratoController::class, 'execute']);
Route::post('/tipo-contrato/visualizar/{id}', function($id){
    $visualizacao = new ContratoController();
    $visualizacao->view($id);
});
Route::post('/tipo-contrato/deletar/{id}', function($id){
    $exclusao = new ContratoController();
    $exclusao->delete($id);
});
Route::post('/tipo-contrato/editar', [ContratoController::class, 'edit']);

/**************************Rotas Para CRUD Parentesco*************************************************/

Route::get('/cadastro-parentesco', [ParentescoController::class, 'show']);
Route::post('/cadastro-parentesco', [ParentescoController::class, 'execute']);
Route::post('/cadastro-parentesco/visualizar/{id}', function($id){
    $visualizacao = new ParentescoController();
    $visualizacao->view($id);
});
Route::post('/cadastro-parentesco/deletar/{id}', function($id){
    $exclusao = new ParentescoController();
    $exclusao->delete($id);
});
Route::post('/cadastro-parentesco/editar', [ParentescoController::class, 'edit']);

/**************************Rotas Para CRUD Exame ou Procedimento***************************************/

Route::get('/cadastro-exame-procedimento', [ExameProcedimentoController::class, 'show']);
Route::post('/cadastro-exame-procedimento', [ExameProcedimentoController::class, 'execute']);
Route::post('/cadastro-exame-procedimento/visualizar/{id}', function($id){
    $visualizacao = new ExameProcedimentoController();
    $visualizacao->view($id);
});
Route::post('/cadastro-exame-procedimento/deletar/{id}', function($id){
    $exclusao = new ExameProcedimentoController();
    $exclusao->delete($id);
});
Route::post('/cadastro-exame-procedimento/editar', [ExameProcedimentoController::class, 'edit']);
/**************************************Cadastro do Colaborador**************************************** */
Route::get('/colaborador',[ColaboradorController::class, 'show']);
Route::post('/colaborador', [ColaboradorController::class,'execute']);
Route::post('/atualiza-foto-colaborador', [ColaboradorController::class, 'updatePhoto']);
Route::post('/colaborador/visualizar-principais/{id}', [ColaboradorController::class, 'viewEmployeeInfo']);
Route::post('/colaborador/visualizar-documentos/{id}', [ColaboradorController::class, 'viewEmployeeInfo']);
Route::post('/colaborador/visualizar-bancarios/{id}', [ColaboradorController::class, 'viewEmployeeInfo']);
Route::post('/colaborador/visualizar-beneficios/{id}', [ColaboradorController::class, 'viewBenefitInfo']);
Route::post('/colaborador/visualizar-outros/{id}', [ColaboradorController::class, 'viewEmployeeInfo']);
Route::post('/colaborador/editar-principais', [ColaboradorController::class, 'updateEmployeeInfo']);
Route::post('/colaborador/editar-documentos', [ColaboradorController::class, 'updateEmployeeDocuments']);
Route::post('/colaborador/editar-bancarios', [ColaboradorController::class, 'updateEmployeeBank']);
Route::post('/colaborador/editar-outros', [ColaboradorController::class, 'updateEmployeeOther']);
Route::post('/colaborador/editar-beneficios', [ColaboradorController::class, 'updateEmployeeBenefits']);

/**************************************Cadastro do Usuário******************************************/
Route::get('/usuarios',[UsuarioController::class, 'show']);
Route::post('/usuarios', [UsuarioController::class, 'execute']);
Route::post('/usuarios/visualizar/{id}', [UsuarioController::class, 'view']);
Route::post('/usuarios/editar', [UsuarioController::class,'edit']);
Route::post('/usuarios/ativar/{id}', [UsuarioController::class,'enable']);
Route::post('/usuarios/desativar/{id}', [UsuarioController::class,'disable']);
Route::get('/usuarios-inativos', [UsuarioController::class, 'showDisabled']);
/**************************************Cadastro de Demissão*****************************************/
Route::get('/demissoes',[DemissaoController::class, 'show']);
Route::post('/demissoes',[DemissaoController::class, 'execute']);
Route::post('/demissoes/editar',[DemissaoController::class, 'edit']);
Route::post('/demissoes/cancelar/{id}',[DemissaoController::class, 'cancel']);

/*****************************************Fazer Prova***********************************************/
Route::get('/prova/{id_prova}', [ProvaController::class, 'show']);
Route::post('/prova/{id_prova}', [ProvaController::class, 'next']);
/*****************************************Prova*****************************************************/
Route::get('/cadastrar-avaliacao', [ProvaController::class, 'viewCreate']);
Route::get('/cadastrar-avaliacao/desativadas', [ProvaController::class, 'viewDisabled']);
Route::post('/cadastrar-avaliacao', [ProvaController::class, 'executeCreate']);
Route::post('/cadastrar-avaliacao/copia/{id}', [ProvaController::class, 'copy']);
Route::post('/cadastrar-avaliacao/desativar/{id}', [ProvaController::class, 'disable']);
Route::post('/cadastrar-avaliacao/reativar/{id}', [ProvaController::class, 'enable']);
Route::post('/cadastrar-avaliacao/visualizar/{id}', [ProvaController::class, 'view']);
Route::post('/cadastrar-avaliacao/editar', [ProvaController::class, 'edit']);
/*************************************Questões de Prova*******************************************/
Route::get('/cadastrar-questoes/{id}', [QuestoesController::class, 'show']);
Route::post('/cadastrar-questoes/{id}', [QuestoesController::class, 'execute']);
Route::post('/cadastrar-questoes/anular/{id}', [QuestoesController::class, 'cancel']);
Route::post('/cadastrar-questoes/ver-alternativas/{id}', [QuestoesController::class, 'showAlternatives']);
/******************************************Cargos*************************************************/
Route::get('/cadastro-cargos', [CargoController::class, 'show']);
Route::post('/cadastro-cargos', [CargoController::class, 'execute']);
Route::post('/cadastro-cargos/visualizar/{id}', function($id){
    $visualizacao = new CargoController();
    $visualizacao->view($id);
});
Route::post('/cadastro-cargos/deletar/{id}', function($id){
    $exclusao = new CargoController();
    $exclusao->delete($id);
});
Route::post('/cadastro-cargos/editar', [CargoController::class, 'edit']);
/******************************************Vagas**************************************************/
Route::get('/cadastro-vagas', [VagaController::class, 'show']);
Route::post('/cadastro-vagas', [VagaController::class, 'execute']);
Route::post('/cadastro-vagas/visualizar/{id}', function($id){
    $visualizacao = new VagaController();
    $visualizacao->view($id);
});
Route::post('/cadastro-vagas/deletar/{id}', function($id){
    $exclusao = new VagaController();
    $exclusao->delete($id);
});
Route::post('/cadastro-vagas/editar', [VagaController::class, 'edit']);
Route::get('/personalizar-mural', [VagaController::class, 'customize']);
Route::post('/personalizar-mural', [VagaController::class, 'customizeExecute']);
Route::post('/personalizar-mural/editar', [VagaController::class, 'customizeEdit']);
Route::get('/mural-vagas/{id}', [VagaController::class, 'showCompanyPage']);
Route::post('/candidatar-se', [VagaController::class, 'application']);
Route::get('/quadro-processo-seletivo/{id}', [ProcessoSeletivoController::class,'view']);
Route::post('/atualizar-drag-n-drop', [ProcessoSeletivoController::class,'execute']);
Route::get('/modificar-etapas/{id}', [ProcessoSeletivoController::class,'modifyView']);
Route::post('/modificar-etapas', [ProcessoSeletivoController::class,'modifySave']);
Route::post('/modificar-etapas/deletar', [ProcessoSeletivoController::class,'modifyDelete']);
Route::post('/cadastra-prova-candidato', [ProcessoSeletivoController::class, 'applicantTest']);
Route::get('/resultado-avaliacao',[ProcessoSeletivoController::class, 'showTestResult']);
Route::get('/ver-curriculo/{id}', [PdfController::class, 'generatePdfCurriculo']);
/************************************Treinamentos**************************************************/
//Agenda
Route::get('/agenda-treinamentos', [TreinamentoController::class, 'showTimelineSearch']);
Route::get('/agenda-geral-treinamentos', [TreinamentoController::class, 'showGeneralTimelineSearch']);
//Lista de Presença
Route::get('/tabela-participantes/{id}', [TreinamentoController::class, 'showParticipantList']);
Route::get('/registro-presenca/{id}',[TreinamentoController::class, 'showAttendanceList']);
Route::post('/registro-presenca/{id}',[TreinamentoController::class, 'executeAttendanceList']);
//Locais
Route::get('/salas-de-aula', [TreinamentoController::class, 'showClassrooms']);
Route::post('/salas-de-aula', [TreinamentoController::class, 'executeClassrooms']);
Route::post('/salas-de-aula/visualizar/{id}', [TreinamentoController::class, 'viewClassrooms']);
Route::post('/salas-de-aula/editar', [TreinamentoController::class, 'editClassrooms']);
Route::post('/salas-de-aula/deletar/{id}', [TreinamentoController::class, 'deleteClassrooms']);
//Aulas
Route::get('/cadastrar-aula', [TreinamentoController::class, 'showLessons']);
Route::post('/cadastrar-aula', [TreinamentoController::class, 'executeLessons']);
Route::post('/cadastrar-aula/visualizar/{id}', [TreinamentoController::class, 'viewLessons']);
Route::post('/cadastrar-aula/editar', [TreinamentoController::class, 'editLessons']);
Route::post('/cadastrar-aula/deletar/{id}', [TreinamentoController::class, 'deleteLessons']);
//Cursos
Route::get('/cadastrar-cursos', [TreinamentoController::class, 'showCourses']);
Route::post('/cadastrar-cursos', [TreinamentoController::class, 'executeCourses']);
Route::post('/cadastrar-cursos/visualizar/{id}', [TreinamentoController::class, 'viewCourses']);
Route::post('/cadastrar-cursos/editar', [TreinamentoController::class, 'editCourses']);
Route::post('/cadastrar-cursos/deletar/{id}', [TreinamentoController::class, 'deleteCourses']);
//Instrutores
Route::get('/instrutores', [TreinamentoController::class, 'showTeachers']);
Route::post('/instrutores', [TreinamentoController::class, 'executeTeachers']);
Route::post('/atualiza-foto-instrutor', [TreinamentoController::class, 'updatePhoto']);
Route::post('/instrutores/visualizar/{id}', [TreinamentoController::class, 'viewTeachers']);
Route::post('/instrutores/editar', [TreinamentoController::class, 'editTeachers']);
Route::post('/instrutores/desativar/{id}', [TreinamentoController::class, 'disableTeacher']);
//Turmas
Route::get('/cadastrar-treinamento', [TreinamentoController::class, 'showTraining']);
Route::post('/cadastrar-treinamento', [TreinamentoController::class, 'executeTraining']);
Route::post('/cadastrar-treinamento/visualizar/{id}', [TreinamentoController::class, 'viewTraining']);
Route::post('/cadastrar-treinamento/editar', [TreinamentoController::class, 'editTraining']);
Route::post('/cadastrar-treinamento/editar-turma', [TreinamentoController::class, 'editTrainingClass']);
Route::post('cadastrar-treinamento/turma/{id}', [TreinamentoController::class, 'viewTrainingClass']);
//Diretriz
Route::get('/diretrizes', [TreinamentoController::class, 'showGuideline']);
Route::post('/diretrizes', [TreinamentoController::class, 'executeGuideline']);
Route::post('/diretrizes/visualizar/{id}', [TreinamentoController::class, 'viewGuideline']);
Route::post('/diretrizes/editar', [TreinamentoController::class, 'editGuideline']);
Route::post('/diretrizes/deletar/{id}', [TreinamentoController::class, 'deleteGuideline']);
//Percentual
Route::get('/percentual-treinamento',[TreinamentoController::class, 'showPercentual']);
//Arquivos
Route::get('/inserir-arquivos-treinamento', [TreinamentoController::class, 'showFiles']);
Route::post('/filtrar-participantes-treinamento', [TreinamentoController::class, 'filterParticipants']);
Route::post('/inserir-arquivos-treinamento', [TreinamentoController::class, 'executeFiles']);
//Pesquisa de Satisfação
Route::get('/pesquisa-satisfacao/{id}', [TreinamentoController::class, 'showAvaliation']);
/************************************Empresas******************************************************/
Route::get('/cadastrar-empresa', [EmpresasController::class, 'show']);
Route::post('/cadastrar-empresa/alterar/{id}', [EmpresasController::class, 'alter']);
Route::post('/cadastrar-empresa', [EmpresasController::class, 'execute']);
Route::post('/cadastrar-empresa/visualizar/{id}', [EmpresasController::class, 'view']);
Route::post('/cadastrar-empresa/editar', [EmpresasController::class, 'edit']);


/**************************************Logout*****************************************************/
Route::get('/logout', function(){
    session_destroy();
    header("Location: /teste/login");
    exit;
});
/*************************************************************************************************/
/**************************************Login de Candidatos/***************************************/
Route::get('login-candidato' , [LoginCandidatoController::class, 'show']);
Route::post('login-candidato' , [LoginCandidatoController::class, 'execute']);
/***********************************Registro de Candidatos****************************************/
Route::get('registro-candidato' , [RegistroCandidatoController::class, 'show']);
Route::post('registro-candidato' , [RegistroCandidatoController::class, 'execute']);

//Rotas de Nova Senha do Candidato
Route::get('/nova-senha-candidato', [SenhaCandidatoController::class,'showNew']);
Route::post('/nova-senha-candidato', [SenhaCandidatoController::class,'executeNew']);

//Rotas Recuperação de Senha do Candidato
Route::get('/recuperar-senha-candidato', [SenhaCandidatoController::class,'showRecover']);
Route::post('/recuperar-senha-candidato', [SenhaCandidatoController::class,'executeRecover']);

//Portal do candidato
Route::get('/portal-do-candidato', [PortalCandidatoController::class, 'authentication']);

//Curriculo do candidato (dados principais)
Route::get('/curriculo', [CurriculoController::class, 'show']);
Route::post('/curriculo', [CurriculoController::class, 'execute']);

//Curriculo do candidato (Idiomas)
Route::get('/idiomas', [CurriculoController::class, 'showLanguages']);
Route::post('/idiomas', [CurriculoController::class,'executeLanguages']);
Route::post('/salvar-alteracoes-idioma', [CurriculoController::class,'saveLanguageChanges']);
Route::post('/idiomas/deletar/{id}', [CurriculoController::class,'deleteLanguage']);

//Curriculo do candidato (Habilidades)
Route::get('/habilidades', [CurriculoController::class, 'showAbilities']);
Route::post('/habilidades', [CurriculoController::class,'executeAbilities']);
Route::post('/salvar-alteracoes-habilidade', [CurriculoController::class,'saveAbilityChanges']);
Route::post('/habilidades/deletar/{id}', [CurriculoController::class,'deleteAbility']);
//Curriculo do candidato (Formação Acadêmica)
Route::get('/formacao', [CurriculoController::class, 'showAcademical']);
Route::post('/formacao', [CurriculoController::class, 'executeAcademical']);
Route::post('/formacao/visualizar/{id}', [CurriculoController::class, 'viewAcademical']);
Route::post('/formacao/editar', [CurriculoController::class, 'editAcademical']);
Route::post('/formacao/deletar/{id}', [CurriculoController::class,'deleteAcademical']);

//Dados não obrigatórios
Route::post('/atualiza-foto', [CurriculoController::class, 'updatePhoto']);
Route::get('/habilitacao', [CurriculoController::class, 'showCNH']);
Route::post('/habilitacao', [CurriculoController::class, 'executeCNH']);

//Candidaturas
Route::get('/candidaturas',[CandidaturaController::class, 'show']);
Route::post('/candidaturas/cancelar/{id}',[CandidaturaController::class, 'cancel']);

//Avaliações do candidato
Route::get('/avaliacoes-candidato', [AvaliacaoCandidatoController::class, 'show']);



Route::get('/logout-candidato', function(){
    session_destroy();
    header("Location: /teste/login-candidato");
    exit;
});

