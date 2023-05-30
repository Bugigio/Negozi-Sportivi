$(document).ready( function() {
	console.log("La pagina è pronta");
});

function aggiungiAlCarrello(articolo, utente) {
	$.ajax({
		type: "POST",
		url: "../shop/aggiungi_rimuovi_carrello.php",
		data: {aggiungi: 1, id_articolo: articolo, email_utente: utente},
		success: function(esito) {
			console.log(esito);
			switch (esito) {
				case "1":
					window.alert("Articolo aggiunto al carrello");
					break;
				default:
					window.alert("Errore generico");
					break;
			}
		}
	});
}