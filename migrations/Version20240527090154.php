<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527090154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_book_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_72A0EBB22C2AC5D3 (translatable_id), UNIQUE INDEX app_book_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_book_translation ADD CONSTRAINT FK_72A0EBB22C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_book DROP title');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_book_translation DROP FOREIGN KEY FK_72A0EBB22C2AC5D3');
        $this->addSql('DROP TABLE app_book_translation');
        $this->addSql('ALTER TABLE app_book ADD title VARCHAR(255) NOT NULL');
    }
}
