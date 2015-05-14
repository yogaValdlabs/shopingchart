<?php
if ( ! class_exists( 'THIM_Widget_Portfolio' ) ) {
	class THIM_Widget_Portfolio extends WP_Widget {
		public $texolomy = "portfolio_category";

		// constructor
		function THIM_Widget_Portfolio() {
			parent::WP_Widget(false, $name = __('Portfolio (THIM)', 'wp_widget_plugin') );
		}

		// widget form creation in BACKEND
		function form($instance) { 
			$instance = wp_parse_args( 
							(array) $instance, 
							array(  'category' => array(), 
	                                'filter_hiden' => 'off', 
	                                'filter_style' => '', 
	                                'filter_position' => '', 
	                                'column' => '', 
	                                'gutter' => 'on',
	                                'item_size' => '',
	                                'item_style' => '',
	                                'item_effect' => '',
	                                'paging' => '',
	                                'num_per_view' => '',
	                        ) 
						);
			// Get values 
		    $category = $instance['category']; 
		    $filter_hiden = $instance['filter_hiden']; 
		    $filter_style = esc_textarea(strip_tags($instance['filter_style'])); 
		    $filter_position = esc_attr(strip_tags($instance['filter_position'])); // Added 
		    $column = esc_attr(strip_tags($instance['column'])); // Added 
		    $gutter = $instance['gutter'];
		    $item_size = esc_attr(strip_tags($instance['item_size']));
		    $item_style = esc_attr(strip_tags($instance['item_style']));
		    $item_effect = esc_attr(strip_tags($instance['item_effect']));
		    $paging = esc_attr(strip_tags($instance['paging']));
		    $num_per_view = esc_attr(strip_tags($instance['num_per_view']));
			

			?>
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>">
					<?php _e('Portfolio Categories', 'wp_widget_plugin'); ?>
				</label>
				<select id="<?php echo $this->get_field_id('category'); ?>" class="multi-select" name="<?php echo $this->get_field_name('category'); ?>[]" multiple="multiple">
					<?php
					if (isset( $category[''] ) && is_array( $category[''] )) {
						$category = $category[''];
					}
					$cats     = get_terms( 'portfolio_category' );
					foreach ( $cats as $cat ) {
						echo '<option value="'.$cat->term_id.'" '.(in_array( $cat->term_id, $category) ? ' selected="selected"' : '').'>'.$cat->name.'</option>';
					}	
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id("filter_hiden"); ?>">
		            <input type="checkbox" class="wg_comments_tab" id="<?php echo $this->get_field_id("filter_hiden"); ?>" name="<?php echo $this->get_field_name("filter_hiden"); ?>" <?php checked( $filter_hiden, 'on' ); ?> />
		            <?php _e( 'Hide Filters?', 'wp_widget_plugin'); ?>
		        </label>
		    </p>
			
			<p>
				<label for="<?php echo $this->get_field_id('filter_style'); ?>">
					<?php _e('Filters Style','wp_widget_plugin'); ?>
				</label>
				<select name="<?php echo $this->get_field_name('filter_style'); ?>" id="<?php echo $this->get_field_id('filter_style'); ?>" class="widefat">
					<?php
					$f_style = array(
						'style-01'	=>	'Style 01', 
						'style-02'	=>	'Style 02', 
					);
					foreach ($f_style as $key => $value) {
						echo '<option value="' . $key . '"', $filter_style == $key ? ' selected="selected"' : '', '>', $value, '</option>';
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('filter_position'); ?>">
					<?php _e('Filters Position','wp_widget_plugin'); ?>
				</label>
				<select name="<?php echo $this->get_field_name('filter_position'); ?>" id="<?php echo $this->get_field_id('filter_position'); ?>" class="widefat">
					<?php
					$f_position = array(
						'left'	=>	'Left', 
						'center'	=>	'Center', 
						'right'	=>	'Right', 
					);
					foreach ($f_position as $key => $value) {
						echo '<option value="' . $key . '"', $filter_position == $key ? ' selected="selected"' : '', '>', $value, '</option>';
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('column'); ?>">
					<?php _e('Columns','wp_widget_plugin'); ?>
				</label>
				<select name="<?php echo $this->get_field_name('column'); ?>" id="<?php echo $this->get_field_id('column'); ?>" class="widefat">
					<?php
					$columns = array(
						'one'	=>	'One', 
						'two'	=>	'Two', 
						'three'	=>	'Three', 
						'four'	=>	'Four', 
						'five'	=>	'Five', 
					);
					foreach ($columns as $key => $value) {
						echo '<option value="' . $key . '"', $column == $key ? ' selected="selected"' : '', '>', $value, '</option>';
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id("gutter"); ?>">
		            <input type="checkbox" id="<?php echo $this->get_field_id("gutter"); ?>" name="<?php echo $this->get_field_name("gutter"); ?>" <?php checked( $gutter, 'on' ); ?> />
		            <?php _e( 'Enable gutter for items', 'wp_widget_plugin'); ?>
		        </label>
		    </p>
		    <p>
				<label for="<?php echo $this->get_field_id('item_size'); ?>">
					<?php _e('Items Size','wp_widget_plugin'); ?>
				</label>
				<select name="<?php echo $this->get_field_name('item_size'); ?>" id="<?php echo $this->get_field_id('item_size'); ?>" class="widefat">
					<?php
					$i_size = array(
						'multigrid'	=>	'Multigrid', 
						'masonry'	=>	'Masonry', 
						'same'	=>	'Same size', 
					);
					foreach ($i_size as $key => $value) {
						echo '<option value="' . $key . '"', $item_size == $key ? ' selected="selected"' : '', '>', $value, '</option>';
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('item_style'); ?>">
					<?php _e('Items Style','wp_widget_plugin'); ?>
				</label>
				<select name="<?php echo $this->get_field_name('item_style'); ?>" id="<?php echo $this->get_field_id('item_style'); ?>" class="widefat">
					<?php
					$i_style = array(
						'text'	=>	'Text', 
						'classic'	=>	'Classic',  
					);
					foreach ($i_style as $key => $value) {
						echo '<option value="' . $key . '"', $item_style == $key ? ' selected="selected"' : '', '>', $value, '</option>';
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('item_effect'); ?>">
					<?php _e('Items Hover Effect','wp_widget_plugin'); ?>
				</label>
				<select name="<?php echo $this->get_field_name('item_effect'); ?>" id="<?php echo $this->get_field_id('item_effect'); ?>" class="widefat">
					<?php
					$i_effect = array(
						'effects_classic'	=>	'Classic', 
						'effects_zoom_01'	=>	'Zoom In 01',  
						'effects_zoom_02'	=>	'Zoom In 02',  
					);
					foreach ($i_effect as $key => $value) {
						echo '<option value="' . $key . '"', $item_effect == $key ? ' selected="selected"' : '', '>', $value, '</option>';
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('paging'); ?>">
					<?php _e('Pagination Styles','wp_widget_plugin'); ?>
				</label>
				<select name="<?php echo $this->get_field_name('paging'); ?>" id="<?php echo $this->get_field_id('paging'); ?>" class="widefat">
					<?php
					$p = array(
						'all'	=>	'Show All', 
						'limit'	=>	'Limit Items',  
						'paging'	=>	'Paging',  
						'infinite_scroll'	=>	'Infinite Scroll',
					);
					foreach ($p as $key => $value) {
						echo '<option value="' . $key . '"', $paging == $key ? ' selected="selected"' : '', '>', $value, '</option>';
					}
					?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('num_per_view'); ?>">
					<?php _e('Items per View', 'widget_plugin'); ?>
				</label>
				<input id="<?php echo $this->get_field_id('num_per_view'); ?>" type="number" min="1" name="<?php echo $this->get_field_name('num_per_view'); ?>" value="<?php echo $num_per_view; ?>" />
				<p class="description">Leave empty to using number in system config</p>
			</p>

			<?php 
		}

		// Update widget
		function update($new_instance, $old_instance) {
			$instance = $old_instance;

			// Fields
			$instance['category'] = $new_instance['category'];
			$instance['filter_hiden'] = $new_instance['filter_hiden'];
			$instance['filter_style'] = strip_tags($new_instance['filter_style']);
			$instance['filter_position'] = strip_tags($new_instance['filter_position']);
			$instance['column'] = strip_tags($new_instance['column']);
			$instance['gutter'] = $new_instance['gutter'];
			$instance['item_size'] = strip_tags($new_instance['item_size']);
			$instance['item_style'] = strip_tags($new_instance['item_style']);
			$instance['item_effect'] = strip_tags($new_instance['item_effect']);
			$instance['paging'] = strip_tags($new_instance['paging']);
			$instance['num_per_view'] = strip_tags($new_instance['num_per_view']);
			return $instance;
		}

		// Display widget in FRONTEND
		function widget($args, $instance) {
			extract( $args );
		    $category = empty($instance['category']) ? array() : $instance['category']; 
		    $filter_hiden = $instance['filter_hiden'] ? $instance['filter_hiden'] : "off"; 
		    $filter_style = $instance['filter_style']; 
		    $filter_position = $instance['filter_position'];
		    $column = $instance['column'];
		    $gutter = $instance['gutter'];
		    $item_size = $instance['item_size'];
		    $item_style = $instance['item_style'];
		    $item_effect = $instance['item_effect'];
		    $paging = $instance['paging'];
		    $num_per_view = $instance['num_per_view'] ? $instance['num_per_view'] : "";
		    if (isset( $category[''] ) && is_array( $category[''] )) {
				$category = $category[''];
			}
		    global $post;

		    echo $before_widget;

		    // Filter position
			if ($filter_position == "left") {
				$css_filter_position = ' style="text-align:left;"';
			}else if ($filter_position == "right") {
				$css_filter_position = ' style="text-align:right;"';
			}else {
				$css_filter_position = ' style="text-align:center;"';
			}

			// Gutter
			if ($gutter == "on") {
				$class_gutter = " gutter";
			}else {
				$class_gutter = "";
			}

			// Column
		    if ( $column == 'two' ) {
				$class_column = "two-col";
			} elseif ( $column == 'three' ) {
				$class_column = "three-col";
			} elseif ( $column == 'four' ) {
				$class_column = "four-col";
			}elseif ( $column == 'five' ) {
				$class_column = "five-col";
			}else {
				$class_column = "one-col";
			}

			// Paging
			if ($paging == 'paging') {
				if ( is_front_page() ) {
					$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
				} else {
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				}
				if ($num_per_view != '') { // overide number
					$args = array(
						'post_type' => 'portfolio',
						'posts_per_page' => $num_per_view,
						'paged'     => $paged
					);
				}else {// using number in config
					$args = array(
						'post_type' => 'portfolio',
						'paged'     => $paged
					);
				}
				
			}else if($paging == 'limit'){
				if ($num_per_view != '') { // overide number
					$args = array(
						'post_type' => 'portfolio',
						'posts_per_page' => $num_per_view
					);
				}else {// using number in config
					$args = array(
						'post_type' => 'portfolio'
					);
				}

			}else if ($paging == 'infinite_scroll') {
				if ( is_front_page() ) {
					$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
				} else {
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				}
				if ($num_per_view != '') { // overide number
					$args = array(
						'post_type' => 'portfolio',
						'posts_per_page' => $num_per_view,
						'paged'     => $paged
					);
					//echo $paged;
					//exit;
				}else {// using number in config
					$args = array(
						'post_type' => 'portfolio',
						'paged'     => $paged
					);
				}
			}else { // show all post
				$args = array(
					'post_type'      => 'portfolio',
					'posts_per_page' => -1
				);
			}
			
			if ( (is_array( $category ) && ! empty( $category )) || (!is_array( $category ) && $category) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'portfolio_category',
					'field'    => 'ID',
					'terms'    => $category
				);
			}

			$gallery = new WP_Query( $args );

			$number_total = max($gallery->post_count, $paging);
			if ( is_array( $gallery->posts ) && ! empty( $gallery->posts ) && $gallery->post_count) {
				foreach ( $gallery->posts as $gallery_post ) {
					$post_taxs = wp_get_post_terms( $gallery_post->ID, 'portfolio_category', array( "fields" => "all" ) );
					if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
						foreach ( $post_taxs as $post_tax ) {
							if ( is_array( $category ) && ! empty( $category ) && ( in_array( $post_tax->term_id, $category ) || in_array( $post_tax->parent, $category ) ) ) {
								$portfolio_taxs[urldecode( $post_tax->slug )] = $post_tax->name;
							}
							if ( empty( $category ) || ! isset( $category ) ) {
								$portfolio_taxs[urldecode( $post_tax->slug )] = $post_tax->name;
							}
						}
					}
				}
			}else {
				//get_template_part( 'content', 'none' );
				exit;
			}


			?>
			<!-- <div class="page-tpl-plo wapper_portfolio <?php echo $item_style;?> <?php echo $item_effect;?><?php echo $class_gutter;?> <?php echo $item_size;?> <?php echo $paging; ?>"> -->
			<div class="wapper_portfolio <?php echo $item_style;?> <?php echo $item_effect;?><?php echo $class_gutter;?> <?php echo $item_size;?> <?php echo $paging; ?>">
				<?php if ($filter_hiden !== "on") { ?>
					<div class="portfolio-tabs-wapper filters <?php echo $filter_style;?>"<?php echo $css_filter_position;?> >
						<ul class="portfolio-tabs">
							<li><a href class="filter active"  data-filter="*"><?php echo __( 'All', 'thimpress' ); ?></a>
							</li>
							<?php foreach ( $portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name ): ?>
								<li>
									<a class="filter" href data-filter=".<?php echo $portfolio_tax_slug; ?>"><?php echo $portfolio_tax_name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php } ?>
				
				<div class="portfolio_column">
				<ul class="content_portfolio">
						<?php
						while ( $gallery->have_posts() ): $gallery->the_post();
							$feature_images = get_post_meta( get_the_ID(), 'feature_images', true );
							//$masonry_size = get_post_meta( get_the_ID(), 'masonry_size', true );
							$images_size    = 'portfolio_size11';
							$style_layout   = '';

							$class_size = "";
							if ($item_size=="multigrid") {
								if ( $feature_images == 'size11' ) {
									$images_size = 'portfolio_size11';
									$class_size       ="";
								} elseif ( $feature_images == 'size12' ) {
									$images_size = 'portfolio_size12';
									$class_size       =" height_large";
	 							}
								elseif ( $feature_images == 'size21' ) {
									$images_size = 'portfolio_size21';
									$class_size       = " item_large";
								}elseif ( $feature_images == 'size22' ) {
									$images_size = 'portfolio_size22';
									$class_size       = " height_large item_large";
								}else {
									$array = array( 
										'portfolio_size11' => 'size11', 
										'portfolio_size12' => 'size12', 
										'portfolio_size21' => 'size21',
										'portfolio_size22' => 'size22'
									);
									$images_size = array_rand($array, 1);
									if ( $images_size == 'portfolio_size11' ) {
										$class_size       = "";
									}else if ( $images_size == 'portfolio_size12' ) {
										$class_size       = " height_large";
		 							}else if ( $images_size == 'portfolio_size21' ) {
										$class_size       = " item_large";
									}else{
										$class_size       = " height_large item_large";
									}
								}
								$class_size = $class_size." ".$class_column;
							}else if ($item_size=="masonry") {
								$class_size       ="";
								$images_size = "full";
								
								$class_size = $class_size." ".$class_column;
							}
							else {
								//$images_size = 'portfolio_same_size';
								$images_size = 'portfolio_size11';
								$class_size = $class_size." ".$class_column;
							}

							$item_classes = '';
							$terms_id     = array();
							$item_cats    = get_the_terms( $post->ID, 'portfolio_category' );
							if ( $item_cats ):
								foreach ( $item_cats as $item_cat ) {
									$item_classes .= $item_cat->slug . ' ';
									$terms_id[] = $item_cat->term_id;
								}
							endif;

							$image_id  = get_post_thumbnail_id( $post->ID );

							if ($item_size=="masonry") {
								$height = null;
								$width = '600';
								$crop = ( $height == null ) ? false : true;

								$imgurl = wp_get_attachment_image_src( $image_id, 'full' );
								$image_crop = aq_resize( $imgurl[0], $width, $height, $crop );

								$image_url = '<img src="'.$image_crop.'" alt= '.get_the_title().' title = '.get_the_title().' />';
								
							}else {
								$crop = true;
								
								if ($images_size == 'portfolio_size11')	{
									$w = '480';
									$h = '320';
								}else if ($images_size == 'portfolio_size12') {
									$w = '480';
									$h = '640';
								}else if ($images_size == 'portfolio_size21') {
									$w = '960';
									$h = '320';
								}else {
									$w = '960';
									$h = '640';
								}
								$imgurl = wp_get_attachment_image_src( $image_id, 'full' );
								$image_crop = aq_resize( $imgurl[0], $w, $h, $crop );

								if ($item_size == "multigrid" && $gutter=="on") {
									$image_url = '<div class="thumb-img" style="background: url('.$image_crop.');background-size: cover;background-repeat: no-repeat;background-position: center center;height: inherit;"><img style="visibility: hidden;" src="'.$image_crop.'" alt= '.get_the_title().' title = '.get_the_title().' /></div>';
								}else {
									$image_url = '<img src="'.$image_crop.'" alt= '.get_the_title().' title = '.get_the_title().' />';
								}
							}

							// check postfolio type
							$btn_text = "Zoom";
							$data_href = "";
							if (get_post_meta( get_the_ID(), 'selectPortfolio', true ) ==  "portfolio_type_1") {
								if (get_post_meta( get_the_ID(), 'style_image_popup', true ) ==  "Style-01") { // prettyPhoto
									$imclass = "image-popup-01";
									if (get_post_meta( get_the_ID(), 'project_item_slides', true ) != "") { //overide image
										$att = get_post_meta( get_the_ID(), 'project_item_slides', true );
										$imImage  = wp_get_attachment_image_src( $att, 'full' );
										$imImage  = $imImage[0];		
									}else if (has_post_thumbnail( $post->ID )) {// using thumb
										
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
										$imImage = $image[0];
									}else {// no thumb and no overide image
										$imclass ="";
										$imImage = get_permalink( $post->ID );
										$btn_text = "View More";
									}
									
								}else { // magnific
									$imclass = "image-popup-02";
									if (get_post_meta( get_the_ID(), 'project_item_slides', true ) != "") {
										$att = get_post_meta( get_the_ID(), 'project_item_slides', true );
										$imImage  = wp_get_attachment_image_src( $att, 'full' );
										$imImage  = $imImage[0];	
									}else if (has_post_thumbnail( $post->ID )) {
										
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
										$imImage = $image[0];
									}else {
										$imclass ="";
										$imImage = get_permalink( $post->ID );
										$btn_text = "View More";
									}
									
								}
							}else if (get_post_meta( get_the_ID(), 'selectPortfolio', true ) ==  "portfolio_type_3") {
								$imclass = "video-popup";
								if (get_post_meta( get_the_ID(), 'project_video_embed', true ) != "") {

									if (get_post_meta( get_the_ID(), 'project_video_type', true ) == "youtube") {
										$imImage = 'http://www.youtube.com/watch?v='.get_post_meta( get_the_ID(), 'project_video_embed', true );
									}else if (get_post_meta( get_the_ID(), 'project_video_type', true ) == "vimeo") {
										$imImage = 'https://vimeo.com/'.get_post_meta( get_the_ID(), 'project_video_embed', true );
									}


								}else if (has_post_thumbnail( $post->ID )) {
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
									$imImage = $image[0];
								}else {
									$imclass ="";
									$imImage = get_permalink( $post->ID );
									$btn_text = "View More";
								}
							}else if (get_post_meta( get_the_ID(), 'selectPortfolio', true ) ==  "portfolio_type_2") {
								$imclass = "slider-popup";
								$imImage = "#".$post->post_name;
								$data_href = 'data-href="'.get_permalink( $post->ID ).'"';
							}else {
								$imclass ="";
								$data_href ="";
								$imImage = get_permalink( $post->ID );
								$btn_text = "View More";
							}
							/* end check portfolio type */

							echo '<li class="element-item ' . $item_classes . ' item_portfolio ' . $class_size . $style_layout . '">';

							if ($item_style == 'text'  ) {
								echo '<div class="portfolio-content-inner">';
								echo '<div class="portfolio-image">';
								echo '<a href="'.esc_url($imImage).'" class="link-hover '.$imclass.'" '.$data_href.'>';
								echo $image_url;
								echo '</a>';
								echo '<div class="portfolio-hover"><div class="thumb-bg"><div class="mask-content">';
								echo '<a href="'.esc_url($imImage).'" title="' . esc_attr(get_the_title( $post->ID )) . '" class="btn_zoom '.$imclass.'" '.$data_href.'>'.$btn_text.'</a>';
								echo '</div> </div></div></div>';
								echo '
								<div class="portfolio_standard"><h3><a href="'.esc_url(get_permalink( $post->ID )).'" title="' . esc_attr(get_the_title( $post->ID )) . '" >' . get_the_title( $post->ID ) . '</a></h3>';
								echo '<span class="p_line"></span>';
								$terms = get_the_terms( $post->ID, 'portfolio_category' );
								if ( $terms && ! is_wp_error( $terms ) ) :
									$cat_name = "";
									foreach ( $terms as $term ) {
										if ($cat_name)
											$cat_name .= ', ';
											$cat_name .= '<a href="'.esc_url(get_term_link($term)) .'">'.$term->name."</a>";
										$terms_id[]   = $term->term_id;

									}
							
									echo '<div class="cat_portfolio">' . $cat_name . '</div>';
								endif;
								echo '</div>';
								echo '</div>';
							} else { // classic
								echo '<div class="portfolio-image">' . $image_url . '
								<div class="portfolio-hover"><div class="thumb-bg""><div class="mask-content">';
								echo '<h3><a href="'.esc_url(get_permalink( $post->ID )).'" title="' . esc_attr(get_the_title( $post->ID )) . '" >' . get_the_title( $post->ID ) . '</a></h3>';
								echo '<span class="p_line"></span>';
								$terms = get_the_terms( $post->ID, 'portfolio_category' );
								$cat_name = "";
								if ( $terms && ! is_wp_error( $terms ) ) :
									foreach ( $terms as $term ) {
										if ($cat_name)
											$cat_name .= ', ';
										$cat_name .= '<a href="'.esc_url(get_term_link( $term)) .'">'.$term->name."</a>";
									}
									echo '<div class="cat_portfolio">' . $cat_name . '</div>';
								endif;
								echo '<a href="'.esc_url($imImage).'" title="' . esc_attr(get_the_title( $post->ID )) . '" class="btn_zoom '.$imclass.'" '.$data_href.'>'.$btn_text.'</a>';
								echo '</div></div></div></div>';
							}
							echo '</li>';
							?>

						<?php endwhile;
						wp_reset_postdata();
						?>
				</ul>
				<?php 
					if ($paging =='paging') {
						portfolio_pagination( $gallery->max_num_pages, $range = 2, $paged ); 	
					}
					
					if ( $paging =='infinite_scroll') {
						portfolio_pagination( $gallery->max_num_pages, $range = 2, $paged ); 	
					}
				?>
				</div>
			</div>
			<!-- .wapper portfolio -->
			<?php
			echo $after_widget;
		}
	}
	// register widget
	add_action('widgets_init', create_function('', 'return register_widget("THIM_Widget_Portfolio");'));
}