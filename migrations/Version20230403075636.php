<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403075636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD a_live BOOLEAN DEFAULT true NOT NULL');
        $this->addSql('ALTER TABLE customer ALTER phone TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE lead ADD a_live BOOLEAN DEFAULT true NOT NULL');
        $this->addSql('ALTER TABLE lead ALTER phone TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE prospect ADD a_live BOOLEAN DEFAULT true NOT NULL');
        $this->addSql('ALTER TABLE prospect ALTER phone TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customer DROP a_live');
        $this->addSql('ALTER TABLE customer ALTER phone TYPE INT');
        $this->addSql('ALTER TABLE prospect DROP a_live');
        $this->addSql('ALTER TABLE prospect ALTER phone TYPE INT');
        $this->addSql('ALTER TABLE lead DROP a_live');
        $this->addSql('ALTER TABLE lead ALTER phone TYPE INT');
    }
}
