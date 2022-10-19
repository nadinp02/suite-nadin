<?php
require_once "Config/Autoload.php";
Config\Autoload::run();
$template = new Clases\TemplateSite();
$contenidos = new Clases\Contenidos();

$data_galeria_principal = [
    "images" => true,
    "filter" => ["contenidos.cod = 'slide-inicio'"]
];
$galeria_principal = $contenidos->list($data_galeria_principal, 'es', true);

$data_inicio = [
    "images" => true,
    "filter" => ["contenidos.area = 'inicio'"]
];
$inicio = $contenidos->list($data_inicio, 'es');

// $sobre_nosotros_inicio = $contenidos->list(["filter" => ["contenidos.cod = 'sobre-nosotros-inicio'"]], 'es', true);
// $preguntas_frecuentes_inicio = $contenidos->list(["images"=>true,"filter" => ["contenidos.cod = 'preguntas-frecuentes-inicio'"]], 'es', true);
$preguntas_frecuentes = $contenidos->list(["images"=>true, "filter" => ["contenidos.area = 'preguntas-frecuentes'"]], 'es');


$template->themeInit();
?>

<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1><?= $galeria_principal["data"]["titulo"] ?></h1>
                <h2><?= $galeria_principal["data"]["contenido"] ?></h2>
                <div class="d-flex justify-content-center justify-content-lg-start">
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    <a href="<?= $galeria_principal["data"]["link"] ?>" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="<?= $galeria_principal["images"][0]["url"] ?>" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section>

<main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
        <div class="container">

            <div class="row" data-aos="zoom-in">
                <?php
                foreach ($inicio["marcas-inicio"]["images"] as $key => $item) { ?>
                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="<?= $item["url"] ?>" class="img-fluid" alt="<?= $inicio["marcas-inicio"]["data"]["titulo"] ?>">
                    </div>
                <?php } ?>

            </div>

        </div>
    </section>
    <!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2><?= $inicio["sobre-nosotros-inicio"]["data"]["titulo"]?></h2>
            </div>
            <?=$inicio["sobre-nosotros-inicio"]["data"]["contenido"]?>
            
        </div>
    </section>
    <!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                    <div class="content">
                        <h3><?= $preguntas_frecuentes["faq-inicio"]["data"]["titulo"]?></h3>
                        <h4><?= $preguntas_frecuentes["faq-inicio"]["data"]["subtitulo"]?></h4>
                        <p>
                            <?= $preguntas_frecuentes["faq-inicio"]["data"]["contenido"]?>
                        </p>
                    </div>

                    <div class="accordion-list">
                        <ul>
                        <?php 
                        $i =1;
                        foreach ($preguntas_frecuentes as $key => $item){ 
                            if($key == 'faq-inicio') continue;
                            ?>
                            <li>
                                <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-<?= $i ?>">
                                <span></span><?= $i ?>
                                <?= $item["data"]["titulo"]?>
                                <i class="bx bx-chevron-down icon-show"></i>
                                <i class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-<?= $i ?>" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        <?= $item["data"]["contenido"]?>
                                    </p>
                                </div>
                            </li>
                        <?php 
                    $i++;
                    } ?>

                        </ul>
                    </div>

                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("<?=$preguntas_frecuentes["faq-inicio"]["images"][0]["url"]?>");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
            </div>

        </div>
    </section><!-- End Why Us Section -->
</main>

<?php
$template->themeEnd();
?>