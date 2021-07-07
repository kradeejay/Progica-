<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706213736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, superficy INT NOT NULL, bedroom INT NOT NULL, nb_bed INT NOT NULL, animals TINYINT(1) NOT NULL, price_animals DOUBLE PRECISION NOT NULL, price_hight_season DOUBLE PRECISION NOT NULL, price_low_season DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, descript LONGTEXT NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lng DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_equipement (gite_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_56A3B31A652CAE9B (gite_id), INDEX IDX_56A3B31A806F0F5C (equipement_id), PRIMARY KEY(gite_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_service (gite_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_1527AE9A652CAE9B (gite_id), INDEX IDX_1527AE9AED5CA9E6 (service_id), PRIMARY KEY(gite_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gite_equipement ADD CONSTRAINT FK_56A3B31A652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_equipement ADD CONSTRAINT FK_56A3B31A806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9A652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gite_equipement DROP FOREIGN KEY FK_56A3B31A806F0F5C');
        $this->addSql('ALTER TABLE gite_equipement DROP FOREIGN KEY FK_56A3B31A652CAE9B');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9A652CAE9B');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9AED5CA9E6');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE gite');
        $this->addSql('DROP TABLE gite_equipement');
        $this->addSql('DROP TABLE gite_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
    }
}
