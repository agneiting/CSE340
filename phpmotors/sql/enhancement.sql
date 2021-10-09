INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', '"I am the real Ironman"');

UPDATE clients
SET clientLevel = '2'
WHERE clientID = '2';

UPDATE inventory
SET invDescription = 'Do you have 6 kids and like to go off-roading? The Hummer gives you the spacious interiors with an engine to get you out of any muddy or rocky situation.'
WHERE invID = '12';

SELECT invModel, 
	classificationName
FROM inventory
JOIN carclassification
	ON inventory.classificationId = carclassification.classificationId
WHERE classificationName = 'SUV';

DELETE FROM inventory
WHERE invId = '1';

UPDATE inventory
SET invImage = concat('/phpmotors',invImage), 
	invThumbnail = concat('/phpmotors',invThumbnail);