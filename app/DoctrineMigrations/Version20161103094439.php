<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161103094439 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE vermin_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vermins_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE vermin_categories (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX vermin_category_name ON vermin_categories (name)');
        $this->addSql('CREATE TABLE vermins (id INT NOT NULL, category_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, dis_description1 TEXT DEFAULT NULL, dis_description2 TEXT DEFAULT NULL, dis_description3 TEXT DEFAULT NULL, dis_description4 TEXT DEFAULT NULL, dis_description5 TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75C7AEF712469DE2 ON vermins (category_id)');
        $this->addSql('CREATE UNIQUE INDEX vermin_name ON vermins (name)');
        $this->addSql('ALTER TABLE vermins ADD CONSTRAINT FK_75C7AEF712469DE2 FOREIGN KEY (category_id) REFERENCES vermin_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE vermins DROP CONSTRAINT FK_75C7AEF712469DE2');
        $this->addSql('DROP SEQUENCE vermin_categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vermins_id_seq CASCADE');
        $this->addSql('DROP TABLE vermin_categories');
        $this->addSql('DROP TABLE vermins');
    }
}
