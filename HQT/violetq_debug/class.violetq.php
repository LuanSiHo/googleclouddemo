<?php
/**
* violetq: Structured information display solution
*
* violetq is a debugging tool (PHP5 only), which displays structured information 
* about any PHP variable. It is a nice replacement for print_r() or var_dump() 
* which are used by a lot of PHP developers. 
*
* @author Kaloyan K. Tsvetkov <kaloyan@kaloyan.info>
* @license http://opensource.org/licenses/lgpl-license.php GNU Lesser General Public License Version 2.1
*
* @package violetq
* @version $Id: class.violetq.php 22 2007-12-02 07:38:18Z Mrasnika $
*/

//////////////////////////////////////////////////////////////////////////////

/**
* backward compatibility: the DIR_SEP constant isn't used anymore
*/
if(!defined('DIR_SEP')) {
	define('DIR_SEP', DIRECTORY_SEPARATOR);
	}
/**
* backward compatibility: the PATH_SEPARATOR constant is availble since 4.3.0RC2
*/
if (!defined('PATH_SEPARATOR')) {
	define('PATH_SEPARATOR', OS_WINDOWS ? ';' : ':');
        }

// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

/**
* Set the violetq_DIR constant up with the absolute path to violetq files. If it is 
* not defined, include_path will be used. Set violetq_DIR only if any other module 
* or application has not already set it up.
*/
if (!defined('violetq_DIR')) {
	define('violetq_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);
	}

/**
* This constant sets the maximum strings of strings that will be shown 
* as they are. Longer strings will be truncated with this length, and 
* their `full form` will be shown in a child node.
*/
if (!defined('violetq_TRUNCATE_LENGTH')) {
	define('violetq_TRUNCATE_LENGTH', 50);
	}

//////////////////////////////////////////////////////////////////////////////

/**
* violetq API
*
* This class stores the violetq API for rendering and
* displaying the structured information it is reporting
*
* @package violetq
*/
Class violetq {

	/**
	* Return violetq version
	*
	* @return string
	* @access public
	* @static
	*/
	Public Static Function version() {
		return '0.2.1a';
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
	
	/**
	* Prints a debug backtrace
	*
	* @access public
	* @static
	*/
	Public Static Function backtrace() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		return violetq::dump(debug_backtrace());
		}
	
	/**
	* Prints a list of all currently declared classes.
	*
	* @access public
	* @static
	*/
	Public Static Function classes() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all currently declared classes.
</div>
		<?php
		return violetq::dump(get_declared_classes());
		}
		
	/**
	* Prints a list of all currently declared interfaces (PHP5 only).
	*
	* @access public
	* @static
	*/
	Public Static Function interfaces() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all currently declared interfaces.
</div>
		<?php
		return violetq::dump(get_declared_interfaces());
		}

	/**
	* Prints a list of all currently included (or required) files.
	*
	* @access public
	* @static
	*/
	Public Static Function includes() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all currently included (or required) files.
</div>
		<?php
		return violetq::dump(get_included_files());
		}
		
	/**
	* Prints a list of all currently declared functions.
	*
	* @access public
	* @static
	*/
	Public Static Function functions() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all currently declared functions.
</div>
		<?php
		return violetq::dump(get_defined_functions());
		}
		
	/**
	* Prints a list of all currently declared constants.
	*
	* @access public
	* @static
	*/
	Public Static Function defines() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all currently declared constants (defines).
</div>
		<?php
		return violetq::dump(get_defined_constants());
		}
		
	/**
	* Prints a list of all currently loaded PHP extensions.
	*
	* @access public
	* @static
	*/
	Public Static Function extensions() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all currently loaded PHP extensions.
</div>
		<?php
		return violetq::dump(get_loaded_extensions());
		}

	/**
	* Prints a list of all HTTP request headers.
	*
	* @access public
	* @static
	*/
	Public Static Function headers() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all HTTP request headers.
</div>
		<?php
		return violetq::dump(getAllHeaders());
		}

	/**
	* Prints a list of the configuration settings read from <i>php.ini</i>
	*
	* @access public
	* @static
	*/
	Public Static Function phpini() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		if (!readable(get_cfg_var('cfg_file_path'))) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of the configuration settings read from <code><b><?php echo get_cfg_var('cfg_file_path');?></b></code>.
</div>
		<?php
		return violetq::dump(parse_ini_file(get_cfg_var('cfg_file_path'), true));
		}
		
	/**
	* Prints a list of all your configuration settings.
	*
	* @access public
	* @static
	*/
	Public Static Function conf() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all your configuration settings.
</div>
		<?php
		return violetq::dump(ini_get_all());
		}

	/**
	* Prints a list of the specified directories under your <i>include_path</i> option.
	*
	* @access public
	* @static
	*/
	Public Static Function path() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of the specified directories under your <code><b>include_path</b></code> option.
</div>
		<?php
		return violetq::dump(explode(PATH_SEPARATOR, ini_get('include_path')));
		}

	/**
	* Prints a list of all the values from the <i>$_REQUEST</i> array.
	*
	* @access public
	* @static
	*/
	Public Static Function request() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b>$_REQUEST</b></code> array.
</div>
		<?php
		return violetq::dump($_REQUEST);
		}

	/**
	* Prints a list of all the values from the <i>$_GET</i> array.
	*
	* @access public
	* @static
	*/
	Public Static Function get() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b>$_GET</b></code> array.
</div>
		<?php
		return violetq::dump($_GET);
		}

	/**
	* Prints a list of all the values from the <i>$_POST</i> array.
	*
	* @access public
	* @static
	*/
	Public Static Function post() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b>$_POST</b></code> array.
</div>
		<?php
		return violetq::dump($_POST);
		}

	/**
	* Prints a list of all the values from the <i>$_SERVER</i> array.
	*
	* @access public
	* @static
	*/
	Public Static Function server() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b>$_SERVER</b></code> array.
</div>
		<?php
		return violetq::dump($_SERVER);
		}

	/**
	* Prints a list of all the values from the <i>$_COOKIE</i> array.
	*
	* @access public
	* @static
	*/
	Public Static Function cookie() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b>$_COOKIE</b></code> array.
</div>
		<?php
		return violetq::dump($_COOKIE);
		}

	/**
	* Prints a list of all the values from the <i>$_ENV</i> array.
	*
	* @access public
	* @static
	*/
	Public Static Function env() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b>$_ENV</b></code> array.
</div>
		<?php
		return violetq::dump($_ENV);
		}

	/**
	* Prints a list of all the values from the <i>$_SESSION</i> array.
	*
	* @access public
	* @static
	*/
	Public Static Function session() {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b>$_SESSION</b></code> array.
</div>
		<?php
		return violetq::dump($_SESSION);
		}

	/**
	* Prints a list of all the values from an INI file.
	*
	* @param string $ini_file
	*
	* @access public
	* @static
	*/
	Public Static Function ini($ini_file) {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// read it
		//
		if (!$_ = @parse_ini_file($ini_file, 1)) {
			return false;
			}

		// render it
		//
		?>
<div class="violetq-title">
This is a list of all the values from the <code><b><?php echo realpath($ini_file) ? realpath($ini_file) : $ini_file;?></b></code> INI file.
</div>
		<?php
		return violetq::dump($_);
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Dump information about a variable
	*
	* @param mixed $data,...
	* @access public
	* @static
	*/
	Public Static Function dump($data) {

		// disabled ?
		//
		if (!violetq::_debug()) {
			return false;
			}

		// more arguments ?
		//
		if (func_num_args() > 1) {
			$_ = func_get_args();
			foreach($_ as $d) {
				violetq::dump($d);
				}
			return;
			}
		
		// the css ?
		//
		violetq::_css();

		// find caller
		//
		$_ = debug_backtrace();
		while($d = array_pop($_)) {
			if ((strToLower($d['function']) == 'violetq') || (strToLower(@$d['class']) == 'violetq')) {
				break;
				}
			}

		// the content
		//
		?>
<div class="violetq-root">
	<ul class="violetq-node violetq-first">
		<?php echo violetq::_dump($data);?>
		<li class="violetq-footnote">
			<div class="violetq-version" style="white-space:nowrap;">
				<h6>violetq</h6> | <a
					href="QUANNGUYEN"
					target="_blank">QUANNGUYEN</a>
			</div>
		
		<?php if (@$d['file']) { ?>
		<span class="violetq-call" style="white-space:nowrap;">
			Called from <code><?php echo $d['file']?></code>,
				line <code><?php echo $d['line']?></code></span>
		<?php } ?>
		&nbsp;
		</li>
	</ul>
</div>
<?php
		// flee the hive
		//
		$_recursion_marker = violetq::_marker();
		if ($hive =& violetq::_hive($dummy)) {
			foreach($hive as $i=>$bee){
				if (is_object($bee)) {
					unset($hive[$i]->$_recursion_marker);
					} else {
					unset($hive[$i][$_recursion_marker]);
					}
				}
			}

		// PHP 4.x.x array reference bug...
		//
		if (is_array($data) && version_compare(PHP_VERSION, "5", "<")) {
			unset($GLOBALS[violetq::_marker()]); 
			}
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Returns values from violetq's configuration
	*
	* @param string $group
	* @param string $name
	* @param mixed $fallback
	* @return mixed
	*
	* @access private
	* @static
	*/
	Private Static Function _config($group, $name, $fallback=null) {
		
		static $_config = array();
		
		// not loaded ?
		//
		if (empty($_config)) {
			$_config = (array) @parse_ini_file(
				violetq_DIR . 'violetq.ini',
				true);
			}
		
		// exists ?
		//
		return (isset($_config[$group][$name]))
			? $_config[$group][$name]
			: $fallback;
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Print the skin (CSS)
	*
	* @return boolean
	* @access private
	* @static
	*/
	Private Static Function _css() {
		
		static $_css = false;
		
		// already set ?
		//
		if ($_css) {
			return true;
			}
		
		$css = '';
		$skin = violetq::_config('skin', 'selected', 'default');
		
		// custom selected skin ?
		//
		$_ = violetq_DIR . "skins/{$skin}/skin.css";
		if ($fp = @fopen($_, 'r', 1)) {
			$css = fread($fp, filesize($_));
			fclose($fp);
			}
		
		// defautl skin ?
		//
		if (!$css && ($skin != 'default')) {
			$skin = 'default';
			$_ = violetq_DIR . "skins/default/skin.css";
			$css = join('', @file($_));
			}
		
		// print ?
		//
		if ($_css = $css != '') {
			
			// fix the urls
			//
			$css_url = violetq::_config('css', 'url') . "skins/{$skin}/";
			$css = preg_replace('~%url%~Uis', $css_url, $css);
			
			// the CSS
			//
			?>
<!-- Using violetq Skin: <?php echo preg_replace('~^' . preg_quote(realpath(violetq_DIR) . DIRECTORY_SEPARATOR) . '~Uis', '', realpath($_));?> -->
<style type="text/css">
<!--/**/
<?php echo $css?>

/**/-->
</style>
<?php
			// the JS 
			//
			?>
<script type="text/javascript">
<!--//
<?php echo join(file(violetq_DIR . "violetq.js"));?>

//-->
</script>
<?php
			}
		
		return $_css;
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Enable violetq
	*
	* @return boolean
	* @access public
	* @static
	*/
	Public Static Function enable() {
		return true === violetq::_debug(true);
		}

	/**
	* Disable violetq
	*
	* @return boolean
	* @access public
	* @static
	*/
	Public Static Function disable() {
		return false === violetq::_debug(false);
		}
	
	/**
	* Get\Set violetq state: whether it is enabled or disabled
	*
	* @param boolean $state
	* @return boolean
	* @access private
	* @static
	*/
	Private Static Function _debug($state=null) {
		
		static $_ = true;
		
		// set
		//
		if (isset($state)) {
			$_ = (boolean) $state;
			}
		
		// get
		//
		return $_;
		}
	
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Dump information about a variable
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _dump(&$data, $name='...') {

		// object ?
		//
		if (is_object($data)) {
			return violetq::_object($data, $name);
			}

		// array ?
		//
		if (is_array($data)) {

			// PHP 4.x.x array reference bug...
			//
			if (version_compare(PHP_VERSION, "5", "<")) {

				// prepare the GLOBAL reference list...
				//
				if (!isset($GLOBALS[violetq::_marker()])) {
					$GLOBALS[violetq::_marker()] = array();
					}
				if (!is_array($GLOBALS[violetq::_marker()])) {
					$GLOBALS[violetq::_marker()] = (array) $GLOBALS[violetq::_marker()];
					}
				
				// extract ?
				//
				if (!empty($GLOBALS[violetq::_marker()])) {
					$d = array_shift($GLOBALS[violetq::_marker()]);
					if (is_array($d)) {
						$data = $d;
						}
					}
				}

			return violetq::_array($data, $name);
			}

		// resource ?
		//
		if (is_resource($data)) {
			return violetq::_resource($data, $name);
			}
		
		// scalar ?
		//
		if (is_string($data)) {
			return violetq::_string($data, $name);
			}
		
		if (is_float($data)) {
			return violetq::_float($data, $name);
			}

		if (is_integer($data)) {
			return violetq::_integer($data, $name);
			}

		if (is_bool($data)) {
			return violetq::_boolean($data, $name);
			}
		
		// null ?
		//
		if (is_null($data)) {
			return violetq::_null($name);
			}
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for a NULL value
	*
	* @param string $name
	* @return string
	* @access private
	* @static
	*/
	Private Static Function _null($name) {
?>
<li class="violetq-child">
	<div class="violetq-element"
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">
		
			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type violetq-null">NULL</em>) 
	</div>
</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
	
	/**
	* Return the marked used to stain arrays
	* and objects in order to detect recursions
	*
	* @return string
	* @access private
	* @static
	*/
	Private Static Function _marker() {
		
		static $_recursion_marker;
		if (!isset($_recursion_marker)) {
			$_recursion_marker = uniqid('violetq');
			}
		
		return $_recursion_marker;
		}
	
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
	
	/**
	* Adds a variable to the hive of arrays and objects which 
	* are tracked for whether they have recursive entries
	*
	* @param mixed &$bee either array or object, not a scallar vale
	* @return array all the bees
	*
	* @access private
	* @static
	*/
	Private Static Function &_hive(&$bee) {
		
		static $_ = array();

		// new bee ?
		//
		if (!is_null($bee)) {
			
			// stain it
			//
			$_recursion_marker = violetq::_marker();
			(is_object($bee))
				? @($bee->$_recursion_marker++)
				: @($bee[$_recursion_marker]++);
			
			$_[0][] =& $bee;
			}

		// return all bees
		//
		return $_[0];
		}
	
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for the properties of an array or objeect
	*
	* @param mixed &$data
	* @access private
	* @static
	*/
	Private Static Function _vars(&$data) {

		$_is_object = is_object($data);
		
		// test for references in order to
		// prevent endless recursion loops
		//
		$_recursion_marker = violetq::_marker();
		$_r = ($_is_object)
			? @$data->$_recursion_marker
			: @$data[$_recursion_marker] ;
		$_r = (integer) $_r;

		// recursion detected
		//
		if ($_r > 0) {
			return violetq::_recursion();
			}

		// stain it
		//
		violetq::_hive($data);

		// render it
		//
		?>
<div class="violetq-nest" style="display:none;">
	<ul class="violetq-node">
	<?php

	// keys ?
	//
	$keys = ($_is_object)
		? array_keys(get_object_vars($data))
		: array_keys($data);
	
	// itterate 
	//
	foreach($keys as $k) {

		// skip marker
		//
		if ($k === $_recursion_marker) {
			continue;
			}
		
		// get real value
		//
		if ($_is_object) {
			$v =& $data->$k;
			} else {
			$v =& $data[$k];
			}

		violetq::_dump($v,$k);
		} ?>
	</ul>
</div>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
	
	/**
	* Render a block that detected recursion
	*
	* @access private
	* @static
	*/
	Private Static Function _recursion() {
?>
<div class="violetq-nest" style="display:none;">
	<ul class="violetq-node">
		<li class="violetq-child">
			<div class="violetq-element"
				onMouseOver="violetq.over(this);"
				onMouseOut="violetq.out(this);">
					<a class="violetq-name"><big>&#8734;</big></a>
					(<em class="violetq-type">Recursion</em>) 
			</div>
		
		</li>
	</ul>
</div>
<?php
		}
	
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for an array
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _array(&$data, $name) {
?>
<li class="violetq-child">
	
	<div class="violetq-element<?php echo count($data) > 0 ? ' violetq-expand' : '';?>"
		<?php if (count($data) > 0) {?> onClick="violetq.toggle(this);"<?php } ?>
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">
		
			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type">Array, <strong class="violetq-array-length"><?php echo 
				(count($data)==1)
					?("1 element")
					:(count($data)." elements");
				?></strong></em>) 
			
				
			<?php
			// callback ?
			//
			if (is_callable($data)) {
				$_ = array_values($data);
				?>
				<span class="violetq-callback"> |
					(<em class="violetq-type">Callback</em>)
					<strong class="violetq-string"><?php
						echo htmlSpecialChars($_[0]);?>::<?php
						echo htmlSpecialChars($_[1]);?>();</strong></span>
				<?php
				}
			?>
				
	</div>

	<?php if (count($data)) {
		violetq::_vars($data);
		} ?>
</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for an object
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _object(&$data, $name) {
?>
<li class="violetq-child">

	<div class="violetq-element<?php echo count($data) > 0 ? ' violetq-expand' : '';?>"
		<?php if (count($data) > 0) {?> onClick="violetq.toggle(this);"<?php } ?>
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">

			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type">Object</em>) 
			<strong class="violetq-class"><?php echo get_class($data);?></strong>
	</div>

	<?php if (count($data)) {
		violetq::_vars($data);
		} ?>
</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for a resource
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _resource($data, $name) {
?>
<li class="violetq-child">

	<div class="violetq-element"
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">
		
			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type">Resource</em>) 
			<strong class="violetq-resource"><?php echo get_resource_type($data);?></strong>
	</div>

</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for a boolean value
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _boolean($data, $name) {
?>
<li class="violetq-child">

	<div class="violetq-element"
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">
		
			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type">Boolean</em>) 
			<strong class="violetq-boolean"><?php echo $data?'TRUE':'FALSE'?></strong>
	</div>

</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for a integer value
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _integer($data, $name) {
?>
<li class="violetq-child">

	<div class="violetq-element"
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">
		
			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type">Integer</em>)
			<strong class="violetq-integer"><?php echo $data;?></strong> 
	</div>

</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for a float value
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _float($data, $name) {
?>
<li class="violetq-child">

	<div class="violetq-element"
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">
		
			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type">Float</em>) 
			<strong class="violetq-float"><?php echo $data;?></strong>
	</div>

</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	/**
	* Render a dump for a string value
	*
	* @param mixed $data
	* @param string $name
	* @access private
	* @static
	*/
	Private Static Function _string($data, $name) {

		// extra ?
		//
		$_extra = false;
		$_ = $data;
		if (strLen($data) > violetq_TRUNCATE_LENGTH) {
			$_ = substr($data, 0, violetq_TRUNCATE_LENGTH - 3) . '...';
			$_extra = true;
			}
?>
<li class="violetq-child">

	<div class="violetq-element<?php echo $_extra ? ' violetq-expand' : '';?>"
		<?php if ($_extra) {?> onClick="violetq.toggle(this);"<?php } ?>
		onMouseOver="violetq.over(this);"
		onMouseOut="violetq.out(this);">

			<a class="violetq-name"><?php echo $name;?></a>
			(<em class="violetq-type">String,
				<strong class="violetq-string-length"><?php
					echo strlen($data) ?> characters</strong> </em>)
			<strong class="violetq-string"><?php echo htmlSpecialChars($_);?></strong>
			
			<?php
			// callback ?
			//
			if (is_callable($data)) {
				?>
				<span class="violetq-callback"> |
					(<em class="violetq-type">Callback</em>)
					<strong class="violetq-string"><?php echo htmlSpecialChars($_);?>();</strong></span>
				<?php
				}
			?>
			
	</div>
	
	<?php if ($_extra) { ?>
	<div class="violetq-nest" style="display:none;">
		<ul class="violetq-node">
			
			<li class="violetq-child">
				<div class="violetq-preview"><?php echo htmlSpecialChars($data);?></div>
			</li>
			
		</ul>
	</div>
	<?php } ?>
</li>
<?php
		}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

//--end-of-class--	
}

//////////////////////////////////////////////////////////////////////////////

/**
* Alias of {@link violetq::dump()}
*
* @param mixed $data,...
*
* @see violetq::dump()
*/
Function violetq() {
	$_ = func_get_args();
	return call_user_func_array(
		array('violetq', 'dump'), $_
		);
	}

//////////////////////////////////////////////////////////////////////////////


	function url(){
		return sprintf(
			"%s://%s%s",
			isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
			$_SERVER['SERVER_NAME'],
			$_SERVER['REQUEST_URI']
			);
	}

	function base_path($path = ''){
		$array = explode('/', $_SERVER['REQUEST_URI']);
		return '/' . $array['1'] . '/' . $path;
	}

?>