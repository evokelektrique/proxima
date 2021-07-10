<?php

namespace Replicant\Admin;

class Panel {
   
   /**
    * Attach panel menus to hooks
    */
   public function __construct() {
      add_action( 'admin_enqueue_scripts', [&$this, 'admin_assets']);
      add_action( 'admin_menu', [&$this, "add_menus"] );
   }

   /**
    * Load dashboard menus
    */
   public static function add_menus() {
      // Filter php files inside "./menus" folder
      $files = glob(__DIR__ . "/menus/*.php");

      foreach($files as &$file) {
         if(file_exists($file)) {
            require_once $file;
         }
      }

      // Initialize Classes
      new \Replicant\Admin\Menus\MainMenu();
      new \Replicant\Admin\Menus\NodesMenu();
   }

   /**
    * Load dashboard css/js files
    */
   public static function admin_assets() {
      if ( isset( $_GET["page"] ) && ! empty( $_GET["page"] ) && strpos($_GET["page"], "replicant-") !== false  ) {
         wp_register_script( 
            "replicant_js", 
            \Replicant\Config::$ROOT_URL . "../dist/scripts.js"
         );
         wp_register_style( 
            "replicant_css", 
            \Replicant\Config::$ROOT_URL . "../dist/styles.css" 
         );
         wp_enqueue_style( "replicant_css" );
         wp_enqueue_script( "replicant_js" );
      }
   }
}
