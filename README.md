Veebirakendus: Tallinna üldhariduskoolide võrk
===
Eesmärki ja lühikirjeldus
---
Tegemist on veebirakendusega, kus on võimalik vaadata Eestis tegutsevate või juba tegutsemise lõpetanud üldhariduskoolide infot. Peamiselt on rakenduse eesmärk, et selle kasutajad saaksid vaadata palju mingil aastal kuskil koolis õpilasi oli. Saab ka eraldi vaadata ka osade koolide puhul palju tüdrukuid, poisse ja mis keelseid õpilasi mingil aasta oli. Meie klient oli kogunud sell info kokku ja meie meeskonna eesmärgiks on viia see veebisõralikku keskkonda, kus seda saavad vaatamas käia, kes sellest huvitatud on. Lisaks on ka administraatori leht, kus saab lisada infot juurde või vajadusel muuta.

Töö on tehtud [Tallinna Ülikooli Digitehnoloogiate instituudi](https://www.tlu.ee/et/Digitehnoloogiate-instituut) suvepraktika raames.

Tehnoloogiad
---
Javascript

Php  

CSS  

HTML  

Mysql  

jquery  

Meeskond  
---
Oscar August Heinla  

Kent Loog  

Tanel Otsa  

Kirill Kotkas  

Brigid-Ly Palkman   

Paigaldus
---
Tuleks tõsta The Real Deal kausta sisu greenyse ja peale seda saab rakendust kasutada.
Andmebaasi käsud on järgmised:

KOOLI INFO TABEL  
CREATE TABLE `s_schools` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `county` varchar(50) DEFAULT NULL,
  `parish` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `webpage` varchar(100) DEFAULT NULL,
  `deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ÕPILASED AASTA KOHTA TABEL  
CREATE TABLE `s_data` (
  `id` varchar(30) NOT NULL,
  `year` varchar(50) NOT NULL,
  `REG_ID` int(11) NOT NULL,
  `students` varchar(50) DEFAULT NULL,
  `boys` varchar(50) DEFAULT NULL,
  `girls` varchar(50) DEFAULT NULL,
  `teachers` varchar(50) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

AADRESSI MUUTUSE TABEL  
CREATE TABLE `s_address` (
  `REG_ID` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

KOOLI AVAMISE TABEL  
CREATE TABLE `s_founded` (
  `REG_ID` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

NIME MUUTUSE TABEL  
CREATE TABLE `s_names` (
  `REG_ID` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DIREKTORITE TABEL  
CREATE TABLE `s_principals` (
  `REG_ID` int(11) NOT NULL,
  `start_year` int(11) DEFAULT NULL,
  `end_year` int(11) DEFAULT NULL,
  `principal` varchar(50) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

PILTIDE TABEL
CREATE TABLE `s_pic` (
  `REG_ID` int,
  `pic_nr` int,
  `link` text,
  `name` text,
  `deleted` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;