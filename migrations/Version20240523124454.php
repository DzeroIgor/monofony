<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523124454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_book_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, enabled TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_book ADD literature_category_id INT DEFAULT NULL, CHANGE literature_category code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE app_book ADD CONSTRAINT FK_CECB86912BB2FF2B FOREIGN KEY (literature_category_id) REFERENCES app_book_category (id)');
        $this->addSql('CREATE INDEX IDX_CECB86912BB2FF2B ON app_book (literature_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_book DROP FOREIGN KEY FK_CECB86912BB2FF2B');
        $this->addSql('DROP TABLE app_book_category');
        $this->addSql('DROP INDEX IDX_CECB86912BB2FF2B ON app_book');
        $this->addSql('ALTER TABLE app_book DROP literature_category_id, CHANGE code literature_category VARCHAR(255) NOT NULL');
    }
}
