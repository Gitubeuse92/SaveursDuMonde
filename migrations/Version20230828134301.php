<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828134301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1CCD7E912');
        $this->addSql('DROP INDEX IDX_64C19C1CCD7E912 ON category');
        $this->addSql('ALTER TABLE category DROP menu_id, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCCD7E912');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD558FBEB9');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('DROP INDEX IDX_D34A04AD558FBEB9 ON product');
        $this->addSql('DROP INDEX IDX_D34A04ADCCD7E912 ON product');
        $this->addSql('ALTER TABLE product DROP purchase_id, DROP category_id, DROP menu_id, DROP title, DROP type, DROP price, DROP description');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BA76ED395');
        $this->addSql('DROP INDEX IDX_6117D13BA76ED395 ON purchase');
        $this->addSql('ALTER TABLE purchase DROP user_id, CHANGE date_time datetime DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD menu_id INT NOT NULL, CHANGE name name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1CCD7E912 ON category (menu_id)');
        $this->addSql('ALTER TABLE product ADD purchase_id INT NOT NULL, ADD category_id INT DEFAULT NULL, ADD menu_id INT NOT NULL, ADD title VARCHAR(255) NOT NULL, ADD type VARCHAR(255) DEFAULT NULL, ADD price NUMERIC(5, 2) NOT NULL, ADD description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD558FBEB9 ON product (purchase_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADCCD7E912 ON product (menu_id)');
        $this->addSql('ALTER TABLE purchase ADD user_id INT NOT NULL, CHANGE datetime date_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6117D13BA76ED395 ON purchase (user_id)');
        $this->addSql('ALTER TABLE user DROP is_verified');
    }
}
