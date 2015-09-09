<!DOCTYPE html>
<html>
  <head>
    <title><?php if(is_home()) { echo "Start - "; bloginfo( 'name' ); } else { wp_title(); } ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf8" />
		<meta property="og:image" content="<?= wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>" />
		<link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="<?php bloginfo('stylesheet_url');?>" type="text/css" rel="stylesheet" media="screen, projection" />

		<?php wp_head(); ?>
	</head>



  <body>



    <nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="container">
          <div class="navbar-header" style="text-transform:uppercase;">
            <button
              type="button"
              class="navbar-toggle"
              data-toggle="collapse"
              data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="header-logo" style="margin-top: -10px; margin-bottom: 60px;" class="navbar-brand" href="<?php echo home_url(); ?>"><img class="logotyp" src="http://i.imgur.com/rr4fKO1.png"></a>

          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right menyn">
            <?php $terms = get_terms(
                array('post_tag'),
                array(
                  'orderby'    => 'count',
                  'hide_empty' => 0
                )
              )
            ?>
            <?php if ( !empty( $terms ) && !is_wp_error( $terms ) ) : ?>
              <?php foreach ( $terms as $term ) : ?>
                <li><a class="nohover current" href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
              <?php endforeach; ?>
            <?php endif; ?>
	         </ul>
         </div>
      </div>
    </nav>


    <div id="main-container" class="container">
