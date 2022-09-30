<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929093603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag_page (tag_id INT NOT NULL, page_id INT NOT NULL, PRIMARY KEY(tag_id, page_id))');
        $this->addSql('CREATE INDEX IDX_FA050996BAD26311 ON tag_page (tag_id)');
        $this->addSql('CREATE INDEX IDX_FA050996C4663E4 ON tag_page (page_id)');
        $this->addSql('ALTER TABLE tag_page ADD CONSTRAINT FK_FA050996BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_page ADD CONSTRAINT FK_FA050996C4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('ALTER TABLE tag_page DROP CONSTRAINT FK_FA050996BAD26311');
        $this->addSql('ALTER TABLE tag_page DROP CONSTRAINT FK_FA050996C4663E4');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_page');
    }
}
