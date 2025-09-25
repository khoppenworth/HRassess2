CREATE TABLE IF NOT EXISTS users ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(64) UNIQUE, password VARCHAR(255), role ENUM('admin','staff') DEFAULT 'staff', full_name VARCHAR(128), email VARCHAR(128) );
CREATE TABLE IF NOT EXISTS settings (`key` VARCHAR(64) PRIMARY KEY, `val` TEXT);
CREATE TABLE IF NOT EXISTS item_banks ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(128) );
CREATE TABLE IF NOT EXISTS forms ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(128), description TEXT );
CREATE TABLE IF NOT EXISTS sections ( id INT AUTO_INCREMENT PRIMARY KEY, form_id INT NOT NULL, title VARCHAR(255), weight DECIMAL(10,2) DEFAULT 1, FOREIGN KEY (form_id) REFERENCES forms(id) ON DELETE CASCADE );
CREATE TABLE IF NOT EXISTS questions ( id INT AUTO_INCREMENT PRIMARY KEY, section_id INT NOT NULL, text TEXT, scale_max INT DEFAULT 5, weight DECIMAL(10,2) DEFAULT 1, item_bank_id INT DEFAULT NULL, FOREIGN KEY (section_id) REFERENCES sections(id) ON DELETE CASCADE, FOREIGN KEY (item_bank_id) REFERENCES item_banks(id) ON DELETE SET NULL );
CREATE TABLE IF NOT EXISTS form_responses ( id INT AUTO_INCREMENT PRIMARY KEY, form_id INT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, score DECIMAL(10,2) DEFAULT 0, FOREIGN KEY (form_id) REFERENCES forms(id) ON DELETE CASCADE, FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE );
CREATE TABLE IF NOT EXISTS answers ( response_id INT NOT NULL, question_id INT NOT NULL, value INT, PRIMARY KEY (response_id,question_id), FOREIGN KEY (response_id) REFERENCES form_responses(id) ON DELETE CASCADE, FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE );

INSERT IGNORE INTO users(username,password,role,full_name,email) VALUES ('admin','$2y$10$Zl4R3O8Ujbp2T.j1q9q8re1B8vk7rS00lT4y7gGvOeZl5g5cVxFjC','admin','Administrator','admin@example.org');
-- password: admin123

DELIMITER $$
CREATE PROCEDURE seed_forms()
BEGIN
  DECLARE i INT DEFAULT 1;
  WHILE i<=10 DO
    INSERT INTO forms(name,description) VALUES (CONCAT('Sample Form ', i),'Auto-seeded sample');
    SET @fid = LAST_INSERT_ID();
    INSERT INTO sections(form_id,title,weight) VALUES (@fid, CONCAT('Section A', i), 1);
    SET @sid = LAST_INSERT_ID();
    INSERT INTO questions(section_id,text,scale_max,weight) VALUES
      (@sid,'Readiness of process A',5,1),
      (@sid,'Availability of resources',5,1),
      (@sid,'Quality assurance level',5,1);
    SET i = i + 1;
  END WHILE;
END$$
DELIMITER ;
CALL seed_forms();
DROP PROCEDURE IF EXISTS seed_forms;
