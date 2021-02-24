
				<a href="<?php the_permalink(); ?>" title="Apri <?php the_title(); ?>" class="media-left">
				<figure itemscope itemtype="http://schema.org/ImageObject">
				<?php
				if (has_post_thumbnail()) {

						$thumb_id = get_post_thumbnail_id($post);
						$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
				?>
				<img src="<?php the_post_thumbnail_url('slidePortrait'); ?>" alt="<?php if ($alt != null) { echo $alt; } else { echo get_the_title(); } ?>" class="media-object"/>
				<?php } else { ?>
						<img src="<?php echo get_template_directory_uri().'/images/placeholder.png'; ?>" class="media-object" alt="placeholder"/>
				<?php } ?>
				</figure>
				</a>
			<a href="<?php the_permalink(); ?>" title="Apri <?php the_title(); ?>" class="media-body">

			<h5 class="media-heading" itemprop="name"><?php $iconatitolo = get_field('icona_titolo'); if($iconatitolo) { echo '<i class="'.$iconatitolo.'"></i>'; } ?><?php the_title(); ?>
			<?php if (get_field('short_text')) { ?> <span class="media-text"><?php echo get_field('short_text');  ?></span> <?php } ?>
			</h5>

			</a>
