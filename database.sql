CREATE DATABASE IF NOT EXISTS universitassemantik
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE universitassemantik;

CREATE TABLE fakultas (
  id_fakultas INT AUTO_INCREMENT PRIMARY KEY,
  nama_fakultas VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE prodi (
  id_prodi INT AUTO_INCREMENT PRIMARY KEY,
  id_fakultas INT NOT NULL,
  nama_prodi VARCHAR(100) NOT NULL,
  UNIQUE KEY uq_prodi_fakultas (id_fakultas, nama_prodi),
  CONSTRAINT fk_prodi_fakultas FOREIGN KEY (id_fakultas)
    REFERENCES fakultas(id_fakultas) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE role (
  id_role INT AUTO_INCREMENT PRIMARY KEY,
  nama_role VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

INSERT INTO role (nama_role) VALUES ('Administrator'), ('Operator Prodi');

CREATE TABLE pengguna (
  id_pengguna INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(100) NOT NULL,
  nip VARCHAR(30) UNIQUE NULL,
  id_role INT NOT NULL,
  id_prodi INT NULL,
  status_aktif ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_pengguna_role FOREIGN KEY (id_role)
    REFERENCES role(id_role) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_pengguna_prodi FOREIGN KEY (id_prodi)
    REFERENCES prodi(id_prodi) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE mahasiswa (
  npm VARCHAR(20) PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  id_prodi INT NOT NULL,
  nama_mahasiswa VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') NOT NULL,
  tempat_lahir VARCHAR(50) NOT NULL,
  tanggal_lahir DATE NOT NULL,
  tanggal_masuk DATE NOT NULL,
  alamat TEXT NOT NULL,
  status_aktif ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_mahasiswa_prodi FOREIGN KEY (id_prodi)
    REFERENCES prodi(id_prodi) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

INSERT INTO fakultas (nama_fakultas) VALUES ('Fakultas Teknik');
INSERT INTO prodi (id_fakultas, nama_prodi) VALUES (1, 'Teknik Informatika');
