

//Definição da classe que representa os cards que podem ser arrastados
const cards = document.querySelectorAll('.drag-card');
//Definição da área onde o card pode ser posicionado
const dropZones = document.querySelectorAll('.dropZone');

//Para Cada card definir a função de acordo com o evento de "arrastar" 
cards.forEach( (card) => {
  card.addEventListener( 'dragstart', dragStart );
  card.addEventListener( 'dragend', dragEnd );
})

function dragStart() {
  
  this.classList.add('dragging');

  switch(this.parentElement.id) {
    case 'quadro-1':
      this.firstElementChild.classList.remove('quadro-1');
      this.id = this.id;
      break;
    case 'quadro-2':
      this.firstElementChild.classList.remove('quadro-2');
      this.id = this.id;
      break;
    case 'quadro-3':
      this.firstElementChild.classList.remove('quadro-3');
      this.id = this.id;
    case 'quadro-4':
      this.firstElementChild.classList.remove('quadro-4');
      this.id = this.id;
    case 'quadro-5':
      this.firstElementChild.classList.remove('quadro-5');
      this.id = this.id;
    case 'quadro-6':
      this.firstElementChild.classList.remove('quadro-6');
      this.id = this.id;
      break;
    default:
      break;
  }
}


function dragEnd() {

  this.classList.remove('dragging');
  
  switch(this.parentElement.id) {
    case 'quadro-1':
      this.firstElementChild.classList.add('quadro-1');
      var data = this.id;
      $.ajax({
        url: '/atualizar-drag-n-drop',
        data:{'id_candidato': data, 'posicao': 1, 'id-vaga': $('#id-vaga').val()},
        method: 'post'
      })
      break;
    case 'quadro-2':
      this.firstElementChild.classList.add('quadro-2');
      var data = this.id;
      $.ajax({
        url:'/atualizar-drag-n-drop',
        data:{'id_candidato': data, 'posicao': 2, 'id-vaga': $('#id-vaga').val()},
        method: 'post'
      })
      break;
    case 'quadro-3':
      this.firstElementChild.classList.add('quadro-3');
      var data = this.id;
      $.ajax({
        url:'/atualizar-drag-n-drop',
        data:{'id_candidato': data, 'posicao': 3, 'id-vaga': $('#id-vaga').val()},
        method: 'post'
      })
      $.ajax({
        url: '/cadastra-prova-candidato',
        data: {'id-candidato': data, 'id-vaga': $('#id-vaga').val()},
        method: 'post'
      }).done(function(data){
        data = JSON.parse(data);
        if(data['flag'] == true){

          $('#alert-ok').show();   
          $('.success-alert-text').html('');    
          $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");  
          $('.success-alert-text').html(data['mensagem']);
        }
      })
      break;
    case 'quadro-4':
      this.firstElementChild.classList.add('quadro-4');
      var data = this.id;
      $.ajax({
        url:'/atualizar-drag-n-drop',
        data:{'id_candidato': data, 'posicao': 4, 'id-vaga': $('#id-vaga').val()},
        method: 'post'
      })
      break;
    case 'quadro-5':
      this.firstElementChild.classList.add('quadro-5');
      var data = this.id;
      $.ajax({
        url:'/atualizar-drag-n-drop',
        data:{'id_candidato': data, 'posicao': 5, 'id-vaga': $('#id-vaga').val()},
        method: 'post'
      })
      break;

      case 'quadro-6':
        this.firstElementChild.classList.add('quadro-6');
        var data = this.id;
        $.ajax({
          url:'/atualizar-drag-n-drop',
          data:{'id_candidato': data, 'posicao': 6, 'id-vaga': $('#id-vaga').val()},
          method: 'post'
        })
        break;
    default:
      break;
  }
}

dropZones.forEach( dropZone => {
  dropZone.addEventListener( 'dragover', dragOver );
  dropZone.addEventListener( 'dragleave', dragLeave );
  dropZone.addEventListener( 'drop', drop);
})



function dragOver() {
  this.classList.add('over');

  const cardBeingDragged = document.querySelector('.dragging');
 
  this.appendChild(cardBeingDragged);
}

function dragLeave() {
  this.classList.remove('over');
}

function drop() {
  this.classList.remove('over');
}