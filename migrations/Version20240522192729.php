<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522192729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compare_section DROP FOREIGN KEY FK_7A47B03B18E7CF9F');
        $this->addSql('DROP INDEX IDX_7A47B03B18E7CF9F ON compare_section');
        $this->addSql('ALTER TABLE compare_section CHANGE csections_id sections_id INT NOT NULL');
        $this->addSql('ALTER TABLE compare_section ADD CONSTRAINT FK_7A47B03B577906E4 FOREIGN KEY (sections_id) REFERENCES sections (id)');
        $this->addSql('CREATE INDEX IDX_7A47B03B577906E4 ON compare_section (sections_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compare_section DROP FOREIGN KEY FK_7A47B03B577906E4');
        $this->addSql('DROP INDEX IDX_7A47B03B577906E4 ON compare_section');
        $this->addSql('ALTER TABLE compare_section CHANGE sections_id csections_id INT NOT NULL');
        $this->addSql('ALTER TABLE compare_section ADD CONSTRAINT FK_7A47B03B18E7CF9F FOREIGN KEY (csections_id) REFERENCES sections (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_7A47B03B18E7CF9F ON compare_section (csections_id)');
    }
}
