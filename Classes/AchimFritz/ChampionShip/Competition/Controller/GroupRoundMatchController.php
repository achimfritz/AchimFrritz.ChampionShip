<?php
namespace AchimFritz\ChampionShip\Competition\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use \AchimFritz\ChampionShip\Competition\Domain\Model\GroupMatch;

/**
 * Match controller for the AchimFritz.ChampionShip package 
 *
 * @Flow\Scope("singleton")
 */
class GroupRoundMatchController extends GroupMatchController {
		
	/**
	 * Adds the given new match object to the cup repository
	 *
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\GroupMatch $match
	 * @return void
	 */
	public function createAction(GroupMatch $match) {
		$this->createMatch($match);
		$this->redirect('index', NULL, NULL, array('match' => $match, 'cup' => $match->getCup()));
	}

	/**
	 * deleteAction
	 *
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\GroupMatch $match
	 * @return void
	 */
	public function deleteAction(GroupMatch $match) {
		$this->deleteMatch($match);
		$this->redirect('index', 'GroupRound', NULL, array('round' => $match->getRound(), 'cup' => $match->getCup()));
	}

	/**
	 * updateAction
	 *
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\GroupMatch $match
	 * @return void
	 */
	public function updateAction(GroupMatch $match) {
		$this->updateMatch($match);
		$this->redirect('index', NULL, NULL, array('match' => $match, 'cup' => $match->getCup()));
	}
}

?>
