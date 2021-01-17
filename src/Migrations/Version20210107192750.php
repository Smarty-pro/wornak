<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210107192750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE search_bar ADD user_id INT DEFAULT NULL, ADD location VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE search_bar ADD CONSTRAINT FK_B244F815A76ED395 FOREIGN KEY (user_id) REFERENCES job_seeker (id)');
        $this->addSql('CREATE INDEX IDX_B244F815A76ED395 ON search_bar (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE search_bar DROP FOREIGN KEY FK_B244F815A76ED395');
        $this->addSql('DROP INDEX IDX_B244F815A76ED395 ON search_bar');
        $this->addSql('ALTER TABLE search_bar DROP user_id, DROP location');
    }
}
