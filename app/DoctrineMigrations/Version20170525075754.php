<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170525075754 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE varieties ALTER video_url TYPE TEXT');
        $this->addSql('ALTER TABLE varieties ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE entomophages ALTER video_url TYPE TEXT');
        $this->addSql('ALTER TABLE entomophages ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE manufacturers ALTER video_url TYPE TEXT');
        $this->addSql('ALTER TABLE manufacturers ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE chemistry ALTER video_url TYPE TEXT');
        $this->addSql('ALTER TABLE chemistry ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE blights ALTER video_url TYPE TEXT');
        $this->addSql('ALTER TABLE blights ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE substrates ALTER video_url TYPE TEXT');
        $this->addSql('ALTER TABLE substrates ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE vermins ALTER video_url TYPE TEXT');
        $this->addSql('ALTER TABLE vermins ALTER video_url DROP DEFAULT');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE varieties ALTER video_url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE varieties ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE entomophages ALTER video_url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE entomophages ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE blights ALTER video_url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE blights ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE manufacturers ALTER video_url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE manufacturers ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE chemistry ALTER video_url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE chemistry ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE substrates ALTER video_url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE substrates ALTER video_url DROP DEFAULT');
        $this->addSql('ALTER TABLE vermins ALTER video_url TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE vermins ALTER video_url DROP DEFAULT');
    }
}
