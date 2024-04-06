<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240406123115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE emplacement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE marche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_emplacement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ville_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE emplacement (id INT NOT NULL, id_marche_id INT DEFAULT NULL, type_emplacement_id INT NOT NULL, id_emplacement INT NOT NULL, numero VARCHAR(160) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C0CF65F61E7CF536 ON emplacement (id_marche_id)');
        $this->addSql('CREATE INDEX IDX_C0CF65F6929AA3C5 ON emplacement (type_emplacement_id)');
        $this->addSql('CREATE TABLE marche (id INT NOT NULL, id_ville_id INT NOT NULL, id_marche INT NOT NULL, nom_marche VARCHAR(140) NOT NULL, description TEXT NOT NULL, capacite INT NOT NULL, adresse VARCHAR(150) NOT NULL, telephone VARCHAR(40) NOT NULL, image VARCHAR(170) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BAA18ACCF7E4ECA3 ON marche (id_ville_id)');
        $this->addSql('CREATE TABLE type_emplacement (id INT NOT NULL, id_type INT NOT NULL, libelle VARCHAR(160) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ville (id INT NOT NULL, id_ville INT NOT NULL, nom_ville VARCHAR(140) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F61E7CF536 FOREIGN KEY (id_marche_id) REFERENCES marche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE emplacement ADD CONSTRAINT FK_C0CF65F6929AA3C5 FOREIGN KEY (type_emplacement_id) REFERENCES type_emplacement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE marche ADD CONSTRAINT FK_BAA18ACCF7E4ECA3 FOREIGN KEY (id_ville_id) REFERENCES ville (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE emplacement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE marche_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_emplacement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ville_id_seq CASCADE');
        $this->addSql('ALTER TABLE emplacement DROP CONSTRAINT FK_C0CF65F61E7CF536');
        $this->addSql('ALTER TABLE emplacement DROP CONSTRAINT FK_C0CF65F6929AA3C5');
        $this->addSql('ALTER TABLE marche DROP CONSTRAINT FK_BAA18ACCF7E4ECA3');
        $this->addSql('DROP TABLE emplacement');
        $this->addSql('DROP TABLE marche');
        $this->addSql('DROP TABLE type_emplacement');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
