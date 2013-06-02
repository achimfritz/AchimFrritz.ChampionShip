<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130525174144 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE UNIQUE INDEX flow_identity_achimfritz_championship_domain_model_cup ON achimfritz_championship_domain_model_cup (name)");
		$this->addSql("CREATE UNIQUE INDEX flow_identity_achimfritz_championship_domain_model_team ON achimfritz_championship_domain_model_team (name)");
		$this->addSql("CREATE UNIQUE INDEX flow_identity_achimfritz_championship_domain_model_user ON achimfritz_championship_domain_model_user (name)");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("DROP INDEX flow_identity_achimfritz_championship_domain_model_cup ON achimfritz_championship_domain_model_cup");
		$this->addSql("DROP INDEX flow_identity_achimfritz_championship_domain_model_team ON achimfritz_championship_domain_model_team");
		$this->addSql("DROP INDEX flow_identity_achimfritz_championship_domain_model_user ON achimfritz_championship_domain_model_user");
	}
}

?>