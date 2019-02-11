<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170526002334 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE legislative_candidates CHANGE district_number district_number SMALLINT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE legislative_candidates CHANGE district_number district_number VARCHAR(10) NOT NULL COLLATE utf8_unicode_ci');
    }
}
