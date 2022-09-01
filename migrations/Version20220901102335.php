<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901102335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE compagny_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE note_frais_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_note_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE compagny (id INT NOT NULL, name VARCHAR(200) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE note_frais (id INT NOT NULL, note_type_id INT NOT NULL, company_id INT NOT NULL, identifiant VARCHAR(255) NOT NULL, note_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, amount DOUBLE PRECISION NOT NULL, registered_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4050EF4F44EA4809 ON note_frais (note_type_id)');
        $this->addSql('CREATE INDEX IDX_4050EF4F979B1AD6 ON note_frais (company_id)');
        $this->addSql('CREATE TABLE type_note (id INT NOT NULL, type_note VARCHAR(200) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, birthday TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE note_frais ADD CONSTRAINT FK_4050EF4F44EA4809 FOREIGN KEY (note_type_id) REFERENCES type_note (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note_frais ADD CONSTRAINT FK_4050EF4F979B1AD6 FOREIGN KEY (company_id) REFERENCES compagny (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE compagny_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE note_frais_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_note_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE note_frais DROP CONSTRAINT FK_4050EF4F44EA4809');
        $this->addSql('ALTER TABLE note_frais DROP CONSTRAINT FK_4050EF4F979B1AD6');
        $this->addSql('DROP TABLE compagny');
        $this->addSql('DROP TABLE note_frais');
        $this->addSql('DROP TABLE type_note');
        $this->addSql('DROP TABLE "user"');
    }
}
