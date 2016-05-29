<?php
namespace AchimFritz\ChampionShip\ViewHelpers;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Fluid".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Reflection\ClassReflection;

/**
 * 
 * Enter description here ...
 * @author af
 *
 */
class TipCupPolicyOptionsViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	
	/**
	 * NOTE: This property has been introduced via code migration to ensure backwards-compatibility.
	 * @see AbstractViewHelper::isOutputEscapingEnabled()
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;

	/**
	 * render
	 *
	 * workaround for http://lists.typo3.org/pipermail/typo3-project-typo3v4mvc/2011-May/009509.html
	 * @param string $prefix
	 * @return array
	 */
	public function render($prefix) {
		$classReflection = new ClassReflection('AchimFritz\ChampionShip\Tip\Domain\Model\TipCup');
		$constants = $classReflection->getConstants();
		$options = array();
		foreach ($constants AS $name => $val) {
			if (strpos($name, $prefix) !== FALSE) {
				$name = str_replace($prefix . '_', '', $name);
				$options[$val] = $name;
			}
		}
		return $options;
	}
}

?>