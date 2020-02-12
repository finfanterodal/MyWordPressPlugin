<?php
/*
Plugin Name: MyWordPressPlugin
Plugin URI:  http://link to your plugin homepage
Description: This plugin replaces words with your own choice of words.
Version:     1.0
Author:      Freddy Muriuki
Author URI:  http://link to your website
License:     GPL2 etc
License URI: https://link to your plugin license

Copyright YEAR PLUGIN_AUTHOR_NAME (email : your email address)
(Plugin Name) is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
(Plugin Name) is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with (Plugin Name). If not, see (http://link to your plugin license).
*/



//Flitro que llama a la función que le dice qué palabra debe sustituir por otra.
add_filter( 'the_content', 'renym_wordpress_typo_fix' );

//Filtro para dar un aviso si la contraseña es errónea.
add_filter( 'login_errors', 'contrasinal_olvidada' );

//Funciñon que reemplaza la primera palabra dada, por la segunda
function renym_wordpress_typo_fix( $text ) {
return str_replace( 'WordPress', 'WordPressDAM', $text );
}

//Función que lanza un aviso cuando escribimos mal nuestra contraseña
function contrasinal_olvidada(){
return 'La contraseña es incorreta ATONTADO!';
}


/*DATABASE*/

// Al activvar el plugin se crea la tabla en la base de datos y se insertan las palabras desagradables.
add_action( 'plugins_loaded', 'create_table_function' );

//Función que crea la tabla en la base de datos cuando es llamada.
function create_table_function() {
   
global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

// le añado el prefijo a la tabla
$table_name = $wpdb->prefix . 'palabras_malsonantes';

// creamos la sentencia sql

$sql = "CREATE TABLE $table_name (
palabras varchar(20) PRIMARY KEY
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}