<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130526132646 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_abstractmatch ADD hostteamalt VARCHAR(255) NOT NULL, ADD guestteamalt VARCHAR(255) NOT NULL");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_eightfinalmatch ADD hostteamalt VARCHAR(255) NOT NULL, ADD guestteamalt VARCHAR(255) NOT NULL");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_finalmatch ADD hostteamalt VARCHAR(255) NOT NULL, ADD guestteamalt VARCHAR(255) NOT NULL");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_quarterfinalmatch ADD hostteamalt VARCHAR(255) NOT NULL, ADD guestteamalt VARCHAR(255) NOT NULL");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_roundmatch ADD hostteamalt VARCHAR(255) NOT NULL, ADD guestteamalt VARCHAR(255) NOT NULL");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_semifinalmatch ADD hostteamalt VARCHAR(255) NOT NULL, ADD guestteamalt VARCHAR(255) NOT NULL");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_abstractmatch DROP hostteamalt, DROP guestteamalt");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_eightfinalmatch DROP hostteamalt, DROP guestteamalt");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_finalmatch DROP hostteamalt, DROP guestteamalt");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_quarterfinalmatch DROP hostteamalt, DROP guestteamalt");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_roundmatch DROP hostteamalt, DROP guestteamalt");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_match_semifinalmatch DROP hostteamalt, DROP guestteamalt");
	}
}

?>