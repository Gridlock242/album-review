<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250501211219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD album_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review ADD CONSTRAINT FK_794381C61137ABCF FOREIGN KEY (album_id) REFERENCES album (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_794381C61137ABCF ON review (album_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP FOREIGN KEY FK_794381C61137ABCF
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_794381C61137ABCF ON review
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE review DROP album_id
        SQL);
    }
}
