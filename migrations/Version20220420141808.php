<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420141808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiimer DROP FOREIGN KEY FK_15F39440A76ED395');
        $this->addSql('DROP INDEX IDX_15F39440A76ED395 ON tiimer');
        $this->addSql('ALTER TABLE tiimer CHANGE user_id idUser INT NOT NULL');
        $this->addSql('ALTER TABLE tiimer ADD CONSTRAINT FK_15F39440FE6E88D7 FOREIGN KEY (idUser) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_15F39440FE6E88D7 ON tiimer (idUser)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiimer DROP FOREIGN KEY FK_15F39440FE6E88D7');
        $this->addSql('DROP INDEX IDX_15F39440FE6E88D7 ON tiimer');
        $this->addSql('ALTER TABLE tiimer CHANGE idUser user_id INT NOT NULL');
        $this->addSql('ALTER TABLE tiimer ADD CONSTRAINT FK_15F39440A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_15F39440A76ED395 ON tiimer (user_id)');
    }
}
