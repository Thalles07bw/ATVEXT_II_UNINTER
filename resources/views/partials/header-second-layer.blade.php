<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Quero Trampar | {{$nome_pagina}}</title>

    <!--Favicon-->
    <link
      rel="shortcut icon"
      href=""
      type="image/x-icon"
    />

    <!-- Custom fonts for this template-->
    <link
      href="../resources/css/fontawesome-free/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="../resources/css/sb-admin2/sb-admin-2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <!--Datatables-->
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <!-- Sidebar - Brand -->
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="/principal"
        >
          <div class="sidebar-brand-icon">
            <img src="../resources/img/logo.png" width=50px>
          </div>
          <div class="sidebar-brand-text mx-3" style="color: orange">
          </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="/principal">
            <i class="fas fa-fw fa-home"></i>
            <span>Principal</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider"/>

        <!-- Heading -->
        <!--<div class="sidebar-heading">Componentes</div>-->

        <!-- Nav Item - Pages Collapse Menu -->

        <!-- Nav Item - Ticket Collapse Menu -->
        
        <!--Item do menu #1-->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseRH"
            aria-expanded="true"
            aria-controls="collapseRH"
          >
          <i class="fas fa-users"></i>
          <span>Gestão de RH</span>
        </a>
        <div
          id="collapseRH"
          class="collapse"
          aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/beneficios">Benefícios</a>
            <a class="collapse-item" href="/usuarios">Cadastrar Usuário </a>
            <a class="collapse-item" href="/cadastro-cargos">Cadastro de Cargos</a>
            <a class="collapse-item" href="/colaborador">Cadastrar Colaborador</a>            
            <a class="collapse-item" href="/demissoes">Demissões</a>      
            <a class="collapse-item" href="/departamentos">Departamentos</a>
            
          </div>
        </div>
      </li>
      <!--Fim item do menu #2-->

      <!--Item do menu-->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseVagas"
          aria-expanded="true"
          aria-controls="collapseVagas"
        >
          <i class="fas fa-file-signature"></i>
          <span>Vagas</span>
        </a>
        <div
          id="collapseVagas"
          class="collapse"
          aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
           
            <a class="collapse-item" href="/cadastro-vagas">Cadastro de Vagas</a>
            <a class="collapse-item" href="/personalizar-mural">Personalizar Mural</a>
            <a class="collapse-item" href="/resultado-avaliacao">Resultados de Avaliações</a>
          </div>
        </div>
      </li>
      <!--Fim item do menu-->

      <!--Item do menu #3-->
      <li class="nav-item">
      <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#collapseTreinamentos"
        aria-expanded="true"
        aria-controls="collapseTreinamentos"
      >
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Treinamento</span>
      </a>
      <div
        id="collapseTreinamentos"
        class="collapse"
        aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar"
      >
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="/instrutores">Cadastrar Instrutor</a>
          <a class="collapse-item" href="/cadastrar-cursos">Cadastrar Curso</a>
          <a class="collapse-item" href="/salas-de-aula">Cadastrar Salas de Aula</a>
          <a class="collapse-item"  href="/diretrizes">Cadastrar Diretriz</a>
          <a class="collapse-item" href="/inserir-arquivos-treinamento">Cadastrar Arquivos</a>
          <a class="collapse-item" href="/cadastrar-treinamento">Cadastrar Treinamento</a>
          <a class="collapse-item" href="/cadastrar-aula">Cadastrar Aula</a> 
          <a class="collapse-item" href="/agenda-treinamentos">Agenda de Treinamentos</a>
          <a class="collapse-item" href="/agenda-geral-treinamentos">Agenda Geral de Aulas</a>
          <a class="collapse-item" href="/percentual-treinamento">Percentual de Conclusão</a>
        </div>
      </div>
    </li>
      <!--Fim item do menu-->
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#collapseAvaliacoes"
        aria-expanded="true"
        aria-controls="collapseAvaliacoes"
      >
        <i class="fas fa-file-signature"></i>
        <span>Avaliações</span>
      </a>
      <div
        id="collapseAvaliacoes"
        class="collapse"
        aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar"
      >
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="/cadastrar-avaliacao">Criar Avaliação</a>

        </div>
      </div>
    </li>
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#collapseEmpresas"
        aria-expanded="true"
        aria-controls="collapseEmpresas"
      >
        <i class="fas fa-industry"></i>
        <span>Empresas</span>
      </a>
      <div
        id="collapseEmpresas"
        class="collapse"
        aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar"
      >
        <div class="bg-white py-2 collapse-inner rounded">

          <a class="collapse-item" href="/cadastrar-empresa">Suas Empresas</a>

        </div>
      </div>
    </li>
    <!--Fim item do menu-->
    <hr class="sidebar-divider d-none d-md-block" />
    <li class="nav-item">
          <a
            class="nav-link"
            id="configuracoes-open"
            data-target="#configuracoes" data-toggle="modal" 
            href="#configuracoes"
          >
            <i class="fas fa-cog"></i>
            <span>Configurações</span></a
          >
        </li>

    <hr class="sidebar-divider d-none d-md-block" />
  
        <li class="nav-item">
          <a
            class="nav-link"
            id="suporte-open"
            data-target="#suporte" data-toggle="modal" 
            href="#suporte"
          >
            <i class="far fa-question-circle"></i>
            <span>Suporte</span></a
          >
        </li>
        
      
  

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>

      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav
            class="
              navbar navbar-expand navbar-light
              bg-white
              topbar
              mb-4
              static-top
              shadow
            "
          >
            <!-- Sidebar Toggle (Topbar) -->
            <button
              id="sidebarToggleTop"
              class="btn btn-link d-md-none rounded-circle mr-3"
            >
              <i class="fa fa-bars"></i>
            </button>



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"
                    >{{ $nome }}</span>

                  <i class="fas fa-user"></i>
                </a>
                <!-- Dropdown - User Information -->
                <div
                  class="
                    dropdown-menu dropdown-menu-right
                    shadow
                    animated--grow-in
                  "
                  aria-labelledby="userDropdown"
                >
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" data-toggle="modal"  data-target="#logoutModal" href="#">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->