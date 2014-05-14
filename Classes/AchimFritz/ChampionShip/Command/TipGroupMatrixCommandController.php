<?php
namespace AchimFritz\ChampionShip\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * The User Command Controller Service
 *
 * @Flow\Scope("singleton")
 */
class TipGroupMatrixCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @var \AchimFritz\ChampionShip\Domain\Factory\TipGroupResultMatrixFactory
	 * @Flow\Inject
	 */
	protected $matrixFactory;

	/**
	 * @var \AchimFritz\ChampionShip\Domain\Repository\UserRepository
	 * @Flow\Inject
	 */
	protected $userRepository;

	/**
	 * @Flow\Inject
	 * @var \AchimFritz\ChampionShip\Domain\Repository\GroupMatchRepository
	 */
	protected $matchRepository;

	/**
	 * @Flow\Inject
	 * @var \AchimFritz\ChampionShip\Domain\Repository\CupRepository
	 */
	protected $cupRepository;

	/**
	 * Create
	 *
	 * @return void
	 */
	public function createCommand() {
		try {
			$cup = $this->cupRepository->findOneByName('em 2008');
			$matches = $this->matchRepository->findByCup($cup);
			$users = $this->userRepository->findByName('achim');
			#$users = $this->userRepository->findAll();
			$matrix = $this->matrixFactory->create($users, $matches);
			$this->outputLine('matrix created: ' . get_class($matrix));
		} catch (\Exception $e) {
			$this->outputLine('ERROR ' . $e->getMessage());
		}
	}

}

?>