<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/lang/summernote-es-ES.min.js"></script>
<style>
    .note-editor.note-frame { margin-bottom: 0; }
    .note-modal { z-index: 1100; }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h1>Articulos</h1>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-default" data-toggle="modal" id="btn_add" data-id="">Nuevo articulo</button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">
                                <span id="modal_insertar">Nuevo Articulo</span>
                                <span id="modal_modificar">Modificar articulo</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" id="addcategory" action="index.php?action=posts&opt=add" role="form">
                                <ul class="nav nav-tabs" role="tablist" id="post_tabs">
                                    <li role="presentation" class="active"><a href="#tab_general" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> General</a></li>
                                    <li role="presentation"><a href="#tab_en" role="tab" data-toggle="tab"><i class='flag-icon flag flag-icon-background flag-icon-gb'></i> English</a></li>
                                    <li role="presentation"><a href="#tab_es" role="tab" data-toggle="tab"><i class='flag-icon flag flag-icon-background flag-icon-es'></i> Castellano</a></li>
                                    <li role="presentation"><a href="#tab_de" role="tab" data-toggle="tab"><i class='flag-icon flag flag-icon-background flag-icon-de'></i> Deutsch</a></li>
                                </ul>
                                <div class="tab-content" style="padding-top: 20px;">
                                    <div role="tabpanel" class="tab-pane active" id="tab_general">
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="checkbox">
                                                    <label><input type="checkbox" value="" id="status" name="status"> Activo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="destination" class="col-lg-2 control-label">Destino del post *</label>
                                            <div class="col-lg-6">
                                                <select name="destination" required class="form-control" id="destination">
                                                    <option value="0">Ambas Webs</option>
                                                    <option value="1">Atalaya Bosque</option>
                                                    <option value="2">Bonaire Paguera</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id" class="col-lg-2 control-label">Categoria *</label>
                                            <div class="col-lg-6">
                                                <select name="category_id" id="category_id" class="form-control" required>
                                                    <option value="">-- SELECCIONAR --</option>
                                                    <?php foreach (CategoryData::getAll() as $g): ?>
                                                        <option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image_new" class="col-lg-2 control-label">Imagen para subir (1920x1080)</label>
                                            <div class="col-lg-6">
                                                <input type="file" name="image_new" id="image_new" accept="image/jpeg,image/png,image/webp,image/gif">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="col-lg-2 control-label">Imagen actual</label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="image" name="image" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="publish_at" class="col-lg-2 control-label">Activar el</label>
                                            <div class="col-lg-4">
                                                <input type="datetime-local" class="form-control" id="publish_at" name="publish_at">
                                                <span class="help-block">Vacío = visible desde que se guarda.</span>
                                            </div>
                                            <label for="expires_at" class="col-lg-2 control-label">Caduca el</label>
                                            <div class="col-lg-4">
                                                <input type="datetime-local" class="form-control" id="expires_at" name="expires_at">
                                                <span class="help-block">Vacío = no caduca.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab_en">
                                        <div class="form-group">
                                            <label for="title" class="col-lg-2 control-label">Titulo*</label>
                                            <div class="col-lg-10">
                                                <input type="text" name="title" required class="form-control" id="title" placeholder="Titulo INGLES">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="brief" class="col-lg-2 control-label">Descripcion breve*</label>
                                            <div class="col-lg-10">
                                                <textarea name="brief" class="form-control rte rte-brief" id="brief" data-label="Descripcion breve (English)" placeholder="Descripcion Breve INGLES"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content" class="col-lg-2 control-label">Contenido*</label>
                                            <div class="col-lg-10">
                                                <textarea name="content" class="form-control rte rte-content" id="content" data-label="Contenido (English)" placeholder="Contenido INGLES"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab_es">
                                        <div class="form-group">
                                            <label for="title_es" class="col-lg-2 control-label">Titulo*</label>
                                            <div class="col-lg-10">
                                                <input type="text" name="title_es" required class="form-control" id="title_es" placeholder="Titulo CASTELLANO">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="brief_es" class="col-lg-2 control-label">Descripcion breve*</label>
                                            <div class="col-lg-10">
                                                <textarea name="brief_es" class="form-control rte rte-brief" id="brief_es" data-label="Descripcion breve (Castellano)" placeholder="Descripcion Breve CASTELLANO"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_es" class="col-lg-2 control-label">Contenido*</label>
                                            <div class="col-lg-10">
                                                <textarea name="content_es" class="form-control rte rte-content" id="content_es" data-label="Contenido (Castellano)" placeholder="Contenido CASTELLANO"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab_de">
                                        <div class="form-group">
                                            <label for="title_de" class="col-lg-2 control-label">Titulo*</label>
                                            <div class="col-lg-10">
                                                <input type="text" name="title_de" required class="form-control" id="title_de" placeholder="Titulo ALEMAN">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="brief_de" class="col-lg-2 control-label">Descripcion breve*</label>
                                            <div class="col-lg-10">
                                                <textarea name="brief_de" class="form-control rte rte-brief" id="brief_de" data-label="Descripcion breve (Deutsch)" placeholder="Descripcion Breve ALEMAN"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="content_de" class="col-lg-2 control-label">Contenido*</label>
                                            <div class="col-lg-10">
                                                <textarea name="content_de" class="form-control rte rte-content" id="content_de" data-label="Contenido (Deutsch)" placeholder="Contenido ALEMAN"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="text-right">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>

                                <input type="hidden" id="id" name="id" value=""/>

                            </form>

                        </div>

                    </div>
                </div>
            </div>


            <br>
            <br>
            <?php

            $users = PostData::getAll();
            if (count($users) > 0) {
                // si hay usuarios
                ?>
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-bordered table-hover datatable">
                            <thead>
                            <th>Titulo</th>
                            <th>Categoria</th>
                            <th>foto</th>
                            <th>Activo</th>
                            <th>Publicación</th>
                            <th>Destino</th>
                            <th>Creacion</th>
                            <th></th>
                            </thead>
                            <?php
                            foreach ($users as $user) {
                                ?>
                                <tr>
                                    <td><?php echo
                                            "<i class='flag-icon flag flag-icon-background flag-icon-gb'></i> " . $user->title . "<br>" .
                                            "<i class='flag-icon flag flag-icon-background flag-icon-es'></i> " . $user->title_es . "<br>" .
                                            "<i class='flag-icon flag flag-icon-background flag-icon-de'></i> " . $user->title_de; ?></td>
                                    <td><?php echo CategoryData::getById($user->category_id)->name; ?></td>
                                    <td><?php if ($user->image != '') {
                                            $src = "../uploads/" . rawurlencode($user->image);
                                            echo "<a href='" . $src . "' target='_blank'><img src='" . $src . "' alt='' loading='lazy' style='width:80px;height:50px;object-fit:cover;border-radius:4px;display:block;'></a>";
                                        } ?></td>
                                    <td><?php if ($user->status == 1) {
                                            echo "<i class='fa fa-check'></i>";
                                        } ?></td>
                                    <td><?php
                                        $ahora = date('Y-m-d H:i:s');
                                        if ($user->status != 1) {
                                            echo "<span class='label label-default'>Desactivado</span>";
                                        } elseif (!empty($user->publish_at) && $user->publish_at > $ahora) {
                                            echo "<span class='label label-warning'>Programado</span>";
                                        } elseif (!empty($user->expires_at) && $user->expires_at <= $ahora) {
                                            echo "<span class='label label-danger'>Caducado</span>";
                                        } else {
                                            echo "<span class='label label-success'>Publicado</span>";
                                        }
                                        if (!empty($user->publish_at)) { echo "<br><small>Desde: " . date('d/m/Y H:i', strtotime($user->publish_at)) . "</small>"; }
                                        if (!empty($user->expires_at)) { echo "<br><small>Hasta: " . date('d/m/Y H:i', strtotime($user->expires_at)) . "</small>"; }
                                    ?></td>
                                    <td><?php echo ($user->destination == 0) ? 'Ambas webs' : (($user->destination == 1) ? 'Atalaya Bosque' : 'Bonaire Paguera'); ?></td>
                                    <td><?php echo $user->created_at; ?></td>
                                    <td style="width:130px;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-xs btn_edit" data-toggle="modal" data-id="<?php echo $user->id; ?>"> Editar</button>
                                            <a href="index.php?action=posts&opt=del&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs" style="margin-left: 6px;" data-confirm-del="1">Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php

                            }

                            ?>
                        </table>
                    </div>
                </div>
                <?php


            } else {
                echo "<p class='alert alert-danger'>No hay Articulos</p>";
            }

            ?>

        </div>
    </div>

</section>

<script language="JavaScript1.5">
    <?php if (isset($users)) {
        echo '      var posts = ' . json_encode($users) . ';' . PHP_EOL;
        /*foreach ($users as $ind => $post) {
            echo "      posts['" . $ind . "'] = [];" . PHP_EOL;
            foreach ($post as $field => $value) {
                echo "      posts['" . $ind . "']['" . $field . "'] = '" . $value . "';\n";
            }
        }*/
    } ?>







</script>
<script>
    $(function () {
        var toolbarBrief = [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol']],
            ['insert', ['link']],
            ['view', ['codeview']]
        ];
        var toolbarContent = [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ];
        var common = {lang: 'es-ES', dialogsInBody: true, disableDragAndDrop: true};

        $('.rte-brief').summernote($.extend({}, common, {height: 110, toolbar: toolbarBrief}));
        $('.rte-content').summernote($.extend({}, common, {height: 260, toolbar: toolbarContent}));

        function emptyHtml(html) {
            html = html || '';
            return $('<div>').html(html).text().replace(/\s/g, '') === '' && !/<(img|hr|table)/i.test(html);
        }

        // Lleva al usuario a la pestana donde esta el campo
        function mostrarPestana(campo) {
            var id = $(campo).closest('.tab-pane').attr('id');
            $('#post_tabs a[href="#' + id + '"]').tab('show');
        }

        // Campos "required" nativos: si el invalido esta en otra pestana, abrirla
        $('#addcategory').find(':input[required]').on('invalid', function () { mostrarPestana(this); });

        // Nuevo: volver a la accion de alta y vaciar los editores
        $('#btn_add').on('click', function () {
            $('#addcategory').attr('action', 'index.php?action=posts&opt=add');
            $('.rte').each(function () { $(this).val(''); });
        });

        // Al mostrar el modal, volcar en los editores el valor que dejo el formulario (alta o edicion)
        $('#myModal').on('show.bs.modal', function () {
            $('#post_tabs a:first').tab('show');
            $('.rte').each(function () { $(this).summernote('code', $(this).val()); });
        });

        // Validacion (los textarea ocultos por el editor no pueden usar "required")
        $('#addcategory').on('submit', function (e) {
            var falta = null;
            $('.rte').each(function () {
                if (emptyHtml($(this).summernote('code'))) { falta = this; return false; }
            });
            if (falta) {
                e.preventDefault();
                mostrarPestana(falta);
                alert('Rellena el campo: ' + $(falta).data('label'));
                $(falta).summernote('focus');
            }
        });
    });
</script>

<script>
    // Traductor automatico (endpoint gratuito de Google Translate, sin clave API)
    $(function () {
        var IDIOMAS = {
            en: {nombre: 'English', suf: ''},
            es: {nombre: 'Castellano', suf: '_es'},
            de: {nombre: 'Deutsch', suf: '_de'}
        };
        var ORIGEN_POR_DEFECTO = {en: 'es', es: 'en', de: 'es'};

        function traduce(texto, de, a) {
            if (!$.trim(texto)) { return Promise.resolve(texto); }
            return fetch('https://translate.googleapis.com/translate_a/single?client=gtx&dt=t&sl=' + de + '&tl=' + a, {
                method: 'POST',
                body: new URLSearchParams({q: texto})
            }).then(function (r) {
                if (!r.ok) { throw new Error('HTTP ' + r.status); }
                return r.json();
            }).then(function (d) {
                return d[0].map(function (t) { return t[0]; }).join('');
            });
        }

        // Ejecuta tareas (funciones que devuelven promesa) con un maximo de n a la vez
        function enParalelo(tareas, n) {
            var i = 0;
            function worker() {
                if (i >= tareas.length) { return Promise.resolve(); }
                return tareas[i++]().then(worker);
            }
            var workers = [];
            for (var k = 0; k < Math.min(n, tareas.length); k++) { workers.push(worker()); }
            return Promise.all(workers);
        }

        // Traduce solo los nodos de texto del HTML, respetando las etiquetas
        function traduceHtml(html, de, a) {
            var cont = document.createElement('div');
            cont.innerHTML = html || '';
            var nodos = [], w = document.createTreeWalker(cont, NodeFilter.SHOW_TEXT, null), n;
            while ((n = w.nextNode())) {
                if ($.trim(n.nodeValue) !== '') { nodos.push(n); }
            }
            var tareas = nodos.map(function (nodo) {
                return function () {
                    var original = nodo.nodeValue;
                    var ini = original.match(/^\s*/)[0], fin = original.match(/\s*$/)[0];
                    return traduce($.trim(original), de, a).then(function (t) { nodo.nodeValue = ini + t + fin; });
                };
            });
            return enParalelo(tareas, 4).then(function () { return cont.innerHTML; });
        }

        // [titulo, brief, contenido] -> {textos: [...], motor: '...'}
        // Primero DeepL a traves de translate.php; si no hay clave configurada (501), Google gratuito
        function traduceTodo(textos, de, a) {
            var idx = [], envio = [];
            $.each(textos, function (i, t) { if ($.trim(t) !== '') { idx.push(i); envio.push(t); } });

            return fetch('translate.php', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({texts: envio, source: de, target: a, html: true})
            }).then(function (r) {
                if (r.status === 501) { return null; }
                return r.json().catch(function () { return {}; }).then(function (d) {
                    if (!r.ok) { throw new Error(d.error || ('HTTP ' + r.status)); }
                    return d.translations;
                });
            }).then(function (trad) {
                if (trad) {
                    var out = textos.slice();
                    $.each(idx, function (k, i) { out[i] = trad[k]; });
                    return {textos: out, motor: 'DeepL'};
                }
                // Respaldo: Google gratuito (no oficial) desde el navegador
                return Promise.all([
                    traduce(textos[0], de, a),
                    traduceHtml(textos[1], de, a),
                    traduceHtml(textos[2], de, a)
                ]).then(function (r) { return {textos: r, motor: 'Google (gratuito)'}; });
            });
        }

        function vacio(html) { return $('<div>').html(html || '').text().replace(/\s/g, '') === ''; }

        $.each(IDIOMAS, function (cod, info) {
            var opciones = '';
            $.each(IDIOMAS, function (c, i) { if (c !== cod) { opciones += '<option value="' + c + '">' + i.nombre + '</option>'; } });
            var barra = $(
                '<div class="well well-sm tr-bar" data-lang="' + cod + '">' +
                '<i class="fa fa-language"></i> Traducir esta pestana desde: ' +
                '<select class="tr-src input-sm">' + opciones + '</select> ' +
                '<button type="button" class="btn btn-info btn-sm tr-go">Traducir con Google</button> ' +
                '<span class="tr-status text-muted"></span></div>');
            barra.find('.tr-src').val(ORIGEN_POR_DEFECTO[cod]);
            $('#tab_' + cod).prepend(barra);
        });

        $(document).on('click', '.tr-go', function () {
            var barra = $(this).closest('.tr-bar'), btn = $(this), estado = barra.find('.tr-status');
            var destino = barra.data('lang'), origen = barra.find('.tr-src').val();
            var sd = IDIOMAS[destino].suf, so = IDIOMAS[origen].suf;

            var titulo = $('#title' + so).val(),
                brief = $('#brief' + so).summernote('code'),
                contenido = $('#content' + so).summernote('code');

            if ($.trim(titulo) === '' && vacio(brief) && vacio(contenido)) {
                estado.text('La pestana de origen (' + IDIOMAS[origen].nombre + ') esta vacia.');
                return;
            }
            var hayDestino = $.trim($('#title' + sd).val()) !== '' || !vacio($('#brief' + sd).summernote('code')) || !vacio($('#content' + sd).summernote('code'));
            if (hayDestino && !confirm('Esta pestana ya tiene texto. ¿Sobrescribirlo con la traduccion?')) { return; }

            btn.prop('disabled', true);
            estado.text('Traduciendo...');
            traduceTodo([titulo, brief, contenido], origen, destino).then(function (res) {
                var r = res.textos;
                $('#title' + sd).val(r[0]);
                $('#brief' + sd).summernote('code', r[1]);
                $('#content' + sd).summernote('code', r[2]);
                estado.text('Traducido con ' + res.motor + '. Revisa el resultado antes de guardar.');
            }).catch(function (e) {
                estado.text('No se pudo traducir: ' + e.message);
            }).then(function () { btn.prop('disabled', false); });
        });
    });
</script>

<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="modalBorrarLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title" id="modalBorrarLabel"><i class="fa fa-warning"></i> Eliminar artículo</h4>
            </div>
            <div class="modal-body">
                <p>¿Seguro que quieres eliminar este artículo?</p>
                <p><strong>Esta acción NO se puede deshacer.</strong> El artículo no se podrá recuperar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No borrar</button>
                <a href="#" id="btnConfirmarBorrar" class="btn btn-danger">Sí, borrar</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $(document).on('click', 'a[data-confirm-del]', function (e) {
            e.preventDefault();
            $('#btnConfirmarBorrar').attr('href', $(this).attr('href'));
            $('#modalBorrar').modal('show');
        });
    });
</script>
