<!-- Modal -->
<div class="modal fade" id="modalAddGame" tabindex="-1" role="dialog" aria-labelledby="modalAddGame" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Videojuego</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./db/add-game.php" method="post" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" placeholder="Título" name="nombre" value="" />
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($_GET['nombre'])) { ?>
                                    <textarea class="form-control" placeholder="Descripción" id="informacion" rows="3" name="informacion"><?php echo $_GET['informacion']; ?></textarea>
                                <?php } else { ?>
                                    <textarea class="form-control" placeholder="Descripción" id="informacion" rows="3" name="informacion"></textarea>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select id="categoria" name="categoria" class="form-control">
                                    <option selected value="<?php echo $_GET['id_categoria'] ?>"></option>
                                    <?php

                                    require './db/dbconexion.php';

                                    $sql = "SELECT * FROM categoria";

                                    $resultado = mysqli_query($conexion, $sql);

                                    $count = mysqli_num_rows($resultado);

                                    if ($count > 0) {
                                        while ($row = mysqli_fetch_assoc($resultado)) {
                                            $id = $row['id_categoria'];
                                            $tipo = $row['tipo'];
                                    ?>
                                            <option value="<?php echo $id ?>"><?php echo $tipo ?></option>
                                        <?php
                                        }
                                    } else { ?>
                                        <option selected value=""></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Subir imagen</label>
                                <input type="file" class="form-control-file text-truncate" id="addImage" name="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary"  name="cancelFree">Cancelar</button>
                        <button type="submit" id="addGameBtn" name="addGame" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

