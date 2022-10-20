<?php
require_once "Config/Autoload.php";
Config\Autoload::run();

$template = new Clases\TemplateSite();
$f = new Clases\PublicFunction();
$contenidos = new Clases\Contenidos();
$config = new Clases\Config();

$datosContacto = $config->viewContact();

$captchaData = $config->viewCaptcha();
#Se carga la configuración de email
$data = [
    "filter" => ['contenidos.area = "contacto"'],
];
$contenidoContacto = $contenidos->list($data, $_SESSION['lang']);
#Información de cabecera
$template->set("title", "Contacto | " . TITULO);
$template->set("description", "Envianos tus dudas y nosotros te asesoramos");
$template->set("keywords", "");
$template->themeInit();
?>

<section id="contact" class="contact pt-100">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contacto</h2>
          <p><?= $contenidoContacto["encabezado"]["data"]["contenido"]?></p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Ubicación:</h4>
                <p><?= $datosContacto["data"]["domicilio"] . ', ' . $datosContacto["data"]["localidad"]. ', ' .$datosContacto["data"]["provincia"] . '. '?></p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p><?= $datosContacto["data"]["email"]?></p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p><?=$datosContacto["data"]["telefono"]?></p>
              </div>
              <iframe allowfullscreen="" frameborder="0" height="400" loading="lazy" referrerpolicy="no-referrer-when-downgrade" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3404.5501178916593!2d-62.084385484680496!3d-31.426518903887064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95cb2818bece7675%3A0x325aecfa5720e84d!2sEstudio%20Rocha%20%26%20Asoc.!5e0!3m2!1ses!2sar!4v1666278583170!5m2!1ses!2sar" style="border:0;" width="100%"></iframe>
            </div>

          </div>
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Nombre</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Apellido</label>
                  <input type="text" class="form-control" name="apellido" id="apellido" required>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Número de teléfono</label>
                  <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Mensaje</label>
                <textarea class="form-control" name="message" rows="10" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Cargando</div>
                <div class="error-message"></div>
                <div class="sent-message">Tu mensaje se envio correctamente. Gracias!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>

<?php $template->themeEnd() ?>