<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514174910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, types_sport_id INT NOT NULL, name VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, title_image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BFDD3168631F5BD6 (types_sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, city_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, articles_id INT DEFAULT NULL, photo_filename VARCHAR(255) DEFAULT NULL, INDEX IDX_E01FBE6A1EBAF6CC (articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, sections_id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', positive LONGTEXT DEFAULT NULL, negative LONGTEXT DEFAULT NULL, text_review LONGTEXT DEFAULT NULL, rating INT NOT NULL, INDEX IDX_6970EB0F577906E4 (sections_id), INDEX IDX_6970EB0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sections (id INT AUTO_INCREMENT NOT NULL, cities_id INT NOT NULL, types_sport_id INT NOT NULL, name VARCHAR(255) NOT NULL, price INT DEFAULT NULL, it_free TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, contact_phone VARCHAR(15) NOT NULL, contact_email VARCHAR(255) NOT NULL, for_who LONGTEXT NOT NULL, format LONGTEXT NOT NULL, count_places INT NOT NULL, soft_delete TINYINT(1) NOT NULL, address VARCHAR(255) NOT NULL, link_to_map LONGTEXT NOT NULL, INDEX IDX_2B964398CAC75398 (cities_id), INDEX IDX_2B964398631F5BD6 (types_sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_sport (id INT AUTO_INCREMENT NOT NULL, sport_name VARCHAR(255) NOT NULL, entries INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, login VARCHAR(50) NOT NULL, name VARCHAR(60) NOT NULL, surname VARCHAR(60) NOT NULL, patronymic VARCHAR(60) NOT NULL, phone_number VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168631F5BD6 FOREIGN KEY (types_sport_id) REFERENCES type_sport (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0F577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sections ADD CONSTRAINT FK_2B964398CAC75398 FOREIGN KEY (cities_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE sections ADD CONSTRAINT FK_2B964398631F5BD6 FOREIGN KEY (types_sport_id) REFERENCES type_sport (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168631F5BD6');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A1EBAF6CC');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0F577906E4');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FA76ED395');
        $this->addSql('ALTER TABLE sections DROP FOREIGN KEY FK_2B964398CAC75398');
        $this->addSql('ALTER TABLE sections DROP FOREIGN KEY FK_2B964398631F5BD6');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE sections');
        $this->addSql('DROP TABLE type_sport');
        $this->addSql('DROP TABLE user');
    }
}
