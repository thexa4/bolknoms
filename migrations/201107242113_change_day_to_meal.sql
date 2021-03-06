ALTER TABLE `registrations`
	DROP FOREIGN KEY `registrations_day_id_meals_id`;
ALTER TABLE `days`
	RENAME TO `meals`;
ALTER TABLE `registrations`
	ALTER `day_id` DROP DEFAULT;
ALTER TABLE `registrations`
	CHANGE COLUMN `day_id` `meal_id` INT(10) UNSIGNED NOT NULL AFTER `name`,
	ADD CONSTRAINT `registrations_meal_id__meals_id` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
