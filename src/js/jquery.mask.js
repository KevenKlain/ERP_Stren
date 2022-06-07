function mascara(i,t){

    var v = i.value;

    if(isNaN(v[v.length-1])){
        i.value = v.substring(0, v.length-1);
        return;
    }

    if(t == "data"){
        i.setAttribute("maxlength", "100");
        if (v.length == 2 || v.length == 5) i.value += "/";
    }

    if(t == "cpf"){
        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";
    }

    if(t == "cnpj"){
        i.setAttribute("maxlength", "18");
        if (v.length == 2 || v.length == 6) i.value += ".";
        if (v.length == 10) i.value += "/";
        if (v.length == 15) i.value += "-";
    }
}
String.prototype.reverse = function(){
    return this.split('').reverse().join(''); 
    };

    function mascaraMoeda(campo,evento){
    var tecla = (!evento) ? window.event.keyCode : evento.which;
    var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
    var resultado  = "";
    var mascara = "##.###.###,##".reverse();
    for (var x=0, y=0; x<mascara.length && y<valor.length;) {
        if (mascara.charAt(x) != '#') {
        resultado += mascara.charAt(x);
        x++;
        } else {
        resultado += valor.charAt(y);
        y++;
        x++;
        }
    }
    campo.value = resultado.reverse();
}