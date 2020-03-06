<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161102102923 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE languages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE terms_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE translations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE languages (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A0D153795E237E06 ON languages (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A0D153794180C698 ON languages (locale)');
        $this->addSql('CREATE TABLE terms (id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88A23F715E237E06 ON terms (name)');
        $this->addSql('CREATE TABLE translations (id INT NOT NULL, language_id INT NOT NULL, term_id INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, value TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C6B7DA8782F1BAF4 ON translations (language_id)');
        $this->addSql('CREATE INDEX IDX_C6B7DA87E2C35FC ON translations (term_id)');
        $this->addSql('CREATE INDEX translation_search_idx ON translations (language_id, value)');
        $this->addSql('CREATE UNIQUE INDEX translation_uniq ON translations (term_id, language_id)');
        $this->addSql('ALTER TABLE translations ADD CONSTRAINT FK_C6B7DA8782F1BAF4 FOREIGN KEY (language_id) REFERENCES languages (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE translations ADD CONSTRAINT FK_C6B7DA87E2C35FC FOREIGN KEY (term_id) REFERENCES terms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER INDEX uniq_c0e80163e7927c74 RENAME TO email_uniq');
        $this->addSql('ALTER INDEX uniq_c0e801635f37a13b RENAME TO token_uniq');
        $this->addSql('ALTER INDEX uniq_d12718b857698a6a RENAME TO pg_role_uniq');
        $this->addSql('ALTER INDEX uniq_d12718b8a7a91e0b RENAME TO domain_uniq');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE translations DROP CONSTRAINT FK_C6B7DA8782F1BAF4');
        $this->addSql('ALTER TABLE translations DROP CONSTRAINT FK_C6B7DA87E2C35FC');
        $this->addSql('DROP SEQUENCE languages_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE terms_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE translations_id_seq CASCADE');
        $this->addSql('DROP TABLE languages');
        $this->addSql('DROP TABLE terms');
        $this->addSql('DROP TABLE translations');
        $this->addSql('ALTER INDEX pg_role_uniq RENAME TO uniq_d12718b857698a6a');
        $this->addSql('ALTER INDEX domain_uniq RENAME TO uniq_d12718b8a7a91e0b');
        $this->addSql('ALTER INDEX token_uniq RENAME TO uniq_c0e801635f37a13b');
        $this->addSql('ALTER INDEX email_uniq RENAME TO uniq_c0e80163e7927c74');
    }
}
