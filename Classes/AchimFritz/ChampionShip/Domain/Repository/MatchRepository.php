<?php
namespace AchimFritz\ChampionShip\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use AchimFritz\ChampionShip\Domain\Model\Result;
use AchimFritz\ChampionShip\Domain\Model\Team;
use AchimFritz\ChampionShip\Domain\Model\Cup;
use TYPO3\Flow\Persistence\QueryInterface;

/**
 * A repository for Matches
 *
 * @Flow\Scope("singleton")
 */
class MatchRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * @Flow\Inject
	 * @var \AchimFritz\ChampionShip\Domain\Service\RankingCalculator
	 */
	protected $rankingCalculator;

	/**
	 * __construct 
	 * 
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		$this->setDefaultOrderings(array('startDate' => QueryInterface::ORDER_ASCENDING));
	}

	/**
	 * update 
	 * 
	 * @param mixed $object 
	 * @return void
	 */
	public function update($object) {
		if ($object->getResult() instanceof Result) {
			$this->rankingCalculator->updateMatch($object);
		}
		parent::update($object);
	}

	/**
	 * findByTeam
	 * 
	 * @param Team $team
	 * @return \TYPO3\FLOW3\Persistence\QueryResultInterface
	 */
	public function findByTeam(Team $team) {
		$query = $this->createQuery();
		return $query->matching(
            $query->logicalOr(
				$query->equals('hostTeam', $team),
				$query->equals('guestTeam', $team)
			)
		)
		->execute();
	}

	/**
	 * findOneByTowTeamsAndCup
	 * 
	 * @param Team $team
	 * @param Team $otherTeam
	 * @return \TYPO3\FLOW3\Persistence\QueryResultInterface
	 */
	public function findOneByTwoTeamsAndCup(Team $team, Team $otherTeam, Cup $cup) {
		return $this->findByTwoTeamsAndCup($team, $otherTeam, $cup)->getFirst();
	}

	/**
	 * findByTowTeamsAndCup
	 * 
	 * @param Team $team
	 * @param Team $otherTeam
	 * @param Cup $cup
	 * @return \TYPO3\FLOW3\Persistence\QueryResultInterface
	 */
	public function findByTwoTeamsAndCup(Team $team, Team $otherTeam, Cup $cup) {
		$query = $this->createQuery();
		return $query->matching(
            $query->logicalAnd(
					$query->logicalOr(
						$query->logicalAnd(
							$query->equals('hostTeam', $team),
							$query->equals('guestTeam', $otherTeam)
						),
						$query->logicalAnd(
							$query->equals('guestTeam', $team),
							$query->equals('hostTeam', $otherTeam)
						)
					),
					$query->equals('cup', $cup)
				)
		)
		->execute();
	}

	/**
	 * findOneByNameAndCup 
	 * 
	 * @param string $name 
	 * @param Cup $cup 
	 * @return Match|NULL
	 */
	public function findOneByNameAndCup($name, Cup $cup) {
		$query = $this->createQuery();
		return $query->matching(
            $query->logicalAnd(
					$query->equals('cup', $cup),
					$query->equals('name', $name)
				)
		)
		->execute()->getFirst();
	}

	/**
	 * findLastByCup 
	 * 
	 * @param Cup $cup 
	 * @return \TYPO3\FLOW3\Persistence\QueryResultInterface
	 */
	public function findLastByCup(Cup $cup) {
		$query = $this->createQuery();
		$query->setOrderings(array('startDate' => QueryInterface::ORDER_DESCENDING));
		$now = new \DateTime();
		$result = $query->setLimit(2)->matching(
			$query->logicalAnd(
				$query->equals('cup', $cup),
				$query->lessThan('startDate', $now)
			)
		)
		->execute();
		return $result;
	}

	/**
	 * findNextByCup 
	 * 
	 * @param Cup $cup 
	 * @return \TYPO3\FLOW3\Persistence\QueryResultInterface
	 */
	public function findNextByCup(Cup $cup) {
		$query = $this->createQuery();
		$now = new \DateTime();
		$result = $query->setLimit(2)->matching(
			$query->logicalAnd(
				$query->equals('cup', $cup),
				$query->greaterThan('startDate', $now)
			)
		)
		->execute();
		return $result;
	}


}
?>
