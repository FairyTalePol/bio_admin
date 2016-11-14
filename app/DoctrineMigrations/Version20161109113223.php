<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161109113223 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE chemistry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chemistry (id INT NOT NULL, category_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, substance VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, prophylaxy TEXT DEFAULT NULL, volume INT DEFAULT NULL, norm INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_678D652912469DE2 ON chemistry (category_id)');
        $this->addSql('CREATE UNIQUE INDEX chemistry_name ON chemistry (name)');
        $this->addSql('CREATE TABLE chemistry_vermins (chemistry_id INT NOT NULL, vermin_id INT NOT NULL, PRIMARY KEY(chemistry_id, vermin_id))');
        $this->addSql('CREATE INDEX IDX_B704F9EEDA5ED847 ON chemistry_vermins (chemistry_id)');
        $this->addSql('CREATE INDEX IDX_B704F9EEE4FD5486 ON chemistry_vermins (vermin_id)');
        $this->addSql('CREATE TABLE chemistry_manufacturers (chemistry_id INT NOT NULL, manufacturer_id INT NOT NULL, PRIMARY KEY(chemistry_id, manufacturer_id))');
        $this->addSql('CREATE INDEX IDX_CC6F185CDA5ED847 ON chemistry_manufacturers (chemistry_id)');
        $this->addSql('CREATE INDEX IDX_CC6F185CA23B42D ON chemistry_manufacturers (manufacturer_id)');
        $this->addSql('ALTER TABLE chemistry ADD CONSTRAINT FK_678D652912469DE2 FOREIGN KEY (category_id) REFERENCES chemistry_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chemistry_vermins ADD CONSTRAINT FK_B704F9EEDA5ED847 FOREIGN KEY (chemistry_id) REFERENCES chemistry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chemistry_vermins ADD CONSTRAINT FK_B704F9EEE4FD5486 FOREIGN KEY (vermin_id) REFERENCES vermins (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chemistry_manufacturers ADD CONSTRAINT FK_CC6F185CDA5ED847 FOREIGN KEY (chemistry_id) REFERENCES chemistry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chemistry_manufacturers ADD CONSTRAINT FK_CC6F185CA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE chemistry_vermins DROP CONSTRAINT FK_B704F9EEDA5ED847');
        $this->addSql('ALTER TABLE chemistry_manufacturers DROP CONSTRAINT FK_CC6F185CDA5ED847');
        $this->addSql('DROP SEQUENCE chemistry_id_seq CASCADE');
        $this->addSql('DROP TABLE chemistry');
        $this->addSql('DROP TABLE chemistry_vermins');
        $this->addSql('DROP TABLE chemistry_manufacturers');
    }
}
