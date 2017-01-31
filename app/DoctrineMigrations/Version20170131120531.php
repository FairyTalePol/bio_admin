<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170131120531 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('GRANT SELECT ON TABLE public.entomophages_categories TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.entomophages TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.entomophagies_vermins TO bio_group, farming_group;');

        $this->addSql('GRANT SELECT ON TABLE public.manufacturers TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.entomophages_categories_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.entomophages_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.manufacturers_id_seq TO bio_group, farming_group;');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('REVOKE SELECT ON TABLE public.entomophages_categories FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.entomophages FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.entomophagies_vermins FROM bio_group, farming_group;');

        $this->addSql('REVOKE SELECT ON TABLE public.manufacturers FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.entomophages_categories_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.entomophages_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.manufacturers_id_seq FROM bio_group, farming_group;');

    }
}
