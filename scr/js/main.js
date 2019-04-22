jQuery(document).ready(function($) {
    $('.dd').nestable();
    var firstWeight = $('ol.dd-list').data('numb');
    //console.log(firstWeight);
    $('.dd').on('change', function() {
        var jsV = $('.dd').nestable('serialize');
        var encoded = $.toJSON( jsV );
        var jsData = '"'+ encoded +'"';
        var patchClass = $('.model-name-base').text();
        // console.log(patchClass + ' ' +encoded);
        $.ajax({
            url: '/treemanager',
            type: 'GET',
            data: {name:patchClass, data:encoded, numb:firstWeight},
        })
        .done(function() {
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
        });
        
    });
});