<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150702233836 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE persons_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_names_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cities_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE countries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE regions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sources_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE announcements_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE region_names_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subcategories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE persons (id INT NOT NULL, name TEXT DEFAULT NULL, msisdn VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN persons.name IS \'(DC2Type:json_array)\'');
        $this->addSql('CREATE TABLE persons_sources (person_id INT NOT NULL, source_id INT NOT NULL, PRIMARY KEY(person_id, source_id))');
        $this->addSql('CREATE INDEX IDX_5696500F217BBB47 ON persons_sources (person_id)');
        $this->addSql('CREATE INDEX IDX_5696500F953C1C61 ON persons_sources (source_id)');
        $this->addSql('CREATE TABLE persons_subcategories (person_id INT NOT NULL, subcategory_id INT NOT NULL, PRIMARY KEY(person_id, subcategory_id))');
        $this->addSql('CREATE INDEX IDX_E2DF46A1217BBB47 ON persons_subcategories (person_id)');
        $this->addSql('CREATE INDEX IDX_E2DF46A15DC6FE57 ON persons_subcategories (subcategory_id)');
        $this->addSql('CREATE TABLE persons_cities (person_id INT NOT NULL, city_id INT NOT NULL, PRIMARY KEY(person_id, city_id))');
        $this->addSql('CREATE INDEX IDX_AC299278217BBB47 ON persons_cities (person_id)');
        $this->addSql('CREATE INDEX IDX_AC2992788BAC62AF ON persons_cities (city_id)');
        $this->addSql('CREATE TABLE city_names (id INT NOT NULL, region_id INT DEFAULT NULL, city_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B1B9EE1798260155 ON city_names (region_id)');
        $this->addSql('CREATE INDEX IDX_B1B9EE178BAC62AF ON city_names (city_id)');
        $this->addSql('CREATE TABLE cities (id INT NOT NULL, region_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, native_name VARCHAR(255) DEFAULT NULL, second_native_name VARCHAR(255) DEFAULT NULL, place_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D95DB16B98260155 ON cities (region_id)');
        $this->addSql('CREATE TABLE countries (id INT NOT NULL, languages TEXT NOT NULL, name VARCHAR(255) NOT NULL, native_name VARCHAR(255) NOT NULL, second_native_name VARCHAR(255) NOT NULL, iso3 CHAR(3) NOT NULL, tz VARCHAR(255) NOT NULL, iso2 CHAR(2) NOT NULL, place_id VARCHAR(255) NOT NULL, area_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN countries.languages IS \'(DC2Type:json_array)\'');
        $this->addSql('CREATE TABLE regions (id INT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, native_name VARCHAR(255) DEFAULT NULL, second_native_name VARCHAR(255) DEFAULT NULL, code VARCHAR(4) DEFAULT NULL, place_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A26779F3F92F3E70 ON regions (country_id)');
        $this->addSql('CREATE TABLE sources (id INT NOT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, config TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D25D65F2F92F3E70 ON sources (country_id)');
        $this->addSql('COMMENT ON COLUMN sources.config IS \'(DC2Type:json_array)\'');
        $this->addSql('CREATE TABLE announcements (id INT NOT NULL, source_id INT DEFAULT NULL, index VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F422A9D953C1C61 ON announcements (source_id)');
        $this->addSql('CREATE TABLE persons_announcements (announcement_id INT NOT NULL, person_id INT NOT NULL, PRIMARY KEY(announcement_id, person_id))');
        $this->addSql('CREATE INDEX IDX_88FFCDF7913AEA17 ON persons_announcements (announcement_id)');
        $this->addSql('CREATE INDEX IDX_88FFCDF7217BBB47 ON persons_announcements (person_id)');
        $this->addSql('CREATE TABLE region_names (id INT NOT NULL, region_id INT DEFAULT NULL, country_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4A574A5898260155 ON region_names (region_id)');
        $this->addSql('CREATE INDEX IDX_4A574A58F92F3E70 ON region_names (country_id)');
        $this->addSql('CREATE TABLE subcategories (id INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6562A1CB12469DE2 ON subcategories (category_id)');
        $this->addSql('CREATE TABLE categories (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE persons_sources ADD CONSTRAINT FK_5696500F217BBB47 FOREIGN KEY (person_id) REFERENCES persons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons_sources ADD CONSTRAINT FK_5696500F953C1C61 FOREIGN KEY (source_id) REFERENCES sources (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons_subcategories ADD CONSTRAINT FK_E2DF46A1217BBB47 FOREIGN KEY (person_id) REFERENCES persons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons_subcategories ADD CONSTRAINT FK_E2DF46A15DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons_cities ADD CONSTRAINT FK_AC299278217BBB47 FOREIGN KEY (person_id) REFERENCES persons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons_cities ADD CONSTRAINT FK_AC2992788BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city_names ADD CONSTRAINT FK_B1B9EE1798260155 FOREIGN KEY (region_id) REFERENCES regions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city_names ADD CONSTRAINT FK_B1B9EE178BAC62AF FOREIGN KEY (city_id) REFERENCES cities (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cities ADD CONSTRAINT FK_D95DB16B98260155 FOREIGN KEY (region_id) REFERENCES regions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE regions ADD CONSTRAINT FK_A26779F3F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sources ADD CONSTRAINT FK_D25D65F2F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE announcements ADD CONSTRAINT FK_F422A9D953C1C61 FOREIGN KEY (source_id) REFERENCES sources (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons_announcements ADD CONSTRAINT FK_88FFCDF7913AEA17 FOREIGN KEY (announcement_id) REFERENCES announcements (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE persons_announcements ADD CONSTRAINT FK_88FFCDF7217BBB47 FOREIGN KEY (person_id) REFERENCES persons (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE region_names ADD CONSTRAINT FK_4A574A5898260155 FOREIGN KEY (region_id) REFERENCES regions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE region_names ADD CONSTRAINT FK_4A574A58F92F3E70 FOREIGN KEY (country_id) REFERENCES countries (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subcategories ADD CONSTRAINT FK_6562A1CB12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE persons_sources DROP CONSTRAINT FK_5696500F217BBB47');
        $this->addSql('ALTER TABLE persons_subcategories DROP CONSTRAINT FK_E2DF46A1217BBB47');
        $this->addSql('ALTER TABLE persons_cities DROP CONSTRAINT FK_AC299278217BBB47');
        $this->addSql('ALTER TABLE persons_announcements DROP CONSTRAINT FK_88FFCDF7217BBB47');
        $this->addSql('ALTER TABLE persons_cities DROP CONSTRAINT FK_AC2992788BAC62AF');
        $this->addSql('ALTER TABLE city_names DROP CONSTRAINT FK_B1B9EE178BAC62AF');
        $this->addSql('ALTER TABLE regions DROP CONSTRAINT FK_A26779F3F92F3E70');
        $this->addSql('ALTER TABLE sources DROP CONSTRAINT FK_D25D65F2F92F3E70');
        $this->addSql('ALTER TABLE region_names DROP CONSTRAINT FK_4A574A58F92F3E70');
        $this->addSql('ALTER TABLE city_names DROP CONSTRAINT FK_B1B9EE1798260155');
        $this->addSql('ALTER TABLE cities DROP CONSTRAINT FK_D95DB16B98260155');
        $this->addSql('ALTER TABLE region_names DROP CONSTRAINT FK_4A574A5898260155');
        $this->addSql('ALTER TABLE persons_sources DROP CONSTRAINT FK_5696500F953C1C61');
        $this->addSql('ALTER TABLE announcements DROP CONSTRAINT FK_F422A9D953C1C61');
        $this->addSql('ALTER TABLE persons_announcements DROP CONSTRAINT FK_88FFCDF7913AEA17');
        $this->addSql('ALTER TABLE persons_subcategories DROP CONSTRAINT FK_E2DF46A15DC6FE57');
        $this->addSql('ALTER TABLE subcategories DROP CONSTRAINT FK_6562A1CB12469DE2');
        $this->addSql('DROP SEQUENCE persons_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_names_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cities_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE countries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE regions_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sources_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE announcements_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE region_names_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subcategories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categories_id_seq CASCADE');
        $this->addSql('DROP TABLE persons');
        $this->addSql('DROP TABLE persons_sources');
        $this->addSql('DROP TABLE persons_subcategories');
        $this->addSql('DROP TABLE persons_cities');
        $this->addSql('DROP TABLE city_names');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE regions');
        $this->addSql('DROP TABLE sources');
        $this->addSql('DROP TABLE announcements');
        $this->addSql('DROP TABLE persons_announcements');
        $this->addSql('DROP TABLE region_names');
        $this->addSql('DROP TABLE subcategories');
        $this->addSql('DROP TABLE categories');
    }
}
