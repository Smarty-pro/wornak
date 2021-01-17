<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111164522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1979B1AD6');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1C2C5BAA3');
        $this->addSql('DROP INDEX IDX_17FD46C1979B1AD6 ON alert');
        $this->addSql('DROP INDEX IDX_17FD46C1C2C5BAA3 ON alert');
        $this->addSql('ALTER TABLE alert ADD user_id INT DEFAULT NULL, DROP company_id, DROP job_seeker_id');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_17FD46C1A76ED395 ON alert (user_id)');
        $this->addSql('ALTER TABLE job_seeker DROP is_verified');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1A76ED395');
        $this->addSql('DROP INDEX IDX_17FD46C1A76ED395 ON alert');
        $this->addSql('ALTER TABLE alert ADD job_seeker_id INT DEFAULT NULL, CHANGE user_id company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1C2C5BAA3 FOREIGN KEY (job_seeker_id) REFERENCES job_seeker (id)');
        $this->addSql('CREATE INDEX IDX_17FD46C1979B1AD6 ON alert (company_id)');
        $this->addSql('CREATE INDEX IDX_17FD46C1C2C5BAA3 ON alert (job_seeker_id)');
        $this->addSql('ALTER TABLE job_seeker ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
