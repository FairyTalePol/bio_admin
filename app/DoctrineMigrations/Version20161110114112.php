<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161110114112 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE cultures_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE culture_manufacturers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cultures (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX culture_name ON cultures (name)');
        $this->addSql('CREATE TABLE culture_manufacturers (id INT NOT NULL, culture_id INT NOT NULL, manufacturer_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A7264065B108249D ON culture_manufacturers (culture_id)');
        $this->addSql('CREATE INDEX IDX_A7264065A23B42D ON culture_manufacturers (manufacturer_id)');
        $this->addSql('CREATE UNIQUE INDEX culture_manufacturer ON culture_manufacturers (culture_id, manufacturer_id)');
        $this->addSql('ALTER TABLE culture_manufacturers ADD CONSTRAINT FK_A7264065B108249D FOREIGN KEY (culture_id) REFERENCES cultures (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE culture_manufacturers ADD CONSTRAINT FK_A7264065A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE culture_manufacturers DROP CONSTRAINT FK_A7264065B108249D');
        $this->addSql('DROP SEQUENCE cultures_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE culture_manufacturers_id_seq CASCADE');
        $this->addSql('DROP TABLE cultures');
        $this->addSql('DROP TABLE culture_manufacturers');
    }
}
