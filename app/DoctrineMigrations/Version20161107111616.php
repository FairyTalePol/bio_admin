<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161107111616 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE entomophages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entomophages_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE entomophages (id INT NOT NULL, category_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, prophylaxy TEXT DEFAULT NULL, norm VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3E0A415212469DE2 ON entomophages (category_id)');
        $this->addSql('CREATE UNIQUE INDEX entomophage_name ON entomophages (name)');
        $this->addSql('CREATE TABLE entomophagies_vermins (entomophage_id INT NOT NULL, vermin_id INT NOT NULL, PRIMARY KEY(entomophage_id, vermin_id))');
        $this->addSql('CREATE INDEX IDX_48B38A25738A80E ON entomophagies_vermins (entomophage_id)');
        $this->addSql('CREATE INDEX IDX_48B38A25E4FD5486 ON entomophagies_vermins (vermin_id)');
        $this->addSql('CREATE TABLE entomophages_categories (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX entomophage_category_name ON entomophages_categories (name)');
        $this->addSql('ALTER TABLE entomophages ADD CONSTRAINT FK_3E0A415212469DE2 FOREIGN KEY (category_id) REFERENCES entomophages_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entomophagies_vermins ADD CONSTRAINT FK_48B38A25738A80E FOREIGN KEY (entomophage_id) REFERENCES entomophages (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entomophagies_vermins ADD CONSTRAINT FK_48B38A25E4FD5486 FOREIGN KEY (vermin_id) REFERENCES vermins (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE entomophagies_vermins DROP CONSTRAINT FK_48B38A25738A80E');
        $this->addSql('ALTER TABLE entomophages DROP CONSTRAINT FK_3E0A415212469DE2');
        $this->addSql('DROP SEQUENCE entomophages_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entomophages_categories_id_seq CASCADE');
        $this->addSql('DROP TABLE entomophages');
        $this->addSql('DROP TABLE entomophagies_vermins');
        $this->addSql('DROP TABLE entomophages_categories');
    }
}
