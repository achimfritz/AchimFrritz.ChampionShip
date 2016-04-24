<?php
namespace AchimFritz\ChampionShip;

use TYPO3\Flow\Package\Package as BasePackage;
use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class Package extends BasePackage {

	/**
	 * Boot the package. We wire some signals to slots here.
	 *
	 * @param \TYPO3\Flow\Core\Bootstrap $bootstrap The current bootstrap
	 * @return void
	 */
	public function boot(\TYPO3\Flow\Core\Bootstrap $bootstrap) {
		$dispatcher = $bootstrap->getSignalSlotDispatcher();
		$dispatcher->connect(
			'AchimFritz\ChampionShip\Competition\Domain\Repository\GroupMatchRepository', 'matchAdded',
			'AchimFritz\ChampionShip\Competition\Domain\Event\Listener\MatchListener', 'onGroupMatchChanged'
		);
		$dispatcher->connect(
			'AchimFritz\ChampionShip\Competition\Domain\Repository\GroupMatchRepository', 'matchUpdated',
			'AchimFritz\ChampionShip\Competition\Domain\Event\Listener\MatchListener', 'onGroupMatchChanged'
		);
		$dispatcher->connect(
			'AchimFritz\ChampionShip\Competition\Domain\Repository\CrossGroupMatchRepository', 'matchAdded',
			'AchimFritz\ChampionShip\Competition\Domain\Event\Listener\MatchListener', 'onCrossGroupMatchChanged'
		);
		$dispatcher->connect(
			'AchimFritz\ChampionShip\Competition\Domain\Repository\CrossGroupMatchRepository', 'matchUpdated',
			'AchimFritz\ChampionShip\Competition\Domain\Event\Listener\MatchListener', 'onCrossGroupMatchChanged'
		);
		$dispatcher->connect(
			'AchimFritz\ChampionShip\Competition\Domain\Repository\KoMatchRepository', 'matchAdded',
			'AchimFritz\ChampionShip\Competition\Domain\Event\Listener\MatchListener', 'onKoMatchChanged'
		);
		$dispatcher->connect(
			'AchimFritz\ChampionShip\Competition\Domain\Repository\KoMatchRepository', 'matchUpdated',
			'AchimFritz\ChampionShip\Competition\Domain\Event\Listener\MatchListener', 'onKoMatchChanged'
		);
		$dispatcher->connect(
			'AchimFritz\ChampionShip\Competition\Domain\Repository\KoMatchRepository', 'matchRemoved',
			'AchimFritz\ChampionShip\Competition\Domain\Event\Listener\MatchListener', 'onKoMatchRemoved'
		);
	}

}
