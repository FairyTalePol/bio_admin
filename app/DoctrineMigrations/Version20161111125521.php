<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161111125521 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE substrate_category_manufacturers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE substrate_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE substrates_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE substrate_category_manufacturers (id INT NOT NULL, substrate_category_id INT NOT NULL, manufacturer_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ECA02760A9C73EC0 ON substrate_category_manufacturers (substrate_category_id)');
        $this->addSql('CREATE INDEX IDX_ECA02760A23B42D ON substrate_category_manufacturers (manufacturer_id)');
        $this->addSql('CREATE UNIQUE INDEX substrate_category_manufacturer ON substrate_category_manufacturers (substrate_category_id, manufacturer_id)');
        $this->addSql('CREATE TABLE substrate_categories (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX substrate_category_name ON substrate_categories (name)');
        $this->addSql('CREATE TABLE substrates (id INT NOT NULL, substrate_category_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, size TEXT NOT NULL, substrate_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_19CBAEF1A9C73EC0 ON substrates (substrate_category_id)');
        $this->addSql('ALTER TABLE substrate_category_manufacturers ADD CONSTRAINT FK_ECA02760A9C73EC0 FOREIGN KEY (substrate_category_id) REFERENCES substrate_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE substrate_category_manufacturers ADD CONSTRAINT FK_ECA02760A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturers (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE substrates ADD CONSTRAINT FK_19CBAEF1A9C73EC0 FOREIGN KEY (substrate_category_id) REFERENCES substrate_category_manufacturers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE substrates DROP CONSTRAINT FK_19CBAEF1A9C73EC0');
        $this->addSql('ALTER TABLE substrate_category_manufacturers DROP CONSTRAINT FK_ECA02760A9C73EC0');
        $this->addSql('DROP SEQUENCE substrate_category_manufacturers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE substrate_categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE substrates_id_seq CASCADE');
        $this->addSql('DROP TABLE substrate_category_manufacturers');
        $this->addSql('DROP TABLE substrate_categories');
        $this->addSql('DROP TABLE substrates');
    }
}
