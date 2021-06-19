<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619143016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE http_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE http_log (id INT NOT NULL, url VARCHAR(1024) NOT NULL, ip VARCHAR(40) NOT NULL, request TEXT NOT NULL, request_headers TEXT NOT NULL, response TEXT NOT NULL, response_headers TEXT NOT NULL, status_code SMALLINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX ip_index ON http_log (ip)');
        $this->addSql('CREATE INDEX url_index ON http_log (url)');
        $this->addSql('COMMENT ON COLUMN http_log.request_headers IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN http_log.response_headers IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN http_log.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE http_log_id_seq CASCADE');
        $this->addSql('DROP TABLE http_log');
    }
}
