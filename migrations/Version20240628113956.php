<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240628113956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_organisation_membership DROP FOREIGN KEY FK_1EE5A45E9395C3F3');
        $this->addSql('ALTER TABLE app_organisation_membership DROP FOREIGN KEY FK_1EE5A45E9E6B1585');
        $this->addSql('ALTER TABLE app_organisation_membership ADD CONSTRAINT FK_1EE5A45E9395C3F3 FOREIGN KEY (customer_id) REFERENCES sylius_customer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_organisation_membership ADD CONSTRAINT FK_1EE5A45E9E6B1585 FOREIGN KEY (organisation_id) REFERENCES app_organisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_project DROP FOREIGN KEY FK_C2EE50A39E6B1585');
        $this->addSql('ALTER TABLE app_project ADD CONSTRAINT FK_C2EE50A39E6B1585 FOREIGN KEY (organisation_id) REFERENCES app_organisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_task DROP FOREIGN KEY FK_5750FE85166D1F9C');
        $this->addSql('ALTER TABLE app_task CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_task ADD CONSTRAINT FK_5750FE85166D1F9C FOREIGN KEY (project_id) REFERENCES app_project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_time_slot DROP FOREIGN KEY FK_A9DC767F8DB60186');
        $this->addSql('ALTER TABLE app_time_slot CHANGE duration duration VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:dateinterval)\', CHANGE date date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE app_time_slot ADD CONSTRAINT FK_A9DC767F8DB60186 FOREIGN KEY (task_id) REFERENCES app_task (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_organisation_membership DROP FOREIGN KEY FK_1EE5A45E9E6B1585');
        $this->addSql('ALTER TABLE app_organisation_membership DROP FOREIGN KEY FK_1EE5A45E9395C3F3');
        $this->addSql('ALTER TABLE app_organisation_membership ADD CONSTRAINT FK_1EE5A45E9E6B1585 FOREIGN KEY (organisation_id) REFERENCES app_organisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE app_organisation_membership ADD CONSTRAINT FK_1EE5A45E9395C3F3 FOREIGN KEY (customer_id) REFERENCES sylius_customer (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE app_project DROP FOREIGN KEY FK_C2EE50A39E6B1585');
        $this->addSql('ALTER TABLE app_project ADD CONSTRAINT FK_C2EE50A39E6B1585 FOREIGN KEY (organisation_id) REFERENCES app_organisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE app_task DROP FOREIGN KEY FK_5750FE85166D1F9C');
        $this->addSql('ALTER TABLE app_task CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE app_task ADD CONSTRAINT FK_5750FE85166D1F9C FOREIGN KEY (project_id) REFERENCES app_project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE app_time_slot DROP FOREIGN KEY FK_A9DC767F8DB60186');
        $this->addSql('ALTER TABLE app_time_slot CHANGE duration duration VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE app_time_slot ADD CONSTRAINT FK_A9DC767F8DB60186 FOREIGN KEY (task_id) REFERENCES app_task (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
