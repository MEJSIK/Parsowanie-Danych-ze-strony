<?php
/**
 * The template for displaying 404 pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>

        <div class="container" data-pg-collapsed>
	        <div id="blad404">
	            <div class="row" data-pg-collapsed>
	                <div class="col-sm-8 col-md-6 col-md-push-1" data-pg-collapsed>
						<div class="error-heading">
							<h1>404</h1>					
	                    	<h2><?php _e('ZALECIAŁEŚ ZA DALEKO', 'starkers'); ?></h2>
	                    </div>
	                <div class="col-sm-11 col-sm-pull-1">
	                    <div class="heading"></div>
	                </div>
	            	</div>
	            </div>
	            <div class="row" id="rakieta">
	            	<div class="col-sm-6 col-md-push-2">
	                    <h4><button type="button" class="btn btn-default btn-lg" id="redbtn" onclick="window.location.href='<?php echo esc_url( home_url( '/' ) ); ?>'"><?php _e('Strona Główna', 'starkers'); ?> <i class="fa fa-angle-double-right"></i></button></h4>
					</div> 
	            </div>            
	      	</div>
		</div>		

<?php get_footer(); ?>