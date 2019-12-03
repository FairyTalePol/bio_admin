<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170131122036 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE entomophages_manufacturers (entomophage_id INT NOT NULL, manufacturer_id INT NOT NULL, PRIMARY KEY(entomophage_id, manufacturer_id))');
        $this->addSql('CREATE INDEX IDX_D53D459738A80E ON entomophages_manufacturers (entomophage_id)');
        $this->addSql('CREATE INDEX IDX_D53D459A23B42D ON entomophages_manufacturers (manufacturer_id)');
        $this->addSql('ALTER TABLE entomophages_manufacturers ADD CONSTRAINT FK_D53D459738A80E FOREIGN KEY (entomophage_id) REFERENCES entomophages (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entomophages_manufacturers ADD CONSTRAINT FK_D53D459A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE entomophages_manufacturers');
    }
}
