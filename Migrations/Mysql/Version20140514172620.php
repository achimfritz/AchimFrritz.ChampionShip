<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20140514172620 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE achimfritz_championship_domain_model_accountrequest (persistence_object_identifier VARCHAR(40) NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, hmac VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("CREATE TABLE achimfritz_championship_domain_model_passwordrequest (persistence_object_identifier VARCHAR(40) NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("CREATE TABLE achimfritz_championship_domain_model_registrationrequest (persistence_object_identifier VARCHAR(40) NOT NULL, newpassword VARCHAR(255) NOT NULL, newpasswordrepeat VARCHAR(255) NOT NULL, tipgroupname VARCHAR(255) NOT NULL, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_passwordrequest ADD CONSTRAINT FK_F182733147A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES achimfritz_championship_domain_model_accountrequest (persistence_object_identifier) ON DELETE CASCADE");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_registrationrequest ADD CONSTRAINT FK_8724C40747A46B0A FOREIGN KEY (persistence_object_identifier) REFERENCES achimfritz_championship_domain_model_accountrequest (persistence_object_identifier) ON DELETE CASCADE");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_passwordrequest DROP FOREIGN KEY FK_F182733147A46B0A");
		$this->addSql("ALTER TABLE achimfritz_championship_domain_model_registrationrequest DROP FOREIGN KEY FK_8724C40747A46B0A");
		$this->addSql("DROP TABLE achimfritz_championship_domain_model_accountrequest");
		$this->addSql("DROP TABLE achimfritz_championship_domain_model_passwordrequest");
		$this->addSql("DROP TABLE achimfritz_championship_domain_model_registrationrequest");
	}
}

?>