<html>
@include('partials.header-candidato')

<body>
  <!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800 ">Portal do Candidato</h1>
		</div>
		<!-- Conteudo do site -->
		<div class="row">
			@if($dados_candidato)
			<div class="col-md-4" style="padding-bottom: 10px;">
					<div class="card border-left-danger shadow h-100 py-2">
						<div class="card-body" style="text-align: center;">
								<img  id="foto-click" src="/teste{{$dados_candidato->foto_candidato}}" 
								alt="User profile picture" width="128px" height="128px" style="border-radius: 50%; 
								cursor: pointer" 
								onmouseover="this.src='/teste/storage/app/images/users/change.png'; this.style.opacity=0.5"
								onmouseout="this.src='/teste{{$dados_candidato->foto_candidato}}'; this.style.opacity=1">
								<form id="troca-foto">
										@csrf
										<input type="file" id="FileInput" style="cursor: pointer;  display: none"/>
										<input type="submit" id="Up" style="display: none;" />
								</form>
								<h5 class="profile-username text-center" style="padding: 10px;">{{$nome}}</h5>
								<div class="author-info">
										<p style="font-size: 14px;">
												<span class="address">
														<i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i>
														{{$cidade}}
												</span>
										</p>
										<p>
												<span>
														<i class="fa fa-fw fa-phone"></i>
														{{$dados_candidato->numero_telefone}}
												</span>
										</p>
								</div>
						</div>
				</div>
			</div>
			@endif
			<div class="col-md-8" style="padding-bottom: 10px;">
				<div class="card border-left-danger shadow h-100 py-2">
					<div class="card-header">
						<h5>Vagas para você</h5>
					</div>
					<div class="card-body">
						<div class="col-md-6" style="font-size: 18px;">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<br>
@include('partials.footer-candidato')
<script type="text/javascript">
	  $("#foto-click").on('click', function() {
      $("#FileInput" ).click();
    });

		$( "#FileInput" ).change(function() {
      $("#Up").click();
    });

		$("#troca-foto").on('submit', function(e){
			e.preventDefault();
                  
    var photo = $('#FileInput').prop('files')[0];    //Arquivo
  
 
    var form_data = new FormData(); 

    form_data.append("photo", photo);
		
			$.ajax({
				url:'/teste/atualiza-foto',
				method: 'post',
				dataType: 'script',
      	cache: false,
      	contentType: false,
      	processData: false,
      	data: form_data
			}).done(function(data){
				document.location.reload(true);
			})
		})
</script>

</html>