<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20171228161433 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen_projects ADD image_name VARCHAR(255) DEFAULT NULL');
    }

    public function postUp(Schema $schema): void
    {
        $this->addSql('UPDATE citizen_projects SET image_name = CONCAT(uuid, \'.jpg\') WHERE image_uploaded = 1');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE citizen_projects DROP image_name');
    }
}
