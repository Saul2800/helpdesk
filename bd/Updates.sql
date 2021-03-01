CREATE TABLE `ticketly`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NULL,
  `comment` VARCHAR(250) NULL,
  `rating` VARCHAR(45) NULL,
  `id_project` INT NULL,
  `id_ticket` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);