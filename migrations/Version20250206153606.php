<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206153606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD content LONGTEXT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE profil_picture profil_picture VARCHAR(300) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP content, CHANGE title title VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE profil_picture profil_picture VARCHAR(300) DEFAULT NULL');
    }
}
