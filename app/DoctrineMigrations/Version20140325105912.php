<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140325105912 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('
        DO
            $body$
            BEGIN
               IF NOT EXISTS (
                  SELECT *
                  FROM   pg_catalog.pg_roles
                  WHERE  rolname = \'bio_group\') THEN

                  CREATE ROLE bio_group;
               END IF;
            END
            $body$
        ');
        //$this->addSql("CREATE ROLE bio_group");

        $username = $this->connection->getUsername();

        $this->addSql("
            CREATE OR REPLACE VIEW public.client_view AS
            SELECT
                c.id,
                c.email,
                c.password,
                c.salt,
                c.role,
                c.token,
                c.token_created,
                c.reg_ip,
                c.reg_dtm,
                c.login_ip,
                c.login_dtm,
                c.db_role_id,
                c.created,
                c.updated
            FROM
                client c
            LEFT JOIN
                dbrole dr ON dr.id = c.db_role_id
            WHERE
                current_user = '{$username}'
            OR
                current_user = dr.role;
    	");

        $this->addSql("
        CREATE OR REPLACE RULE client_insert AS
           ON INSERT TO public.client_view
           DO INSTEAD
        INSERT INTO client (
            id,
            email,
            password,
            salt,
            role,
            token,
            token_created,
            reg_ip,
            reg_dtm,
            login_ip,
            login_dtm,
            db_role_id,
            created,
            updated
        ) VALUES (
            nextval('client_id_seq'),
            new.email,
            new.password,
            new.salt,
            new.role,
            new.token,
            new.token_created,
            new.reg_ip,
            new.reg_dtm,
            new.login_ip,
            new.login_dtm,
            (
                CASE
                    WHEN current_user = '{$username}' THEN new.db_role_id
                    ELSE (SELECT dr.id FROM dbrole dr WHERE dr.role = current_user LIMIT 1)
                END
            ),
            new.created,
            new.updated

        ) RETURNING
            client.id,
            client.email,
            client.password,
            client.salt,
            client.role,
            client.token,
            client.token_created,
            client.reg_ip,
            client.reg_dtm,
            client.login_ip,
            client.login_dtm,
            client.db_role_id,
            client.created,
            client.updated;
        ");

        $this->addSql("
            CREATE OR REPLACE RULE client_update AS
               ON UPDATE TO public.client_view
               DO INSTEAD
               UPDATE client
                SET
                email = new.email,
                password = new.password,
                salt = new.salt,
                role = new.role,
                token = new.token,
                token_created = new.token_created,
                reg_ip = new.reg_ip,
                reg_dtm = new.reg_dtm,
                login_ip = new.login_ip,
                login_dtm = new.login_dtm,
                created = new.created,
                updated = new.updated,
                db_role_id = (
                    CASE
                        WHEN current_user = '{$username}' THEN new.db_role_id
                        ELSE old.db_role_id
                    END
                )
                WHERE
                    (old.db_role_id = (SELECT dr.id FROM dbrole dr WHERE dr.role = current_user) OR current_user = '{$username}')
                AND
                    id = old.id
                RETURNING new.*;
        ");

        $this->addSql("
            CREATE OR REPLACE RULE client_delete AS
               ON DELETE TO public.client_view
               DO INSTEAD
                DELETE FROM
                    client
                WHERE
                    id = old.id
                AND
                    (old.id IN (SELECT c.id FROM client c LEFT JOIN dbrole dr ON dr.id = c.db_role_id WHERE dr.role = current_user) OR current_user = '{$username}')
                RETURNING old.*;
        ");

        $this->addSql("GRANT SELECT, UPDATE, DELETE, INSERT ON public.client_view TO bio_group;");
        $this->addSql("GRANT SELECT ON client_id_seq TO bio_group;");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("REVOKE SELECT ON client_id_seq FROM bio_group");
        $this->addSql("REVOKE SELECT, UPDATE, DELETE, INSERT ON public.client_view FROM bio_group");
        $this->addSql("DROP RULE client_delete ON public.client_view");
        $this->addSql("DROP RULE client_update ON public.client_view");
        $this->addSql("DROP RULE client_insert ON public.client_view");
        $this->addSql("DROP VIEW public.client_view");
        //$this->addSql("DROP ROLE bio_group");
    }
}
