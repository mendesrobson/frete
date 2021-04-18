$( "#codcliente" ).change(function() {

    $.ajax({
        url : "https://sonasystem.com.br/apis/v1/clientes/buscarcodigo/codigo="+ $( "#codcliente" ).val(),
        type : 'get',
        beforeSend : function(){
            $("#loading").show();
             console.log("ENVIANDO...")
        }
   })
   .done(function(msg){
        if(msg.status == 200){
            $("#Cliente").val(msg.dados[0].NomeFantasia);
        }
        $("#loading").hide();
   })
   .fail(function(jqXHR, textStatus, msg){
        alert(msg);
   });

    // $("#Cliente").val($( "#codcliente" ).val());
});



function autocomplete(inp, arr) {
    /* a função de preenchimento automático leva dois argumentos,
    o elemento do campo de texto e uma matriz de possíveis valores preenchidos automaticamente: */
  var currentFocus;
  /*executa uma função quando alguém escreve no campo de texto: */
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*feche todas as listas já abertas de valores preenchidos automaticamente*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*crie um elemento DIV que conterá os itens (valores):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*anexar o elemento DIV como um filho do contêiner de preenchimento automático*/
      this.parentNode.appendChild(a);
      /*para cada item da matriz ..*/
      for (i = 0; i < arr.length; i++) {
        /*verifique se o item começa com as mesmas letras do valor do campo de texto:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*crie um elemento DIV para cada elemento correspondente:*/
          b = document.createElement("DIV");
          /*deixe as letras correspondentes em negrito:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insira um campo de entrada que conterá o valor do item da matriz atual:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*executa uma função quando alguém clica no valor do item (elemento DIV):*/
          b.addEventListener("click", function(e) {
              /*insira o valor para o campo de texto de preenchimento automático:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*feche a lista de valores de preenchimento automático 
              (ou qualquer outra lista aberta de valores de preenchimento automático:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*executar uma função pressionando uma tecla no teclado:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*Se a tecla de seta para BAIXO for pressionada,
         aumente a variável currentFocus:*/
        currentFocus++;
        /*e e tornar o item atual mais visível:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*Se a tecla de seta para cima for pressionada,
         diminua a variável currentFocus:*/
        currentFocus--;
        /*ee tornar o item atual mais visível:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*Se a tecla ENTER for pressionada, evita que o formulário seja enviado,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*e simular um clique no item "ativo":*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*uma função para classificar um item como "ativo":*/
    if (!x) return false;
    /*comece removendo a classe "ativa" em todos os itens:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*adicione a classe "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*uma função para remover a classe "ativa" de todos os itens de preenchimento automático:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*feche todas as listas de preenchimento automático no documento,
     exceto aquele passado como um argumento:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
var clientes = [];

$.ajax({
    url : "https://sonasystem.com.br/apis/v1/clientes/buscarnome",
    type : 'get',
    beforeSend : function(){
         console.log("ENVIANDO...")
    }
})
.done(function(msg){
    if(msg.status == 200){
        for (var i = 0; i < msg.dados.length; i++) {
            clientes.push(msg.dados[i].NomeFantasia);
          }
    }
    console.log(clientes);
})
.fail(function(jqXHR, textStatus, msg){
    alert(msg);
});

/*Uma matriz contendo todos os nomes de países do mundo:*/
//var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*inicie a função de preenchimento automático no elemento "myInput" e transmita a matriz de países como possíveis valores de preenchimento automático:*/
autocomplete(document.getElementById("Cliente"), clientes);