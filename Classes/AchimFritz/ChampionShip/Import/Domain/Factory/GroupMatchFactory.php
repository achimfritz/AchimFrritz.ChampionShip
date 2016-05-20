<?php
namespace AchimFritz\ChampionShip\Import\Domain\Factory;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip.Import".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use AchimFritz\ChampionShip\Competition\Domain\Model\GroupMatch;
use AchimFritz\ChampionShip\Competition\Domain\Model\Result;
use AchimFritz\ChampionShip\Competition\Domain\Model\GroupRound;
use AchimFritz\ChampionShip\Competition\Domain\Model\Cup;
use AchimFritz\ChampionShip\Import\Domain\Model\Match;

/**
 * GroupMatchFactory
 *
 * @Flow\Scope("singleton")
 */
class GroupMatchFactory {

	/**
	 * @Flow\Inject
	 * @var \AchimFritz\ChampionShip\Competition\Domain\Repository\GroupMatchRepository
	 */
	protected $groupMatchRepository;

	/**
	 * createFromMatch
	 *
	 * @param \AchimFritz\ChampionShip\Import\Domain\Model\Match $match
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\Cup $cup
	 * @param array $teams
	 * @param \AchimFritz\ChampionShip\Competition\Domain\Model\GroupRound $groupRound
	 * @return GroupMatch $groupMatch
	 */
	public function createFromMatch(Match $match, array $teams, Cup $cup, GroupRound $groupRound) {
		$groupMatch = $this->groupMatchRepository->findByTwoTeamsAndCup(
			$teams[$match->getHomeTeam()],
			$teams[$match->getGuestTeam()],
			$cup
		)->getFirst();
		$newMatch = FALSE;
		if (!$groupMatch instanceof GroupMatch) {
			$groupMatch = new GroupMatch();
			$newMatch = TRUE;
		}
		$groupMatch->setName($match->getName());
		$groupMatch->setHostTeam($teams[$match->getHomeTeam()]);
		$groupMatch->setGuestTeam($teams[$match->getGuestTeam()]);
		$groupMatch->setCup($cup);
		$startDate = new \DateTime();
		$startDate->setTimestamp($match->getStartDate());
		$groupMatch->setStartDate($startDate);
		$groupMatch->setRound($groupRound);
		if ((int)$match->getHomeGoals() === $match->getHomeGoals() AND (int)$match->getGuestGoals() === $match->getGuestGoals()) {
			$result = new Result((int)$match->getHomeGoals(), (int)$match->getGuestGoals());
			$groupMatch->setResult($result);
		}
		if ($newMatch === TRUE) {
			$this->groupMatchRepository->add($groupMatch);
		} else {
			$this->groupMatchRepository->update($groupMatch);
		}
		return $groupMatch;
	}

}

?>
