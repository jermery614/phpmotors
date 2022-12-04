--Query 1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail,clientPassword, clientLevel, comment)
VALUES ('Tony', 'Stark', 'tonystarkent.com', 'Iam1ronM2n', 1, 'I am the real Ironman.' );

--Query 2
UPDATE clients SET clientLevel = 3
WHERE clientId = 1; 

--Query 3
UPDATE inventory SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invId = 12 AND invModel ='Hummer';

--Query 4
SELECT invModel , classificationName 
FROM Inventory x
INNER JOIN carclassification y ON
x.classificationId = y.classificationId
WHERE classificationName = 'SUV';
 --Query 5
DELETE FROM inventory 
WHERE invId =1;

--Query 6
UPDATE inventory SET invImage = CONCAT('/phpmotors', invImage), invThumbnail = CONCAT('/phpmotors', invThumbnail);