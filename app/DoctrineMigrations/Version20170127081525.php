<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170127081525 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('GRANT SELECT ON TABLE public.vermin_categories TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.vermins TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.vermin_categories_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.vermins_id_seq TO bio_group, farming_group;');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('REVOKE SELECT ON TABLE public.vermin_categories FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.vermins FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.vermin_categories_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.vermins_id_seq FROM bio_group, farming_group;');

    }
}
