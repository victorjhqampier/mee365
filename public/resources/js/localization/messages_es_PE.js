(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory( require( "jquery" ) );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ES (Spanish; Español)
 * Region: PE (Perú)
 */
$.extend( $.validator.messages, {
	required: "Este dato es obligatorio.",
	remote: "Por favor, llene este campo.",
	email: "Escriba un correo electrónico válido.",
	url: "Escriba una URL válida.",
	date: "Escriba una fecha válida.",
	dateISO: "Escriba una fecha (ISO) válida.",
	number: "Escriba un número válido.",
	digits: "Escriba sólo dígitos.",
	creditcard: "Escriba un número de tarjeta válido.",
	equalTo: "Escriba el mismo valor de nuevo.",
	extension: "Escriba un valor con una extensión permitida.",
	maxlength: $.validator.format( "No escriba más de {0} caracteres." ),
	minlength: $.validator.format( "No escriba menos de {0} caracteres." ),
	rangelength: $.validator.format( "Escriba un valor entre {0} y {1} caracteres." ),
	range: $.validator.format( "Escriba un valor entre {0} y {1}." ),
	max: $.validator.format( "Escriba un valor menor o igual a {0}." ),
	min: $.validator.format( "Escriba un valor mayor o igual a {0}." ),
	nifES: "Escriba un NIF válido.",
	nieES: "Escriba un NIE válido.",
	cifES: "Escriba un CIF válido."
} );
return $;
}));