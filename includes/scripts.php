<!-- jQuery -->
<script src="js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4.5 JS -->
<script src="js/bootstrap.min.js"></script>
<!-- Popper JS -->
<script src="js/popper.min.js"></script>
<!-- Font Awesome -->
<script src="js/all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script type="text/javascript">
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('.nav-link');
    const menuLength = menuItem.length;
    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].className = "nav-link active"
        }
    }
</script>

<script type="text/javascript">
    $('#like').click(function() {
        <?php if (isset($_SESSION['usuario'])) { ?>
            var usuario = document.getElementById("usuarioAjax").value;
            var videojuego = document.getElementById("videojuegoAjax").value;

            $.ajax({
                type: 'post',
                url: './db/votes.php',
                data: {
                    id_usuario: usuario,
                    id_videojuego: videojuego,
                    action: 'up'
                },
                success: function(response) {
                    $('.display_up').html(response[1]);
                    $('.display_down').html(response[3]);
                }
            });
        <?php } else { ?>
            $(document).ready(function() {
                $("#modalMsg").modal("show");
            });
        <?php } ?>
    });

    $('#dislike').click(function() {
        <?php if (isset($_SESSION['usuario'])) { ?>
            var usuario = document.getElementById("usuarioAjax").value;
            var videojuego = document.getElementById("videojuegoAjax").value;
            $.ajax({
                type: 'post',
                url: './db/votes.php',
                data: {
                    id_usuario: usuario,
                    id_videojuego: videojuego,
                    action: 'down'
                },
                success: function(response) {
                    $('.display_up').html(response[1]);
                    $('.display_down').html(response[3]);
                }
            });
        <?php } else { ?>
            $(document).ready(function() {
                $("#modalMsg").modal("show");
            });
        <?php } ?>
    });


    $('#addComment').click(function() {
        <?php if (isset($_SESSION['usuario'])) { ?>
            var usuario = document.getElementById("usuarioComAjax").value;
            var videojuego = document.getElementById("videojuegoComAjax").value;
            var comentario = document.getElementById("comentarioAjax").value;
            var imagen = document.getElementById("imagenAjax").value;
            $.ajax({
                type: 'post',
                url: './db/comentarios.php',
                data: {
                    usuario: usuario,
                    id_videojuego: videojuego,
                    imagen: imagen,
                    comentario: comentario,
                    action: 'addComment'
                },

                success: function(response) {
                    var data = jQuery.parseJSON(response);
                    $('#comentariosAppend').append('<div id="added"><div class="row mt-5"> <div class="col-2 text-center"><img src="uploads/' + data.key3 + '"class="img-thumbnail rounded float-left w-auto mb-2"><p>Usuario: ' + data.key1 + '</p> </div> <div class="col-10 bg-dark text-light border border-dark rounded"> <p class="text-muted">Fecha: ' + data.key4 + '</p><p>' + data.key2 + '</p></div></div><div class="d-flex flex-row-reverse mt-2"><button type="button" class="btn btn-danger" id="deleteComment">Eliminar</button></div></div>');
                    document.getElementById("comentarioAjax").value = '';
                }
            });
        <?php } else { ?> $(document).ready(function() {
                $("#modalMsg").modal("show");
            });
        <?php } ?>
    });

    $(document).on('click', '#deleteComment', function(){
        $('#added').remove();
    });

    <?php
    $sqlComentario = "SELECT * FROM comentarios WHERE id_videojuego = $id_videojuego ORDER BY fecha_pub ASC";
    $resComentario = mysqli_query($conexion,  $sqlComentario);
    if (mysqli_num_rows($resComentario) > 0) {
        while ($comentarios = mysqli_fetch_assoc($resComentario)) { ?>
            $('#deleteComment<?= $comentarios['id_comentario'] ?>').click(function() {
                $.ajax({
                    type: 'post',
                    url: './db/comentarios.php',
                    data: {
                        id_comentario: <?= $comentarios['id_comentario'] ?>,
                        action: 'deleteComment'
                    },
                    success: function(response) {
                        $('#comentarios<?= $comentarios['id_comentario'] ?>').remove();

                    }

                });
            });
    <?php }
    } ?>
</script>