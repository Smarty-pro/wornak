<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201019212918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job_post CHANGE training training VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_4FBF094FD17F50A6 ON company');
        $this->addSql('ALTER TABLE company ADD uuid_id INT NOT NULL, DROP uuid, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FC1B5D5CA FOREIGN KEY (uuid_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094FC1B5D5CA ON company (uuid_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AAA75D2B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E1E7CF1D');
        $this->addSql('DROP INDEX UNIQ_8D93D649AAA75D2B ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E1E7CF1D ON user');
        $this->addSql('ALTER TABLE user DROP jobseeker_uuid_id, DROP company_uuid_id, CHANGE group_id_id group_id_id INT DEFAULT NULL, CHANGE activation_token activation_token VARCHAR(255) DEFAULT NULL, CHANGE tel tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job_seeker ADD uuid_id INT NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE diploma diploma VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE job_seeker ADD CONSTRAINT FK_D359A772C1B5D5CA FOREIGN KEY (uuid_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D359A772C1B5D5CA ON job_seeker (uuid_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FC1B5D5CA');
        $this->addSql('DROP INDEX UNIQ_4FBF094FC1B5D5CA ON company');
        $this->addSql('ALTER TABLE company ADD uuid VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP uuid_id, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094FD17F50A6 ON company (uuid)');
        $this->addSql('ALTER TABLE job_post CHANGE training training VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE job_seeker DROP FOREIGN KEY FK_D359A772C1B5D5CA');
        $this->addSql('DROP INDEX UNIQ_D359A772C1B5D5CA ON job_seeker');
        $this->addSql('ALTER TABLE job_seeker DROP uuid_id, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE diploma diploma VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD jobseeker_uuid_id INT DEFAULT NULL, ADD company_uuid_id INT DEFAULT NULL, CHANGE group_id_id group_id_id INT DEFAULT NULL, CHANGE activation_token activation_token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AAA75D2B FOREIGN KEY (jobseeker_uuid_id) REFERENCES job_seeker (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E1E7CF1D FOREIGN KEY (company_uuid_id) REFERENCES company (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AAA75D2B ON user (jobseeker_uuid_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E1E7CF1D ON user (company_uuid_id)');
    }
}
