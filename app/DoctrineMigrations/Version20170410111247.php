<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170410111247 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql('CREATE SEQUENCE blights_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE blight_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chemistry_blights (chemistry_id INT NOT NULL, blight_id INT NOT NULL, PRIMARY KEY(chemistry_id, blight_id))');
        $this->addSql('CREATE INDEX IDX_CAF8C6E0DA5ED847 ON chemistry_blights (chemistry_id)');
        $this->addSql('CREATE INDEX IDX_CAF8C6E0CC1829C9 ON chemistry_blights (blight_id)');
        $this->addSql('CREATE TABLE blights (id INT NOT NULL, category_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, dis_description1 TEXT DEFAULT NULL, dis_description2 TEXT DEFAULT NULL, dis_description3 TEXT DEFAULT NULL, dis_description4 TEXT DEFAULT NULL, dis_description5 TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83B91F912469DE2 ON blights (category_id)');
        $this->addSql('CREATE UNIQUE INDEX blight_name ON blights (name)');
        $this->addSql('CREATE TABLE blight_categories (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX blight_category_name ON blight_categories (name)');
        $this->addSql('ALTER TABLE chemistry_blights ADD CONSTRAINT FK_CAF8C6E0DA5ED847 FOREIGN KEY (chemistry_id) REFERENCES chemistry (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chemistry_blights ADD CONSTRAINT FK_CAF8C6E0CC1829C9 FOREIGN KEY (blight_id) REFERENCES blights (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blights ADD CONSTRAINT FK_83B91F912469DE2 FOREIGN KEY (category_id) REFERENCES blight_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE chemistry_blights DROP CONSTRAINT FK_CAF8C6E0CC1829C9');
        $this->addSql('ALTER TABLE blights DROP CONSTRAINT FK_83B91F912469DE2');
        $this->addSql('DROP SEQUENCE blights_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE blight_categories_id_seq CASCADE');
        $this->addSql('DROP TABLE chemistry_blights');
        $this->addSql('DROP TABLE blights');
        $this->addSql('DROP TABLE blight_categories');
    }
}
