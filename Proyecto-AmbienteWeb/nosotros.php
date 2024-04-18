<?php
include_once "include/template/header.php";
?>
<link rel="stylesheet" href="css/nosotros.css">
<main class="contenedor">
    <div class="bienv-pos">
        <h1 class="bienvenido">BURGER SHOP</h1>
    </div>
    <div class="pos-logo-nosotros">
        <a href="mainProductos.php">
            <img class="logo-nosotros" src="img/logo.jpg" alt="Logo de tienda">
        </a>
    </div>
    <div class="nuestra-tienda">
        <h3 class="parrafo">¡Bienvenidos a Burger Shop, tu destino premium para disfrutar de las mejores hamburguesas naturales de alta calidad, todo desde la comodidad de tu hogar! En Burger Shop, nos enorgullecemos de ofrecer una experiencia de compra en línea excepcional que fusiona la frescura de los ingredientes naturales con la comodidad de la tecnología moderna. Imagina hundir tus dientes en nuestras jugosas y sabrosas hamburguesas, elaboradas con ingredientes 100% naturales y cuidadosamente seleccionados. Nos esforzamos incansablemente para garantizar que cada bocado sea una explosión de sabor y frescura que deleitará tus papilas gustativas y te dejará anhelando más. En Burger Shop, la calidad es nuestra máxima prioridad y nos comprometemos a ofrecerte productos que superen tus expectativas en cada orden. </h3>
    </div>
    <div class="info-tienda">
        <div class="texto">
            <div>
                <h1>Nuestros Productos</h1>
            </div>
            <p>Burger Shop ofrece una variedad de hamburguesas para todos los clientes. Podrás encontrar descuentos disponibles en cualquier momento. </p>
        </div>
        <div class="texto">
            <div>
                <h1>Nuestra Localización</h1>
            </div>
            <p>¡Descubre el sabor auténtico de Burger Shop en cada rincón de Costa Rica! En Burger Shop, nos enorgullecemos de llevar nuestros productos de alta calidad a todos los hogares y oficinas de este país. </p>
        </div>
        <div class="texto">
            <div>
                <h1>Nuestras Redes Sociales</h1>
            </div>
            <p>Burger Shop está disponible en varias redes sociales. Si deseas seguirnos, puedes navegar en nuestros contactos </p>
            <?php
            echo "<th><a href='contacto.php' class='boton-admin'>Contáctenos</a></th>";
            ?>
        </div>
    </div>
</main>
<?php
require_once "include/template/footer.php";
?>