<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs! This block will be used as the migration description if getDescription() is not used.
 */
class Version20210521133542 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription()
    {
        return '';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('ALTER TABLE typo3_party_domain_model_abstractparty_accounts_join DROP FOREIGN KEY FK_1EEEBC2F38110E12');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person DROP FOREIGN KEY typo3_party_domain_model_person_ibfk_3');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person DROP FOREIGN KEY typo3_party_domain_model_person_ibfk_2');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person_electronicaddresses_join DROP FOREIGN KEY typo3_party_domain_model_person_electronicaddresses_join_ibfk_2');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person_electronicaddresses_join DROP FOREIGN KEY typo3_party_domain_model_person_electronicaddresses_join_ibfk_1');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person DROP FOREIGN KEY typo3_party_domain_model_person_ibfk_1');
        $this->addSql('DROP TABLE typo3_party_domain_model_abstractparty');
        $this->addSql('DROP TABLE typo3_party_domain_model_abstractparty_accounts_join');
        $this->addSql('DROP TABLE typo3_party_domain_model_electronicaddress');
        $this->addSql('DROP TABLE typo3_party_domain_model_person');
        $this->addSql('DROP TABLE typo3_party_domain_model_person_electronicaddresses_join');
        $this->addSql('DROP TABLE typo3_party_domain_model_personname');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('CREATE TABLE typo3_party_domain_model_abstractparty (persistence_object_identifier VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, dtype VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typo3_party_domain_model_abstractparty_accounts_join (party_abstractparty VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, flow_security_account VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_1EEEBC2F38110E12 (party_abstractparty), UNIQUE INDEX UNIQ_1EEEBC2F58842EFC (flow_security_account), PRIMARY KEY(party_abstractparty, flow_security_account)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typo3_party_domain_model_electronicaddress (persistence_object_identifier VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, identifier VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, type VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, usagetype VARCHAR(20) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, approved TINYINT(1) NOT NULL, dtype VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typo3_party_domain_model_person (persistence_object_identifier VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, name VARCHAR(40) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, primaryelectronicaddress VARCHAR(40) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_C60479E1A7CECF13 (primaryelectronicaddress), UNIQUE INDEX UNIQ_C60479E15E237E06 (name), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typo3_party_domain_model_person_electronicaddresses_join (party_person VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, party_electronicaddress VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_BE7D49F772AAAA2F (party_person), INDEX IDX_BE7D49F7B06BD60D (party_electronicaddress), PRIMARY KEY(party_person, party_electronicaddress)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE typo3_party_domain_model_personname (persistence_object_identifier VARCHAR(40) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, title VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, firstname VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, middlename VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, lastname VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, othername VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, alias VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, fullname VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, dtype VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE typo3_party_domain_model_abstractparty_accounts_join ADD CONSTRAINT FK_1EEEBC2F38110E12 FOREIGN KEY (party_abstractparty) REFERENCES typo3_party_domain_model_abstractparty (persistence_object_identifier) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE typo3_party_domain_model_abstractparty_accounts_join ADD CONSTRAINT FK_1EEEBC2F58842EFC FOREIGN KEY (flow_security_account) REFERENCES neos_flow_security_account (persistence_object_identifier) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person ADD CONSTRAINT typo3_party_domain_model_person_ibfk_1 FOREIGN KEY (name) REFERENCES typo3_party_domain_model_personname (persistence_object_identifier) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person ADD CONSTRAINT typo3_party_domain_model_person_ibfk_2 FOREIGN KEY (primaryelectronicaddress) REFERENCES typo3_party_domain_model_electronicaddress (persistence_object_identifier) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person ADD CONSTRAINT typo3_party_domain_model_person_ibfk_3 FOREIGN KEY (persistence_object_identifier) REFERENCES typo3_party_domain_model_abstractparty (persistence_object_identifier) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person_electronicaddresses_join ADD CONSTRAINT typo3_party_domain_model_person_electronicaddresses_join_ibfk_1 FOREIGN KEY (party_person) REFERENCES typo3_party_domain_model_person (persistence_object_identifier) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE typo3_party_domain_model_person_electronicaddresses_join ADD CONSTRAINT typo3_party_domain_model_person_electronicaddresses_join_ibfk_2 FOREIGN KEY (party_electronicaddress) REFERENCES typo3_party_domain_model_electronicaddress (persistence_object_identifier) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}