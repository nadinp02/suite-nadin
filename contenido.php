<?php
require_once "Config/Autoload.php";
Config\Autoload::run();

$template = new Clases\TemplateSite();
$f = new Clases\PublicFunction();
$contenidos = new Clases\Contenidos();

$filter = [];

isset($_GET["area"]) ?  $filter[] = "contenidos.area = '" . $f->antihack_mysqli($_GET["area"]) . "'" : '';
isset($_GET["cod"]) ?  $filter[] = "contenidos.cod = '" . $f->antihack_mysqli($_GET["cod"]) . "'" : '';


$data = [
    "filter" => $filter,
    "images" => true,
];

#List de contenidos (al ser único el título, solo trae un resultado)
$contenidoData = $contenidos->list($data, $_SESSION["lang"], true);

#Si se encontro el contenido se almacena y sino se redirecciona al inicio
if (empty($contenidoData)) $f->headerMove(URL);
#Información de cabecera
$template->set("title", $contenidoData['data']['titulo'] . " | " . TITULO);
$template->set("description", $contenidoData['data']['description']);
$template->set("keywords", $contenidoData['data']['keywords']);
$template->set("imagen", isset($contenidoData['data']['images'][0]['url']) ? $contenidoData['data']['images'][0]['url'] : LOGO);
$template->themeInit();
?>
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container mt-4">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li><?= $contenidoData["data"]["titulo"] ?></li>
            </ol>
            <h2><?= $contenidoData["data"]["titulo"] ?></h2>

        </div>
    </section>

    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <?php foreach ($contenidoData["images"] as $key => $item) { ?>
                                <div class="swiper-slide">
                                    <img src="<?= $item["url"] ?>" alt="">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>


               <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3><?= $contenidoData["data"]["titulo"] ?></h3>
                        <p>
                        <?= strip_tags($contenidoData["data"]["contenido"],["<ul>","<li>"]); ?>
                        </p>
                    </div>
                    <div class="portfolio-description">

                    </div>
                </div>
             </div>
        </div>
    </section>
</main>
<?php
$template->themeEnd();
?>