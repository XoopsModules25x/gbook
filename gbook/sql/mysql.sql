CREATE TABLE `gbook_entries` (
  `id`		smallint(5) unsigned	NOT NULL auto_increment,
  `name`	varchar(128)		NOT NULL default '',
  `email`	varchar(64)		NOT NULL default '',
  `url`		varchar(64)		NOT NULL default '',
  `message`	text,
  `note`	text,
  `time`	int(10)			NOT NULL default '0',
  `ip`		varchar(15)		default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

