<?php
namespace AchimFritz\ChampionShip\Domain\Factory;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Account;
use AchimFritz\ChampionShip\Domain\Model\Cup;
use AchimFritz\ChampionShip\Domain\Model\User;
use AchimFritz\ChampionShip\Domain\Model\Tip;
use AchimFritz\ChampionShip\Domain\Model\Match;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * A TipFactory
 *
 * @Flow\Scope("singleton")
 */
class TipFactory {

	/**
	 * @var \AchimFritz\ChampionShip\Domain\Repository\TipRepository
	 * @Flow\Inject
	 */
	protected $tipRepository;

	/**
	 * @var \AchimFritz\ChampionShip\Domain\Repository\MatchRepository
	 * @Flow\Inject
	 */
	protected $matchRepository;

	/**
	 * @var \TYPO3\Flow\Persistence\Doctrine\PersistenceManager
	 * @Flow\Inject
	 */
	protected $persistenceManager;


	/**
	 * checkUserTips 
	 * 
	 * @param Cup $cup 
	 * @param User $user 
	 * @return void
	 */
	public function checkUserTips(Cup $cup, User $user) {
		// init tips if match in future exists and use has no tips in cup
		$lastMatches = $this->matchRepository->findNextByCup($cup, 1);
		$lastMatch = $lastMatches->getFirst();
		if ($lastMatch instanceof Match) {
			$tips = $this->tipRepository->findByUserInCup($user, $cup);
			if (count($tips) === 0) {
				$newTips = $this->initTips($cup, $user);
				$this->persistenceManager->persistAll();
			}
		}
	}

	/**
	 * initTips 
	 * 
	 * @param Cup $cup
	 * @param User $user
	 * @return Collection<Tip>
	 */
	public function initTips(Cup $cup, User $user = NULL) {
		$existingTips = $this->tipRepository->findByUser($user);
		$tips = new ArrayCollection();
		$matches = $this->matchRepository->findByCup($cup);
		foreach ($matches AS $match) {
			$tipExists = FALSE;
			foreach ($existingTips AS $tip) {
				if ($tip->getMatch() === $match) {
					$tipExists = TRUE;
					continue 2;
				}
			}
			if ($tipExists === FALSE) {
				$tip = new Tip();
				$tip->setMatch($match);
				$tip->setUser($user);
				$this->tipRepository->add($tip);
				$tips->add($tip);
			}
		}
		return $tips;
	}

}
?>
