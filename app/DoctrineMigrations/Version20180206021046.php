<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180206021046 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql('ALTER TABLE blights  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE blight_categories  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE chemistry  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE chemistry_categories  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE cultures  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE entomophages  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE entomophages_categories  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE manufacturers  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE substrates  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE substrate_categories  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE varieties  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE vermins  ADD record_id uuid DEFAULT uuid_generate_v4();');
        $this->addSql('ALTER TABLE vermin_categories  ADD record_id uuid DEFAULT uuid_generate_v4();');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');
        $this->addSql('ALTER TABLE blights  DROP record_id');
        $this->addSql('ALTER TABLE blight_categories  DROP record_id');
        $this->addSql('ALTER TABLE chemistry  DROP record_id');
        $this->addSql('ALTER TABLE chemistry_categories  DROP record_id');
        $this->addSql('ALTER TABLE cultures  DROP record_id');
        $this->addSql('ALTER TABLE entomophages  DROP record_id');
        $this->addSql('ALTER TABLE entomophages_categories  DROP record_id');
        $this->addSql('ALTER TABLE manufacturers  DROP record_id');
        $this->addSql('ALTER TABLE substrates  DROP record_id');
        $this->addSql('ALTER TABLE substrate_categories  DROP record_id');
        $this->addSql('ALTER TABLE varieties  DROP record_id');
        $this->addSql('ALTER TABLE vermins  DROP record_id');
        $this->addSql('ALTER TABLE vermin_categories  DROP record_id');




    }
}
