/**
 * Select2 Spanish translation
 */
(function($) {
    "use strict";

    $.extend($.fn.select2.defaults, {
        formatNoMatches: function(input) {
            return '<a href="javascript:void(0)" style="cursor: pointer; font-size: 13px; color:#8CC152" onclick="AgregarNuevoPunto()">Agregar Nuevo punto</a>';
        },
        formatInputTooShort: function(input, min) {
            var n = min - input.length;
            return "Tipea al menos " + n + " caracter" + (n == 1 ? "" : "es");
        },
        formatInputTooLong: function(input, max) {
            var n = input.length - max;
            return "Por favor elimina " + n + " caracter" + (n == 1 ? "" : "es");
        },
        formatSelectionTooBig: function(limit) {
            return "Solo puede seleccionar " + limit + " elemento" + (limit == 1 ? "" : "s");
        },
        formatLoadMore: function(pageNumber) {
            return "Cargando más resultados...";
        },
        formatSearching: function() {
            return "Buscando...";
        }
    });
})(jQuery);