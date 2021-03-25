<?php get_header(); ?>

<?php 

    if(!is_single() && !is_shop()) { ?>
    <div id="archiveHeader" class="row">
    <?php
    if(is_tax() ) { 
        $queried_object = get_queried_object();
        $taxonomy = $queried_object->taxonomy;
        $term_id = $queried_object->term_id;
        $thumbnail = get_field('testata_categoria', $queried_object);

        $title = $queried_object->name;
        $description = $queried_object->description;

        } elseif( is_post_type_archive() ) {
            $title = get_query_var( 'post_type' );
            $description = null;
            $thumbnail = null;
        } else {
            $title = null;
            $description = null;
            $thumbnail = null;
        }
        ?>
        <?php if(!empty($thumbnail)) { ?>
            <picture>
                <source srcset="<?php echo $thumbnail['sizes']['md'] ?>" media="(max-width: 768px)">
                <source srcset="<?php echo $thumbnail['sizes']['lg'] ?>">
                <img src="<?php echo $thumbnail['sizes']['lg'] ?>" alt="<?php echo $title; ?>" class="img-responsive">
            </picture>
        <?php } ?>
        <div id="archiveHeaderTxt">
            <?php if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<p id="breadcrumbs" class="row">','</p>');
            } ?>
            <div class="header-title"><?php echo $title; ?></div>
            <?php if ( have_posts() ) { 
                if(!empty($description)) :
                // mostra la descrizione sotto al titolo solo se non sono presenti articoli.
                echo '<p>'.$description.'</p>';
                endif;
            }?>
        </div>
    </div>
    <?php } else {?>

        <?php if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<p id="breadcrumbs" class="row">','</p>');
        } ?>

   <?php } ?>
    
<main class="container">
<?php woocommerce_content(); ?>
</main>
<?php get_footer(); ?>
