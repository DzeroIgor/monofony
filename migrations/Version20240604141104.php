<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604141104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_organisation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, enabled TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_organisation_membership (id INT AUTO_INCREMENT NOT NULL, organisation_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, position VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_verification_token VARCHAR(255) NOT NULL, verified DATETIME NOT NULL, enabled TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_1EE5A45E9E6B1585 (organisation_id), INDEX IDX_1EE5A45E9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_project (id INT AUTO_INCREMENT NOT NULL, organisation_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_C2EE50A39E6B1585 (organisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_task (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5750FE85166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_time_slot (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, duration VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', date DATETIME NOT NULL, INDEX IDX_A9DC767F8DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_organisation_membership ADD CONSTRAINT FK_1EE5A45E9E6B1585 FOREIGN KEY (organisation_id) REFERENCES app_organisation (id)');
        $this->addSql('ALTER TABLE app_organisation_membership ADD CONSTRAINT FK_1EE5A45E9395C3F3 FOREIGN KEY (customer_id) REFERENCES sylius_customer (id)');
        $this->addSql('ALTER TABLE app_project ADD CONSTRAINT FK_C2EE50A39E6B1585 FOREIGN KEY (organisation_id) REFERENCES app_organisation (id)');
        $this->addSql('ALTER TABLE app_task ADD CONSTRAINT FK_5750FE85166D1F9C FOREIGN KEY (project_id) REFERENCES app_project (id)');
        $this->addSql('ALTER TABLE app_time_slot ADD CONSTRAINT FK_A9DC767F8DB60186 FOREIGN KEY (task_id) REFERENCES app_task (id)');
        $this->addSql('ALTER TABLE app_vehicle ADD enabled TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_organisation_membership DROP FOREIGN KEY FK_1EE5A45E9E6B1585');
        $this->addSql('ALTER TABLE app_organisation_membership DROP FOREIGN KEY FK_1EE5A45E9395C3F3');
        $this->addSql('ALTER TABLE app_project DROP FOREIGN KEY FK_C2EE50A39E6B1585');
        $this->addSql('ALTER TABLE app_task DROP FOREIGN KEY FK_5750FE85166D1F9C');
        $this->addSql('ALTER TABLE app_time_slot DROP FOREIGN KEY FK_A9DC767F8DB60186');
        $this->addSql('DROP TABLE app_organisation');
        $this->addSql('DROP TABLE app_organisation_membership');
        $this->addSql('DROP TABLE app_project');
        $this->addSql('DROP TABLE app_task');
        $this->addSql('DROP TABLE app_time_slot');
        $this->addSql('ALTER TABLE app_vehicle DROP enabled');
    }
}
