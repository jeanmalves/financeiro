function formataDinheiro(valor) {
    var valor_formatado;
    var valores;
    
    valor = parseFloat(valor);   
    valor = valor.toFixed(2);
    valores = valor.split('.'); 
    
    if(valores[1].length > 2) {
        valores[1] += "0";
    }
    
    valor_formatado = valores[0] + "," + valores[1];
    
    return valor_formatado;
}

function insereRegistro(elem, ordem) {
    var classValor = (elem.tipo == "C")? 'valor-credito':'valor-debito';
    
    var tr = $('<tr>'+
        '<td>'+ elem.data +'</td>'+
        '<td>'+ elem.descricao +'</td>'+
        '<td>'+ elem.categoria +'</td>'+
        '<td>'+ elem.tipo+'</td>'+
        '<td class="'+classValor+'">R$ '+ formataDinheiro(elem.valor) +'</td>'+
      '</tr>');

    if(ordem == "append"){  
        $('#rel-30dias tbody').append(tr);
    } else {    
        $('#rel-30dias tbody').prepend(tr);
    }
}

function formataDataDB(data) {
    var data = new Date(data);
    var data_formatada = data.getDate() + '/' + (data.getMonth()+1) + '/' + data.getFullYear();
    
    return data_formatada;
}