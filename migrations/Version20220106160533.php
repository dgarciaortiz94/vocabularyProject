<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220106160533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE expression_language');
        $this->addSql('ALTER TABLE expression ADD expression_language_id INT NOT NULL, ADD translation_language_id INT NOT NULL');
        $this->addSql('ALTER TABLE expression ADD CONSTRAINT FK_D830560110CE321B FOREIGN KEY (expression_language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE expression ADD CONSTRAINT FK_D830560119EFF0F5 FOREIGN KEY (translation_language_id) REFERENCES language (id)');
        $this->addSql('CREATE INDEX IDX_D830560110CE321B ON expression (expression_language_id)');
        $this->addSql('CREATE INDEX IDX_D830560119EFF0F5 ON expression (translation_language_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expression_language (expression_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_2827E1C7ADBB65A1 (expression_id), INDEX IDX_2827E1C782F1BAF4 (language_id), PRIMARY KEY(expression_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE expression_language ADD CONSTRAINT FK_2827E1C782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expression_language ADD CONSTRAINT FK_2827E1C7ADBB65A1 FOREIGN KEY (expression_id) REFERENCES expression (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expression DROP FOREIGN KEY FK_D830560110CE321B');
        $this->addSql('ALTER TABLE expression DROP FOREIGN KEY FK_D830560119EFF0F5');
        $this->addSql('DROP INDEX IDX_D830560110CE321B ON expression');
        $this->addSql('DROP INDEX IDX_D830560119EFF0F5 ON expression');
        $this->addSql('ALTER TABLE expression DROP expression_language_id, DROP translation_language_id');
    }
}
