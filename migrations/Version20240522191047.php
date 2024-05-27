<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522191047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compare_section (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, csections_id INT NOT NULL, INDEX IDX_7A47B03BA76ED395 (user_id), INDEX IDX_7A47B03B18E7CF9F (csections_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_entries (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, sections_id INT NOT NULL, INDEX IDX_75F5ADCFA76ED395 (user_id), INDEX IDX_75F5ADCF577906E4 (sections_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compare_section ADD CONSTRAINT FK_7A47B03BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE compare_section ADD CONSTRAINT FK_7A47B03B18E7CF9F FOREIGN KEY (csections_id) REFERENCES sections (id)');
        $this->addSql('ALTER TABLE user_entries ADD CONSTRAINT FK_75F5ADCFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_entries ADD CONSTRAINT FK_75F5ADCF577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id)');
        $this->addSql('DROP TABLE messenger_messages');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E016BA31DB (delivered_at), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E0FB7336F0 (queue_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE compare_section DROP FOREIGN KEY FK_7A47B03BA76ED395');
        $this->addSql('ALTER TABLE compare_section DROP FOREIGN KEY FK_7A47B03B18E7CF9F');
        $this->addSql('ALTER TABLE user_entries DROP FOREIGN KEY FK_75F5ADCFA76ED395');
        $this->addSql('ALTER TABLE user_entries DROP FOREIGN KEY FK_75F5ADCF577906E4');
        $this->addSql('DROP TABLE compare_section');
        $this->addSql('DROP TABLE user_entries');
    }
}
