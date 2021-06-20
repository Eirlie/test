<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619165430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE http_log ALTER request_headers TYPE TEXT');
        $this->addSql('ALTER TABLE http_log ALTER request_headers DROP DEFAULT');
        $this->addSql('ALTER TABLE http_log ALTER request_headers DROP NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER response_headers TYPE TEXT');
        $this->addSql('ALTER TABLE http_log ALTER response_headers DROP DEFAULT');
        $this->addSql('ALTER TABLE http_log ALTER response_headers DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN http_log.request_headers IS NULL');
        $this->addSql('COMMENT ON COLUMN http_log.response_headers IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE http_log ALTER request_headers TYPE TEXT');
        $this->addSql('ALTER TABLE http_log ALTER request_headers DROP DEFAULT');
        $this->addSql('ALTER TABLE http_log ALTER request_headers SET NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER response_headers TYPE TEXT');
        $this->addSql('ALTER TABLE http_log ALTER response_headers DROP DEFAULT');
        $this->addSql('ALTER TABLE http_log ALTER response_headers SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN http_log.request_headers IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN http_log.response_headers IS \'(DC2Type:array)\'');
    }
}
