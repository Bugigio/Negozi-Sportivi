$(document).ready( function() {
	console.log("La pagina è pronta");
});

function aggiungiAlCarrello(articolo, utente) {
	$.ajax({
		method: "POST",
		url: "http://localhost/web%pages/shop/carrello.php",
		data: {id_articolo: articolo, email_utente: utente},
		success: function(esito) {
			switch (esito) {
				case 1:
					window.alert("Articolo aggiunto al carrello");
					break;
				default:
					window.alert("Errore generico");
					break;
			}
		}
	});
}