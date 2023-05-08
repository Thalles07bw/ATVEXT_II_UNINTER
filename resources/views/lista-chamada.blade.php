<!DOCTYPE html>
<html>
  <head>
    <style>
    table, th, td {
      border:1px solid black;
    }
    </style>
    <H2>Data:&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/</H2>
  </head>
  
  <body>
    <h2>{{$alunos[0]->descricao_treinamento}}</h2>
    <table style="width:50%">
      <tr>
        <th>Nome</th>
        <th>Presente</th>
      </tr>
      @foreach ($alunos as $aluno)
      <tr>
        <td>{{$aluno->nome_colaborador}}</td>
        <td style="width: 10%;"></td>
      </tr>
      @endforeach
    </table>
  </body>
</html>

