<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626122859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_invoice (id INT AUTO_INCREMENT NOT NULL, organisation_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, additional VARCHAR(255) NOT NULL, billing_data DATETIME NOT NULL, due_date DATETIME NOT NULL, issued_at DATETIME NOT NULL, amount INT NOT NULL, total INT NOT NULL, INDEX IDX_7D3897099E6B1585 (organisation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_invoice ADD CONSTRAINT FK_7D3897099E6B1585 FOREIGN KEY (organisation_id) REFERENCES app_organisation (id)');
        $this->addSql('ALTER TABLE app_catalogue ADD code VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_invoice DROP FOREIGN KEY FK_7D3897099E6B1585');
        $this->addSql('DROP TABLE app_invoice');
        $this->addSql('ALTER TABLE app_catalogue DROP code');
    }
}
