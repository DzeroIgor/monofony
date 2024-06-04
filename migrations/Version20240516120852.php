<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516120852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_comment ADD post_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_comment ADD CONSTRAINT FK_7929D2214B89032C FOREIGN KEY (post_id) REFERENCES app_article (id)');
        $this->addSql('CREATE INDEX IDX_7929D2214B89032C ON app_comment (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_comment DROP FOREIGN KEY FK_7929D2214B89032C');
        $this->addSql('DROP INDEX IDX_7929D2214B89032C ON app_comment');
        $this->addSql('ALTER TABLE app_comment DROP post_id');
    }
}
