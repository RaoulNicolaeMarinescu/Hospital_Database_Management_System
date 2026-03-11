-- Inserimento dati per la tabella Ospedale
INSERT INTO Ospedale (CodiceOspedale, Nome, Indirizzo) VALUES
('OSP001', 'Ospedale Centrale', 'Via Roma, 1'),
('OSP002', 'Ospedale Nord', 'Via Milano, 2'),
('OSP003', 'Ospedale Sud', 'Via Napoli, 3');

-- Inserimento dati per la tabella ProntoSoccorso
INSERT INTO ProntoSoccorso (CodiceProntoSoccorso, Ospedale) VALUES
('PSC001', 'OSP001'),
('PSC002', 'OSP002');

-- Inserimento dati per la tabella Reparto
INSERT INTO Reparto (CodiceReparto, Ospedale, Nome, NumeroTelefono, InizioOrarioVisita, FineOrarioVisita) VALUES
('REP001', 'OSP001', 'Cardiologia', '1234567890', '10:00:00', '18:00:00'),
('REP002', 'OSP002', 'Ortopedia', '0987654321', '11:00:00', '19:00:00'),
('REP003', 'OSP003', 'Medicina Generale', '1122334455', '09:00:00', '17:00:00'),
('REP004', 'OSP001', 'Pediatria', '1223334444', '12:00:00', '20:00:00'),
('REP005', 'OSP003', 'Chirurgia', '1888999000', '14:00:00', '21:00:00');

-- Inserimento dati per la tabella PersonaleAmministrativo
INSERT INTO PersonaleAmministrativo (CF, Reparto, Nome, Cognome, DataNascita) VALUES
('CF00000000000001', 'REP001', 'Mario', 'Rossi', '1980-01-01'),
('CF00000000000002', 'REP002', 'Luigi', 'Bianchi', '1985-02-02'),
('CF00000000000003', 'REP003', 'Anna', 'Verdi', '1990-03-03'),
('CF00000000000004', 'REP004', 'Carlo', 'Neri', '1982-04-04'),
('CF00000000000005', 'REP005', 'Marta', 'Rosa', '1987-05-05'),
('CF00000000000006', 'REP001', 'Elisa', 'Viola', '1992-06-06'),
('CF00000000000007', 'REP002', 'Stefano', 'Blu', '1975-07-07'),
('CF00000000000008', 'REP003', 'Giulia', 'Gialli', '1981-08-08'),
('CF00000000000009', 'REP004', 'Simone', 'Arancio', '1986-09-09'),
('CF00000000000010', 'REP005', 'Paolo', 'Neri', '1980-10-10'),
('CF00000000000011', 'REP001', 'Federica', 'Rossi', '1985-11-11'),
('CF00000000000012', 'REP002', 'Giorgio', 'Bianchi', '1990-12-12'),
('CF00000000000013', 'REP003', 'Lucia', 'Verdi', '1982-01-13'),
('CF00000000000014', 'REP004', 'Alessandro', 'Blu', '1987-02-14'),
('CF00000000000015', 'REP005', 'Valeria', 'Gialli', '1992-03-15');

-- Inserimento dati per la tabella Infermiere
INSERT INTO Infermiere (CF, Reparto, Nome, Cognome, DataNascita) VALUES
('CF00000000000016', 'REP001', 'Giovanni', 'Rossi', '1981-04-16'),
('CF00000000000017', 'REP002', 'Francesca', 'Bianchi', '1983-05-17'),
('CF00000000000018', 'REP003', 'Andrea', 'Verdi', '1991-06-18'),
('CF00000000000019', 'REP004', 'Lorenzo', 'Neri', '1984-07-19'),
('CF00000000000020', 'REP005', 'Elena', 'Rosa', '1989-08-20'),
('CF00000000000021', 'REP001', 'Martina', 'Viola', '1994-09-21'),
('CF00000000000022', 'REP002', 'Roberto', 'Blu', '1976-10-22'),
('CF00000000000023', 'REP003', 'Giada', 'Gialli', '1982-11-23'),
('CF00000000000024', 'REP004', 'Matteo', 'Arancio', '1987-12-24'),
('CF00000000000025', 'REP005', 'Alberto', 'Neri', '1983-01-25'),
('CF00000000000026', 'REP001', 'Silvia', 'Rossi', '1988-02-26'),
('CF00000000000027', 'REP002', 'Federico', 'Bianchi', '1993-03-27'),
('CF00000000000028', 'REP003', 'Chiara', 'Verdi', '1985-04-28'),
('CF00000000000029', 'REP004', 'Dario', 'Blu', '1990-05-29'),
('CF00000000000030', 'REP005', 'Serena', 'Gialli', '1995-06-30');

-- Inserimento dati per la tabella PersonaleMedico
INSERT INTO PersonaleMedico (CF, Reparto, Nome, Cognome, DataNascita, AnzianitaServizio) VALUES
('CF00000000000031', 'REP001', 'Pietro', 'Rossi', '1977-07-31', 20),
('CF00000000000032', 'REP002', 'Marco', 'Bianchi', '1982-08-01', 15),
('CF00000000000033', 'REP003', 'Stefania', 'Verdi', '1987-09-02', 10),
('CF00000000000034', 'REP004', 'Paola', 'Neri', '1981-10-03', 12),
('CF00000000000035', 'REP005', 'Michele', 'Rosa', '1986-11-04', 8),
('CF00000000000036', 'REP001', 'Sergio', 'Viola', '1991-12-05', 5),
('CF00000000000037', 'REP002', 'Giuseppe', 'Blu', '1978-01-06', 18),
('CF00000000000038', 'REP003', 'Rita', 'Gialli', '1983-02-07', 14),
('CF00000000000039', 'REP004', 'Daniele', 'Arancio', '1988-03-08', 9),
('CF00000000000040', 'REP005', 'Claudia', 'Neri', '1982-04-09', 11),
('CF00000000000041', 'REP001', 'Matilde', 'Rossi', '1987-05-10', 7),
('CF00000000000042', 'REP002', 'Alessio', 'Bianchi', '1992-06-11', 4),
('CF00000000000043', 'REP003', 'Renato', 'Verdi', '1979-07-12', 17),
('CF00000000000044', 'REP004', 'Claudio', 'Blu', '1984-08-13', 13),
('CF00000000000045', 'REP005', 'Giorgia', 'Gialli', '1989-01-14', 8),
('CF00000000000046', 'REP001', 'Valerio', 'Trump', '1994-09-11', 4),
('CF00000000000047', 'REP002', 'Vincenza', 'Pavia', '1971-08-12', 13),
('CF00000000000048', 'REP003', 'Fagiolina', 'Gallarate', '1981-08-13', 16),
('CF00000000000049', 'REP004', 'Peppa', 'Pig', '1983-04-14', 3),
('CF00000000000050', 'REP005', 'Michael', 'Duro', '1981-03-14', 4);

-- Inserimento dati per la tabella Specializzazione
INSERT INTO Specializzazione (Tipo) VALUES
('Cardiologia'),
('Ortopedia'),
('Neurologia'),
('Pediatria'),
('Oncologia'),
('Chirurgia'),
('Dermatologia'),
('Ginecologia'),
('Urologia'),
('Oftalmologia'),
('Psichiatria'),
('Endocrinologia'),
('Gastroenterologia'),
('Nefrologia'),
('Ematologia');

-- Inserimento dati per la tabella SalaOperatoria
INSERT INTO SalaOperatoria (CodiceSalaOperatoria, Reparto) VALUES
('SOP001', 'REP001'),
('SOP002', 'REP002'),
('SOP003', 'REP003'),
('SOP004', 'REP004'),
('SOP005', 'REP005'),
('SOP006', 'REP001'),
('SOP007', 'REP002'),
('SOP008', 'REP003'),
('SOP009', 'REP004'),
('SOP010', 'REP005'),
('SOP011', 'REP001'),
('SOP012', 'REP002'),
('SOP013', 'REP003'),
('SOP014', 'REP004'),
('SOP015', 'REP005');

-- Inserimento dati per la tabella LaboratorioAmbulatorio
INSERT INTO LaboratorioAmbulatorio (CodiceLabAmb, Tipo, Piano, OrarioApertura, OrarioChiusura, NumeroTelefono, Indirizzo) VALUES
('LAB001', 'Interno', 1, NULL, NULL, NULL, NULL),
('LAB002', 'Esterno', NULL, '09:00:00', '19:00:00', '3213214321', 'Via Test, 2'),
('LAB003', 'Interno', 3, NULL, NULL, NULL, NULL),
('LAB004', 'Esterno', NULL, '08:30:00', '18:00:00', '7897897890', 'Via Test, 4'),
('LAB005', 'Interno', 2, NULL, NULL, NULL, NULL),
('LAB006', 'Esterno', NULL, '10:30:00', '20:00:00', '9879879870', 'Via Test, 6'),
('LAB007', 'Interno', 1, NULL, NULL, NULL, NULL),
('LAB008', 'Esterno', NULL, '09:45:00', '19:00:00', '8768768761', 'Via Test, 8'),
('LAB009', 'Interno', 3, NULL, NULL, NULL, NULL),
('LAB010', 'Interno', 1, NULL, NULL, NULL, NULL),
('LAB011', 'Esterno', NULL, '09:15:00', '19:00:00', '3213214322', 'Via Test, 11'),
('LAB012', 'Interno', 3, NULL, NULL, NULL, NULL),
('LAB013', 'Esterno', NULL, '08:50:00', '18:00:00', '7897897891', 'Via Test, 13'),
('LAB014', 'Interno', 2, NULL, NULL, NULL, NULL),
('LAB015', 'Esterno', NULL, '10:50:00', '20:00:00', '9879879871', 'Via Test, 15');

-- Inserimento dati per la tabella Stanza
INSERT INTO Stanza (CodiceStanza, Numero, Reparto, LettiOccupati, LettiTotali) VALUES
('STA101', 1, 'REP001', 241, 490),
('STA202', 2, 'REP002', 112, 350),
('STA303', 3, 'REP003', 14, 240),
('STA404', 4, 'REP004', 344, 430),
('STA501', 1, 'REP005', 21, 380),
('STA102', 2, 'REP001', 142, 210),
('STA203', 3, 'REP002', 111, 400),
('STA304', 4, 'REP003', 251, 320),
('STA405', 5, 'REP004', 221, 240),
('STA511', 11, 'REP005', 166, 440),
('STA112', 12, 'REP001', 124, 370),
('STA213', 13, 'REP002', 35, 210),
('STA315', 15, 'REP003', 225, 420),
('STA417', 17, 'REP004', 163, 370),
('STA518', 18, 'REP005', 125, 210);

-- Paziente
INSERT INTO Paziente (TesseraSanitaria, Nome, Cognome, DataNascita) VALUES
('10000000000000000001', 'Marco', 'Rossi', '1985-04-10'),
('10000000000000000002', 'Luca', 'Bianchi', '1990-07-12'),
('10000000000000000003', 'Maria', 'Verdi', '1975-11-05'),
('10000000000000000004', 'Anna', 'Neri', '1982-02-20'),
('10000000000000000005', 'Paolo', 'Gialli', '1993-09-15'),
('10000000000000000006', 'Laura', 'Blu', '1988-05-22'),
('10000000000000000007', 'Giovanni', 'Grigi', '1979-03-30'),
('10000000000000000008', 'Chiara', 'Rossi', '1995-08-19'),
('10000000000000000009', 'Alessandro', 'Bianchi', '1983-06-28'),
('10000000000000000010', 'Elisa', 'Verdi', '1998-12-14'),
('10000000000000000011', 'Giorgio', 'Neri', '1972-01-18'),
('10000000000000000012', 'Francesca', 'Gialli', '1980-07-05'),
('10000000000000000013', 'Simone', 'Blu', '1991-10-11'),
('10000000000000000014', 'Serena', 'Grigi', '1987-09-25'),
('10000000000000000015', 'Matteo', 'Rossi', '1996-04-04');

-- PazienteRicoverato
INSERT INTO PazienteRicoverato (CodiceRicovero, TesseraSanitaria, DataRicovero, Patologie, Stanza) VALUES
('RIC001', '10000000000000000001', '2023-06-10', 'Appendicite', 'STA101'),
('RIC010', '10000000000000000001', '2023-07-10', 'Appendicite', 'STA101'),
('RIC011', '10000000000000000001', '2023-08-10', 'Appendicite', 'STA101'),
('RIC012', '10000000000000000001', '2023-09-10', 'Appendicite', 'STA101'),
('RIC002', '10000000000000000002', '2023-06-11', 'Frattura', 'STA102'),
('RIC003', '10000000000000000003', '2023-06-12', 'Bronchite', 'STA203'),
('RIC004', '10000000000000000004', '2023-06-13', 'Gastrite', 'STA304'),
('RIC005', '10000000000000000005', '2023-06-14', 'Polmonite', 'STA405'),
('RIC006', '10000000000000000006', '2023-06-15', 'Diabete', 'STA417'),
('RIC007', '10000000000000000007', '2023-06-16', 'Ipertensione', 'STA511'),
('RIC008', '10000000000000000008', '2023-06-17', 'Frattura', 'STA518'),
('RIC009', '10000000000000000009', '2023-06-18', 'Emicrania', 'STA213'),
('RIC013', '10000000000000000010', '2023-06-19', 'Artrite', 'STA501'),
('RIC014', '10000000000000000011', '2023-06-20', 'Asma', 'STA112'),
('RIC015', '10000000000000000012', '2023-06-21', 'Cistite', 'STA213');

-- PazienteDimesso
INSERT INTO PazienteDimesso (CodiceRicovero, DataDimissione) VALUES
('RIC001', '2023-06-25'),
('RIC002', '2023-06-26'),
('RIC003', '2023-06-27'),
('RIC004', '2023-06-28'),
('RIC005', '2023-06-29'),
('RIC006', '2023-06-30'),
('RIC007', '2023-07-01'),
('RIC008', '2023-07-02'),
('RIC009', '2023-07-03');

-- VicePrimario
INSERT INTO VicePrimario (CF, Reparto, DataAssunzioneRuolo) VALUES
('CF00000000000031', 'REP001', '2020-01-01'),
('CF00000000000032', 'REP002', '2020-02-01'),
('CF00000000000033', 'REP003', '2020-03-01'),
('CF00000000000034', 'REP004', '2020-04-01'),
('CF00000000000035', 'REP005', '2020-05-01'),
('CF00000000000036', 'REP001', '2020-06-01'),
('CF00000000000037', 'REP002', '2020-07-01'),
('CF00000000000038', 'REP003', '2020-08-01'),
('CF00000000000039', 'REP004', '2020-09-01'),
('CF00000000000040', 'REP005', '2020-10-01');

-- Primario
INSERT INTO Primario (CF, Reparto) VALUES
('CF00000000000041', 'REP001'),
('CF00000000000042', 'REP002'),
('CF00000000000043', 'REP003'),
('CF00000000000044', 'REP004'),
('CF00000000000045', 'REP005');

-- TurnoLavorativoInfermiere
INSERT INTO TurnoLavorativoInfermiere (CodiceTurno, Infermiere, ProntoSoccorso, OraInizio, OraFine, Data) VALUES 
('TUR001', 'CF00000000000016', 'PSC001', '08:00:00', '16:00:00', '2024-07-11'),
('TUR002', 'CF00000000000017', 'PSC002', '08:00:00', '16:00:00', '2024-07-11'),
('TUR003', 'CF00000000000019', 'PSC001', '08:00:00', '16:00:00', '2024-07-11'),
('TUR004', 'CF00000000000021', 'PSC001', '16:00:00', '23:00:00', '2024-07-14'),
('TUR005', 'CF00000000000022', 'PSC002', '00:00:00', '08:00:00', '2024-07-14'),
('TUR006', 'CF00000000000024', 'PSC001', '00:00:00', '08:00:00', '2024-07-15'),
('TUR007', 'CF00000000000026', 'PSC001', '08:00:00', '16:00:00', '2024-07-16'),
('TUR008', 'CF00000000000027', 'PSC002', '08:00:00', '16:00:00', '2024-07-17'),
('TUR009', 'CF00000000000029', 'PSC001', '16:00:00', '23:00:00', '2024-07-18');


-- TurnoLavorativoMedico
INSERT INTO TurnoLavorativoMedico (CodiceTurno, PersonaleMedico, ProntoSoccorso, OraInizio, OraFine, Data) VALUES
('TUR010', 'CF00000000000031', 'PSC001', '08:00:00', '14:00:00', '2024-07-01'),
('TUR011', 'CF00000000000032', 'PSC002', '14:00:00', '20:00:00', '2024-07-01'),
('TUR012', 'CF00000000000034', 'PSC001', '02:00:00', '08:00:00', '2024-07-02'),
('TUR013', 'CF00000000000036', 'PSC001', '02:00:00', '08:00:00', '2024-07-02'),
('TUR014', 'CF00000000000037', 'PSC002', '20:00:00', '23:00:00', '2024-07-03'),
('TUR015', 'CF00000000000039', 'PSC001', '08:00:00', '14:00:00', '2024-07-03'),
('TUR016', 'CF00000000000041', 'PSC001', '20:00:00', '23:00:00', '2024-07-04'),
('TUR017', 'CF00000000000042', 'PSC002', '02:00:00', '08:00:00', '2024-07-04'),
('TUR018', 'CF00000000000044', 'PSC001', '14:00:00', '20:00:00', '2024-07-04'),
('TUR019', 'CF00000000000046', 'PSC001', '02:00:00', '08:00:00', '2024-07-05'),
('TUR020', 'CF00000000000047', 'PSC002', '08:00:00', '14:00:00', '2024-07-05'),
('TUR021', 'CF00000000000049', 'PSC001', '20:00:00', '23:00:00', '2024-07-06'),
('TUR022', 'CF00000000000031', 'PSC001', '08:00:00', '14:00:00', '2024-07-06'),
('TUR023', 'CF00000000000032', 'PSC002', '14:00:00', '20:00:00', '2024-07-06'),
('TUR024', 'CF00000000000034', 'PSC001', '02:00:00', '08:00:00', '2024-07-07');

INSERT INTO Sostituzione (CodiceSostituzione, DataInizio, VicePrimario, Primario, DataFine) VALUES
('SOS001', '2024-06-01', 'CF00000000000031', 'CF00000000000041', '2024-06-15'),
('SOS002', '2024-06-27', 'CF00000000000036', 'CF00000000000041', '2024-06-30'),
('SOS003', '2024-07-01', 'CF00000000000036', 'CF00000000000041', '2024-07-15'),
('SOS004', '2024-06-01', 'CF00000000000037', 'CF00000000000042', '2024-06-15'),
('SOS005', '2024-08-01', 'CF00000000000032', 'CF00000000000042', '2024-08-15'),
('SOS006', '2024-08-16', 'CF00000000000038', 'CF00000000000043', '2024-08-31'),
('SOS007', '2024-09-01', 'CF00000000000033', 'CF00000000000043', '2024-09-15'),
('SOS008', '2024-09-16', 'CF00000000000039', 'CF00000000000044', '2024-09-30'),
('SOS009', '2024-10-01', 'CF00000000000034', 'CF00000000000044', '2024-10-15'),
('SOS010', '2024-10-16', 'CF00000000000039', 'CF00000000000044', '2024-10-31');

INSERT INTO Dispone (Ospedale, LaboratorioAmbulatorio) VALUES
('OSP001', 'LAB001'),
('OSP003', 'LAB003'),
('OSP002', 'LAB005'),
('OSP003', 'LAB007'),
('OSP003', 'LAB009'),
('OSP003', 'LAB010'),
('OSP003', 'LAB012'),
('OSP002', 'LAB014');

INSERT INTO Collocata (LaboratorioAmbulatorio, Stanza) VALUES
('LAB001', 'STA101'),
('LAB003', 'STA303'),
('LAB005', 'STA202'),
('LAB007', 'STA304'),
('LAB009', 'STA511'),
('LAB010', 'STA315'),
('LAB012', 'STA518'),
('LAB014', 'STA203');

INSERT INTO Ottenuto (Specializzazione, Primario) VALUES
('Cardiologia', 'CF00000000000041'),
('Ortopedia', 'CF00000000000041'),
('Neurologia', 'CF00000000000041'),
('Pediatria', 'CF00000000000041'),
('Oncologia', 'CF00000000000042'),
('Chirurgia', 'CF00000000000042'),
('Dermatologia', 'CF00000000000042'),
('Ginecologia', 'CF00000000000042'),
('Urologia', 'CF00000000000043'),
('Oftalmologia', 'CF00000000000044'),
('Psichiatria', 'CF00000000000044'),
('Endocrinologia', 'CF00000000000044'),
('Gastroenterologia', 'CF00000000000044'),
('Nefrologia', 'CF00000000000044'),
('Ematologia', 'CF00000000000044'),
('Cardiologia', 'CF00000000000045'),
('Ortopedia', 'CF00000000000045'),
('Neurologia', 'CF00000000000045'),
('Pediatria', 'CF00000000000045'),
('Oncologia', 'CF00000000000041');

INSERT INTO Esame (CodiceEsame, CodiceMedico, Descrizione, CostoAssistenzaSanitaria, CostoPrivato, Avvertenze) VALUES
('ESA001', NULL, 'ECG', 50.00, 100.00, NULL),
('ESA002', 'CF00000000000032', 'Risonanza Magnetica', 150.00, 300.00, 'Rimuovere oggetti metallici'),
('ESA003', 'CF00000000000033', 'Tac', 200.00, 400.00, 'Digiuno da 6 ore'),
('ESA004', NULL, 'Ecografia', 70.00, 140.00, NULL),
('ESA005', 'CF00000000000035', 'Radiografia', 50.00, 100.00, 'Rimuovere gioielli'),
('ESA006', 'CF00000000000036', 'Gastroscopia', 100.00, 200.00, 'Digiuno da 8 ore'),
('ESA007', 'CF00000000000037', 'Colonscopia', 150.00, 300.00, 'Digiuno da 12 ore'),
('ESA008', NULL, 'Elettromiografia', 80.00, 160.00, NULL),
('ESA009', 'CF00000000000039', 'Ecocardiogramma', 90.00, 180.00, 'Qualsiasi cosa'),
('ESA010', NULL, 'Spirometria', 60.00, 120.00, NULL),
('ESA011', 'CF00000000000041', 'Test da sforzo', 120.00, 240.00, 'Abbigliamento sportivo'),
('ESA012', NULL, 'Mammografia', 80.00, 160.00, NULL),
('ESA013', NULL, 'Densitometria ossea', 70.00, 140.00, NULL),
('ESA014', NULL, 'Holter', 100.00, 200.00, NULL),
('ESA015', NULL, 'EEG', 90.00, 180.00, NULL);

INSERT INTO Prenotazione (CodicePrenotazione, LaboratorioAmbulatorio, TesseraSanitaria, CodiceEsame, OraEsame, DataPrenotazione, RegimeCosto, Urgenza, DataEsame) VALUES
('PRE001', 'LAB001', '10000000000000000001', 'ESA001', '09:00:00', '2024-07-01', 'Privato', 'Giallo', '2024-08-17'),
('PRE002', 'LAB002', '10000000000000000001', 'ESA001', '12:00:00', '2024-07-01', 'Pubblico', 'Verde', '2024-08-16'),
('PRE003', 'LAB003', '10000000000000000002', 'ESA002', '08:00:00', '2024-07-03', 'Privato', 'Giallo', '2024-09-17'),
('PRE004', 'LAB004', '10000000000000000002', 'ESA003', '07:00:00', '2024-04-05', 'Pubblico', 'Giallo', '2024-08-21'),
('PRE005', 'LAB005', '10000000000000000003', 'ESA002', '06:00:00', '2024-07-08', 'Privato', 'Rosso', '2024-08-17'),
('PRE006', 'LAB006', '10000000000000000003', 'ESA005', '06:00:00', '2024-06-21', 'Pubblico', 'Giallo', '2024-08-17'),
('PRE007', 'LAB007', '10000000000000000003', 'ESA002', '06:00:00', '2024-02-28', 'Privato', 'Verde', '2024-08-19'),
('PRE008', 'LAB008', '10000000000000000004', 'ESA005', '11:00:00', '2024-02-14', 'Privato', 'Rosso', '2024-08-17'),
('PRE009', 'LAB009', '10000000000000000007', 'ESA006', '12:00:00', '2024-01-05', 'Privato', 'Giallo', '2024-09-15'),
('PRE010', 'LAB010', '10000000000000000008', 'ESA007', '13:00:00', '2024-06-07', 'Pubblico', 'Verde', '2024-10-13'),
('PRE011', 'LAB011', '10000000000000000008', 'ESA001', '14:00:00', '2024-01-08', 'Privato', 'Giallo', '2024-11-17'),
('PRE012', 'LAB012', '10000000000000000009', 'ESA002', '15:00:00', '2024-07-19', 'Pubblico', 'Rosso', '2024-08-15'),
('PRE013', 'LAB013', '10000000000000000010', 'ESA003', '16:00:00', '2024-02-18', 'Privato', 'Giallo', '2024-11-14'),
('PRE014', 'LAB014', '10000000000000000010', 'ESA004', '17:00:00', '2024-03-11', 'Pubblico', 'Verde', '2024-08-11'),
('PRE015', 'LAB015', '10000000000000000010', 'ESA005', '18:00:00', '2024-01-15', 'Pubblico', 'Rosso', '2024-11-12'),
('PRE016', 'LAB001', '10000000000000000010', 'ESA008', '15:00:00', '2024-07-13', 'Privato', 'Giallo', '2024-08-11'),
('PRE017', 'LAB002', '10000000000000000011', 'ESA009', '06:00:00', '2024-07-12', 'Pubblico', 'Verde', '2024-11-12'),
('PRE018', 'LAB003', '10000000000000000013', 'ESA010', '17:00:00', '2024-06-06', 'Pubblico', 'Giallo', '2024-09-17'),
('PRE019', 'LAB004', '10000000000000000013', 'ESA015', '10:00:00', '2024-04-09', 'Pubblico', 'Rosso', '2024-12-19'),
('PRE020', 'LAB005', '10000000000000000014', 'ESA013', '11:00:00', '2024-01-06', 'Privato', 'Giallo', '2024-09-19'),
('PRE021', 'LAB006', '10000000000000000014', 'ESA014', '12:00:00', '2024-01-01', 'Pubblico', 'Giallo', '2024-12-16'),
('PRE022', 'LAB007', '10000000000000000015', 'ESA015', '09:00:00', '2024-02-02', 'Privato', 'Rosso', '2024-09-11'),
('PRE023', 'LAB008', '10000000000000000015', 'ESA011', '13:00:00', '2024-03-05', 'Pubblico', 'Verde', '2024-12-12');