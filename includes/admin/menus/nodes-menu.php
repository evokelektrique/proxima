<?php

namespace Replicant\Admin\Menus;

class NodesMenu {

   public function __construct() {
      add_submenu_page( 
         "replicant-settings",
         __( "Nodes", "replicant" ),
         __( "Nodes", "replicant" ),
         "manage_options",
         "replicant-nodes",
         [&$this, "handle"]
      );
   }  
   
   public static function handle() {
      $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
      $id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

      switch ($action) {
          case 'view':

              $template = \Replicant\Config::$ROOT_DIR . "admin/layout/nodes/single.php";
              break;

          case 'edit':
              $template = \Replicant\Config::$ROOT_DIR . "admin/layout/nodes/edit.php";
              break;

          case 'new':
              $template = \Replicant\Config::$ROOT_DIR . "admin/layout/nodes/new.php";
              break;

          default:
              $template = \Replicant\Config::$ROOT_DIR . "admin/layout/nodes/list.php";
              break;
      }

      if ( file_exists( $template ) ) {
          require_once $template;
      }
   }
}