<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201226111005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_job_post (tag_id INT NOT NULL, job_post_id INT NOT NULL, INDEX IDX_EB776117BAD26311 (tag_id), INDEX IDX_EB776117D166B4B7 (job_post_id), PRIMARY KEY(tag_id, job_post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_job_post ADD CONSTRAINT FK_EB776117BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_job_post ADD CONSTRAINT FK_EB776117D166B4B7 FOREIGN KEY (job_post_id) REFERENCES job_post (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tag_job_post');
    }
}
