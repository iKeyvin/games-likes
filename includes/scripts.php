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
        });

    $('#dislike').click(function() {
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
    });

</script>