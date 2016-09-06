CREATE TABLE `gbook_entries` (
  `id`      SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`    VARCHAR(128)         NOT NULL DEFAULT '',
  `email`   VARCHAR(64)          NOT NULL DEFAULT '',
  `url`     VARCHAR(64)          NOT NULL DEFAULT '',
  `message` TEXT,
  `note`    TEXT,
  `time`    INT(10)              NOT NULL DEFAULT '0',
  `ip`      VARCHAR(15)                   DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = MyISAM;

