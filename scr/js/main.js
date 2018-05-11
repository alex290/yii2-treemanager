jQuery(document).ready(function($) {
    $('.dd').nestable();
    $('.dd').on('change', function() {
        var jsV = $('.dd').nestable('serialize');
        var encoded = $.toJSON( jsV );
        var jsData = '"'+ encoded +'"';
        var patchClass = $('.model-name-base').text();
        console.log(patchClass + ' ' +encoded);
        $.ajax({
            url: '/treemanager',
            type: 'GET',
            data: {name:patchClass, data:encoded},
        })
        .done(function(dtext) {
            console.log(dtext);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });
});