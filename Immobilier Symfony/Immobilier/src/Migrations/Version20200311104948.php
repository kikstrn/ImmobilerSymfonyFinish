<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311104948 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recherche ADD nom_vente_id INT DEFAULT NULL, DROP field');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B46E88DD283 FOREIGN KEY (nom_vente_id) REFERENCES vente (id)');
        $this->addSql('CREATE INDEX IDX_B4271B46E88DD283 ON recherche (nom_vente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recherche DROP FOREIGN KEY FK_B4271B46E88DD283');
        $this->addSql('DROP INDEX IDX_B4271B46E88DD283 ON recherche');
        $this->addSql('ALTER TABLE recherche ADD field VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP nom_vente_id');
    }
}
