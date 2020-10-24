<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023202748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX IDX_8D93D649EFD5657E ON user');
        $this->addSql('ALTER TABLE user ADD jobseeker_id INT DEFAULT NULL, DROP jobseaker2_id, CHANGE companies_id companies_id INT DEFAULT NULL, CHANGE activation_token activation_token VARCHAR(255) DEFAULT NULL, CHANGE tel tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494CF2B5A9 FOREIGN KEY (jobseeker_id) REFERENCES job_seeker (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496AE4741E FOREIGN KEY (companies_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494CF2B5A9 ON user (jobseeker_id)');
        $this->addSql('ALTER TABLE job_seeker DROP FOREIGN KEY FK_D359A772C1B5D5CA');
        $this->addSql('DROP INDEX UNIQ_D359A772C1B5D5CA ON job_seeker');
        $this->addSql('ALTER TABLE job_seeker ADD uuid INT DEFAULT NULL, DROP uuid_id, CHANGE roles roles JSON NOT NULL, CHANGE diploma diploma VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE company2 (id INT AUTO_INCREMENT NOT NULL, uuid INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE job_seeker2 (id INT AUTO_INCREMENT NOT NULL, uuid INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE company ADD uuid_id INT DEFAULT NULL, DROP uuid, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FC1B5D5CA FOREIGN KEY (uuid_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094FC1B5D5CA ON company (uuid_id)');
        $this->addSql('ALTER TABLE job_post CHANGE training training VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE job_seeker ADD uuid_id INT DEFAULT NULL, DROP uuid, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE diploma diploma VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE job_seeker ADD CONSTRAINT FK_D359A772C1B5D5CA FOREIGN KEY (uuid_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D359A772C1B5D5CA ON job_seeker (uuid_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494CF2B5A9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496AE4741E');
        $this->addSql('DROP INDEX IDX_8D93D6494CF2B5A9 ON user');
        $this->addSql('ALTER TABLE user ADD jobseaker2_id INT DEFAULT NULL, DROP jobseeker_id, CHANGE companies_id companies_id INT DEFAULT NULL, CHANGE activation_token activation_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EFD5657E FOREIGN KEY (jobseaker2_id) REFERENCES job_seeker2 (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496AE4741E FOREIGN KEY (companies_id) REFERENCES company2 (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649EFD5657E ON user (jobseaker2_id)');
    }
}
