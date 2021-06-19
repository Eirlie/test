<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210619143817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE http_log ALTER ip DROP NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER request DROP NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER response DROP NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER status_code DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE http_log ALTER ip SET NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER request SET NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER response SET NOT NULL');
        $this->addSql('ALTER TABLE http_log ALTER status_code SET NOT NULL');
    }
}
