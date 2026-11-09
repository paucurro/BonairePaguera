<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h1>Articulos</h1>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-default" data-toggle="modal" id="btn_add" data-id="">Nuevo articulo</button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
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
                                <div class="form-check">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-6">
                                        <input class="form-check-input" type="checkbox" value="" id="status" name="status">
                                        <label class="form-check-label" for="defaultCheck1">Activo</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Titulo EN*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="title" required class="form-control" id="title" placeholder="Titulo INGLES">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Titulo ES*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="title_es" required class="form-control" id="title_es" placeholder="Titulo CASTELLANO">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Titulo DE*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="title_de" required class="form-control" id="title_de" placeholder="Titulo ALEMAN">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Descripcion Breve EN*</label>
                                    <div class="col-md-6">
                                        <textarea name="brief" required class="form-control" id="brief" placeholder="Descripcion Breve INGLES"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Descripcion Breve ES*</label>
                                    <div class="col-md-6">
                                        <textarea name="brief_es" required class="form-control" id="brief_es" placeholder="Descripcion Breve CASTELLANO"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Descripcion Breve DE*</label>
                                    <div class="col-md-6">
                                        <textarea name="brief_de" required class="form-control" id="brief_de" placeholder="Descripcion Breve ALEMAN"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Contenido EN*</label>
                                    <div class="col-md-6">
                                        <textarea name="content" required class="form-control" id="content" placeholder="Contenido INGLES"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Contenido ES*</label>
                                    <div class="col-md-6">
                                        <textarea name="content_es" required class="form-control" id="content_es" placeholder="Contenido CASTELLANO"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Contenido DE*</label>
                                    <div class="col-md-6">
                                        <textarea name="content_de" required class="form-control" id="content_de" placeholder="Contenido ALEMAN"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Destino del post *</label>
                                    <div class="col-md-6">
                                        <select name="destination" required class="form-control" id="destination">
                                            <option value="0">Ambas Webs</option>
                                            <option value="1">Atalaya Bosque</option>
                                            <option value="2">Bonaire Paguera</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Imagen para subir (1920x1080)</label>
                                    <div class="col-md-6">
                                        <input type="file" name="image_new" id="image_new">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Imagen actual</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="image" name="image" value=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-4 control-label">Categoria </label>
                                    <div class="col-md-6">
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">-- SELECCIONAR --</option>
                                            <?php foreach (CategoryData::getAll() as $g): ?>
                                                <option value="<?php echo $g->id; ?>"><?php echo $g->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
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
                                            echo "<a href='../uploads/" . $user->image . "' target='_blank' ><i class='fa fa-image'></i></a>";
                                        } ?></td>
                                    <td><?php if ($user->status == 1) {
                                            echo "<i class='fa fa-check'></i>";
                                        } ?></td>
                                    <td><?php echo ($user->destination == 0) ? 'Ambas webs' : (($user->destination == 1) ? 'Atalaya Bosque' : 'Bonaire Paguera'); ?></td>
                                    <td><?php echo $user->created_at; ?></td>
                                    <td style="width:130px;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-xs btn_edit" data-toggle="modal" data-id="<?php echo $user->id; ?>"> Editar</button>
                                            <a href="index.php?action=posts&opt=del&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs" style="margin-left: 6px;">Eliminar</a>
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

