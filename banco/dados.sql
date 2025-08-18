use intercurso;

insert into modalidade (nome, regras, numero_atletas) values ('Futebol', 'Sem regras', 2);

INSERT INTO usuario (nome, email, tipo, senha) VALUES ("maria", "maria123@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("ana", "ana_silva@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("carlos", "carlos789@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("pedro", "pedro_lima@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("beatriz", "beatriz_melo@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("fernando", "fernando22@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("juliana", "juliana.oliveira@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("lucas", "lucas.rocha@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("lais", "lais.souza@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("ricardo", "ricardo_pinto@gmail.com", "gestor", NULL);
INSERT INTO usuario (nome, email, tipo, senha) VALUES ("aline", "aline123@gmail.com", "gestor", NULL);

insert into time (nome, id_gestor, id_modalidade) values("Engenharia de Software", 2, 1);
INSERT INTO time (nome, id_gestor, id_modalidade) VALUES ("Administração", 3, 1);
INSERT INTO time (nome, id_gestor, id_modalidade) VALUES ("Direito", 4, 1);
INSERT INTO time (nome, id_gestor, id_modalidade) VALUES ("Psicologia", 5, 1);
INSERT INTO time (nome, id_gestor, id_modalidade) VALUES ("Educação Física", 6, 1);
INSERT INTO time (nome, id_gestor, id_modalidade) VALUES ("Enfermagem", 7, 1);

INSERT INTO etapa (nome) VALUES ("Classificatória Extra");
INSERT INTO etapa (nome) VALUES ("Classificatória");
INSERT INTO etapa (nome) VALUES ("Semifinal");
INSERT INTO etapa (nome) VALUES ("Final");