<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210126191051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D6496AE4741E, ADD UNIQUE INDEX UNIQ_8D93D6496AE4741E (companies_id)');
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D6494CF2B5A9, ADD UNIQUE INDEX UNIQ_8D93D6494CF2B5A9 (jobseeker_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D6496AE4741E, ADD INDEX IDX_8D93D6496AE4741E (companies_id)');
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D6494CF2B5A9, ADD INDEX IDX_8D93D6494CF2B5A9 (jobseeker_id)');
    }
}
