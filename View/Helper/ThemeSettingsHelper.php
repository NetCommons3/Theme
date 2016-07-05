<?php
/**
 * ThemeSettingsヘルパー
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * ThemeSettingsヘルパー
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\ThemeSettings\View\Helper
 */
class ThemeSettingsHelper extends AppHelper {

/**
 * 使用するヘルパー
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.NetCommonsHtml',
	);

/**
 * Before render callback. beforeRender is called before the view file is rendered.
 *
 * Overridden in subclasses.
 *
 * @param string $viewFile The view file that is going to be rendered
 * @return void
 */
	public function beforeRender($viewFile) {
		$this->NetCommonsHtml->css(array(
			'/theme_settings/css/style.css'
		));
		parent::beforeRender($viewFile);
	}

/**
 * テーマ設定のレンダー
 *
 * @param string $callback callbackのパス
 * @return string HTML
 */
	public function render($callback) {
		return $this->_View->element(
			'ThemeSettings.render_index', ['callback' => $callback, 'activeTheme' => $this->_View->theme]
		);
	}

}
