<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191129102947 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE substrates ADD name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE substrates ADD description_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD short_name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD description_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD dis_description1_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD dis_description2_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD dis_description3_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD dis_description4_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE vermins ADD dis_description5_en TEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_75C7AEF73D773AC4 ON vermins (name_en)');
        $this->addSql('ALTER TABLE entomophages ADD name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD short_name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD description_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD prophylaxy_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE entomophages ADD norm_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3E0A41523D773AC4 ON entomophages (name_en)');
        $this->addSql('ALTER TABLE blights ADD name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD short_name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD description_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD dis_description1_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD dis_description2_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD dis_description3_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD dis_description4_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE blights ADD dis_description5_en TEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_83B91F93D773AC4 ON blights (name_en)');
        $this->addSql('ALTER TABLE varieties ADD name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE varieties ADD description_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE varieties ADD form_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE varieties ADD color_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF211793D773AC4 ON varieties (name_en)');
        $this->addSql('ALTER TABLE chemistry ADD name_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD description_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD prophylaxy_en TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD volume_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD norm_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD chemistry_class_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE chemistry ADD action_mechanism_en VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_678D65293D773AC4 ON chemistry (name_en)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP INDEX UNIQ_83B91F93D773AC4');
        $this->addSql('ALTER TABLE blights DROP name_en');
        $this->addSql('ALTER TABLE blights DROP short_name_en');
        $this->addSql('ALTER TABLE blights DROP description_en');
        $this->addSql('ALTER TABLE blights DROP dis_description1_en');
        $this->addSql('ALTER TABLE blights DROP dis_description2_en');
        $this->addSql('ALTER TABLE blights DROP dis_description3_en');
        $this->addSql('ALTER TABLE blights DROP dis_description4_en');
        $this->addSql('ALTER TABLE blights DROP dis_description5_en');
        $this->addSql('DROP INDEX UNIQ_678D65293D773AC4');
        $this->addSql('ALTER TABLE chemistry DROP name_en');
        $this->addSql('ALTER TABLE chemistry DROP description_en');
        $this->addSql('ALTER TABLE chemistry DROP prophylaxy_en');
        $this->addSql('ALTER TABLE chemistry DROP volume_en');
        $this->addSql('ALTER TABLE chemistry DROP norm_en');
        $this->addSql('ALTER TABLE chemistry DROP chemistry_class_en');
        $this->addSql('ALTER TABLE chemistry DROP action_mechanism_en');
        $this->addSql('DROP INDEX UNIQ_EF211793D773AC4');
        $this->addSql('ALTER TABLE varieties DROP name_en');
        $this->addSql('ALTER TABLE varieties DROP description_en');
        $this->addSql('ALTER TABLE varieties DROP form_en');
        $this->addSql('ALTER TABLE varieties DROP color_en');
        $this->addSql('ALTER TABLE substrates DROP name_en');
        $this->addSql('ALTER TABLE substrates DROP description_en');
        $this->addSql('DROP INDEX UNIQ_75C7AEF73D773AC4');
        $this->addSql('ALTER TABLE vermins DROP name_en');
        $this->addSql('ALTER TABLE vermins DROP short_name_en');
        $this->addSql('ALTER TABLE vermins DROP description_en');
        $this->addSql('ALTER TABLE vermins DROP dis_description1_en');
        $this->addSql('ALTER TABLE vermins DROP dis_description2_en');
        $this->addSql('ALTER TABLE vermins DROP dis_description3_en');
        $this->addSql('ALTER TABLE vermins DROP dis_description4_en');
        $this->addSql('ALTER TABLE vermins DROP dis_description5_en');
        $this->addSql('DROP INDEX UNIQ_3E0A41523D773AC4');
        $this->addSql('ALTER TABLE entomophages DROP name_en');
        $this->addSql('ALTER TABLE entomophages DROP short_name_en');
        $this->addSql('ALTER TABLE entomophages DROP description_en');
        $this->addSql('ALTER TABLE entomophages DROP prophylaxy_en');
        $this->addSql('ALTER TABLE entomophages DROP norm_en');
    }
}
