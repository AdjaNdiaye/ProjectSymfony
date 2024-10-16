<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241015142612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP date_add');
        $this->addSql('ALTER TABLE produit ADD idcategory_id INT NOT NULL, DROP idcategory');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27D487ED4D FOREIGN KEY (idcategory_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27D487ED4D ON produit (idcategory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD date_add DATETIME NOT NULL');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27D487ED4D');
        $this->addSql('DROP INDEX IDX_29A5EC27D487ED4D ON produit');
        $this->addSql('ALTER TABLE produit ADD idcategory VARCHAR(255) NOT NULL, DROP idcategory_id');
    }
}
