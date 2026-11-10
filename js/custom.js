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
        var $zona = $('#zona_blog'), $grid = null, msnry = null;
        var $btnMas = $('#btn_blog_mas'), $wrapMas = $('#zona_blog_mas');

        function html_tarjeta(row) {
            var link_url = 'blog_det.php?id=' + row['id'];
            var html =
                '<div class="blog-masonry-item">\n' +
                '    <div class="probootstrap-hentry" style="border: 1px solid #efefef; padding: 10px;">\n';
            if ((row['image'] != null) && (row['image'] != '')) {
                html +=
                    '<div class="blog-masonry-img">\n' +
                    '   <a href="' + link_url + '"><img src="/uploads/' + row['image'] + '" alt="" class="img-responsive"></a>\n' +
                    '</div>\n';
            }
            html +=
                '        <h4 class="mt0"><a href="' + link_url + '" class="hover-reverse">' + pon_campo_idioma(row, 'title') + '</a></h4>\n' +
                '        <div class="text-mute">' + pon_campo_idioma(row, 'brief') + '</div>\n' +
                '        <p class="text-mute">' + row['fecha'] + ' • ' + row['category'] + '</p>\n' +
                '    </div>\n' +
                '</div>';
            return html;
        }

        function carga_noticias(offset) {
            $btnMas.prop('disabled', true);
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "BlogGet.php",
                data: {offset: offset},
                success: function (data) {
                    if (data['resp'] != 'OK') {
                        $zona.html('Error cargando noticias. ' + data['data']);
                        return;
                    }
                    var $items = $(data['data'].map(html_tarjeta).join(''));

                    if ($grid === null) {
                        $zona.empty();
                        $grid = $('<div class="blog-masonry"></div>').appendTo($zona);
                        $grid.append($items);
                        if (typeof Masonry !== 'undefined' && typeof imagesLoaded !== 'undefined') {
                            msnry = new Masonry($grid[0], {itemSelector: '.blog-masonry-item', percentPosition: true, transitionDuration: 0});
                            imagesLoaded($grid[0]).on('progress', function () { msnry.layout(); });
                        }
                    } else {
                        $grid.append($items);
                        if (msnry) {
                            msnry.appended($items.get());
                            imagesLoaded($grid[0]).on('progress', function () { msnry.layout(); });
                        }
                    }

                    $btnMas.data('offset', data['next_offset']).prop('disabled', false);
                    $wrapMas.toggle(!!data['has_more']);
                },
                error: function () {
                    $zona.html('Error cargando noticias.');
                }
            });
        }

        $btnMas.on('click', function () {
            carga_noticias($btnMas.data('offset') || 0);
        });
        carga_noticias(0);
    }

});
