<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524113643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_book_cover (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_book ADD cover_id INT DEFAULT NULL, ADD published_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE app_book ADD CONSTRAINT FK_CECB8691922726E9 FOREIGN KEY (cover_id) REFERENCES app_book_cover (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CECB8691922726E9 ON app_book (cover_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_book DROP FOREIGN KEY FK_CECB8691922726E9');
        $this->addSql('DROP TABLE app_book_cover');
        $this->addSql('DROP INDEX UNIQ_CECB8691922726E9 ON app_book');
        $this->addSql('ALTER TABLE app_book DROP cover_id, DROP published_at');
    }
}
