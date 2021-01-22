<!-- Modal -->
<div class="modal fade" id="modalUpdateGame<?= $videojuegos['id_videojuego'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdateGame" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Videojuego</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./db/update-game.php" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" name="id_videojuego" value="<?= $videojuegos['id_videojuego'] ?>">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success text-success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <?php if (isset($_GET['nombre'])) { ?>
                                    <input type="text" class="form-control" placeholder="Título" name="nombre" value="<?php echo $_GET['nombre']; ?>" />
                                <?php } else { ?>
                                    <input type="text" class="form-control" placeholder="Título" name="nombre" value="<?= $videojuegos['nombre'] ?>" />
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($_GET['informacion'])) { ?>
                                    <textarea class="form-control" placeholder="Descripción" id="informacion" rows="3" name="informacion"><?php echo $_GET['informacion']; ?></textarea>
                                <?php } else { ?>
                                    <textarea class="form-control" placeholder="Descripción" id="informacion" rows="3" name="informacion"><?= $videojuegos['informacion'] ?></textarea>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select id="categoria" name="categoria" class="form-control">
                                    <?php

                                    require './db/dbconexion.php';

                                    $sql = "SELECT * FROM categoria";

                                    $resultado = mysqli_query($conexion, $sql);

                                    $count = mysqli_num_rows($resultado);

                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($resultado)) {
                                            $id = $row['id_categoria'];
                                            $tipo = $row['tipo'];

                                            if ($_GET['categoria'] == $id) {
                                    ?> <option value=""></option>
                                                <option selected value="<?php echo $id ?>"><?php echo $tipo ?></option>
                                            <?php } else if ($videojuegos['id_categoria'] == $id) { ?>
                                                <option value=""></option>
                                                <option selected value="<?= $videojuegos['id_categoria'] ?>"><?php echo $tipo ?></option>
                                            <?php } ?>
                                            <option value="<?php echo $id ?>"><?php echo $tipo ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Subir imagen</label>
                                <input type="file" class="form-control-file text-truncate" id="updateImage" name="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" name="cancelFree">Cancelar</button>
                        <button type="submit" id="updateGameBtn" name="updateGame" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>