<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210108192114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_job_seeker (company_id INT NOT NULL, job_seeker_id INT NOT NULL, INDEX IDX_6ED74EE4979B1AD6 (company_id), INDEX IDX_6ED74EE4C2C5BAA3 (job_seeker_id), PRIMARY KEY(company_id, job_seeker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company_job_seeker ADD CONSTRAINT FK_6ED74EE4979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_job_seeker ADD CONSTRAINT FK_6ED74EE4C2C5BAA3 FOREIGN KEY (job_seeker_id) REFERENCES job_seeker (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE company_job_seeker');
    }
}
