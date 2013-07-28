<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130728150308 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE achimfritz_championship_domain_model_winnersoftwomatchesround (persistence_object_identifier VARCHAR(40) NOT NULL, parentround VARCHAR(40) DEFAULT NULL, INDEX IDX_995C7148A528AC9B (parentround), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_winnersoftwomatchesround ADD CONSTRAINT FK_995C7148A528AC9B FOREIGN KEY (parentround) REFERENCES achimfritz_championship_domain_model_koround (persistence_object_identifier)");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_winnersoftwomatchesround ADD CONSTRAINT FK_995C714847A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES achimfritz_championship_domain_model_round (persistence_object_identifier) ON DELETE CASCADE");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("DROP TABLE achimfritz_championship_domain_model_winnersoftwomatchesround");
	}
}

?>