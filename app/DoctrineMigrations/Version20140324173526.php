<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140324173526 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("CREATE SEQUENCE Client_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE SEQUENCE DBRole_id_seq INCREMENT BY 1 MINVALUE 1 START 1");
        $this->addSql("CREATE TABLE Client (id INT NOT NULL, db_role_id INT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, token_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, reg_ip VARCHAR(255) NOT NULL, reg_dtm TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, login_ip VARCHAR(255) DEFAULT NULL, login_dtm TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_C0E80163E7927C74 ON Client (email)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_C0E801635F37A13B ON Client (token)");
        $this->addSql("CREATE INDEX IDX_C0E801638E7A79E6 ON Client (db_role_id)");
        $this->addSql("CREATE TABLE DBRole (id INT NOT NULL, role VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))");
        $this->addSql("ALTER TABLE Client ADD CONSTRAINT FK_C0E801638E7A79E6 FOREIGN KEY (db_role_id) REFERENCES DBRole (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "postgresql", "Migration can only be executed safely on 'postgresql'.");
        
        $this->addSql("ALTER TABLE Client DROP CONSTRAINT FK_C0E801638E7A79E6");
        $this->addSql("DROP SEQUENCE Client_id_seq CASCADE");
        $this->addSql("DROP SEQUENCE DBRole_id_seq CASCADE");
        $this->addSql("DROP TABLE Client");
        $this->addSql("DROP TABLE DBRole");
    }
}
