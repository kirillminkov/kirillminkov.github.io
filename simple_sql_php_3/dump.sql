CREATE TABLE `category` (
`id` INT(10) NOT NULL AUTO_INCREMENT,
`name` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `news` (
`id` INT(10) NOT NULL AUTO_INCREMENT,
`id_category` INT(10) NOT NULL,
`title` VARCHAR(255) NOT NULL,
`small_text` TEXT NOT NULL,
`text` TEXT NOT NULL,
`author` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

ALTER TABLE `news`
	ADD CONSTRAINT `FK_news_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

INSERT INTO `category` (`category_name`) VALUES ('category_1');
INSERT INTO `category` (`category_name`) VALUES ('category_2');
INSERT INTO `news` (`id_category`, `title`, `small_text`, `text`, `author`) VALUES (1, 'title1', 'small_text1', 'text1', 'author1');
INSERT INTO `news` (`id_category`, `title`, `small_text`, `text`, `author`) VALUES (2, 'title2', 'small_text2', 'text2', 'author2');
INSERT INTO `news` (`id_category`, `title`, `small_text`, `text`, `author`) VALUES (2, 'title3', 'small_text3', 'text3', 'author3');
