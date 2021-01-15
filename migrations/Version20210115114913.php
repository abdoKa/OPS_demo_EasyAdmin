<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115114913 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product ADD order_parrent_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE67BE5AE9F FOREIGN KEY (order_parrent_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_2530ADE67BE5AE9F ON order_product (order_parrent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE67BE5AE9F');
        $this->addSql('DROP INDEX IDX_2530ADE67BE5AE9F ON order_product');
        $this->addSql('ALTER TABLE order_product DROP order_parrent_id');
    }
}
