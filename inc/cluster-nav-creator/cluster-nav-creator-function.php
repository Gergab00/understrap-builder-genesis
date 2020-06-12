<?php
/**
 * Plugin Name: Cluster Navigation Creator
 * Plugin URI: https://github.com/Gergab00/
 * Description: A cluster navigation creator toolkit
 * Version: 1.0.0
 * Author: Gerardo Gonzalez
 * Author URI: https://github.com/Gergab00/
 * Text Domain: cluster-nav
 *
 * @package cluster-nav
 * @author Gerardo Gonzalez <gergab00@hotmail.com>
 * @version 1.0.0
 * @license GNU General Public License v2 or later
 */

defined('ABSPATH') || exit;

/**
 * Funcion para registrar el post type de cluster
 *
 * @package cluster-nav
 * @author Gerardo Gonzalez <gergab00@hotmail.com>
 * @version 1.0.0
 * @license GNU General Public License v2 or later
 * @since 1.0.0
 * @see https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/
 *
 */
function clusterCustomPostType() {
    register_post_type('cluster_nav',
        array(
            'labels'       => array(
                'name'          => 'Clusters',
                'singular_name' => 'Cluster',
            ),
            'descripction' => 'Create your own clusters',
            'public'       => true,
            'has_archive'  => true,
            'rewrite'      => array('slug' => 'categorias'), // my custom slug
             'add_new'      => 'Agregar Clusters',
            'add_new_item' => 'Agregar nuevo grupo de Clusters',
            'supports'     => array('title', 'thumbnail'),
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-networking',
        )
    );
}
/**
 * Funcion para agregar las metaboxes del post type
 *
 * @package cluster-nav
 * @author Gerardo Gonzalez <gergab00@hotmail.com>
 * @version 1.0.0
 * @license GNU General Public License v2 or later
 * @since 1.0.0
 * @see https://developer.wordpress.org/reference/functions/add_meta_box/
 *
 */
function clusterNavmetabox() {
    add_meta_box('meta-box-cluster_nav', 'Selecciona la categoria o subcategoria del cluster', 'clusterNavmetaboxcb', 'cluster_nav', 'normal', 'high');
}
function clusterNavmetaboxcb($post) {
    ?>

	<p>Aquí pondremos todo el contenido de nuestro metabox</p>

<?php

}
//Acciones
add_action('init', 'clusterCustomPostType');
add_action('add_meta_boxes', 'clusterNavmetabox');
