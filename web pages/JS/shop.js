function aumenta(numeroArticolo) {
    if(document.getElementsByClassName("numero_quantita").item(numeroArticolo).value < 10) {
        document.getElementsByClassName("numero_quantita").item(numeroArticolo).value++;
        document.getElementById("prezzo_totale").value = (eval(document.getElementById("prezzo_totale").value + "+" + document.getElementsByClassName("prezzo_articolo").item(numeroArticolo).value)).toFixed(2);
    }
}
function diminuisci(numeroArticolo) {
    if(document.getElementsByClassName("numero_quantita").item(numeroArticolo).value > 0) {
        document.getElementsByClassName("numero_quantita").item(numeroArticolo).value--;
        document.getElementById("prezzo_totale").value = (eval(document.getElementById("prezzo_totale").value + "-" + document.getElementsByClassName("prezzo_articolo").item(numeroArticolo).value)).toFixed(2); 
    }
}
