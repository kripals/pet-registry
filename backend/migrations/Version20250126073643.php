<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126073643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE breed (id INT AUTO_INCREMENT NOT NULL, pet_type_id INT NOT NULL, breed_name VARCHAR(100) NOT NULL, is_dangerous TINYINT(1) NOT NULL, INDEX IDX_F8AF884FDB020C75 (pet_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, phone_no VARCHAR(20) NOT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet_breed (id INT AUTO_INCREMENT NOT NULL, breed_id INT NOT NULL, pet_detail_id INT NOT NULL, INDEX IDX_55D348ECA8B4A30F (breed_id), INDEX IDX_55D348EC3D4CCABF (pet_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet_detail (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, age INT NOT NULL, gender VARCHAR(20) NOT NULL, dob DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet_detail_breed (pet_detail_id INT NOT NULL, breed_id INT NOT NULL, INDEX IDX_61D758473D4CCABF (pet_detail_id), INDEX IDX_61D75847A8B4A30F (breed_id), PRIMARY KEY(pet_detail_id, breed_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registration (id INT AUTO_INCREMENT NOT NULL, pet_detail_id INT NOT NULL, owner_id INT NOT NULL, registration_no VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_62A8A7A75BAEC00C (registration_no), INDEX IDX_62A8A7A73D4CCABF (pet_detail_id), INDEX IDX_62A8A7A77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE breed ADD CONSTRAINT FK_F8AF884FDB020C75 FOREIGN KEY (pet_type_id) REFERENCES pet_type (id)');
        $this->addSql('ALTER TABLE pet_breed ADD CONSTRAINT FK_55D348ECA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id)');
        $this->addSql('ALTER TABLE pet_breed ADD CONSTRAINT FK_55D348EC3D4CCABF FOREIGN KEY (pet_detail_id) REFERENCES pet_detail (id)');
        $this->addSql('ALTER TABLE pet_detail_breed ADD CONSTRAINT FK_61D758473D4CCABF FOREIGN KEY (pet_detail_id) REFERENCES pet_detail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pet_detail_breed ADD CONSTRAINT FK_61D75847A8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A73D4CCABF FOREIGN KEY (pet_detail_id) REFERENCES pet_detail (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A77E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE breed DROP FOREIGN KEY FK_F8AF884FDB020C75');
        $this->addSql('ALTER TABLE pet_breed DROP FOREIGN KEY FK_55D348ECA8B4A30F');
        $this->addSql('ALTER TABLE pet_breed DROP FOREIGN KEY FK_55D348EC3D4CCABF');
        $this->addSql('ALTER TABLE pet_detail_breed DROP FOREIGN KEY FK_61D758473D4CCABF');
        $this->addSql('ALTER TABLE pet_detail_breed DROP FOREIGN KEY FK_61D75847A8B4A30F');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A73D4CCABF');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A77E3C61F9');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE pet_breed');
        $this->addSql('DROP TABLE pet_detail');
        $this->addSql('DROP TABLE pet_detail_breed');
        $this->addSql('DROP TABLE pet_type');
        $this->addSql('DROP TABLE registration');
        $this->addSql('DROP TABLE user');
    }
}
