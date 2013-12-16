<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Item extends Widget
{
	public $header;
	public $body;
	public $options;

	public function run()
	{
		$class = 'item';
		$option = '';
		foreach ($this->options as $k => $v) {
			if ($k === 'class') {
				$class .= ' ' . $v;
				continue;
			}
			$option .= $k . '=' . '"' . $v . '" ';
		}

		echo '<div class="' . $class . '" ' . $option . '>';

		if ($this->header !== null) {
			echo '<div class="item-heading">', $this->header, '</div>';
		}

		echo '<div class="item-body">', $this->body, '</div>';
		echo '</div>';
	}
}