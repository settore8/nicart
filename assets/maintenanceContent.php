<!DOCTYPE HTML>
<html lang="it-IT">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo get_bloginfo( 'name' ); ?> in Manutenzione</title>
<link href="<?php bloginfo('template_directory'); ?>/maintenance.css" rel = "stylesheet">
</head>
<body>
<section id="error">
    <img src="<?php bloginfo("template_url"); ?>/images/logo-nicart.svg" alt="Logo Nicart" onerror="this.onerror=null; this.src='<?php bloginfo("template_url"); ?>/images/logo-nicart.png'">
    <h2>Sito <strong><?php echo get_bloginfo( 'name' ); ?></strong> in manutenzione</h2>
    <p>Stiamo migliorando il nostro sito internet.<br/>Ritorna a visitarci più tardi.</p>
    <hr/>
    <a class="btn" href="https://www.nicart.it/NICART_generale_2022.pdf" target="_blank">Scarica il catalogo 2022</a>
    <hr/>
    <address><strong>Nicart di Artini Aldo</strong>
    <small>Via G. La Pira, 11 - 52024 Loro Ciuffenna (AR)<br/>
    Cell. <?php echo NICART_TEL; ?> - Tel/Fax 055 9172783 - info@nicart.it</small></address>
</section>
</body>
</html>

