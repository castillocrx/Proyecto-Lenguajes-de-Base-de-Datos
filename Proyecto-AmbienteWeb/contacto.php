<?php
include_once "include/template/header.php";
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/contacto.css">
<script src="js/contacto.js" defer></script>

<body>
    <div class="content-container">
        <div id="cards">
            <div class="card">
                <div class="card-content">
                    <i class="fa-brands fa-instagram"></i>
                    <h2>Instagram</h2>

                    <p>Seguidores: <span>33K</span></p>

                    <a href="#">
                        <i class="fa-solid fa-link"></i>
                        <span>Siguenos</span>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <i class="fa-solid fa-envelope"></i>
                    <h2>Mail</h2>

                    <p>Correo: <span>Burguershop@gmail.com</span></p>

                    <a href="#">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Escribir</span>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <i class="fa-brands fa-whatsapp"></i>
                    <h2>Whatsapp</h2>

                    <p>Telefono: <span>7632-8742</span></p>

                    <a href="#">
                        <i class="fa-solid fa-phone"></i>
                        <span>Llamar Ahora</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>



<?php
require_once "include/template/footer.php";
?>