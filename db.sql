DROP DATABASE IF EXISTS shop_db;

CREATE DATABASE shop_db;

USE shop_db;

CREATE TABLE artifacts
(
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    flavour_text VARCHAR(255) NOT NULL,
    modifiers TEXT NOT NULL,
    image_url VARCHAR(255),
    price DECIMAL(10, 2) NOT NULL,

    INDEX (title)
) ENGINE = InnoDB;


CREATE TABLE artifacts_metadata
(
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    artifact_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    value VARCHAR(255) NOT NULL,

    FOREIGN KEY (artifact_id) REFERENCES artifacts(id)
) ENGINE = InnoDB;

INSERT INTO artifacts (title, flavour_text, modifiers, image_url, price)
VALUES
       (
        'Greed''s Embrace &lt;br /&gt; Golden Plate',
        'Some would question if the risk was worth it. &lt;br /&gt; The rest were already dead.',
        'a:3:{i:0;s:23:"-10% to Fire Resistance";i:1;s:23:"+25% to Cold Resistance";i:2;s:28:"-20% to Lightning Resistance";}',
        'assets/images/artifacts/armour.png',
        25
       ),
       (
        'Hello Kitty &lt;br /&gt; Backpack',
        'Mew.',
        'a:3:{i:0;s:23:"+25% to Fire Resistance";i:1;s:23:"+25% to Cold Resistance";i:2;s:28:"+25% to Lightning Resistance";}',
        'assets/images/artifacts/kitty.png',
        50
       ),
       (
        'Little Prince''s &lt;br /&gt; Rose',
        'It is the time you have wasted for your rose that makes your rose so important.',
        'a:2:{i:0;s:23:"-10% to Cold Resistance";i:1;s:16:"-5% to Happiness";}',
        'assets/images/artifacts/rose.png',
        25
       ),
       (
        'The &lt;br /&gt;  Ring',
        'One to rule them all.',
        'a:2:{i:0;s:19:"-100% to Visibility";i:1;s:14:"-75% to Sanity";}',
        'assets/images/artifacts/ring.png',
        25
       );

INSERT INTO artifacts_metadata (artifact_id, name, value)
VALUES
       (1, 'armour', 670),
       (1, 'movement speed', '-5%'),
       (2, 'armour', '890'),
       (2, 'movement speed', '+5%'),
       (3, 'armour', 50),
       (4, 'armour', 1),
       (4, 'movement speed', '+5%');

SELECT artifacts.title, artifacts_metadata.name, artifacts_metadata.value FROM artifacts JOIN artifacts_metadata ON artifacts.id = artifacts_metadata.artifact_id;

SELECT ar.title, md.name, md.value FROM artifacts ar JOIN artifacts_metadata md ON ar.id = md.artifact_id WHERE md.name = 'armour';
SELECT ar.title, md.name, md.value FROM artifacts ar JOIN artifacts_metadata md ON ar.id = md.artifact_id WHERE md.name = 'armour' and md.value > 55;
SELECT ar.title, COUNT(md.name) as attributes FROM artifacts ar JOIN artifacts_metadata md ON ar.id = md.artifact_id GROUP BY 1;