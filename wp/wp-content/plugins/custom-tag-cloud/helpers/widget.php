<?php
/*------------------------------------------------------------------------
# Custom Tag Cloud
# ------------------------------------------------------------------------
# The Krotek
# Copyright (C) 2011-2016 thekrotek.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: http://thekrotek.com
# Support: support@thekrotek.com
-------------------------------------------------------------------------*/

class CustomTagCloudWidget extends WP_Widget
{
	protected $params;
	protected $label;
	protected $basedir;
	protected $basename;	
	
	public function __construct()
	{
		global $tagcloud;
		
		$this->label = $tagcloud->get('label');
		$this->basedir = $tagcloud->get('basedir');
		$this->basename = $tagcloud->get('basename');
		
		parent::__construct($this->label, __('Custom Tag Cloud', $this->label), array('description' => __('Displays customized tag cloud.', $this->label)));
	}
	
	public function form($instance)
	{
		$this->params = !empty($instance['params']) ? $instance['params'] : array();
	
		$widget = true;

		require($this->basedir.'settings.php');
	}

	public function update($new, $old)
	{
		$instance = array();
		
		$params = $new['params'];

		foreach ($params as $name => $value) {
			$instance['params'][$name] = !empty($value) ? $value : (!is_array($value) ? '' : array());
		}

		return $instance;
	}
	
	public function widget($args, $instance)
	{
		global $tagcloud;
		
		$title = !empty($instance['params']['title']) ? esc_attr($instance['params']['title']) : __('Tags');
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $args['before_widget'];
		
		if ($title) {
			echo $args['before_title'].$title.$args['after_title'];
		}
		
		echo $tagcloud->getOutput(array('id' => $this->number, 'widget' => true));
		echo $args['after_widget'];
	}
	
	public function getOption($name, $default = "")
	{
		return isset($this->params[$name]) ? $this->params[$name] : $default;
	}
}

?>