<?php
	/****** MINECRAFT 3D Skin Generator *****
	 * The contents of this project were first developed by Pierre Gros on 17th April 2012.
	 * It has once been modified by Carlos Ferreira (http://www.carlosferreira.me) on 31st May 2014.
	 * Translations done by Carlos Ferreira.
	 * Later adapted by Gijs "Gyzie" Oortgiese (http://www.gijsoortgiese.com/). Started on the 6st of July 2014.
	 * Fixing various issues.
	 *
	 **** GET Parameters ****
	 * user - Minecraft's username for the skin to be rendered.
	 * vr - Vertical Rotation.
	 * hr - Horizontal Rotation.
	 *
	 * hrh - Horizontal Rotation of the Head.
	 *
	 * vrll - Vertical Rotation of the Left Leg.
	 * vrrl - Vertical Rotation of the Right Leg.
	 * vrla - Vertical Rotation of the Left Arm.
	 * vrra - Vertical Rotation of the Right Arm.
	 *
	 * displayHair - Either or not to display hairs. Set to "false" to NOT display hairs.
	 * headOnly - Either or not to display the ONLY the head. Set to "true" to display ONLY the head (and the hair, based on displayHair).
	 *
	 * format - The format in which the image is to be rendered. PNG ("png") is used by default set to "svg" to use a vector version.
	 * ratio - The size of the "png" image. The default and minimum value is 2.
	 * 
	 * aa - Image smooting, false by default.
	 */
 
error_reporting(E_ERROR);
/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/


require_once 'lib/img.php';
require_once 'lib/point.php';
require_once 'lib/polygon.php';
require_once 'render3dplayer.php';


/* Start Global variabal
 * These variabals are shared over multiple classes
 */
$seconds_to_cache = 60 * 60 * 24 * 7; // Cache duration sent to the browser.

// Cosine and Sine values
$cos_alpha = null;
$sin_alpha = null;
$cos_omega = null;
$sin_omega = null;

$minX = null;
$maxX = null;
$minY = null;
$maxY = null;
/* End Global variabel */

/* Function converts the old _GET names to
 * the new names. This makes it still compatable
 * with scrips using the old names.
 * 
 * Espects the English _GET name.
 * Returns the _GET value or the default value.
 * Return false if the _GET is not found.
 */
function grabGetValue($name) {
  $parameters = array('user' => array('old' => 'login', 'default' => false),
            'vr' => array('old' => 'a', 'default' => '-25'),
            'hr' => array('old' => 'w', 'default' => '35'),
            'hrh' => array('old' => 'wt', 'default' => '0'),
            'vrll' => array('old' => 'ajg', 'default' => '0'),
            'vrrl' => array('old' => 'ajd', 'default' => '0'),
            'vrla' => array('old' => 'abg', 'default' => '0'),
            'vrra' => array('old' => 'abd', 'default' => '0'),
            'displayHair' => array('old' => 'displayHairs', 'default' => 'true'),
            'headOnly' => array('old' => 'headOnly', 'default' => 'false'),
            'format' => array('old' => 'format', 'default' => 'png'),
            'ratio' => array('old' => 'ratio', 'default' => '12'),
            'aa' => array('old' => 'aa', 'default' => 'false'),
            'layers' => array('old' => 'layers', 'default' => 'true')
            );
  
  if(array_key_exists($name, $parameters)) {
    if(isset($_GET[$name])) {
      return $_GET[$name];
    } else if (isset($_GET[$parameters[$name]['old']])) {
      return $_GET[$parameters[$name]['old']];
    }
    return $parameters[$name]['default'];
  }
  
  return false;
}

// Check if the player name value has been set. If not. Do nothing.
if(grabGetValue('user') !== false) {
  // There is a player name so they want an image output via url
  $player = new render3DPlayer(	grabGetValue('user'),
                  grabGetValue('vr'),
                  grabGetValue('hr'),
                  grabGetValue('hrh'),
                  grabGetValue('vrll'),
                  grabGetValue('vrrl'),
                  grabGetValue('vrla'),
                  grabGetValue('vrra'),
                  grabGetValue('displayHair'),
                  grabGetValue('headOnly'),
                  grabGetValue('format'),
                  grabGetValue('ratio'),
                  grabGetValue('aa'),
                  grabGetValue('layers')
              );
  $player->get3DRender('browser');
}
