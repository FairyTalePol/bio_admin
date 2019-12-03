<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161115120508 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('GRANT SELECT ON TABLE public.chemistry TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.chemistry_categories TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.chemistry_manufacturers TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.chemistry_vermins TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.culture_manufacturers TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.cultures TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.entomophages TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.entomophages_categories TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.entomophagies_vermins TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.manufacturers TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.providers TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.substrate_categories TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.substrate_category_manufacturers TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.varieties TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.vermin_categories TO bio_group;');
        $this->addSql('GRANT SELECT ON TABLE public.vermins TO bio_group;');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry_categories FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry_manufacturers FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.chemistry_vermins FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.culture_manufacturers FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.cultures FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.entomophages FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.entomophages_categories FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.entomophagies_vermins FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.manufacturers FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.providers FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.substrate_categories FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.substrate_category_manufacturers FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.varieties FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.vermin_categories FROM bio_group;');
        $this->addSql('REVOKE SELECT ON TABLE public.vermins FROM bio_group;');

    }
}
