<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331070405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_message ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer_message ADD CONSTRAINT FK_AA6094C1727ACA70 FOREIGN KEY (parent_id) REFERENCES customer_message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AA6094C1727ACA70 ON customer_message (parent_id)');
        $this->addSql('ALTER TABLE prospect_message ADD parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prospect_message ADD CONSTRAINT FK_75F120AB727ACA70 FOREIGN KEY (parent_id) REFERENCES prospect_message (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_75F120AB727ACA70 ON prospect_message (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE customer_message DROP CONSTRAINT FK_AA6094C1727ACA70');
        $this->addSql('DROP INDEX IDX_AA6094C1727ACA70');
        $this->addSql('ALTER TABLE customer_message DROP parent_id');
        $this->addSql('ALTER TABLE prospect_message DROP CONSTRAINT FK_75F120AB727ACA70');
        $this->addSql('DROP INDEX IDX_75F120AB727ACA70');
        $this->addSql('ALTER TABLE prospect_message DROP parent_id');
    }
}
