<?php
namespace AchimFritz\ChampionShip\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "AchimFritz.ChampionShip".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Round
 *
 * @Flow\Entity
 */
class GroupRound extends Round {

	/**
	 * The group table
	 * @var \Doctrine\Common\Collections\Collection<\AchimFritz\ChampionShip\Domain\Model\GroupTableRow>
	 * @ORM\OneToMany(mappedBy="groupRound")
	 * @ORM\OrderBy({"rank" = "ASC"})
	 */
	protected $groupTableRows;
	
	/**
	 * __construct
	 * 
	 * @return void
	 */
	public function __construct() {
		$this->groupTableRows = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	 * Get the Group table's group table rows
	 *
	 * @return \AchimFritz\ChampionShip\Domain\Model\GroupTableRow The Group table's group table rows
	 */
	public function getGroupTableRows() {
		return $this->groupTableRows;
	}

	/**
	 * Sets this Group table's group table rows
	 *
	 * @param \Doctrine\Common\Collections\Collection<\AchimFritz\ChampionShip\Domain\Model\GroupTableRow>
	 * @return void
	 */
	public function setGroupTableRows(\Doctrine\Common\Collections\Collection $groupTableRows) {
		$this->groupTableRows = $groupTableRows;
	}
	
	/**
	 * clearGroupTableRows
	 * 
	 * @return void
	 */
	public function clearGroupTableRows() {
		$this->groupTableRows->clear();
	}
	
	/**
	 * removeGroupTableRow
	 * 
	 * @param \AchimFritz\ChampionShip\Domain\Model\GroupTableRow $groupTableRow
	 * @return void
	 */
	public function removeGroupTableRow(\AchimFritz\ChampionShip\Domain\Model\GroupTableRow $groupTableRow) {
		$this->groupTableRows->remove($groupTableRow);
	}
	
	/**
	 * Sets this Group table's group table rows
	 *
	 * @param \AchimFritz\ChampionShip\Domain\Model\GroupTableRow
	 * @return void
	 */
	public function addGroupTableRow(\AchimFritz\ChampionShip\Domain\Model\GroupTableRow $groupTableRow) {
		$this->groupTableRows->add($groupTableRow);
	}
	
	/**
	 * getIsKoRound
	 * 
	 * @return boolean
	 */
	public function getIsKoRound() {
		return FALSE;
	}
	
	/**
	 * getIsGroupRound
	 * 
	 * @return boolean
	 */
	public function getIsGroupRound() {
		return TRUE;
	}
}
?>
