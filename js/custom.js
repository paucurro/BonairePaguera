jQuery(document).ready(function () {

    function pon_campo_idioma(array, campo) {
        var field = campo;
        if (lang == 'es') {
            campo += '_es';
        } else if (lang == 'de') {
            campo += '_de';
        }
        return (array[campo] !== null) ? array[campo] : array[field];
    }

    "use strict";
    // Your custom js code goes here.

    $('.img_zoom').magnificPopup({type: 'image'});

    if ($('#zona_blog').length > 0) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "BlogGet.php",
            data: '',
            success: function (data) {

                if (data['resp'] == 'OK') {
                    var html = '';
                    if (data['data'].length > 0) {
                        var link_url, contador = 0;

                        $.each(data['data'], function (ind, row) {
                            link_url = 'blog_det.php?id=' + row['id'];
                            html +=
                                '<div class="col-md-4 col-sm-6 col-xs-12">\n' +
                                '    <div class="probootstrap-hentry mb30"  style="border: 1px solid #efefef; padding: 10px;">\n';
                            if ((row['image'] != null) && (row['image'] != '')) {
                                html +=
                                    '<div class="image_max_size">\n' +
                                    '   <a href="' + link_url + '"><img src="/uploads/' + row['image'] + '" alt="" class="img-responsive"></a>\n' +
                                    '</div>\n';
                            }
                            html +=
                                '        <h4 class="mt0"><a href="' + link_url + '" class="hover-reverse">' + pon_campo_idioma(row, 'title') + '</a></h4>\n' +
                                '        <div class="text-mute">' + pon_campo_idioma(row, 'brief') + '</div>\n' +
                                '        <p class="text-mute">' + row['fecha'] + ' • ' + row['category'] + '</p>\n' +
                                '    </div>\n' +
                                '</div>';

                            contador++;
                            if (contador >= 3) {
                                contador = 0;
                                html += '<div class="clearfix visible-lg-block visible-md-block"></div>\n';
                            }
                        });
                    }

                    $('#zona_blog').html(html);

                } else {
                    $('#zona_blog').html('Error cargando noticias. ' + data['data'])
                }
            }
        });

    }

});