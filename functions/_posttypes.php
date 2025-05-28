<?php

add_action( 'init', 'codex_video_init' );

function codex_video_init() {
	$labels = array(
		'name'               => _x( 'Video', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'video', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Video', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'video', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Aggiungi video', 'privati', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Aggiungi nuovo video', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nuovo video', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Modifico video', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Vedi i video', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Cerca video', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent video:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nessuna video trovato.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nessuna video trovato nel cestino.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite' => array(
	    'slug' => 'video',
	    'with_front' => true
	  	),
    'has_archive'        => 'video',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array( 'title')
	);

	register_post_type( 'video', $args );
}



add_action( 'init', 'codex_retailer_init' );

function codex_retailer_init() {
	$labels = array(
		'name'               => _x( 'Rivenditore', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Rivenditore', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Rivenditori', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Rivenditore', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Aggiungi Rivenditore', 'privati', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Aggiungi nuovo Rivenditore', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nuovo Rivenditore', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Modifico Rivenditore', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Vedi i rivenditori', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Cerca Rivenditore', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Rivenditore:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nessuna rivenditore trovato.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nessuna rivenditore trovato nel cestino.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite' => array(
	    'slug' => 'rivenditori',
	    'with_front' => true
	  	),
    	'has_archive'        => 'rivenditori',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array( 'title')
	);

	register_post_type( 'retailer', $args );
}


add_action( 'template_redirect', function() {
    if ( is_singular('retailer') ) {
        global $post;
        $redirectLink = get_post_type_archive_link( 'retailer' );
        wp_redirect( $redirectLink, 302 );
        exit;
    }
});


add_action( 'init', 'codex_faq_init' );

function codex_faq_init() {
	$labels = array(
		'name'               => _x( 'Faqs', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Faq', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Faqs', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'faq', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Aggiungi faq', 'privati', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Aggiungi nuovo faq', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nuovo faq', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Modifico faq', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Vedi i faq', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Cerca faq', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent faq:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nessuna faq trovato.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nessuna faq trovato nel cestino.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
    	'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite' => array(
	    'slug' => 'faq',
	    	'with_front' => true
	  	),
		'has_archive'        => 'domande-frequenti',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'supports'           => array( 'title', 'page-attributes' ),
		);
	register_post_type( 'faq', $args );
}


function format_duration_iso8601($seconds) {
    $minutes = floor($seconds / 60);
    $secs = $seconds % 60;

    $parts = 'PT';
    if ($minutes > 0) {
        $parts .= $minutes . 'M';
    }
    if ($secs > 0 || $minutes == 0) {
        $parts .= $secs . 'S';
    }

    return $parts;
}



function inject_videoobject_jsonld() {
	if (!is_singular('video')) return;

	if (!have_posts()) return;

	global $post;
	setup_postdata($post);

	$video_iframe   = get_field('video_youtube', $post->ID);
	$duration       = get_field('duration', $post->ID); // in secondi, es. 67
	$poster       	= get_field('poster', $post->ID); // in secondi, es. 67
	$description   	= get_field('description', $post->ID); // in secondi, es. 67
	$upload_date    = get_the_date('c', $post->ID);
	$publisher_name = 'Nicart';
	$publisher_logo = get_theme_file_uri('/images/logo-nicart.png');

	// Estrai l’ID del video YouTube
	$video_id = '';
	if (strpos($video_iframe, 'youtube.com') !== false || strpos($video_iframe, 'youtu.be') !== false) {
		preg_match('/(youtube\.com\/embed\/|youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/i', $video_iframe, $matches);
		$video_id = isset($matches[2]) ? $matches[2] : '';
	}
	if (!$video_id) return;

	$video_url  = 'https://www.youtube.com/watch?v=' . $video_id;
	$embed_url  = 'https://www.youtube.com/embed/' . $video_id;
	$thumb_url  = $poster['url'] ? $poster['url'] : "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
	$duration_iso = format_duration_iso8601($duration);

	// Output JSON-LD
	?>
	<script type="application/ld+json">
	{
	  "@context": "https://schema.org",
	  "@type": "VideoObject",
	  "name": <?= json_encode(get_the_title($post)) ?>,
	  "description": <?= json_encode($description) ?>,
	  "thumbnailUrl": <?= json_encode($thumb_url) ?>,
	  "uploadDate": "<?= $upload_date ?>",
	  "embedUrl": <?= json_encode($embed_url) ?>,
	  "contentUrl": <?= json_encode($video_url) ?>,
	  "duration": "<?= $duration_iso ?>",
	  "publisher": {
	    "@type": "Organization",
	    "name": <?= json_encode($publisher_name) ?>,
	    "logo": {
	      "@type": "ImageObject",
	      "url": <?= json_encode($publisher_logo) ?>
	    }
	  }
	}
	</script>
	<?php

	wp_reset_postdata();
}
add_action('wp_head', 'inject_videoobject_jsonld');



function save_youtube_thumbnail_as_poster($post_id) {

    // Evita salvataggi indesiderati
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;

    // Solo per post type "video"
    if (get_post_type($post_id) !== 'video') return;

    // Se il campo "poster" è già valorizzato, non fare nulla
    $existing_poster = get_field('poster', $post_id);
    if (!empty($existing_poster)) return;

    // Recupera il campo "video_youtube"
    $video_field = get_field('video_youtube', $post_id);
    if (!$video_field) return;

    // Estrai ID del video
    $video_id = '';
    if (strpos($video_field, 'youtube.com') !== false || strpos($video_field, 'youtu.be') !== false) {
        preg_match('/(youtube\.com\/embed\/|youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/i', $video_field, $matches);
        $video_id = isset($matches[2]) ? $matches[2] : '';
    }
    if (!$video_id) return;

    // URL del thumbnail
    $thumb_url = "https://img.youtube.com/vi/{$video_id}/maxresdefault.jpg";

    // Scarica temporaneamente il file
    $tmp = download_url($thumb_url);
    if (is_wp_error($tmp)) return;

    // Fallback a hqdefault se maxresdefault è troppo piccolo
    if (filesize($tmp) < 1000) {
        @unlink($tmp);
        $thumb_url = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
        $tmp = download_url($thumb_url);
        if (is_wp_error($tmp)) return;
    }

    // Prepara il file
   	$post_title  = get_the_title($post_id);
	$slug_title  = sanitize_title($post_title); // es. "il-mio-video"
	$file_array = [
		'name'     => "{$slug_title}-{$video_id}-nicart.jpg",
		'tmp_name' => $tmp,
	];

    // Salva nella Media Library
    $attachment_id = media_handle_sideload($file_array, $post_id);

    // In caso di errore
    if (is_wp_error($attachment_id)) {
        @unlink($tmp);
        return;
    }

    // Salva l'ID dell'immagine nel campo ACF "poster"
    update_field('poster', $attachment_id, $post_id);
}
add_action('acf/save_post', 'save_youtube_thumbnail_as_poster');



// 1. Aggiungi colonne personalizzate
function custom_video_columns($columns) {
    $new_columns = [];

    // Inserisci dopo il titolo
    foreach ($columns as $key => $label) {
        $new_columns[$key] = $label;

        if ($key === 'title') {
            $new_columns['poster']    = 'Poster';
            $new_columns['duration']  = 'Durata';
            $new_columns['excerpt']   = 'Descrizione';
        }
    }

    return $new_columns;
}
add_filter('manage_video_posts_columns', 'custom_video_columns');

// 2. Popola i valori delle colonne
function custom_video_column_content($column, $post_id) {
    if ($column === 'poster') {
        $poster_id = get_field('poster', $post_id);
        if ($poster_id) {
            echo wp_get_attachment_image($poster_id['ID'], 'thumbnail', false, ['style' => 'display:block;width:120px;height:auto;']);
        } else {
            echo '—';
        }

    } elseif ($column === 'duration') {
        $seconds = (int) get_field('duration', $post_id);
        if ($seconds) {
            $minutes = floor($seconds / 60);
            $remain  = $seconds % 60;
            printf('%d:%02d', $minutes, $remain);
        } else {
            echo '—';
        }

    } elseif ($column === 'excerpt') {
        echo wp_trim_words(get_field('description',$post_id), 8, '…');
    }
}
add_action('manage_video_posts_custom_column', 'custom_video_column_content', 10, 2);



function generate_posters_for_all_videos() {
    $query = new WP_Query([
        'post_type'      => 'video',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => [
            [
                'key'     => 'poster',
                'compare' => 'NOT EXISTS'
            ]
        ]
    ]);

    if (!$query->have_posts()) {
        echo 'Nessun video da aggiornare.';
        return;
    }

    foreach ($query->posts as $post) {
        $post_id = $post->ID;
        $video_field = get_field('video_youtube', $post_id);

        if (!$video_field) continue;

        // Estrai ID YouTube
        preg_match('/(youtube\.com\/embed\/|youtube\.com\/watch\?v=|youtu\.be\/)([\w\-]+)/i', $video_field, $matches);
        $video_id = $matches[2] ?? '';
        if (!$video_id) continue;

        $poster_set = false;

        // Prova prima con maxresdefault
        $thumb_urls = [
            "https://img.youtube.com/vi/{$video_id}/maxresdefault.jpg",
            "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg"
        ];

        foreach ($thumb_urls as $thumb_url) {
            $tmp = download_url($thumb_url);

            if (is_wp_error($tmp)) continue;
            if (filesize($tmp) < 1000) { // immagine non valida
                @unlink($tmp);
                continue;
            }

            // Costruisci nome file
            $post_title = get_the_title($post_id);
            $slug_title = sanitize_title($post_title);
            $file_array = [
                'name'     => "{$slug_title}-{$video_id}.jpg",
                'tmp_name' => $tmp,
            ];

            $attachment_id = media_handle_sideload($file_array, $post_id);
            if (is_wp_error($attachment_id)) {
                @unlink($tmp);
                continue;
            }

            // Salva poster
            update_field('poster', $attachment_id, $post_id);
            $poster_set = true;
            break; // esci dal ciclo thumb_urls
        }

        if (!$poster_set) {
            error_log("Impossibile scaricare poster per video ID: $video_id (Post ID: $post_id)");
        }
    }

    echo 'Poster generati per tutti i video validi.';
}

add_action('admin_menu', function() {
    add_management_page(
        'Genera Poster Video',
        'Genera Poster Video',
        'manage_options',
        'genera-poster-video',
        function() {
            echo '<div class="wrap"><h1>Generazione Poster</h1>';
            generate_posters_for_all_videos();
            echo '</div>';
        }
    );
});

?>
