<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170424104037 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE varieties ADD video_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE varieties ADD image2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE varieties ADD image3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE varieties ADD image4 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD video_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD image2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD image3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD image4 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE manufacturers ADD video_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE manufacturers ADD image2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE manufacturers ADD image3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE manufacturers ADD image4 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD video_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD image2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD image3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD image4 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD video_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD image2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD image3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD image4 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE substrates ADD video_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE substrates ADD image2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE substrates ADD image3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE substrates ADD image4 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD video_url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD image2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD image3 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD image4 VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE varieties DROP video_url');
        $this->addSql('ALTER TABLE varieties DROP image2');
        $this->addSql('ALTER TABLE varieties DROP image3');
        $this->addSql('ALTER TABLE varieties DROP image4');
        $this->addSql('ALTER TABLE entomophages DROP video_url');
        $this->addSql('ALTER TABLE entomophages DROP image2');
        $this->addSql('ALTER TABLE entomophages DROP image3');
        $this->addSql('ALTER TABLE entomophages DROP image4');
        $this->addSql('ALTER TABLE blights DROP video_url');
        $this->addSql('ALTER TABLE blights DROP image2');
        $this->addSql('ALTER TABLE blights DROP image3');
        $this->addSql('ALTER TABLE blights DROP image4');
        $this->addSql('ALTER TABLE vermins DROP video_url');
        $this->addSql('ALTER TABLE vermins DROP image2');
        $this->addSql('ALTER TABLE vermins DROP image3');
        $this->addSql('ALTER TABLE vermins DROP image4');
        $this->addSql('ALTER TABLE manufacturers DROP video_url');
        $this->addSql('ALTER TABLE manufacturers DROP image2');
        $this->addSql('ALTER TABLE manufacturers DROP image3');
        $this->addSql('ALTER TABLE manufacturers DROP image4');
        $this->addSql('ALTER TABLE chemistry DROP video_url');
        $this->addSql('ALTER TABLE chemistry DROP image2');
        $this->addSql('ALTER TABLE chemistry DROP image3');
        $this->addSql('ALTER TABLE chemistry DROP image4');
        $this->addSql('ALTER TABLE substrates DROP video_url');
        $this->addSql('ALTER TABLE substrates DROP image2');
        $this->addSql('ALTER TABLE substrates DROP image3');
        $this->addSql('ALTER TABLE substrates DROP image4');
    }
}
