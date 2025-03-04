

-- -----------------------------------------------------
-- Table `rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rol` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `centroFormacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `centroFormacion` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `programaFormacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programaFormacion` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(15) NOT NULL,
  `nombre` VARCHAR(30) NULL,
  `FkIdCentroFormacion` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FkIdCentroFormacion`
    FOREIGN KEY (`FkIdCentroFormacion`)
    REFERENCES `centroFormacion` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `actividad` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tipoUsuarioGym`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tipoUsuarioGym` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grupo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ficha` VARCHAR(15) NOT NULL,
  `cantidadAprendices` TINYINT UNSIGNED NULL,
  `estado` VARCHAR(15) NOT NULL,
  `fechaInicioLectiva` DATE NULL,
  `fechaFinLectiva` DATE NULL,
  `fkIdProgForm` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fkIdProgFrom`
    FOREIGN KEY (`fkIdProgForm`)
    REFERENCES `programaFormacion` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `tipoDocumento` CHAR(2) NOT NULL,
  `documento` VARCHAR(20) NOT NULL,
  `fechaNacimiento` DATE NULL,
  `email` VARCHAR(80) NOT NULL,
  `genero` CHAR(1) NOT NULL,
  `estado` VARCHAR(15) NOT NULL,
  `telefono` VARCHAR(15) NOT NULL,
  `eps` VARCHAR(20) NULL,
  `tipoSangre` CHAR(3) NOT NULL,
  `peso` DECIMAL NULL,
  `estatura` DECIMAL NULL,
  `telefonoEmerjencia` VARCHAR(15) NULL,
  `password` VARCHAR(255) NULL,
  `observaciones` TEXT NULL,
  `fkIdRol` INT UNSIGNED NOT NULL,
  `fkIdGrupo` INT UNSIGNED NULL,
  `fkIdCentroFormacion2` INT UNSIGNED NULL,
  `fkIdTipoUserGym` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fkIdRol`
    FOREIGN KEY (`fkIdRol`)
    REFERENCES `rol` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fkIdGrupo`
    FOREIGN KEY (`fkIdGrupo`)
    REFERENCES `grupo` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fkIdCentroFormacion2`
    FOREIGN KEY (`fkIdCentroFormacion2`)
    REFERENCES `centroFormacion` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fkIdTipoUserGym`
    FOREIGN KEY (`fkIdTipoUserGym`)
    REFERENCES `tipoUsuarioGym` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controlProgreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controlProgreso` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaRealizacion` DATE NOT NULL,
  `peso` DECIMAL NULL,
  `cintura` DECIMAL NULL,
  `cadera` DECIMAL NULL,
  `musloDerecho` DECIMAL NULL,
  `musloIsquierdo` DECIMAL NULL,
  `brazoDerecho` DECIMAL NULL,
  `brazoIzquierdo` DECIMAL NULL,
  `antebrazoDerecho` DECIMAL NULL,
  `antebrazoIzquierdo` DECIMAL NULL,
  `pantorrillaDerecha` DECIMAL NULL,
  `pantorrillaIzquierda` DECIMAL NULL,
  `examenMedico` VARCHAR(255) NULL,
  `observaciones` TEXT NULL,
  `fechaExamen` DATE NULL,
  `fkIdUsuario` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fkIdUser`
    FOREIGN KEY (`fkIdUsuario`)
    REFERENCES `usuario` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `registroIngresos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `registroIngresos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fechaIn` DATETIME NOT NULL,
  `fechaOut` DATETIME NULL,
  `fkIdUserGym` INT UNSIGNED NOT NULL,
  `fkIdActividad` INT UNSIGNED NULL,
  `fkIdTrainer` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fkIdUserGymReg`
    FOREIGN KEY (`fkIdUserGym`)
    REFERENCES `usuario` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fkIdActividad`
    FOREIGN KEY (`fkIdActividad`)
    REFERENCES `actividad` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fkIdTrainer`
    FOREIGN KEY (`fkIdTrainer`)
    REFERENCES `usuario` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;



