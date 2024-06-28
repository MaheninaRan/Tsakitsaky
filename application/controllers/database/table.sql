    Drop database tsakitsaky;
    CREATE database tsakitsaky;
    use tsakitsaky;

    CREATE TABLE genre(
        id int primary key auto_increment,
        nom varchar(10)
    );

    CREATE TABLE admin(
        id int primary key auto_increment,
        nom varchar(30),
        prenom varchar(30),
        idgenre int references genre(id),
        email varchar(30),
        passwORd varchar(30)
    );  
    CREATE TABLE etudiant(
        id int primary key auto_increment,
        nom varchar(30),
        prenom varchar(30),
        idgenre int references genre(id),
        email varchar(30),
        passwORd varchar(30)
    );  

    CREATE TABLE produit(
        id int primary key auto_increment,
        nom varchar(30),
        valeur varchar(10),
        unite varchar(10),
        prix float
    );  

    CREATE TABLE stockproduit(
        id int primary key auto_increment,
        idproduit int references produit(id),
        dateheure datetime,
        quantite float,
        etat int
    );

    CREATE TABLE packet(
        id int primary key auto_increment,
        nom varchar(30),
        photo varchar(50),
        prix float
    );

    CREATE TABLE stockpacket(
        id int primary key auto_increment,
        idpacket int references packet(id),
        dateheure datetime,
        quantite float,
        etat int
    );
    CREATE TABLE produitpacket(
        id int primary key auto_increment,
        idpacket int references packet(id),
        idproduit int references produit(id),
        quantite float
    );  

    CREATE TABLE lieu(
        id int primary key auto_increment,
        axe int,
        nom varchar(30)
    );

    CREATE TABLE detailvente(
        id int primary key auto_increment,
        idetudiant int references etudiant(id),
        idpacket int references packet(id),
        client varchar(20),
        dateheure datetime,
        idlieu int references lieu(id),
        etatpaiement varchar(20)
    );


    CREATE OR REPLACE VIEW matierepremier as 
    SELECT pack.id,pack.idpacket, pack.idproduit,pack.quantite, (pack.quantite*prod.prix)/prod.valeur as prix
    FROM produit as prod 
    INNER JOIN produitpacket as pack on pack.idproduit=prod.id
    GROUP BY idproduit,idpacket
    ORDER BY idpacket;

    CREATE OR REPLACE VIEW VenduEtudiant AS 
    SELECT idetudiant,idpacket,count(*) AS quantite
    FROM detailvente GROUP by idpacket,idetudiant ORDER BY idetudiant;

    CREATE OR REPLACE VIEW detailpayment AS
    SELECT det.id as detail, det.idetudiant,det.etatpaiement,sum(pack.prix) as montant
    FROM detailvente as det 
    INNER JOIN packet as pack on det.idpacket = pack.id
    GROUP BY det.idetudiant,det.etatpaiement;

    CREATE OR REPLACE VIEW paiementEtudiant AS
    SELECT  det.idetudiant,
            IFNULL(SUM(Case WHEN det.etatpaiement=1 THEN det.montant ELSE 0 END),0) AS payer,
            IFNULL(SUM(Case WHEN det.etatpaiement=0 THEN det.montant ELSE 0 END),0) AS reste
    FROM detailpayment as det 
    GROUP BY det.idetudiant;

    INSERT INTO genre(nom) values ('Homme'),('Femme');
    INSERT INTO admin(nom,prenom,idgenre,email,password) values('RANDRIA','Mahenina',1,'Mahenina@gmail.com','Mahenina');
    INSERT INTO etudiant(nom,prenom,idgenre,email,password) values
    ('RAJAONARISOA','Mirana',2,'Mirana@gmail.com','Mirana'),
    ('RAKOTOBE','Jean',1,'Jean@gmail.com','Jean'),
    ('RAMILY','Mec',1,'Mec@gmail.com','Mec');

    INSERT INTO produit(nom,valeur,unite,prix) values
    ('Sosisy',1,'pc',2000),
    ('Karoty',1,'pc',500),
    ('Fromage',50,'g',2500);
    INSERT INTO stockproduit(idproduit,dateheure,quantite,etat) values
    (1,'12-04-2024 12:00',999999999,1),
    (2,'12-04-2024 12:00',999999999,1),
    (3,'12-04-2024 12:00',999999999,1);

    INSERT INTO packet(nom,photo,prix) values 
    ('Matsiro','img/kaly1.jpg',20000),
    ('Doreintsa','img/kaly2.jpg',30000); 
    INSERT INTO stockpacket(idpacket,dateheure,quantite,etat) values
    (1, '12-04-2024 17:00',999999999,1),
    (2, '12-04-2024 17:00',999999999,1);
    INSERT INTO produitpacket(idpacket,idproduit,quantite) values
    (1,1,3),
    (1,2,5),
    (2,3,250),
    (2,1,2),
    (2,2,1);
    
    INSERT INTO lieu(axe,nom) values
    (1,'Andoharanofotsy'),
    (1,'Tanjombato'),
    (1,'Iavoloha'),
    (2,'Tsibazaza'),
    (2,'Ankadibahoka'),
    (3,'Mahamasina'),
    (3,'Analakely'),
    (3,'Behoririka');

