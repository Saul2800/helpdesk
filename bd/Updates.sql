CREATE TABLE `ticketly`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_user` INT NULL,
  `comment` VARCHAR(250) NULL,
  `rating` VARCHAR(45) NULL,
  `id_project` INT NULL,
  `id_ticket` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE);

ALTER TABLE `ticketly`.`user` 
ADD COLUMN `dni` INT NULL DEFAULT NULL AFTER `username`,
ADD COLUMN `phone` VARCHAR(15) NULL DEFAULT NULL AFTER `name`,
ADD COLUMN `kind_proveedor` VARCHAR(45) NULL DEFAULT NULL AFTER `kind`;

ALTER TABLE `ticketly`.`ticket` 
ADD COLUMN `problem_imguno` VARCHAR(250) NULL DEFAULT NULL AFTER `rating_ticket`,
ADD COLUMN `problem_imgdos` VARCHAR(250) NULL DEFAULT NULL AFTER `problem_imguno`;
