<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403121543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE customer ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE customer_message ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE customer_message ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE lead ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE lead ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE prospect ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE prospect ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE prospect_message ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE prospect_message ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE sale ALTER created_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE sale ALTER updated_at SET DEFAULT CURRENT_TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE lead ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE lead ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE prospect_message ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE prospect_message ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE customer_message ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE customer_message ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE prospect ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE prospect ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE sale ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE sale ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE customer ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE customer ALTER updated_at DROP DEFAULT');
    }
}
