-- phpMyAdmin wouldn't generate the .sql file including all of the UPDATE and DELETE statements I ran, only giving the final product. This sql file is a reconstruction I made myself that has ALL of the statements I ran for each question. -- 
-- Create the database
CREATE DATABASE IF NOT EXISTS homework_8;
USE homework_8;

-- Create the table
CREATE TABLE notes (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(80) NOT NULL,
  description TEXT NOT NULL,
  PRIMARY KEY (id)
);

-- Insert data
INSERT INTO notes (title, description)
VALUES 
  ('Update 1.21.5 – Dried Ghast Block', 'A new Nether block appears near soul sand and can be rehydrated.'),
  ('Update 1.21.6 – Ghastling Mob', 'Players can now rehydrate dried ghasts into baby Ghastlings.'),
  ('Update 1.21.7 – Happy Ghasts', 'Ghastlings evolve into rideable Happy Ghasts that carry up to 4 players.');

-- Update description
UPDATE notes
SET description = 'Happy Ghasts are now fully flyable and can support custom sky builds.'
WHERE title = 'Update 1.21.7 – Happy Ghasts';

-- Delete one note
DELETE FROM notes
WHERE title = 'Update 1.21.6 – Ghastling Mob';

-- Queries
-- a. All notes in reverse alphabetical order
SELECT * FROM notes ORDER BY title DESC;

-- b. Second note in table
SELECT * FROM notes ORDER BY id LIMIT 1 OFFSET 1;

-- c. Notes with descriptions containing vowels
SELECT * FROM notes WHERE description REGEXP '[aeiouAEIOU]';
