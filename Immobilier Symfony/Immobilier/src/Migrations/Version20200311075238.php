<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311075238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD44577DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('CREATE INDEX IDX_F0FD44577DC7170A ON logement (vente_id)');
        $this->addSql('ALTER TABLE recherche DROP FOREIGN KEY FK_B4271B467DC7170A');
        $this->addSql('DROP INDEX IDX_B4271B467DC7170A ON recherche');
        $this->addSql('ALTER TABLE recherche DROP vente_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD44577DC7170A');
        $this->addSql('DROP INDEX IDX_F0FD44577DC7170A ON logement');
        $this->addSql('ALTER TABLE recherche ADD vente_id INT NOT NULL');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B467DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B4271B467DC7170A ON recherche (vente_id)');
    }
}
