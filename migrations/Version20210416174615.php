<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416174615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE slider (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE slider_image (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, slider_id INTEGER NOT NULL, image_id INTEGER NOT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_4389483B2CCC9638 ON slider_image (slider_id)');
        $this->addSql('CREATE INDEX IDX_4389483B3DA5256D ON slider_image (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE slider');
        $this->addSql('DROP TABLE slider_image');
    }
}
