<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310094437 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE media CHANGE logement_id logement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recherche ADD vente_id INT NOT NULL, ADD type_logement_id INT NOT NULL, ADD localisation_id INT NOT NULL, ADD nombre_piece INT NOT NULL, ADD prix NUMERIC(10, 2) NOT NULL, ADD surface_totale NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B467DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B4613B22EC4 FOREIGN KEY (type_logement_id) REFERENCES type_logement (id)');
        $this->addSql('ALTER TABLE recherche ADD CONSTRAINT FK_B4271B46C68BE09C FOREIGN KEY (localisation_id) REFERENCES localisation (id)');
        $this->addSql('CREATE INDEX IDX_B4271B467DC7170A ON recherche (vente_id)');
        $this->addSql('CREATE INDEX IDX_B4271B4613B22EC4 ON recherche (type_logement_id)');
        $this->addSql('CREATE INDEX IDX_B4271B46C68BE09C ON recherche (localisation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE media CHANGE logement_id logement_id INT NOT NULL');
        $this->addSql('ALTER TABLE recherche DROP FOREIGN KEY FK_B4271B467DC7170A');
        $this->addSql('ALTER TABLE recherche DROP FOREIGN KEY FK_B4271B4613B22EC4');
        $this->addSql('ALTER TABLE recherche DROP FOREIGN KEY FK_B4271B46C68BE09C');
        $this->addSql('DROP INDEX IDX_B4271B467DC7170A ON recherche');
        $this->addSql('DROP INDEX IDX_B4271B4613B22EC4 ON recherche');
        $this->addSql('DROP INDEX IDX_B4271B46C68BE09C ON recherche');
        $this->addSql('ALTER TABLE recherche DROP vente_id, DROP type_logement_id, DROP localisation_id, DROP nombre_piece, DROP prix, DROP surface_totale');
    }
}
