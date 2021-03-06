<?php
/**
 * Theme Behavior
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('ModelBehavior', 'Model');

/**
 * Theme Behavior
 *
 * @author Kohei Teraguchi <kteraguchi@commonsnet.org>
 * @package NetCommons\ThemeSettings\Model\Behavior
 */
class ThemeBehavior extends ModelBehavior {

/**
 * テーマリストの取得
 *
 * @param Model $model 呼び出しもとのモデル
 * @return array テーマリスト
 */
	public function getThemes(Model $model) {
		$themes = array();
		$themePath = realpath(App::themePath('')) . DS;

		$dirs = scandir($themePath, 1);

		foreach ($dirs as $path) {
			if (! is_dir($themePath . $path) ||
				! is_file($themePath . $path . DS . 'theme.json') ||
				$path === '.' || $path === '..') {

				continue;
			}

			$package = json_decode(file_get_contents($themePath . $path . DS . 'theme.json'), true);
			if (is_file(App::themePath($path) . 'webroot/snapshot.jpg')) {
				$package['snapshot'] = Router::url('/') . 'theme/' . $path . '/snapshot.jpg';
			} elseif (is_file(App::themePath($path) . 'webroot/snapshot.png')) {
				$package['snapshot'] = Router::url('/') . 'theme/' . $path . '/snapshot.png';
			} else {
				$package['snapshot'] = Router::url('/') . 'theme_settings/img/snapshot_noimage.png';
			}
			$package['key'] = $path;
			$package['name'] = __d('theme_settings', $package['name']);

			$themes[] = $package;
		}

		return Hash::sort($themes, '{n}.key', 'asc');
	}

}
