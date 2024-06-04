<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528072038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sylius_currency (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_96EDD3D077153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sylius_exchange_rate (id INT AUTO_INCREMENT NOT NULL, source_currency INT NOT NULL, target_currency INT NOT NULL, ratio NUMERIC(10, 5) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_5F52B852A76BEED (source_currency), INDEX IDX_5F52B85B3FD5856 (target_currency), UNIQUE INDEX UNIQ_5F52B852A76BEEDB3FD5856 (source_currency, target_currency), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sylius_exchange_rate ADD CONSTRAINT FK_5F52B852A76BEED FOREIGN KEY (source_currency) REFERENCES sylius_currency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sylius_exchange_rate ADD CONSTRAINT FK_5F52B85B3FD5856 FOREIGN KEY (target_currency) REFERENCES sylius_currency (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sylius_exchange_rate DROP FOREIGN KEY FK_5F52B852A76BEED');
        $this->addSql('ALTER TABLE sylius_exchange_rate DROP FOREIGN KEY FK_5F52B85B3FD5856');
        $this->addSql('DROP TABLE sylius_currency');
        $this->addSql('DROP TABLE sylius_exchange_rate');
    }
}
