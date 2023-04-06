<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405143430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP CONSTRAINT fk_cfbdfa1426ed0855');
        $this->addSql('DROP INDEX idx_cfbdfa1426ed0855');
        $this->addSql('ALTER TABLE note RENAME COLUMN note_id TO note_type_id');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1444EA4809 FOREIGN KEY (note_type_id) REFERENCES note_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CFBDFA1444EA4809 ON note (note_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA1444EA4809');
        $this->addSql('DROP INDEX IDX_CFBDFA1444EA4809');
        $this->addSql('ALTER TABLE note RENAME COLUMN note_type_id TO note_id');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT fk_cfbdfa1426ed0855 FOREIGN KEY (note_id) REFERENCES note_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cfbdfa1426ed0855 ON note (note_id)');
    }
}
