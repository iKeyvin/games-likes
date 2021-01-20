<!-- Modal -->
<div class="modal fade" id="modalDeleteGame<?= $videojuegos['id_videojuego'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalDeleteGame" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar <?= $videojuegos['nombre'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./db/delete-game.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" name="id_videojuego" class="form-control" value="<?= $videojuegos['id_videojuego'] ?>">
                                <p class="text-danger">¿Estás seguro que deseas eliminar este videojuego?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="deleteGameBtn" name="deleteGame" class="btn btn-primary">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>