<?php
namespace AchimFritz\ChampionShip\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Account;
use AchimFritz\ChampionShip\Domain\Model\TipGroup;

/**
 * A repository for Users
 *
 * @Flow\Scope("singleton")
 */
class UserRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * findOneByUsername 
	 * 
	 * @param string $username 
	 * @return User|NULL
	 */
	public function findOneByUsername($username) {
		$query = $this->createQuery();
		return $query->matching(
					$query->equals('account.accountIdentifier', $username)
				)
			->execute()->getFirst();
			/*
		$account = $this->accountRepository->findOneByAccountIdentifier($username);
		if ($account instanceof Account) {
			return $this->findOneByAccount($account);
		}
		return NULL;*/
	}

	/**
	 * findOneByIdentifierAndEmail 
	 * 
	 * @param string $identifier 
	 * @param string $email 
	 * @return Uesr|NULL
	 */
	public function findOneByIdentifierAndEmail($identifier, $email) {
		$query = $this->createQuery();
		return $query->matching(
				$query->logicalAnd(
					$query->equals('account.accountIdentifier', $identifier),
					$query->equals('email', $email)
					)
				)
			->execute()->getFirst();
	}

	/**
	 * findInTipGroup 
	 * 
	 * @param TipGroup $tipGroup 
	 * @return \TYPO3\FLOW3\Persistence\QueryResultInterface
	 */
	public function findInTipGroup(TipGroup $tipGroup) {
		$query = $this->createQuery();
		return $query->matching(
			$query->contains('tipGroups', $tipGroup)
		)->execute();
	}


}
?>
