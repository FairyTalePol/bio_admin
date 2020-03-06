<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161107132553 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE providers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE manufacturers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE providers (id INT NOT NULL, manufacturer_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fio VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, position VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E225D417A23B42D ON providers (manufacturer_id)');
        $this->addSql('CREATE TABLE manufacturers (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, manufacturer_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_94565B125E237E06 ON manufacturers (name)');
        $this->addSql('CREATE UNIQUE INDEX manufacturer_name_type ON manufacturers (name, manufacturer_type)');
        $this->addSql('ALTER TABLE providers ADD CONSTRAINT FK_E225D417A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE providers DROP CONSTRAINT FK_E225D417A23B42D');
        $this->addSql('DROP SEQUENCE providers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manufacturers_id_seq CASCADE');
        $this->addSql('DROP TABLE providers');
        $this->addSql('DROP TABLE manufacturers');
    }
}
