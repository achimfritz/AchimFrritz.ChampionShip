<?php
namespace AchimFritz\ChampionShip\Competition\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use \AchimFritz\ChampionShip\Competition\Domain\Model\TeamsOfTwoMatchesMatch;

/**
 * Match controller for the AchimFritz.ChampionShip package 
 *
 * @Flow\Scope("singleton")
 */
class TeamsOfTwoMatchesMatchController extends KoMatchController {
		
	/**
	 * Adds the given new match object to the cup repository
	 *
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\TeamsOfTwoMatchesMatch $match
	 * @return void
	 */
	public function createAction(TeamsOfTwoMatchesMatch $match) {
		$this->createMatch($match);
		$this->redirect('index', NULL, NULL, array('match' => $match, 'cup' => $match->getCup()));
	}

	/**
	 * deleteAction
	 *
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\TeamsOfTwoMatchesMatch $match
	 * @return void
	 */
	public function deleteAction(TeamsOfTwoMatchesMatch $match) {
		$this->deleteMatch($match);
		$this->redirect('index', 'KoRound', NULL, array('round' => $match->getRound(), 'cup' => $match->getCup()));
	}

	/**
	 * updateAction
	 *
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\TeamsOfTwoMatchesMatch $match
	 * @return void
	 */
	public function updateAction(TeamsOfTwoMatchesMatch $match) {
		$this->updateMatch($match);
		$this->redirect('index', NULL, NULL, array('match' => $match, 'cup' => $match->getCup()));
	}
}

?>
