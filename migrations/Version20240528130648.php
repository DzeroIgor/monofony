<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240528130648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_vehicle (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, model_id INT DEFAULT NULL, category_id INT DEFAULT NULL, vin VARCHAR(255) NOT NULL, year DATETIME NOT NULL, weight INT NOT NULL, engine_volume INT NOT NULL, engine_number VARCHAR(255) NOT NULL, chassis_number VARCHAR(255) NOT NULL, number_of_place INT NOT NULL, state VARCHAR(255) NOT NULL, has_accident TINYINT(1) NOT NULL, color VARCHAR(255) NOT NULL, engine_type VARCHAR(255) NOT NULL, number_of_places VARCHAR(255) NOT NULL, INDEX IDX_F6DD64CB44F5D008 (brand_id), INDEX IDX_F6DD64CB7975B7E7 (model_id), INDEX IDX_F6DD64CB12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_vehicle_brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_vehicle_category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_vehicle_model (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, model VARCHAR(255) NOT NULL, INDEX IDX_2F47CF9944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_vehicle ADD CONSTRAINT FK_F6DD64CB44F5D008 FOREIGN KEY (brand_id) REFERENCES app_vehicle_brand (id)');
        $this->addSql('ALTER TABLE app_vehicle ADD CONSTRAINT FK_F6DD64CB7975B7E7 FOREIGN KEY (model_id) REFERENCES app_vehicle_model (id)');
        $this->addSql('ALTER TABLE app_vehicle ADD CONSTRAINT FK_F6DD64CB12469DE2 FOREIGN KEY (category_id) REFERENCES app_vehicle_category (id)');
        $this->addSql('ALTER TABLE app_vehicle_model ADD CONSTRAINT FK_2F47CF9944F5D008 FOREIGN KEY (brand_id) REFERENCES app_vehicle_brand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_vehicle DROP FOREIGN KEY FK_F6DD64CB44F5D008');
        $this->addSql('ALTER TABLE app_vehicle DROP FOREIGN KEY FK_F6DD64CB7975B7E7');
        $this->addSql('ALTER TABLE app_vehicle DROP FOREIGN KEY FK_F6DD64CB12469DE2');
        $this->addSql('ALTER TABLE app_vehicle_model DROP FOREIGN KEY FK_2F47CF9944F5D008');
        $this->addSql('DROP TABLE app_vehicle');
        $this->addSql('DROP TABLE app_vehicle_brand');
        $this->addSql('DROP TABLE app_vehicle_category');
        $this->addSql('DROP TABLE app_vehicle_model');
    }
}
