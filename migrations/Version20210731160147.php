<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210731160147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address ADD addresses_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F815713BC80 FOREIGN KEY (addresses_id) REFERENCES garage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F815713BC80 ON address (addresses_id)');
        $this->addSql('ALTER TABLE model ADD brand_id INT NOT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('ALTER TABLE picture ADD pictures_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89BC415685 FOREIGN KEY (pictures_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89BC415685 ON picture (pictures_id)');
        $this->addSql('ALTER TABLE post ADD garage_id INT DEFAULT NULL, ADD model_id INT DEFAULT NULL, ADD fuel_id INT DEFAULT NULL, ADD carcategory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DC4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D97C79677 FOREIGN KEY (fuel_id) REFERENCES fuel (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D43D2E38B FOREIGN KEY (carcategory_id) REFERENCES carcategory (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DC4FFF555 ON post (garage_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D7975B7E7 ON post (model_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D97C79677 ON post (fuel_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D43D2E38B ON post (carcategory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F815713BC80');
        $this->addSql('DROP INDEX UNIQ_D4E6F815713BC80 ON address');
        $this->addSql('ALTER TABLE address DROP addresses_id');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('ALTER TABLE model DROP brand_id');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89BC415685');
        $this->addSql('DROP INDEX IDX_16DB4F89BC415685 ON picture');
        $this->addSql('ALTER TABLE picture DROP pictures_id');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DC4FFF555');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D7975B7E7');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D97C79677');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D43D2E38B');
        $this->addSql('DROP INDEX IDX_5A8A6C8DC4FFF555 ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8D7975B7E7 ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8D97C79677 ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8D43D2E38B ON post');
        $this->addSql('ALTER TABLE post DROP garage_id, DROP model_id, DROP fuel_id, DROP carcategory_id');
    }
}
