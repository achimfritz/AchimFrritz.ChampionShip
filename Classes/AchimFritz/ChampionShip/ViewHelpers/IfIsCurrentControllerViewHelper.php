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
use AchimFritz\ChampionShip\Domain\Model\Round;
use AchimFritz\ChampionShip\Domain\Model\KoRound;


/**
 * 
 * Enter description here ...
 * @author af
 *
 */
class IfIsCurrentControllerViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractConditionViewHelper {
	
	/**
	 * Renders <f:then> child if match is groupMatch is true, otherwise renders <f:else> child.
	 *
	 * @param string $controllerName
	 * @return string the rendered string
	 */
	public function render($controllerName) {
		$requestControllerName = $this->controllerContext->getRequest()->getControllerName();
		if ($requestControllerName == $controllerName) {
			return $this->renderThenChild();
		} else {
			if ($controllerName == 'GroupRound' AND $requestControllerName == 'GroupRoundMatch') {
				return $this->renderThenChild();
			}
			if ($controllerName == 'KoRound' AND $requestControllerName == 'CrossGroupMatch') {
				return $this->renderThenChild();
			}
			if ($controllerName == 'KoRound' AND $requestControllerName == 'TeamsOfTwoMatchesMatch') {
				return $this->renderThenChild();
			}
			return $this->renderElseChild();
		}
	}
}

?>