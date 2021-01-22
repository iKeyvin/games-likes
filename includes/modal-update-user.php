<!-- Modal -->
<div class="modal fade" id="modalUpdateUser<?= $usuarios['id_usuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalUpdateUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./db/update-user.php" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" name="id_usuario" value="<?= $usuarios['id_usuario'] ?>">
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
                                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo $_GET['nombre']; ?>" />
                                <?php } else { ?>
                                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?= $usuarios['nombre'] ?>" />
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($_GET['apellidos'])) { ?>
                                    <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" value="<?php echo $_GET['apellidos']; ?>" />
                                <?php } else { ?>
                                    <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" value="<?= $usuarios['apellidos'] ?>" />
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($_GET['email'])) { ?>
                                    <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $_GET['email']; ?>" />
                                <?php } else { ?>
                                    <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $usuarios['email'] ?>" />
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <?php if (isset($_GET['fecha_nacimiento'])) { ?>
                                    <input type="date" class="form-control" placeholder="Fecha Nacimiento *" name="fecha_nacimiento" value="<?php echo $_GET['fecha_nacimiento']; ?>" />
                                <?php } else { ?>
                                    <input type="date" class="form-control" placeholder="Fecha Nacimiento *" name="fecha_nacimiento" value="<?= $usuarios['fecha_nacimiento'] ?>" />
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($_GET['telefono'])) { ?>
                                    <input type="text" class="form-control" placeholder="Teléfono/Móvil *" name="telefono" value="<?php echo $_GET['telefono']; ?>" />
                                <?php } else { ?>
                                    <input type="text" class="form-control" placeholder="Teléfono/Móvil *" name="telefono" value="<?= $usuarios['telefono'] ?>" />
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Subir imagen</label>
                                <input type="file" class="form-control-file text-truncate" id="updateImage" name="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" name="cancelFree">Cancelar</button>
                        <button type="submit" id="updateUserBtn" name="updateUser" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>