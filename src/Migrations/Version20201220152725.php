<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220152725 extends AbstractMigration
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
        $this->addSql('DROP TABLE migration_versions');
        $this->addSql('ALTER TABLE company CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE job_post DROP tags, CHANGE training training VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE job_seeker CHANGE roles roles JSON NOT NULL, CHANGE diploma diploma VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE slug slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE companies_id companies_id INT DEFAULT NULL, CHANGE jobseeker_id jobseeker_id INT DEFAULT NULL, CHANGE activation_token activation_token VARCHAR(255) DEFAULT NULL, CHANGE tel tel INT DEFAULT NULL, CHANGE roles roles JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE migration_versions (version VARCHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(version)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE tag_job_post');
        $this->addSql('ALTER TABLE company CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE job_post ADD tags VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE training training VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE job_seeker CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE diploma diploma VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tag CHANGE slug slug VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE companies_id companies_id INT DEFAULT NULL, CHANGE jobseeker_id jobseeker_id INT DEFAULT NULL, CHANGE activation_token activation_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`');
    }
}
