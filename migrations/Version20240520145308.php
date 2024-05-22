<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240520145308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_sport ADD title_image LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_identifier_email TO UNIQ_8D93D649E7927C74');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_identifier_login TO UNIQ_8D93D649AA08CB10');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649e7927c74 TO UNIQ_IDENTIFIER_EMAIL');
        $this->addSql('ALTER TABLE user RENAME INDEX uniq_8d93d649aa08cb10 TO UNIQ_IDENTIFIER_LOGIN');
        $this->addSql('ALTER TABLE type_sport DROP title_image');
    }
}
