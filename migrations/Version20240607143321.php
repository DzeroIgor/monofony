<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240607143321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_task ADD assignee_id INT DEFAULT NULL, CHANGE status status VARCHAR(255) DEFAULT \'New\' NOT NULL');
        $this->addSql('ALTER TABLE app_task ADD CONSTRAINT FK_5750FE8559EC7D60 FOREIGN KEY (assignee_id) REFERENCES app_organisation_membership (id)');
        $this->addSql('CREATE INDEX IDX_5750FE8559EC7D60 ON app_task (assignee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_task DROP FOREIGN KEY FK_5750FE8559EC7D60');
        $this->addSql('DROP INDEX IDX_5750FE8559EC7D60 ON app_task');
        $this->addSql('ALTER TABLE app_task DROP assignee_id, CHANGE status status VARCHAR(255) NOT NULL');
    }
}
