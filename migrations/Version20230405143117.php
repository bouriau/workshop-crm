<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405143117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action DROP CONSTRAINT fk_47cc8c929d32f035');
        $this->addSql('DROP INDEX idx_47cc8c929d32f035');
        $this->addSql('ALTER TABLE action RENAME COLUMN action_id TO action_type_id');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C921FEE0472 FOREIGN KEY (action_type_id) REFERENCES action_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_47CC8C921FEE0472 ON action (action_type_id)');
        $this->addSql('ALTER TABLE action_type ALTER code TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE action_type ALTER name TYPE VARCHAR(255)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA3FEC2777153098 ON action_type (code)');
        $this->addSql('ALTER TABLE note ADD action_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA149D32F035 FOREIGN KEY (action_id) REFERENCES action (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CFBDFA149D32F035 ON note (action_id)');
        $this->addSql('ALTER TABLE note_type ALTER code TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE note_type ALTER name TYPE VARCHAR(255)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2CA4467177153098 ON note_type (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA149D32F035');
        $this->addSql('DROP INDEX IDX_CFBDFA149D32F035');
        $this->addSql('ALTER TABLE note DROP action_id');
        $this->addSql('DROP INDEX UNIQ_2CA4467177153098');
        $this->addSql('ALTER TABLE note_type ALTER code TYPE TEXT');
        $this->addSql('ALTER TABLE note_type ALTER name TYPE TEXT');
        $this->addSql('ALTER TABLE action DROP CONSTRAINT FK_47CC8C921FEE0472');
        $this->addSql('DROP INDEX IDX_47CC8C921FEE0472');
        $this->addSql('ALTER TABLE action RENAME COLUMN action_type_id TO action_id');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT fk_47cc8c929d32f035 FOREIGN KEY (action_id) REFERENCES action_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_47cc8c929d32f035 ON action (action_id)');
        $this->addSql('DROP INDEX UNIQ_FA3FEC2777153098');
        $this->addSql('ALTER TABLE action_type ALTER code TYPE TEXT');
        $this->addSql('ALTER TABLE action_type ALTER name TYPE TEXT');
    }
}
