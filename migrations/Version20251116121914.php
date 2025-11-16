<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251116121914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE brave_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE czesci_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE komponent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, art VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE brave (id INT NOT NULL, s VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE czesci (id INT NOT NULL, klocki_hamulcowe VARCHAR(255) NOT NULL, dostepne BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE komponent (id INT NOT NULL, name VARCHAR(255) NOT NULL, descriptions VARCHAR(255) NOT NULL, available VARCHAR(255) NOT NULL, stocks INT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE brave_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE czesci_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE komponent_id_seq CASCADE');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE brave');
        $this->addSql('DROP TABLE czesci');
        $this->addSql('DROP TABLE komponent');
    }
}
