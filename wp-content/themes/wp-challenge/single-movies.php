<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

                $fields = get_fields($movie);
                if( $fields ): ?>
                    <ul class="post-container">
                        <?php foreach( $fields as $name => $value ): 
                            if ($name == 'genre') {
                                foreach ($value as $obj) {
                                    $name = $obj->name;
                            
                                    $html  = "<li class='genre'>";
                                    $html .=    "$name";
                                    $html .= "</li>";
                                    echo $html;
                                }
                            }
                            else if ($name == 'production_companies') {
                                foreach ($value as $companie) {
                                    $logo_path = $companie->logo_path;
                                    $companie_name = $companie->name;

                                    if($logo_path != ''){
                                        
                                        $html  = "<li class='production_companies'>";
                                        $html .=    "<img src='";
                                        $html .= "https://image.tmdb.org/t/p/w500";
                                        $html .= $logo_path;
                                        $html .= "'/>";
                                        $html .= "</li>";
                                        echo $html;

                                    }else {

                                        $html  = "<li class='production_companies'>";
                                        $html .=   "<p>";
                                        $html .=   $companie_name;
                                        $html .=   "</p>";
                                        $html .= "</li>";
                                        echo $html;

                                    }
                                    
                                }
                            }
                            else if ($name == 'poster') {
                                        
                                $html  = "<li class='poster'>";
                                $html .=    "<img src='";
                                $html .= "https://image.tmdb.org/t/p/w500";
                                $html .= $value;
                                $html .= "'/>";
                                $html .= "</li>";
                                echo $html;

                            }
                            else if ($name == 'id') {
                                        
                                echo '';

                            }
                            else{?>
                            <li class="<?php echo $name; ?>"><?php echo $value; ?></li>
                        <?php }
                        endforeach; ?>
                    </ul>
                <?php endif;

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
