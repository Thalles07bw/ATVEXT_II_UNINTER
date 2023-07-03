
<title>Curriculo_{{$nome}}</title>
<div style="text-align: center;"><img src="{{substr($foto,1)}}" style="max-width: 115px; max-height: 115px; border-radius: 50%"></div>
<h1 style="text-align:center">{{$nome}}</h1>
<h3 style="text-align:center">{{$email}}</h3>
<h3 style="text-align:center">{{$telefone}}</h3>
<span style="text-align: center"><h4>{{$rua}}, Nº {{$numero_end}}, {{$bairro}}, {{$cidade}}-{{$estado}}</h4><span>

<p style="text-align: left;">
  <span><u><b>Dados Pessoais</b></u></span>
  @foreach($generos as $genero)
    @if($genero->id_genero == $genero_usr)
    <p style="text-align: left;">Gênero: {{$genero->nome_genero}}</p>
    @endif
  @endforeach
  @foreach($estados_civis as $estado_civil)
    @if($estado_civil->id_estado_civil == $estado_civil_usr)
    <p style="text-align: left;">Estado Civil: {{$estado_civil->nome_estado_civil}}</p>
    @endif
  @endforeach
  @foreach($categorias_cnh as $categoria)
    @if($cnh != NULL)
      @if($categoria->id_categoria_cnh == $cnh->id_categoria_cnh)
      <p style="text-align: left;">Categoria da CNH: {{$categoria->categoria_cnh}}</p>
      @endif
    @endif
  @endforeach
</p>
@if($academicos != NULL)
<p style="text-align: left;">
  <span><u><b>Dados Acadêmicos</b></u></span>
  @foreach($academicos as $academico)
  <p style="text-align: left;">
    <b>{{$academico->curso_formacao_candidato}}</b> - {{$academico->nome_escolaridade}} -  
      @if($academico->data_fim_formacao == NULL)
      Em Andamento
      @else
      Concluído em:
      {{$academico->data_fim_formacao}}
      @endif
  </p>
  @endforeach
</p>
@endif
@if($habilidades != NULL)
<p style="text-align: left;">
  <span><u><b>Habilidades</b></u></span>
  @foreach($habilidades as $habilidade)
  <p style="text-align: left;">
  {{$habilidade->habilidade_candidato}} 
  @if($habilidade->nivel_habilidade_candidato == 1)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($habilidade->nivel_habilidade_candidato == 2)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($habilidade->nivel_habilidade_candidato == 3)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($habilidade->nivel_habilidade_candidato == 4)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($habilidade->nivel_habilidade_candidato == 5)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  </p>
  @endforeach
</p>
@endif
<p style="text-align: left;">
@if($idiomas != NULL)
<p style="text-align: left;">
  <span><u><b>Idiomas</b></u></span>
  @foreach($idiomas as $idioma)
  <p style="text-align: left;">
  {{$idioma->idioma}} 
  @if($idioma->nivel_idioma_candidato == 1)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($idioma->nivel_idioma_candidato == 2)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($idioma->nivel_idioma_candidato == 3)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($idioma->nivel_idioma_candidato == 4)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  @if($idioma->nivel_idioma_candidato == 5)
  &nbsp;<img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px"><img src="storage/images/loading/estrela.png" style="max-width: 15px">
  @endif
  </p>
  @endforeach
</p>
@endif
</p>


