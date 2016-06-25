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