<?php
/**
 * Template Name: Mapa Salony 2018
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
	<link rel="icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/pages/mapaTest/style_mapa_2018.css"/>
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animate.css"/>    
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/navbar.css"/>  
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/font-awesome/css/font-awesome.min.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

   	<title> <?php wp_title(); ?> </title>
	<meta name="description" content="Grupa MIG od wielu lat skutecznie wprowadza na polski rynek znane, międzynarodowe marki i sprawnie nimi zarządza. Profesjonalizm i zaangażowanie osób tworzących zespół Marketing Investment Group są źródłem sukcesu, jaki w naszym kraju odniosły między innymi Umbro, Timberland oraz Sizeer." />
	<meta name="keywords" content="Marketing Investment Group, Sizeer, Timberland, Tensport, Pro-Game, Umbro, 50 Sport" />
    <?php wp_head(); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSxppcEADIC-6N27C6JyRXmVSwvW4V8hg&v=3.exp&signed_in=false&libraries=places"></script>
      <script>

$(document).ready(function () {
    

    $("#showLocInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#showResult li").each(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


    </script>
    <style>
#showLocInput{
    color: #000;
}
#showResult{
  overflow: auto !important;
    max-height: 18rem !important;
    list-style-type: none;
    margin-top: 2rem;
    padding: 0;
    list-style-type: none;
}


#showResult > li{
    scroll-behavior: smooth;
}

#showResult > li:hover{
    cursor: pointer;
}

#showResult > li:not(:last-child){
    margin-bottom: 4rem;

}
</style>
    </head>     
    <body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    
        <header data-pg-collapsed>
            
            <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <div class="container">                
                    <div class="navbar-header page-scroll">                    
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button> 
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <span class="logo"></span>
                        </a>  
                    </div>

                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <?php
                        wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => 'false',
                        'menu_class' => 'nav navbar-nav'
                        )
                        );
                        ?>
                    </div>
                </div> 
            </nav>            

            <nav class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-md-push-9 col-sm-4 col-sm-push-8">
                        
                             <ul class="nav navbar-nav navbar-right navbar-lang">
                                <li class="dropdown">
                                    <!--<?php language_attributes(); ?>-->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php 
 $lang=get_bloginfo("language");
    if($lang=='pl-PL') { echo '<span>Wybierz język:</span> <img src="/wp-content/polylang/pl_PL.jpg" alt="polski" class="main-flag"> ' ;
       }
    elseif ($lang=='en-GB'){ 
         echo '<span>Choose Language:</span> <img src="/wp-content/polylang/en_GB.jpg" alt="english" class="main-flag"> ' ;
     }
     elseif ($lang=='cs-CZ'){ 
         echo '<span>Choose Language:</span> <img src="/wp-content/polylang/cs_CZ.jpg" alt="" class="main-flag"> ' ;
     }
     elseif ($lang=='de-DE'){ 
         echo '<span>Wählen Sie eine Sprache:</span> <img src="/wp-content/polylang/de_DE.jpg" alt="" class="main-flag"> ' ;
     }
     elseif ($lang=='lt-LT'){ 
         echo '<span>Choose Language:</span> <img src="/wp-content/polylang/lt_LT.jpg" alt="" class="main-flag"> ' ;
     }
     elseif ($lang=='sk-SK'){ 
         echo '<span>Choose Language:</span> <img src="/wp-content/polylang/sk_SK.jpg" alt="" class="main-flag"> ' ;
     }
    else { 
         echo 'Choose Language:';
     }
        
      ?>
                                                 <b class="right-caret"><img src="<?php bloginfo('template_url'); ?>/img/flag_dropDown.png" alt="język"></b></a>
                                    <ul class="dropdown-menu"><?php pll_the_languages(array('show_names'=>1,'show_flags'=>1));?>
                                    </ul>
                                </li>
                            </ul>
                        
                    </div>
                </div>

            </div>
</nav>
            <div id="banner1"> 
                <div class="jumbotron">
                    <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <h2><?php bloginfo( 'description' ); ?></h2> 
		    <h4><a href="<?php _e('/pl/o-firmie/', 'starkers'); ?>" class="circle-btn"><?php _e('Czytaj więcej', 'starkers'); ?> <i class="fa fa-angle-double-right"></i></a></h4>
                </div>
            </div>
    </header>
<?php get_template_part( 'loop', 'page' ); ?>
<?php get_sidebar(); ?>
            </div>
        </div>


    	
    <div class="container">
        <div class="row" style="position: relative">
        <div class="legend-buttons wow bounceInRight animated">        
                        <button onclick="filterMarkers(value='Symbiosis');">
                             <img src='/wp-content/themes/starkers-html5-master/img/pointer_symbiosis.png' alt="Symbiosis" class="img-responsive" >
                        </button>
                        <button onclick="filterMarkers(value='50 style');">
                            <img src='/wp-content/themes/starkers-html5-master/img/pointer_50.png' alt="50 Style" class="img-responsive">
                        </button>
                        <button onclick="filterMarkers(value='Sizeer');">
                            <img src='/wp-content/themes/starkers-html5-master/img/pointer_sizeer.png' alt="Sizeer" class="img-responsive">
                        </button>
                        <button onclick="filterMarkers(value='Timberland');">
                            <img src='/wp-content/themes/starkers-html5-master/img/pointer_timberland.png' alt="Timberland" class="img-responsive">
                        </button>
                        <button onclick="filterMarkers(value='Umbro');">
                            <img src='/wp-content/themes/starkers-html5-master/img/pointer_umbro.png' alt="Umbro" class="img-responsive">
                        </button>
                        <button onclick="filterMarkers(value='ONeill');">
                            <img src='/wp-content/themes/starkers-html5-master/img/pointer_oneill.png' alt="O'Neill" class="img-responsive">
                        </button>
                        <button onclick="filterMarkers(value='UP8');">
                            <img src='/wp-content/themes/starkers-html5-master/img/pointer_up8.png' alt="Up8" class="img-responsive">
                        </button>
                    </div>   
            <div class="col-xs-12 col-sm-6 col-md-3 legend-details">
                <div class="wow bounceInLeft">
                    <h4><?php _e('SZUKAJ SKLEPU:', 'starkers'); ?></h4>
                    <input id="showLocInput" type="text" placeholder="<?php _e('miasto, ulica', 'starkers'); ?>">
                    <ul id="showResult"></ul>
                    <div class="showLocResult"></div>
                    <!-- <h4><?php _e('Wybierz salon:', 'starkers'); ?></h4> -->

                          
                </div>
            </div>
        </div>
    </div>

    <div id="map-canvas">


    </div>
  
<script src="<?php bloginfo('template_url'); ?>/pages/mapaTest/<?php 
 $lang=get_bloginfo("language");
    if($lang=='pl-PL') { echo 'shopsMaps_PL.js' ;
       }
    elseif ($lang=='en-GB'){ 
         echo 'map_TESTwersja2_EN.js' ;
     }
     elseif ($lang=='de-DE'){ 
         echo 'map_TESTwersja2_DE.js' ;
     }
    else { 
         echo 'map_TESTwersja2.js';
     } ?>"></script>



<?php get_footer(); ?>


