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

    <title>Basis | {{$nome_pagina}}</title>

<head>
    <!-- Custom styles for this template-->
    <link href="resources/css/sb-admin2/sb-admin-2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            </div>
            <!-- Content Row -->
            <div class="row">
                <!-- Meta de Serviço Card -->
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-left-danger shadow h-100">
                        <div class="card-body">
                            <!--Conteudo do site aqui-->
                            <div class="row">                 
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <textarea class="textarea" placeholder="Place some text here">                                            
                                      </textarea>
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
  <footer>
    <script src="resources/js/jquery/jquery.min.js"></script>
    <!--Bootstrap 4.3.1-->
    <script src="resources/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!--Summernote-->
    <script src="resources/js/summernote/summernote.js"></script>
    <script src="resources/js/summernote/dist_lang_summernote-pt-BR.js"></script>
  </footer>
</html>

<script type="text/javascript">
    $('.textarea').summernote({
        lang: 'pt-BR', 
        height: 250, //Definição da area de texto do editor
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['height', ['height']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']]
        
       ],
        fontSizes: [ '12', '16', '18', '24'],
    });

    function sendFile(file) {//função de envio de imagem recebida no POST: "/news/upload-image", para o editor HTML 
    var form_data = new FormData();
    form_data.append('file', file);
    $.ajax({
        data: form_data,
        type: "POST",
        url: '/news/upload-image',
        cache: false,
        contentType: false,
        processData: false,
        success: function (url) {
            $('#noticia').summernote('editor.insertImage', url); /*quando summernote preciasa armazenar imagem com a api
             usar: editor.insertImage*/
        }
    });
  }
</script>