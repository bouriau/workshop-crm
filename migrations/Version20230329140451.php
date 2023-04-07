<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329140451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE customer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE customer_message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lead_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prospect_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prospect_message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sale_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE customer_message (id INT NOT NULL, customer_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, message TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AA6094C19395C3F3 ON customer_message (customer_id)');
        $this->addSql('CREATE TABLE lead (id INT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE prospect (id INT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE prospect_message (id INT NOT NULL, prospect_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, message TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75F120ABD182060A ON prospect_message (prospect_id)');
        $this->addSql('CREATE TABLE sale (id INT NOT NULL, customer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, price NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E54BC0059395C3F3 ON sale (customer_id)');
        $this->addSql('ALTER TABLE customer_message ADD CONSTRAINT FK_AA6094C19395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prospect_message ADD CONSTRAINT FK_75F120ABD182060A FOREIGN KEY (prospect_id) REFERENCES prospect (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE customer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE customer_message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lead_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prospect_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prospect_message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sale_id_seq CASCADE');
        $this->addSql('ALTER TABLE customer_message DROP CONSTRAINT FK_AA6094C19395C3F3');
        $this->addSql('ALTER TABLE prospect_message DROP CONSTRAINT FK_75F120ABD182060A');
        $this->addSql('ALTER TABLE sale DROP CONSTRAINT FK_E54BC0059395C3F3');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE customer_message');
        $this->addSql('DROP TABLE lead');
        $this->addSql('DROP TABLE prospect');
        $this->addSql('DROP TABLE prospect_message');
        $this->addSql('DROP TABLE sale');
    }
}
