<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106155217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expression (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, translation VARCHAR(255) NOT NULL, searches INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expression_user (expression_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6E3A751BADBB65A1 (expression_id), INDEX IDX_6E3A751BA76ED395 (user_id), PRIMARY KEY(expression_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expression_user ADD CONSTRAINT FK_6E3A751BADBB65A1 FOREIGN KEY (expression_id) REFERENCES expression (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expression_user ADD CONSTRAINT FK_6E3A751BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expression_user DROP FOREIGN KEY FK_6E3A751BADBB65A1');
        $this->addSql('DROP TABLE expression');
        $this->addSql('DROP TABLE expression_user');
    }
}
