<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606140241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_task ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_task ADD CONSTRAINT FK_5750FE85F675F31B FOREIGN KEY (author_id) REFERENCES app_organisation_membership (id)');
        $this->addSql('CREATE INDEX IDX_5750FE85F675F31B ON app_task (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_task DROP FOREIGN KEY FK_5750FE85F675F31B');
        $this->addSql('DROP INDEX IDX_5750FE85F675F31B ON app_task');
        $this->addSql('ALTER TABLE app_task DROP author_id');
    }
}
