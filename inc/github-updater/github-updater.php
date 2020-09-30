<?php
/**
 * GitHub Updater
 *
 * @author  Andy Fragen
 * @license GPL-2.0+
 * @link    https://github.com/afragen/github-updater
 * @package github-updater
 */

namespace Fragen\GitHub_Updater;

/*
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Load the Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

// Check for composer autoloader.
if ( ! class_exists( 'Fragen\GitHub_Updater\Bootstrap' ) ) {
	require_once __DIR__ . '/src/GitHub_Updater/Bootstrap.php';
	( new Bootstrap( __FILE__ ) )->deactivate_die();
}

( new Bootstrap( __FILE__ ) )->run();