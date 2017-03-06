<?php
/**
 * Plugin Name: Custom Tag Cloud
 * Plugin URI:  http://thekrotek.com/wordpress-extensions/miscellaneous
 * Description: Customizable widget and shortcode to display tag cloud anywhere you want.
 * Version:     1.0.0
 * Author:      The Krotek
 * Author URI:  http://thekrotek.com
 * Text Domain: tagcloud 
 * License:     GPL2
 */
 
defined("ABSPATH") or die("Restricted access");

$tagcloud = new CustomTagCloud();
    
class CustomTagCloud
{		
	protected $label = 'tagcloud';
	protected $basedir;
	protected $basename;
	protected $params;
	protected $debug = false;
			
	public function __construct()
	{
		add_action('init', array($this, 'init'));

		$this->basedir = plugin_dir_path(__FILE__);
		$this->basename = plugin_basename(__FILE__);
		
		require_once('helpers/widget.php');
		
		add_action('widgets_init', function () { register_widget('CustomTagCloudWidget'); });
		
		add_shortcode($this->label, array($this, 'getOutput'));
		
		if ($this->debug) {
			ini_set('error_reporting', E_ALL);
			ini_set("display_errors", 1);
		}		
	}
	
	public function init()
	{
		add_action('admin_enqueue_scripts', array($this, 'loadAdminScripts'));		
		
		add_filter('plugin_row_meta', array($this, 'updatePluginMeta'), 10, 2);
		add_filter('sidebars_widgets', array($this, 'filterWidgets'), 10, 1);
		
		load_plugin_textdomain($this->label, false, dirname($this->basename).'/languages');
	}
	
    public function loadAdminScripts($hook)
    {
    	if ($hook == 'widgets.php') {
			wp_enqueue_style($this->label, plugins_url('', __FILE__).'/assets/admin.css'.($this->debug ? '?v='.time() : ''), array(), null);
		}
	}
	
	public function filterWidgets($sidebars)
	{
		if (!is_admin()) {
			$options = get_option('widget_'.$this->label);
		
			foreach ($sidebars as $sidebar => $widgets) {
				if (!empty($widgets) && is_array($widgets)) {
					foreach ($widgets as $key => $widget) {
						if (preg_match('/^'.$this->label.'-/', $widget)) {
							$number = str_replace($this->label.'-', '', $widget);
						
							if (!empty($options[$number]) && !empty($options[$number]['params'])) {
								if ($options[$number]['params']['mode'] == 'shortcode') {
									unset($sidebars[$sidebar][$key]);
								}
							}							
						}
					}
				}
			}
		}
		
		return $sidebars;
	}
				
	public function getOutput($args)
	{
		$output = "";
		
		$options = get_option('widget_'.$this->label);
		
		if (empty($args['widget'])) $args['widget'] = false;
		
		if (!empty($args['id'])) {
			if (!empty($options[$args['id']]) && !empty($options[$args['id']]['params'])) {
				$this->params = $options[$args['id']]['params'];

				if ($args['widget'] || ($this->params['mode'] != 'widget')) {	
					$tags = $this->getOption('tags', '');
					$action = $this->getOption('action', 'exclude');
					$taxonomy = $this->getOption('taxonomy', 'post_tag');
		
					$ids = array();
		
					if (!empty($tags)) {
						$terms = array_map('trim', explode(',', $tags));
			
						foreach ($terms as $term) {
							$ids[] = get_term_by('name', $term, $taxonomy)->term_id;
						}
					}
		
					$params = array(
						'taxonomy' => $taxonomy,
						'number' => $this->getOption('number', '45'),
						'separator' => $this->getOption('separator', ' '),
						'smallest' => $this->getOption('smallest', '8'),
						'largest' => $this->getOption('largest', '22'),
						'unit' => $this->getOption('unit', 'pt'),
						'format' => $this->getOption('format', 'flat'),
						'orderby' => $this->getOption('orderby', 'name'),
						'order' => $this->getOption('order', 'ASC'),
						'exclude' => ($action == 'exclude' ? implode(',', $ids) : ''),
						'include' => ($action == 'include' ? implode(',', $ids) : ''),
						'echo' => false);

					$output = "<div class='custom-tagcloud'>".wp_tag_cloud($params)."</div>";
				}
			} else {
				$output = __('heading', $this->label).": ".__('error_params', $this->label);
			}
		} else {
			$output = __('heading', $this->label).": ".__('error_id', $this->label);
		}
		
		return $output;
    }
		    
	public function updatePluginMeta($links, $file)
	{
		if ($file == $this->basename) {
			$links = array_merge($links, array('<a href="widgets.php">'.__('Settings', $this->label).'</a>'));
			$links = array_merge($links, array('<a href="https://thekrotek.com/support">'.__('Donate & Support', $this->label).'</a>'));
		}
	
		return $links;
	}
	
	public function getOption($name, $default = "")
	{
		return isset($this->params[$name]) ? $this->params[$name] : $default;
	}
	
    public function get($variable)
    {
        return $this->{$variable};
    }	
} 

?>
