<article class="pagePreview col-xs-12" itemscope itemtype="http://schema.org/Service">
			<a href="<?php the_permalink(); ?>" class="row" title="<?php echo  _e('Scopri', 'lang'); ?> <?php the_title(); ?>">

				<div class="col-xs-12 col-sm-3">
					<figure itemscope itemtype="http://schema.org/ImageObject">
					<?php
					if (has_post_thumbnail()) {
						$thumb_id = get_post_thumbnail_id($post);
						$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
					?>
					<img src="<?php the_post_thumbnail_url('slidePortrait'); ?>" alt="<?php if ($alt != null) { echo $alt; } else { echo get_the_title(); } ?>" class="img-responsive" itemprop="contentUrl"/>
					<?php } else { ?>
					<img src="<?php echo get_template_directory_uri().'/images/placeholder.png'; ?>" class="img-responsive" alt="placeholder" itemprop="contentUrl"/>
					<?php } ?>
					</figure>
				</div>

				<div class="col-xs-12 col-sm-9">
						<h4 itemprop="name"><?php $iconatitolo = get_field('icona_titolo'); if($iconatitolo) { echo '<i class="'.$iconatitolo.'"></i>'; } ?><?php the_title(); ?></h4>
						<?php if (get_field('short_text')) { ?>
							<strong class="shortdesc"><?php echo get_field('short_text'); ?></strong>
						<?php } ?>
					</div>



			</a>
</article>
