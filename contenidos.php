<?php
require_once "Config/Autoload.php";
Config\Autoload::run();

$template = new Clases\TemplateSite();
$f = new Clases\PublicFunction();
$contenidos = new Clases\Contenidos();

$filter = [];
$get = $f->antihackMulti($_GET);
foreach ($get as $key => $get_) {
    (isset($_GET[$key]) && $key != 'pagina') ?  $filter[] = "contenidos.$key = '" . $get_ . "'" : '';
}

$area = isset($get['area']) ? $get['area'] : '';
$pagina = isset($_GET['pagina']) ? $f->antihack_mysqli($_GET['pagina']) : 1;
$limite = 9;
$data = [
    "filter" => $filter,
    "images" => true,
    "limit" => ($limite * ($pagina - 1)) . "," . $limite
];
#List de contenidos (al ser único el título, solo trae un resultado)
$contenidoData = $contenidos->list($data, $_SESSION["lang"], false);

if (empty($contenidoData)) $f->headerMove(URL);
#Si se encontro el contenido se almacena y sino se redirecciona al inicio


$paginador = $contenidos->paginador(URL . '/c/' . $area, $filter, $limite, $pagina, 1);

#Información de cabecera
$template->set("title", $contenidoData[array_key_first($contenidoData)]['area']["data"]['titulo'] . " | " . TITULO);
$template->set("description", "");
$template->set("keywords", "");
$template->set("imagen", LOGO);
$template->themeInit();
?>

<section id="portfolio" class="portfolio" style="padding-top:150px">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2><?=$contenidoData[array_key_first($contenidoData)]['area']["data"]['titulo']?></h2>
            <p>Nuestros <?=$contenidoData[array_key_first($contenidoData)]['area']["data"]['titulo']?></p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            <?php
            foreach ($contenidoData as $key => $item) {
                $link = URL . "/c/" . $item["data"]["area"] . "/" . $f->normalizar_link($item["data"]["titulo"]) . "/" . $item["data"]["cod"];
            ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-img"><img src="<?= $item["images"][0]["url"]?>" class="img-fluid" alt="<?= $item["data"]["titulo"]?>"></div>
                    <div class="portfolio-info">
                        <h4><?= $item["data"]["titulo"]?></h4>
                        <p><?= $item["data"]["subtitulo"]?></p>
                        <a href="<?= $item["images"][0]["url"]?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?= $item["data"]["titulo"]?>"><i class="bx bx-plus"></i></a>
                        <a href="<?= $link ?>" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</section><!-- End Portfolio Section -->


<?php
$template->themeEnd();
?>