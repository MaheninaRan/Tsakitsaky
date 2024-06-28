create database course;
use course;

CREATE TABLE admin  (
    id int PRIMARY KEY auto_increment,
    nom varchar(30),
    prenom varchar(30),
    email varchar(30) unique ,
    password varchar(20)
);

create table equipe(
    id int PRIMARY KEY auto_increment,
    nom varchar(5),
    login varchar(30),
    mdp varchar(5)
);

create table etape (
    id int PRIMARY KEY auto_increment,
    nom varchar(20),
    debut timestamp,
    longueur double precision,
    nbcoureur int,
    rang int
);

create table genre(
    id int PRIMARY KEY auto_increment,
    nom varchar(10)
);

create  table coureur(
    id int PRIMARY KEY auto_increment,
    nom varchar(20),
    numero int unique ,
    idgenre int references genre,
    dtn date,
    idequipe int references equipe
);

create table categorie(
    id int PRIMARY KEY auto_increment,
    nom varchar(20)
);

create table coureurcategorie(
    id int PRIMARY KEY auto_increment,
    idcategorie int references categorie,
    idcoureur int references coureur
);

create table compositionetape(
    id int PRIMARY KEY auto_increment,
    idetape int references etape,
    idcoureur int references coureur
);

create table point(
    id int PRIMARY KEY auto_increment,
    place int,
    point double precision
);

create table resultatetape(
    id int PRIMARY KEY auto_increment,
    idcompositionetape int references compositionetape,
    debut timestamp,
    fin timestamp

);



INSERT INTO admin (nom,prenom, email, password) VALUES
   ('John ','Doe', 'john@example.com',  'password123');

-----------------------------------------------------x---------------------------------------
create table ipoint(
    id int PRIMARY KEY auto_increment,
    classement int,
    points int
);

CREATE TABLE ietape(
    id int PRIMARY KEY auto_increment,
    etape varchar(30),
    longueur varchar(30),
    nbcoureur varchar(30),
    rang varchar(30),
    datedepart varchar(30),
    heuredepart varchar(30)
);

CREATE TABLE iresultat(
    id int PRIMARY KEY auto_increment,
    etaperang varchar(30),
    numdossard varchar(30),
    nom varchar(30),
    genre varchar(30),
    dateNaissance varchar(30),
    equipe varchar(30),
    arriver varchar(30)
);


CREATE TABLE penalite(
    id serial primary key,
    etape_id int references etape,
    equipe_id int references equipe,
    penalite time
);


CREATE OR REPLACE VIEW v_penalite AS
SELECT
    row_number() over () as id,
    etape_id,
    equipe_id,
    SUM(penalite) AS penalite
FROM
    penalite
GROUP BY
    etape_id,
    equipe_id;

CREATE OR REPLACE VIEW temps_resultats AS
SELECT
    re.id AS id_resultat,
    re.idcompositionetape,
    cp.idetape,
    cp.idcoureur,
    cr.idequipe,
    re.debut,
    re.fin,
    CAST(re.fin - re.debut AS INTERVAL) + COALESCE(CAST(p.penalite AS INTERVAL), '00:00:00') as temps
FROM
    resultatetape as re
    JOIN compositionetape as cp ON re.idcompositionetape = cp.id
    JOIN coureur as cr on cp.idcoureur = cr.id
    LEFT JOIN v_penalite p ON p.equipe_id = cr.idequipe AND p.etape_id = cp.idetape;

CREATE OR REPLACE VIEW resultats_par_etape AS
SELECT
    *,
    DENSE_RANK() OVER (PARTITION BY idetape ORDER BY temps) AS classement_par_etape
FROM
    temps_resultats;


------classement par etape
    CREATE OR REPLACE VIEW classement_par_etape AS
SELECT row_number() OVER () AS id, rpe.*, COALESCE(p.point,0) as point FROM resultats_par_etape rpe
Left JOIN point p ON rpe.classement_par_etape = p.place;

------classement par equipe
CREATE OR REPLACE VIEW classement_generale_equipe AS
SELECT  row_number() OVER () AS id, DENSE_RANK() OVER (order by sum(point)desc ) AS rang,cpe.idequipe, SUM(cpe.point) as pointequipe FROM classement_par_etape cpe GROUP BY cpe.idequipe ORDER BY pointequipe desc;

------classement par coureur
CREATE OR REPLACE VIEW v_resultat_coureur AS
SELECT row_number() OVER () AS id,c.idetape,c.idcoureur,coalesce(t.temps,'00:00:00') as temps
                FROM compositionetape c
                 Left JOIN temps_resultats t on c.id=t.idcompositionetape;


------classement par categorie
CREATE OR REPLACE VIEW v_temps_categorie AS
SELECT row_number() OVER (PARTITION BY idcategorie ORDER BY t.temps) AS rang,c.idcoureur,t.temps,c.idcategorie
FROM temps_resultats t
         INNER JOIN coureurcategorie c on t.idcoureur = c.idcoureur;

------point par rang
    CREATE OR REPLACE VIEW v_tout_categorie AS
    SELECT row_number() OVER () AS id,co.id as idcoureur,v.temps,eq.id as idequipe, v.idcategorie,p.point
    FROM v_temps_categorie v
             INNER JOIN point p on p.id = v.rang
             INNER JOIN coureur co on co.id = v.idcoureur
             INNER JOIN equipe eq on eq.id = co.idequipe;

------point par categorie
CREATE OR REPLACE VIEW v_equipe_categorie AS
SELECT row_number() OVER () AS id, idequipe, idcategorie, SUM(point) AS point_total
FROM (
         SELECT co.idequipe, v.idcategorie, p.point
         FROM v_temps_categorie v
                  INNER JOIN point p ON p.id = v.rang
                  INNER JOIN coureur co ON co.id = v.idcoureur
                  INNER JOIN equipe eq ON eq.id = co.idequipe
     ) AS subquery
GROUP BY idequipe, idcategorie;

SELECT
            row_number() OVER () AS id,
    idequipe,
    null,
    SUM(point_total) as point_total
FROM v_equipe_categorie v
GROUP BY idequipe;



-------------------aaa

----Vue classement coureur par categorie


CREATE OR REPLACE VIEW classement_par_categorie AS
SELECT
    comp.idetape,
    c.idequipe,
    cc.idcategorie AS categorie_id,
    cat.nom AS categorie_nom,
    c.id AS coureur_id,
    c.nom AS coureur_nom,
    r.debut,
    r.fin,
    CAST(r.fin - r.debut AS INTERVAL) + COALESCE(CAST(p.penalite AS INTERVAL), '00:00:00') AS duree,
    DENSE_RANK() OVER (PARTITION BY comp.idetape, cc.idcategorie ORDER BY CAST(r.fin - r.debut AS INTERVAL) + COALESCE(CAST(p.penalite AS INTERVAL), '00:00:00')) AS classement
FROM
    coureurcategorie cc
        JOIN coureur c ON cc.idcoureur = c.id
        JOIN categorie cat ON cc.idcategorie = cat.id
        JOIN compositionetape comp ON comp.idcoureur = c.id
        JOIN resultatetape r ON r.idcompositionetape = comp.id
        LEFT JOIN v_penalite p ON comp.idetape = p.etape_id AND p.equipe_id = c.idequipe
ORDER BY cc.idcategorie, classement;

CREATE TABLE events (
                        event_id SERIAL PRIMARY KEY,
                        event_time TIMESTAMP,
                        duration TIME
);

-- Insertion d'un événement avec une durée
INSERT INTO events (event_time, duration) VALUES ('2024-06-04 12:00:00', '02:00:00');

-- Calcul du nouveau timestamp après addition de la durée
SELECT event_time + INTERVAL duration AS new_event_time
FROM events;

--- Vue resultat generale equipe par categorie

CREATE OR REPLACE VIEW resultat_equipe_categorie AS
SELECT
    row_number() OVER () AS id,
    cpc.idequipe,
    cpc.categorie_id,
    cpc.categorie_nom,
    SUM(COALESCE(p.point, 0)) as totalpoints
FROM
    classement_par_categorie cpc
    LEFT JOIN
    point p ON cpc.classement = p.place
GROUP BY
    cpc.idequipe, cpc.categorie_id, cpc.categorie_nom
ORDER BY
    cpc.categorie_id, totalpoints DESC;

--- Vue classement generale equipe par categorie

CREATE OR REPLACE VIEW classement_generale_equipe_categorie AS
SELECT
    row_number() OVER () AS id,
    rec.idequipe,
    rec.categorie_id,
    rec.totalpoints,
    DENSE_RANK() OVER (PARTITION BY rec.categorie_id ORDER BY rec.totalpoints DESC) AS classement
FROM
    resultat_equipe_categorie rec
ORDER BY
    rec.categorie_id, classement;

CREATE OR REPLACE VIEW v_penalite AS
SELECT
    row_number() over () as id,
    etape_id,
    equipe_id,
    SUM(penalite) AS penalite
FROM
    penalite
GROUP BY
    etape_id,
    equipe_id
