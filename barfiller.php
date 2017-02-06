<?php
/*
Plugin Name: bar filler
Plugin URI:
Description: Simaple shortcode
Author: Apurba Podder
Version: 1.6
Author URI: http://apurba.me
*/



  add_action( 'wp_enqueue_scripts', 'enqueue_script' );
  add_shortcode('ap-barfiller','barfiller_callback');
  add_action( 'vc_before_init', 'barfiler_addon_callback' );


  function enqueue_script(){
    wp_enqueue_script( 'barfiler-js', plugin_dir_url(__FILE__).'js/jquery.barfiller.js', array('jquery'),  false,  true );
    wp_enqueue_script( 'plugins-js', plugin_dir_url(__FILE__).'js/plugin.js', array('jquery','barfiler-js'),  false,  true );
    wp_enqueue_style('barfiller-style',plugin_dir_url(__FILE__).'css/style.css');

  }


  function barfiller_callback ($atts){

   $atts = shortcode_atts(array(

        'title'=> 'undefined',
        'color' => '#000',
        'duration'=> 500,
        'tooltip' => false,
        'parcent' => 50

    ),$atts);

    ob_start();

    ?>
    <div class="barfill-container" data-options='{"barColor":"<?php echo $atts['color']; ?>","duration":"<?php echo $atts['duration']; ?>","tooltip":"<?php echo $atts['tooltip']; ?>"}'>
      <h3><?php echo $atts['title']; ?></h3>

      <div id="bar" class="barfiller" >
        <div class="tipWrap">
          <span class="tip"></span>
        </div>
        <span class="fill" data-percentage="<?php echo $atts['parcent']; ?>"></span>
      </div>

    </div>


    <?php

    $output = ob_get_clean();
    return $output;
  }

?>

  <?php
function barfiler_addon_callback() {
  vc_map( array(
      "name" => __( "barfiller", "my-text-domain" ),
      "base" => "ap-barfiller",
      "class" => "",
      "category" => __( "Content", "my-text-domain"),
      "params" => array(
          array(
              "type" => "textfield",
              "heading" => __( "Barfiller Title", "my-text-domain" ),
              "param_name" => "title",
          ),
          array(
              "type" => "colorpicker",
              "heading" => __( "Barfiller Color", "my-text-domain" ),
              "param_name" => "color"
          ),
          array(
              "type" => "textfield",
              "heading" => __( "Barfiller Duration", "my-text-domain" ),
              "param_name" => "duration"
          ),
          array(
              "type" => "checkbox",
              "heading" => __( "Barfiller Tooltip", "my-text-domain" ),
              "param_name" => "tooltip"
          ),

          array(
              "type" => "textfield",
              "heading" => __( "Data Parentage", "my-text-domain" ),
              "param_name" => "parcent"
          ),


      )
  ) );
}
?>
