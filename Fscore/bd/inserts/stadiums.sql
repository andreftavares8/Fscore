INSERT INTO `stadiums` 
(`id`, `name`, `logo_stadium`, `capacity`, `city`, `foundation`, `grass_type`, `idcountry`) 
VALUES 

('1', 'Parque Desportivo do Buçaquinho', 'florgrade_fc3.png', '500', 'Cortegaça', '1923-01-05', 'Sintético', '1'),
('2', 'Campo São Tiago de Lobão', 'lobao3.png', '6000', 'Lobão, Santa Maria da Feira', '1923-01-05', 'Sintético', '1'),
('3', 'Campo de Futebol de Pousadela', 'ad_nogueira_regedoura3.png', '500', 'Nogueira da Regedoura, Santa Maria Feira', '1974-01-05', 'Pelado', '1'),
('4', 'Campo Minas do Pintor', 'real_nogueirense3.png', '500', 'Nogueira do Cravo - Oliveira de Azeméis', '1923-01-05', 'Sintético', '1'),
('5', 'Complexo Desportivo do Sargaçal', 'ccr_valega3.png', '1500', 'Válega, Ovar', '1969-09-30', 'Sintético', '1'),
('6', 'Campo de Jogos da ADC Sanguedo', 'sanguedo3.png', '3000', 'Sanguedo, Santa Maria da Feira', '1975-05-02', 'Sintético', '1'),
('7', 'Campo Floriano Borges', 'milheiroense3.png', '500', 'Milheirós de Poiares, Santa Maria da Feira', '1975-10-23', 'Pelado', '1'),
('8', 'Academia Forte Paixão', 'lusitania_de_lourosa_b3.png', '700', 'Lourosa, Santa Maria da Feira', '2016-01-05', 'Sintético', '1'),
('9', 'Parque de Jogos de Santo André', 'mosteiro_fc3.png.png', '2500', 'Mosteirô, Santa Maria da Feira', '1923-01-05', 'Sintético', '1'),
('10', 'Campo da Raposeira', 'macieira_cambra3.png', '1000', 'Macieira de Cambra, Vale de Cambra', '1981-05-04', 'Sintético', '1'),
('11', 'Campo dos Valos', 'romariz_sta_maria_feira3.png', '1500', 'Romariz - Santa Maria da Feira', '1976-09-16', 'Pelado', '1'),
('12', 'Parque Desportivo de Caldas S. Jorge', 'caldas_s_jorge3.png', '1500', 'Caldas de São Jorge, Santa Maria da Feira', '1980-10-24', 'Sintético', '1'),
('13', 'Campo do Rejumil', 'ud_fermedo3.png', '196', 'Cabeçais, Fermedo', '1992-06-01', 'Sintético', '1'),
('14', 'Parque da Concórdia', 'relampago_nogueirense3.png', '1000', 'Nogueira da Regedoura, Santa Maria da Feira', '1978-03-01', 'Pelado', '1'),
('15', 'Campo Dona Maria da Guia', 'cd_tarei3.png', '780', 'Tarei, Santa Maria da Feira', '1972-09-25', 'Sintético', '1'),
('16', 'Parque de Jogos de Vila Viçosa', 'ccr_vila_vicosa3.png', '500', 'Vila Viçosa, Arouca', '1977-08-13', 'Pelado', '1'),
('17', 'Campo Manuel Emilio dos Santos', 'ccr_sao_martinho3.png', '1000', 'São Martinho de Sardoura, Castelo de Paiva', '2001-01-05', 'Pelado', '1'),
('18', 'Parque Desportivo da Associação Atlética de Avanca', 'santiais3.png', '1000', 'Avanca, Estarreja', '1937-01-05', 'Sintético', '1'),

/*portugal*/
('19', 'Estádio do Sport Lisboa e Benfica (Luz)', 'benfica3.png', '64 642', 'Lisboa', '2003-01-25', 'Relva Natural', '1'), 
('20', 'Estádio do Dragão', 'porto3.png', '50 033', 'Porto', '2003-01-25', 'Relva Natural', '1'),

/*espanha*/
('21', 'Santiago Bernabéu', 'real_madrid3.png', '81 044', 'Madrid', '1947-01-25', 'Relva Natural', '3'), 
('22', 'Camp Nou', 'barcelona3.png', '99 354', 'Barcelona', '1957-01-25', 'Relva Natural', '3'),

/*inglaterra*/
('23', 'Etihad Stadium', 'man_city3.png', '55 097', 'Manchester', '2003-01-25', 'Relva Natural', '2'), 
('24', 'Anfield', 'liverpool3.png', '54800', 'Liverpool', '1884-01-25', 'Relva Natural', '2'),

/*italia*/
('25', 'Allianz Stadium', 'juventus3.png', '75 000', 'Torino', '2013-01-25', 'Relva Natural', '4'), 
('26', 'Stadio Giuseppe Meazza', 'inter3.png', '80 018', 'Milano', '1925-01-25', 'Relva Natural', '4'),

/*alemanha*/
('27', 'Allianz Arena', 'bayern3.png', '75 000', 'Munique', '2005-01-25', 'Relva Natural', '5'), 
('28', 'Signal Iduna Park', 'dortmund3.png', '81 359', 'Dortmund', '1974-01-25', 'Relva Natural', '5'),

/*franca*/
('29', 'Parc des Princes', 'psg3.png', '48 583', 'Paris', '1897-01-25', 'Relva Natural', '6'), 
('30', 'Orange Vélodrome', 'marseille3.png', '67 394', 'Marseille', '1974-01-25', 'Relva Natural', '6'),

/*holanda*/
('31', 'Johan Cruyff Arena', 'ajax3.png', '53 748', 'Amesterdão', '1996-01-25', 'Relva Natural', '7'), 
('32', 'Philips Stadion', 'psv3.png', '35 000', 'Eindhoven', '1910-01-25', 'Relva Natural', '7'),

/*estadios de equipas com historia transferencias e campeonato*/
('33', 'Estádio do Lusitânia FC Lourosa', NULL, '0', 'Lourosa - Santa Maria da Feira', '1999-01-05', 'Relva', '1'),
('34', 'Estádio Conde Dias Garcia', 'ad_sanjoanense3.png', '15 000', 'São João da Madeira', '1910-01-25', 'Relva', '1'),
('35', 'Estádio da Barrinha', NULL, '0', 'Esmoriz', '1999-01-05', 'Relva', '1'),
('36', 'Parque Silva Matos', NULL, '0', 'Santa Marinha - Vila Nova de Gaia', '1999-01-05', 'Relva', '1'),
('37', 'Estádio Rei Ramiro', NULL, '0', 'Santa Marinha - Vila Nova de Gaia', '1999-01-05', 'Relva', '1'),
('38', 'Estádio da Ribes', NULL, '0', '	Santa Maria de Oliveira - V.N. Famalicão', '1999-01-05', 'Relva', '1'),
('39', 'Estádio Comendador Manuel de Oliveira Violas', NULL, '0', 'Espinho', '1999-01-05', 'Relva', '1'),
('40', 'Estádio Manuel Marques', NULL, '0', 'Torres Vedras', '1999-01-05', 'Relva', '1'),
('41', 'Complexo Desportivo de Nine', NULL, '0', 'Nine - Vila Nova de Famalicão', '1999-01-05', 'Relva', '1'),
('42', 'Gymnastikos Sullogos ta Pagkypria (Neo GSP)', NULL, '0', 'Nicósia', '1999-01-05', 'Relva', '8'),

/* estadios com historia em titulos*/
('43', 'Estádio Jaime Rocha', NULL, '0', 'Pinheiro da Bemposta', '1999-01-05', 'Relva', '1'),
('44', 'CR Antes', NULL, '0', 'CR Antes', '1999-01-05', 'Relva', '1'),
('45', 'Ovarense', NULL, '0', 'Ovarense', '1999-01-05', 'Relva', '1'),
('46', 'Amigos Visconde', NULL, '0', 'Amigos Visconde', '1999-01-05', 'Relva', '1');


