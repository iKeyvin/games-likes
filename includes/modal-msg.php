<!-- Modal -->
<div class="modal fade" id="modalMsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-success d-flex justify-content-center">
        <?php if (isset($_GET['mensaje'])) { ?>
          <p class="mensaje"><?php echo $_GET['mensaje']; ?></p>
      </div>
      <div class="modal-footer">
        <a href="./admin-view.php" class="btn btn-secondary">Cerrar</a>

      <?php } else { ?>

        <p class="text-danger">¡Tienes que registrarte!</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <?php } ?>
      </div>
    </div>
  </div>
</div>