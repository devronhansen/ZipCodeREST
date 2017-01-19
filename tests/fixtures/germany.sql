CREATE TABLE germany (
  Ort        VARCHAR(32) DEFAULT NULL,
  Zusatz     VARCHAR(30) DEFAULT NULL,
  Plz        INT(5)      DEFAULT NULL,
  Vorwahl    VARCHAR(6)  DEFAULT NULL,
  Bundesland VARCHAR(22) DEFAULT NULL
);

INSERT INTO germany VALUES ('Flensburg', 'Tead', '24941', '0122513', 'SSH');
INSERT INTO germany VALUES ('Flensburg', 'Tead', '24939', '1251324', 'SSH');