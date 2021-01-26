<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122171557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE job_seeker_job_post');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_seeker_job_post (job_seeker_id INT NOT NULL, job_post_id INT NOT NULL, INDEX IDX_AFBC988FC2C5BAA3 (job_seeker_id), INDEX IDX_AFBC988FD166B4B7 (job_post_id), PRIMARY KEY(job_seeker_id, job_post_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE job_seeker_job_post ADD CONSTRAINT FK_AFBC988FC2C5BAA3 FOREIGN KEY (job_seeker_id) REFERENCES job_seeker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_seeker_job_post ADD CONSTRAINT FK_AFBC988FD166B4B7 FOREIGN KEY (job_post_id) REFERENCES job_post (id) ON DELETE CASCADE');
    }
}
