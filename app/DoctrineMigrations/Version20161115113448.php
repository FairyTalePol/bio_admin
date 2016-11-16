<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161115113448 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('CREATE OR REPLACE FUNCTION get_translations()
  RETURNS JSONB AS
  $BODY$
  SELECT json_object_agg(
             l.locale,
             (SELECT json_object_agg(t.name, tr.value) :: JSONB
              FROM
                translations tr
                LEFT JOIN
                terms t ON t.id = tr.term_id
              WHERE
                tr.language_id = l.id
             )) :: JSONB result
  FROM
    languages l
  WHERE
    exists(SELECT 1 AS a
           FROM translations _t
           WHERE _t.language_id = l.id
           LIMIT 1);
  $BODY$ LANGUAGE SQL SECURITY DEFINER;
        ');

        $this->addSql('GRANT EXECUTE ON FUNCTION get_translations() TO GROUP bio_group;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('REVOKE ALL ON FUNCTION get_translations() FROM GROUP bio_group;');

        $this->addSql('DROP FUNCTION IF EXISTS get_translations()');
    }
}
