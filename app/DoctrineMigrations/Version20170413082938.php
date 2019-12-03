<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170413082938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('GRANT SELECT ON TABLE public.blight_categories TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.blights TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.blight_categories_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.blights_id_seq TO bio_group, farming_group;');

        $this->addSql('GRANT SELECT ON TABLE public.culture_manufacturers TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.cultures TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.culture_manufacturers_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.cultures_id_seq TO bio_group, farming_group;');

        $this->addSql('GRANT SELECT ON TABLE public.varieties TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.varieties_id_seq TO bio_group, farming_group;');

        $this->addSql('GRANT SELECT ON TABLE public.substrates TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.substrates_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.substrate_categories TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.substrate_categories_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.substrate_category_manufacturers TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.substrate_category_manufacturers_id_seq TO bio_group, farming_group;');

        $this->addSql('GRANT SELECT ON TABLE public.chemistry TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.chemistry_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.chemistry_categories TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON SEQUENCE public.chemistry_categories_id_seq TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.chemistry_blights TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.chemistry_manufacturers TO bio_group, farming_group;');
        $this->addSql('GRANT SELECT ON TABLE public.chemistry_vermins TO bio_group, farming_group;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('REVOKE SELECT ON TABLE public.blight_categories FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.blights FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.blight_categories_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.blights_id_seq FROM bio_group, farming_group;');

        $this->addSql('REVOKE SELECT ON TABLE public.culture_manufacturers FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.cultures FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.culture_manufacturers_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.cultures_id_seq FROM bio_group, farming_group;');

        $this->addSql('REVOKE SELECT ON TABLE public.varieties FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.varieties_id_seq FROM bio_group, farming_group;');

        $this->addSql('REVOKE SELECT ON TABLE public.substrates FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.substrates_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.substrate_categories FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.substrate_categories_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.substrate_category_manufacturers FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.substrate_category_manufacturers_id_seq FROM bio_group, farming_group;');

        $this->addSql('REVOKE SELECT ON TABLE public.chemistry FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.chemistry_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry_categories FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON SEQUENCE public.chemistry_categories_id_seq FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry_blights FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry_manufacturers FROM bio_group, farming_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry_vermins FROM bio_group, farming_group;');

    }
}
