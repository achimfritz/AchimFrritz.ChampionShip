<?php
namespace AchimFritz\ChampionShip\Tip\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use AchimFritz\ChampionShip\Competition\Domain\Model\Match;
use AchimFritz\ChampionShip\User\Domain\Model\User;
use AchimFritz\ChampionShip\Competition\Domain\Model\Cup;
use AchimFritz\ChampionShip\Competition\Domain\Model\Round;
use AchimFritz\ChampionShip\Competition\Domain\Model\Result;
use AchimFritz\ChampionShip\Tip\Domain\Model\Tip;
use \TYPO3\Flow\Persistence\Repository;
use \TYPO3\Flow\Persistence\QueryInterface;

/**
 * A repository for TipGroups
 *
 * @Flow\Scope("singleton")
 */
class TipRepository extends Repository {

	/**
	 * __construct 
	 * 
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->setDefaultOrderings(array('generalMatch.startDate' => QueryInterface::ORDER_ASCENDING));
	}

	/**
	 * findByCup 
	 * 
	 * @param Cup $cup 
	 * @param User $user
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findByUserInCup(User $user, Cup $cup) {
		$query = $this->createQuery();
		return $query->matching(
         $query->logicalAnd(
				$query->equals('generalMatch.cup', $cup),
				$query->equals('user', $user)
			)
		)
		->execute();
	}

	/**
	 * findByCup 
	 * 
	 * @param Cup $cup 
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findByCup(Cup $cup) {
		$query = $this->createQuery();
		return $query->matching(
			$query->equals('generalMatch.cup', $cup)
		)
		->execute();
	}

	/**
	 * findOneUserInMatches
	 * 
	 * @param User $user 
	 * @param mixed $matches
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findByUserInMatches(User $user, $matches) {
		$identifiers = array();
		foreach ($matches as $match) {
			$identifiers[] = $this->persistenceManager->getIdentifierByObject($match);
		}
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->in('generalMatch', $identifiers),
				$query->equals('user', $user)
			)
		)->execute();
	}

	/**
	 * findOneByUserAndMatch 
	 * 
	 * @param \AchimFritz\ChampionShip\User\Domain\Model\User $user
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\Match $match
	 * @return \AchimFritz\ChampionShip\Tip\Domain\Model\Tip
	 */
	public function findOneByUserAndMatch(User $user, Match $match) {
		$query = $this->createQuery();
		return $query->matching(
            $query->logicalAnd(
				$query->equals('generalMatch', $match),
				$query->equals('user', $user)
			)
		)
		->execute()->getFirst();
	}

	/**
	 * findMatchTipsByUserInRound 
	 * 
	 * @param User $user 
	 * @param GroupRound $round 
	 * @return ArrayCollection
	 */
	public function findByUserInRound(User $user, Round $round) {
		$query = $this->createQuery();
		return $query->matching(
         $query->logicalAnd(
				$query->equals('generalMatch.round', $round),
				$query->equals('user', $user)
			)
		)->execute();
	}

	/**
	 * add
	 * 
	 * @param mixed $object 
	 * @return void
	 */
	public function add($object) {
		$tip = $this->updateTipResult($object);
		parent::add($object);
	}

	/**
	 * update 
	 * 
	 * @param mixed $object 
	 * @return void
	 */
	public function update($object) {
		$tip = $this->updateTipResult($object);
		parent::update($object);
	}

	/**
	 * updateTipResult 
	 * 
	 * @param Tip $tip 
	 * @return Tip $tip
	 */
	protected function updateTipResult(Tip $tip) {
		if ($tip->getResult() instanceof Result) {
			$name = $tip->getMatch()->getCup()->getTipPointsPolicy();
			$tipPointsPolicy = new $name;
			$points = $tipPointsPolicy->getPointsForTip($tip);
			$tip->setPoints($points);
		}
		return $tip;
	}


}
?>
