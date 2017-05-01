/*
Navicat MySQL Data Transfer

Source Server         : localmysql
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : contribuyente

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-05-01 17:40:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for contribuyentes
-- ----------------------------
DROP TABLE IF EXISTS `contribuyentes`;
CREATE TABLE `contribuyentes` (
  `contribuyente_id` int(11) NOT NULL AUTO_INCREMENT,
  `rif` varchar(20) DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `parroquia_id` int(11) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `cierre_fiscal` varchar(20) DEFAULT NULL,
  `actividad` varchar(255) DEFAULT NULL,
  `estatus_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`contribuyente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contribuyentes
-- ----------------------------

-- ----------------------------
-- Table structure for estados
-- ----------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(250) NOT NULL,
  `iso_3166-2` varchar(4) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estados
-- ----------------------------
INSERT INTO `estados` VALUES ('3', 'Apure', 'VE-C');
INSERT INTO `estados` VALUES ('5', 'Barinas', 'VE-E');
INSERT INTO `estados` VALUES ('13', 'Mérida', 'VE-L');
INSERT INTO `estados` VALUES ('19', 'Táchira', 'VE-S');
INSERT INTO `estados` VALUES ('20', 'Trujillo', 'VE-T');

-- ----------------------------
-- Table structure for estados_all
-- ----------------------------
DROP TABLE IF EXISTS `estados_all`;
CREATE TABLE `estados_all` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(250) NOT NULL,
  `iso_3166-2` varchar(4) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estados_all
-- ----------------------------
INSERT INTO `estados_all` VALUES ('1', 'Amazonas', 'VE-X');
INSERT INTO `estados_all` VALUES ('2', 'Anzoátegui', 'VE-B');
INSERT INTO `estados_all` VALUES ('3', 'Apure', 'VE-C');
INSERT INTO `estados_all` VALUES ('4', 'Aragua', 'VE-D');
INSERT INTO `estados_all` VALUES ('5', 'Barinas', 'VE-E');
INSERT INTO `estados_all` VALUES ('6', 'Bolívar', 'VE-F');
INSERT INTO `estados_all` VALUES ('7', 'Carabobo', 'VE-G');
INSERT INTO `estados_all` VALUES ('8', 'Cojedes', 'VE-H');
INSERT INTO `estados_all` VALUES ('9', 'Delta Amacuro', 'VE-Y');
INSERT INTO `estados_all` VALUES ('10', 'Falcón', 'VE-I');
INSERT INTO `estados_all` VALUES ('11', 'Guárico', 'VE-J');
INSERT INTO `estados_all` VALUES ('12', 'Lara', 'VE-K');
INSERT INTO `estados_all` VALUES ('13', 'Mérida', 'VE-L');
INSERT INTO `estados_all` VALUES ('14', 'Miranda', 'VE-M');
INSERT INTO `estados_all` VALUES ('15', 'Monagas', 'VE-N');
INSERT INTO `estados_all` VALUES ('16', 'Nueva Esparta', 'VE-O');
INSERT INTO `estados_all` VALUES ('17', 'Portuguesa', 'VE-P');
INSERT INTO `estados_all` VALUES ('18', 'Sucre', 'VE-R');
INSERT INTO `estados_all` VALUES ('19', 'Táchira', 'VE-S');
INSERT INTO `estados_all` VALUES ('20', 'Trujillo', 'VE-T');
INSERT INTO `estados_all` VALUES ('21', 'Vargas', 'VE-W');
INSERT INTO `estados_all` VALUES ('22', 'Yaracuy', 'VE-U');
INSERT INTO `estados_all` VALUES ('23', 'Zulia', 'VE-V');
INSERT INTO `estados_all` VALUES ('24', 'Distrito Capital', 'VE-A');
INSERT INTO `estados_all` VALUES ('25', 'Dependencias Federales', 'VE-Z');

-- ----------------------------
-- Table structure for estatus
-- ----------------------------
DROP TABLE IF EXISTS `estatus`;
CREATE TABLE `estatus` (
  `estatus_id` int(11) NOT NULL,
  `estatus` varchar(45) NOT NULL,
  PRIMARY KEY (`estatus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estatus
-- ----------------------------
INSERT INTO `estatus` VALUES ('1', 'Desincorporados');
INSERT INTO `estatus` VALUES ('2', ' Activo');
INSERT INTO `estatus` VALUES ('3', 'Inactivo');
INSERT INTO `estatus` VALUES ('4', ' Traslado de región');
INSERT INTO `estatus` VALUES ('5', 'Sin notificar');

-- ----------------------------
-- Table structure for municipios
-- ----------------------------
DROP TABLE IF EXISTS `municipios`;
CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of municipios
-- ----------------------------
INSERT INTO `municipios` VALUES ('29', '3', 'Achaguas');
INSERT INTO `municipios` VALUES ('30', '3', 'Biruaca');
INSERT INTO `municipios` VALUES ('31', '3', 'Muñóz');
INSERT INTO `municipios` VALUES ('32', '3', 'Páez');
INSERT INTO `municipios` VALUES ('33', '3', 'Pedro Camejo');
INSERT INTO `municipios` VALUES ('34', '3', 'Rómulo Gallegos');
INSERT INTO `municipios` VALUES ('35', '3', 'San Fernando');
INSERT INTO `municipios` VALUES ('54', '5', 'Alberto Arvelo Torrealba');
INSERT INTO `municipios` VALUES ('55', '5', 'Andrés Eloy Blanco');
INSERT INTO `municipios` VALUES ('56', '5', 'Antonio José de Sucre');
INSERT INTO `municipios` VALUES ('57', '5', 'Arismendi');
INSERT INTO `municipios` VALUES ('58', '5', 'Barinas');
INSERT INTO `municipios` VALUES ('59', '5', 'Bolívar');
INSERT INTO `municipios` VALUES ('60', '5', 'Cruz Paredes');
INSERT INTO `municipios` VALUES ('61', '5', 'Ezequiel Zamora');
INSERT INTO `municipios` VALUES ('62', '5', 'Obispos');
INSERT INTO `municipios` VALUES ('63', '5', 'Pedraza');
INSERT INTO `municipios` VALUES ('64', '5', 'Rojas');
INSERT INTO `municipios` VALUES ('65', '5', 'Sosa');
INSERT INTO `municipios` VALUES ('179', '13', 'Alberto Adriani');
INSERT INTO `municipios` VALUES ('180', '13', 'Andrés Bello');
INSERT INTO `municipios` VALUES ('181', '13', 'Antonio Pinto Salinas');
INSERT INTO `municipios` VALUES ('182', '13', 'Aricagua');
INSERT INTO `municipios` VALUES ('183', '13', 'Arzobispo Chacón');
INSERT INTO `municipios` VALUES ('184', '13', 'Campo Elías');
INSERT INTO `municipios` VALUES ('185', '13', 'Caracciolo Parra Olmedo');
INSERT INTO `municipios` VALUES ('186', '13', 'Cardenal Quintero');
INSERT INTO `municipios` VALUES ('187', '13', 'Guaraque');
INSERT INTO `municipios` VALUES ('188', '13', 'Julio César Salas');
INSERT INTO `municipios` VALUES ('189', '13', 'Justo Briceño');
INSERT INTO `municipios` VALUES ('190', '13', 'Libertador');
INSERT INTO `municipios` VALUES ('191', '13', 'Miranda');
INSERT INTO `municipios` VALUES ('192', '13', 'Obispo Ramos de Lora');
INSERT INTO `municipios` VALUES ('193', '13', 'Padre Noguera');
INSERT INTO `municipios` VALUES ('194', '13', 'Pueblo Llano');
INSERT INTO `municipios` VALUES ('195', '13', 'Rangel');
INSERT INTO `municipios` VALUES ('196', '13', 'Rivas Dávila');
INSERT INTO `municipios` VALUES ('197', '13', 'Santos Marquina');
INSERT INTO `municipios` VALUES ('198', '13', 'Sucre');
INSERT INTO `municipios` VALUES ('199', '13', 'Tovar');
INSERT INTO `municipios` VALUES ('200', '13', 'Tulio Febres Cordero');
INSERT INTO `municipios` VALUES ('201', '13', 'Zea');
INSERT INTO `municipios` VALUES ('341', '19', 'Andrés Bello');
INSERT INTO `municipios` VALUES ('342', '19', 'Antonio Rómulo Costa');
INSERT INTO `municipios` VALUES ('343', '19', 'Ayacucho');
INSERT INTO `municipios` VALUES ('344', '19', 'Bolívar');
INSERT INTO `municipios` VALUES ('345', '19', 'Cárdenas');
INSERT INTO `municipios` VALUES ('346', '19', 'Córdoba');
INSERT INTO `municipios` VALUES ('347', '19', 'Fernández Feo');
INSERT INTO `municipios` VALUES ('348', '19', 'Francisco de Miranda');
INSERT INTO `municipios` VALUES ('349', '19', 'García de Hevia');
INSERT INTO `municipios` VALUES ('350', '19', 'Guásimos');
INSERT INTO `municipios` VALUES ('351', '19', 'Independencia');
INSERT INTO `municipios` VALUES ('352', '19', 'Jáuregui');
INSERT INTO `municipios` VALUES ('353', '19', 'José María Vargas');
INSERT INTO `municipios` VALUES ('354', '19', 'Junín');
INSERT INTO `municipios` VALUES ('355', '19', 'Libertad');
INSERT INTO `municipios` VALUES ('356', '19', 'Libertador');
INSERT INTO `municipios` VALUES ('357', '19', 'Lobatera');
INSERT INTO `municipios` VALUES ('358', '19', 'Michelena');
INSERT INTO `municipios` VALUES ('359', '19', 'Panamericano');
INSERT INTO `municipios` VALUES ('360', '19', 'Pedro María Ureña');
INSERT INTO `municipios` VALUES ('361', '19', 'Rafael Urdaneta');
INSERT INTO `municipios` VALUES ('362', '19', 'Samuel Darío Maldonado');
INSERT INTO `municipios` VALUES ('363', '19', 'San Cristóbal');
INSERT INTO `municipios` VALUES ('364', '19', 'Seboruco');
INSERT INTO `municipios` VALUES ('365', '19', 'Simón Rodríguez');
INSERT INTO `municipios` VALUES ('366', '19', 'Sucre');
INSERT INTO `municipios` VALUES ('367', '19', 'Torbes');
INSERT INTO `municipios` VALUES ('368', '19', 'Uribante');
INSERT INTO `municipios` VALUES ('369', '19', 'San Judas Tadeo');
INSERT INTO `municipios` VALUES ('370', '20', 'Andrés Bello');
INSERT INTO `municipios` VALUES ('371', '20', 'Boconó');
INSERT INTO `municipios` VALUES ('372', '20', 'Bolívar');
INSERT INTO `municipios` VALUES ('373', '20', 'Candelaria');
INSERT INTO `municipios` VALUES ('374', '20', 'Carache');
INSERT INTO `municipios` VALUES ('375', '20', 'Escuque');
INSERT INTO `municipios` VALUES ('376', '20', 'José Felipe Márquez Cañizalez');
INSERT INTO `municipios` VALUES ('377', '20', 'Juan Vicente Campos Elías');
INSERT INTO `municipios` VALUES ('378', '20', 'La Ceiba');
INSERT INTO `municipios` VALUES ('379', '20', 'Miranda');
INSERT INTO `municipios` VALUES ('380', '20', 'Monte Carmelo');
INSERT INTO `municipios` VALUES ('381', '20', 'Motatán');
INSERT INTO `municipios` VALUES ('382', '20', 'Pampán');
INSERT INTO `municipios` VALUES ('383', '20', 'Pampanito');
INSERT INTO `municipios` VALUES ('384', '20', 'Rafael Rangel');
INSERT INTO `municipios` VALUES ('385', '20', 'San Rafael de Carvajal');
INSERT INTO `municipios` VALUES ('386', '20', 'Sucre');
INSERT INTO `municipios` VALUES ('387', '20', 'Trujillo');
INSERT INTO `municipios` VALUES ('388', '20', 'Urdaneta');
INSERT INTO `municipios` VALUES ('389', '20', 'Valera');

-- ----------------------------
-- Table structure for parroquias
-- ----------------------------
DROP TABLE IF EXISTS `parroquias`;
CREATE TABLE `parroquias` (
  `id_parroquia` int(11) NOT NULL AUTO_INCREMENT,
  `id_municipio` int(11) NOT NULL,
  `parroquia` varchar(250) NOT NULL,
  PRIMARY KEY (`id_parroquia`),
  KEY `id_municipio` (`id_municipio`),
  CONSTRAINT `parroquias_ibfk_1` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=978 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of parroquias
-- ----------------------------
INSERT INTO `parroquias` VALUES ('81', '29', 'Achaguas');
INSERT INTO `parroquias` VALUES ('82', '29', 'Apurito');
INSERT INTO `parroquias` VALUES ('83', '29', 'El Yagual');
INSERT INTO `parroquias` VALUES ('84', '29', 'Guachara');
INSERT INTO `parroquias` VALUES ('85', '29', 'Mucuritas');
INSERT INTO `parroquias` VALUES ('86', '29', 'Queseras del medio');
INSERT INTO `parroquias` VALUES ('87', '30', 'Biruaca');
INSERT INTO `parroquias` VALUES ('88', '31', 'Bruzual');
INSERT INTO `parroquias` VALUES ('89', '31', 'Mantecal');
INSERT INTO `parroquias` VALUES ('90', '31', 'Quintero');
INSERT INTO `parroquias` VALUES ('91', '31', 'Rincón Hondo');
INSERT INTO `parroquias` VALUES ('92', '31', 'San Vicente');
INSERT INTO `parroquias` VALUES ('93', '32', 'Guasdualito');
INSERT INTO `parroquias` VALUES ('94', '32', 'Aramendi');
INSERT INTO `parroquias` VALUES ('95', '32', 'El Amparo');
INSERT INTO `parroquias` VALUES ('96', '32', 'San Camilo');
INSERT INTO `parroquias` VALUES ('97', '32', 'Urdaneta');
INSERT INTO `parroquias` VALUES ('98', '33', 'San Juan de Payara');
INSERT INTO `parroquias` VALUES ('99', '33', 'Codazzi');
INSERT INTO `parroquias` VALUES ('100', '33', 'Cunaviche');
INSERT INTO `parroquias` VALUES ('101', '34', 'Elorza');
INSERT INTO `parroquias` VALUES ('102', '34', 'La Trinidad');
INSERT INTO `parroquias` VALUES ('103', '35', 'San Fernando');
INSERT INTO `parroquias` VALUES ('104', '35', 'El Recreo');
INSERT INTO `parroquias` VALUES ('105', '35', 'Peñalver');
INSERT INTO `parroquias` VALUES ('106', '35', 'San Rafael de Atamaica');
INSERT INTO `parroquias` VALUES ('157', '54', 'Sabaneta');
INSERT INTO `parroquias` VALUES ('158', '54', 'Juan Antonio Rodríguez Domínguez');
INSERT INTO `parroquias` VALUES ('159', '55', 'El Cantón');
INSERT INTO `parroquias` VALUES ('160', '55', 'Santa Cruz de Guacas');
INSERT INTO `parroquias` VALUES ('161', '55', 'Puerto Vivas');
INSERT INTO `parroquias` VALUES ('162', '56', 'Ticoporo');
INSERT INTO `parroquias` VALUES ('163', '56', 'Nicolás Pulido');
INSERT INTO `parroquias` VALUES ('164', '56', 'Andrés Bello');
INSERT INTO `parroquias` VALUES ('165', '57', 'Arismendi');
INSERT INTO `parroquias` VALUES ('166', '57', 'Guadarrama');
INSERT INTO `parroquias` VALUES ('167', '57', 'La Unión');
INSERT INTO `parroquias` VALUES ('168', '57', 'San Antonio');
INSERT INTO `parroquias` VALUES ('169', '58', 'Barinas');
INSERT INTO `parroquias` VALUES ('170', '58', 'Alberto Arvelo Larriva');
INSERT INTO `parroquias` VALUES ('171', '58', 'San Silvestre');
INSERT INTO `parroquias` VALUES ('172', '58', 'Santa Inés');
INSERT INTO `parroquias` VALUES ('173', '58', 'Santa Lucía');
INSERT INTO `parroquias` VALUES ('174', '58', 'Torumos');
INSERT INTO `parroquias` VALUES ('175', '58', 'El Carmen');
INSERT INTO `parroquias` VALUES ('176', '58', 'Rómulo Betancourt');
INSERT INTO `parroquias` VALUES ('177', '58', 'Corazón de Jesús');
INSERT INTO `parroquias` VALUES ('178', '58', 'Ramón Ignacio Méndez');
INSERT INTO `parroquias` VALUES ('179', '58', 'Alto Barinas');
INSERT INTO `parroquias` VALUES ('180', '58', 'Manuel Palacio Fajardo');
INSERT INTO `parroquias` VALUES ('181', '58', 'Juan Antonio Rodríguez Domínguez');
INSERT INTO `parroquias` VALUES ('182', '58', 'Dominga Ortiz de Páez');
INSERT INTO `parroquias` VALUES ('183', '59', 'Barinitas');
INSERT INTO `parroquias` VALUES ('184', '59', 'Altamira de Cáceres');
INSERT INTO `parroquias` VALUES ('185', '59', 'Calderas');
INSERT INTO `parroquias` VALUES ('186', '60', 'Barrancas');
INSERT INTO `parroquias` VALUES ('187', '60', 'El Socorro');
INSERT INTO `parroquias` VALUES ('188', '60', 'Mazparrito');
INSERT INTO `parroquias` VALUES ('189', '61', 'Santa Bárbara');
INSERT INTO `parroquias` VALUES ('190', '61', 'Pedro Briceño Méndez');
INSERT INTO `parroquias` VALUES ('191', '61', 'Ramón Ignacio Méndez');
INSERT INTO `parroquias` VALUES ('192', '61', 'José Ignacio del Pumar');
INSERT INTO `parroquias` VALUES ('193', '62', 'Obispos');
INSERT INTO `parroquias` VALUES ('194', '62', 'Guasimitos');
INSERT INTO `parroquias` VALUES ('195', '62', 'El Real');
INSERT INTO `parroquias` VALUES ('196', '62', 'La Luz');
INSERT INTO `parroquias` VALUES ('197', '63', 'Ciudad Bolívia');
INSERT INTO `parroquias` VALUES ('198', '63', 'José Ignacio Briceño');
INSERT INTO `parroquias` VALUES ('199', '63', 'José Félix Ribas');
INSERT INTO `parroquias` VALUES ('200', '63', 'Páez');
INSERT INTO `parroquias` VALUES ('201', '64', 'Libertad');
INSERT INTO `parroquias` VALUES ('202', '64', 'Dolores');
INSERT INTO `parroquias` VALUES ('203', '64', 'Santa Rosa');
INSERT INTO `parroquias` VALUES ('204', '64', 'Palacio Fajardo');
INSERT INTO `parroquias` VALUES ('205', '65', 'Ciudad de Nutrias');
INSERT INTO `parroquias` VALUES ('206', '65', 'El Regalo');
INSERT INTO `parroquias` VALUES ('207', '65', 'Puerto Nutrias');
INSERT INTO `parroquias` VALUES ('208', '65', 'Santa Catalina');
INSERT INTO `parroquias` VALUES ('515', '179', 'Presidente Betancourt');
INSERT INTO `parroquias` VALUES ('516', '179', 'Presidente Páez');
INSERT INTO `parroquias` VALUES ('517', '179', 'Presidente Rómulo Gallegos');
INSERT INTO `parroquias` VALUES ('518', '179', 'Gabriel Picón González');
INSERT INTO `parroquias` VALUES ('519', '179', 'Héctor Amable Mora');
INSERT INTO `parroquias` VALUES ('520', '179', 'José Nucete Sardi');
INSERT INTO `parroquias` VALUES ('521', '179', 'Pulido Méndez');
INSERT INTO `parroquias` VALUES ('522', '180', 'La Azulita');
INSERT INTO `parroquias` VALUES ('523', '181', 'Santa Cruz de Mora');
INSERT INTO `parroquias` VALUES ('524', '181', 'Mesa Bolívar');
INSERT INTO `parroquias` VALUES ('525', '181', 'Mesa de Las Palmas');
INSERT INTO `parroquias` VALUES ('526', '182', 'Aricagua');
INSERT INTO `parroquias` VALUES ('527', '182', 'San Antonio');
INSERT INTO `parroquias` VALUES ('528', '183', 'Canagua');
INSERT INTO `parroquias` VALUES ('529', '183', 'Capurí');
INSERT INTO `parroquias` VALUES ('530', '183', 'Chacantá');
INSERT INTO `parroquias` VALUES ('531', '183', 'El Molino');
INSERT INTO `parroquias` VALUES ('532', '183', 'Guaimaral');
INSERT INTO `parroquias` VALUES ('533', '183', 'Mucutuy');
INSERT INTO `parroquias` VALUES ('534', '183', 'Mucuchachí');
INSERT INTO `parroquias` VALUES ('535', '184', 'Fernández Peña');
INSERT INTO `parroquias` VALUES ('536', '184', 'Matriz');
INSERT INTO `parroquias` VALUES ('537', '184', 'Montalbán');
INSERT INTO `parroquias` VALUES ('538', '184', 'Acequias');
INSERT INTO `parroquias` VALUES ('539', '184', 'Jají');
INSERT INTO `parroquias` VALUES ('540', '184', 'La Mesa');
INSERT INTO `parroquias` VALUES ('541', '184', 'San José del Sur');
INSERT INTO `parroquias` VALUES ('542', '185', 'Tucaní');
INSERT INTO `parroquias` VALUES ('543', '185', 'Florencio Ramírez');
INSERT INTO `parroquias` VALUES ('544', '186', 'Santo Domingo');
INSERT INTO `parroquias` VALUES ('545', '186', 'Las Piedras');
INSERT INTO `parroquias` VALUES ('546', '187', 'Guaraque');
INSERT INTO `parroquias` VALUES ('547', '187', 'Mesa de Quintero');
INSERT INTO `parroquias` VALUES ('548', '187', 'Río Negro');
INSERT INTO `parroquias` VALUES ('549', '188', 'Arapuey');
INSERT INTO `parroquias` VALUES ('550', '188', 'Palmira');
INSERT INTO `parroquias` VALUES ('551', '189', 'San Cristóbal de Torondoy');
INSERT INTO `parroquias` VALUES ('552', '189', 'Torondoy');
INSERT INTO `parroquias` VALUES ('553', '190', 'Antonio Spinetti Dini');
INSERT INTO `parroquias` VALUES ('554', '190', 'Arias');
INSERT INTO `parroquias` VALUES ('555', '190', 'Caracciolo Parra Pérez');
INSERT INTO `parroquias` VALUES ('556', '190', 'Domingo Peña');
INSERT INTO `parroquias` VALUES ('557', '190', 'El Llano');
INSERT INTO `parroquias` VALUES ('558', '190', 'Gonzalo Picón Febres');
INSERT INTO `parroquias` VALUES ('559', '190', 'Jacinto Plaza');
INSERT INTO `parroquias` VALUES ('560', '190', 'Juan Rodríguez Suárez');
INSERT INTO `parroquias` VALUES ('561', '190', 'Lasso de la Vega');
INSERT INTO `parroquias` VALUES ('562', '190', 'Mariano Picón Salas');
INSERT INTO `parroquias` VALUES ('563', '190', 'Milla');
INSERT INTO `parroquias` VALUES ('564', '190', 'Osuna Rodríguez');
INSERT INTO `parroquias` VALUES ('565', '190', 'Sagrario');
INSERT INTO `parroquias` VALUES ('566', '190', 'El Morro');
INSERT INTO `parroquias` VALUES ('567', '190', 'Los Nevados');
INSERT INTO `parroquias` VALUES ('568', '191', 'Andrés Eloy Blanco');
INSERT INTO `parroquias` VALUES ('569', '191', 'La Venta');
INSERT INTO `parroquias` VALUES ('570', '191', 'Piñango');
INSERT INTO `parroquias` VALUES ('571', '191', 'Timotes');
INSERT INTO `parroquias` VALUES ('572', '192', 'Eloy Paredes');
INSERT INTO `parroquias` VALUES ('573', '192', 'San Rafael de Alcázar');
INSERT INTO `parroquias` VALUES ('574', '192', 'Santa Elena de Arenales');
INSERT INTO `parroquias` VALUES ('575', '193', 'Santa María de Caparo');
INSERT INTO `parroquias` VALUES ('576', '194', 'Pueblo Llano');
INSERT INTO `parroquias` VALUES ('577', '195', 'Cacute');
INSERT INTO `parroquias` VALUES ('578', '195', 'La Toma');
INSERT INTO `parroquias` VALUES ('579', '195', 'Mucuchíes');
INSERT INTO `parroquias` VALUES ('580', '195', 'Mucurubá');
INSERT INTO `parroquias` VALUES ('581', '195', 'San Rafael');
INSERT INTO `parroquias` VALUES ('582', '196', 'Gerónimo Maldonado');
INSERT INTO `parroquias` VALUES ('583', '196', 'Bailadores');
INSERT INTO `parroquias` VALUES ('584', '197', 'Tabay');
INSERT INTO `parroquias` VALUES ('585', '198', 'Chiguará');
INSERT INTO `parroquias` VALUES ('586', '198', 'Estánquez');
INSERT INTO `parroquias` VALUES ('587', '198', 'Lagunillas');
INSERT INTO `parroquias` VALUES ('588', '198', 'La Trampa');
INSERT INTO `parroquias` VALUES ('589', '198', 'Pueblo Nuevo del Sur');
INSERT INTO `parroquias` VALUES ('590', '198', 'San Juan');
INSERT INTO `parroquias` VALUES ('591', '199', 'El Amparo');
INSERT INTO `parroquias` VALUES ('592', '199', 'El Llano');
INSERT INTO `parroquias` VALUES ('593', '199', 'San Francisco');
INSERT INTO `parroquias` VALUES ('594', '199', 'Tovar');
INSERT INTO `parroquias` VALUES ('595', '200', 'Independencia');
INSERT INTO `parroquias` VALUES ('596', '200', 'María de la Concepción Palacios Blanco');
INSERT INTO `parroquias` VALUES ('597', '200', 'Nueva Bolivia');
INSERT INTO `parroquias` VALUES ('598', '200', 'Santa Apolonia');
INSERT INTO `parroquias` VALUES ('599', '201', 'Caño El Tigre');
INSERT INTO `parroquias` VALUES ('600', '201', 'Zea');
INSERT INTO `parroquias` VALUES ('818', '341', 'Andrés Bello');
INSERT INTO `parroquias` VALUES ('819', '342', 'Antonio Rómulo Costa');
INSERT INTO `parroquias` VALUES ('820', '343', 'Ayacucho');
INSERT INTO `parroquias` VALUES ('821', '343', 'Rivas Berti');
INSERT INTO `parroquias` VALUES ('822', '343', 'San Pedro del Río');
INSERT INTO `parroquias` VALUES ('823', '344', 'Bolívar');
INSERT INTO `parroquias` VALUES ('824', '344', 'Palotal');
INSERT INTO `parroquias` VALUES ('825', '344', 'General Juan Vicente Gómez');
INSERT INTO `parroquias` VALUES ('826', '344', 'Isaías Medina Angarita');
INSERT INTO `parroquias` VALUES ('827', '345', 'Cárdenas');
INSERT INTO `parroquias` VALUES ('828', '345', 'Amenodoro Ángel Lamus');
INSERT INTO `parroquias` VALUES ('829', '345', 'La Florida');
INSERT INTO `parroquias` VALUES ('830', '346', 'Córdoba');
INSERT INTO `parroquias` VALUES ('831', '347', 'Fernández Feo');
INSERT INTO `parroquias` VALUES ('832', '347', 'Alberto Adriani');
INSERT INTO `parroquias` VALUES ('833', '347', 'Santo Domingo');
INSERT INTO `parroquias` VALUES ('834', '348', 'Francisco de Miranda');
INSERT INTO `parroquias` VALUES ('835', '349', 'García de Hevia');
INSERT INTO `parroquias` VALUES ('836', '349', 'Boca de Grita');
INSERT INTO `parroquias` VALUES ('837', '349', 'José Antonio Páez');
INSERT INTO `parroquias` VALUES ('838', '350', 'Guásimos');
INSERT INTO `parroquias` VALUES ('839', '351', 'Independencia');
INSERT INTO `parroquias` VALUES ('840', '351', 'Juan Germán Roscio');
INSERT INTO `parroquias` VALUES ('841', '351', 'Román Cárdenas');
INSERT INTO `parroquias` VALUES ('842', '352', 'Jáuregui');
INSERT INTO `parroquias` VALUES ('843', '352', 'Emilio Constantino Guerrero');
INSERT INTO `parroquias` VALUES ('844', '352', 'Monseñor Miguel Antonio Salas');
INSERT INTO `parroquias` VALUES ('845', '353', 'José María Vargas');
INSERT INTO `parroquias` VALUES ('846', '354', 'Junín');
INSERT INTO `parroquias` VALUES ('847', '354', 'La Petrólea');
INSERT INTO `parroquias` VALUES ('848', '354', 'Quinimarí');
INSERT INTO `parroquias` VALUES ('849', '354', 'Bramón');
INSERT INTO `parroquias` VALUES ('850', '355', 'Libertad');
INSERT INTO `parroquias` VALUES ('851', '355', 'Cipriano Castro');
INSERT INTO `parroquias` VALUES ('852', '355', 'Manuel Felipe Rugeles');
INSERT INTO `parroquias` VALUES ('853', '356', 'Libertador');
INSERT INTO `parroquias` VALUES ('854', '356', 'Doradas');
INSERT INTO `parroquias` VALUES ('855', '356', 'Emeterio Ochoa');
INSERT INTO `parroquias` VALUES ('856', '356', 'San Joaquín de Navay');
INSERT INTO `parroquias` VALUES ('857', '357', 'Lobatera');
INSERT INTO `parroquias` VALUES ('858', '357', 'Constitución');
INSERT INTO `parroquias` VALUES ('859', '358', 'Michelena');
INSERT INTO `parroquias` VALUES ('860', '359', 'Panamericano');
INSERT INTO `parroquias` VALUES ('861', '359', 'La Palmita');
INSERT INTO `parroquias` VALUES ('862', '360', 'Pedro María Ureña');
INSERT INTO `parroquias` VALUES ('863', '360', 'Nueva Arcadia');
INSERT INTO `parroquias` VALUES ('864', '361', 'Delicias');
INSERT INTO `parroquias` VALUES ('865', '361', 'Pecaya');
INSERT INTO `parroquias` VALUES ('866', '362', 'Samuel Darío Maldonado');
INSERT INTO `parroquias` VALUES ('867', '362', 'Boconó');
INSERT INTO `parroquias` VALUES ('868', '362', 'Hernández');
INSERT INTO `parroquias` VALUES ('869', '363', 'La Concordia');
INSERT INTO `parroquias` VALUES ('870', '363', 'San Juan Bautista');
INSERT INTO `parroquias` VALUES ('871', '363', 'Pedro María Morantes');
INSERT INTO `parroquias` VALUES ('872', '363', 'San Sebastián');
INSERT INTO `parroquias` VALUES ('873', '363', 'Dr. Francisco Romero Lobo');
INSERT INTO `parroquias` VALUES ('874', '364', 'Seboruco');
INSERT INTO `parroquias` VALUES ('875', '365', 'Simón Rodríguez');
INSERT INTO `parroquias` VALUES ('876', '366', 'Sucre');
INSERT INTO `parroquias` VALUES ('877', '366', 'Eleazar López Contreras');
INSERT INTO `parroquias` VALUES ('878', '366', 'San Pablo');
INSERT INTO `parroquias` VALUES ('879', '367', 'Torbes');
INSERT INTO `parroquias` VALUES ('880', '368', 'Uribante');
INSERT INTO `parroquias` VALUES ('881', '368', 'Cárdenas');
INSERT INTO `parroquias` VALUES ('882', '368', 'Juan Pablo Peñalosa');
INSERT INTO `parroquias` VALUES ('883', '368', 'Potosí');
INSERT INTO `parroquias` VALUES ('884', '369', 'San Judas Tadeo');
INSERT INTO `parroquias` VALUES ('885', '370', 'Araguaney');
INSERT INTO `parroquias` VALUES ('886', '370', 'El Jaguito');
INSERT INTO `parroquias` VALUES ('887', '370', 'La Esperanza');
INSERT INTO `parroquias` VALUES ('888', '370', 'Santa Isabel');
INSERT INTO `parroquias` VALUES ('889', '371', 'Boconó');
INSERT INTO `parroquias` VALUES ('890', '371', 'El Carmen');
INSERT INTO `parroquias` VALUES ('891', '371', 'Mosquey');
INSERT INTO `parroquias` VALUES ('892', '371', 'Ayacucho');
INSERT INTO `parroquias` VALUES ('893', '371', 'Burbusay');
INSERT INTO `parroquias` VALUES ('894', '371', 'General Ribas');
INSERT INTO `parroquias` VALUES ('895', '371', 'Guaramacal');
INSERT INTO `parroquias` VALUES ('896', '371', 'Vega de Guaramacal');
INSERT INTO `parroquias` VALUES ('897', '371', 'Monseñor Jáuregui');
INSERT INTO `parroquias` VALUES ('898', '371', 'Rafael Rangel');
INSERT INTO `parroquias` VALUES ('899', '371', 'San Miguel');
INSERT INTO `parroquias` VALUES ('900', '371', 'San José');
INSERT INTO `parroquias` VALUES ('901', '372', 'Sabana Grande');
INSERT INTO `parroquias` VALUES ('902', '372', 'Cheregüé');
INSERT INTO `parroquias` VALUES ('903', '372', 'Granados');
INSERT INTO `parroquias` VALUES ('904', '373', 'Arnoldo Gabaldón');
INSERT INTO `parroquias` VALUES ('905', '373', 'Bolivia');
INSERT INTO `parroquias` VALUES ('906', '373', 'Carrillo');
INSERT INTO `parroquias` VALUES ('907', '373', 'Cegarra');
INSERT INTO `parroquias` VALUES ('908', '373', 'Chejendé');
INSERT INTO `parroquias` VALUES ('909', '373', 'Manuel Salvador Ulloa');
INSERT INTO `parroquias` VALUES ('910', '373', 'San José');
INSERT INTO `parroquias` VALUES ('911', '374', 'Carache');
INSERT INTO `parroquias` VALUES ('912', '374', 'La Concepción');
INSERT INTO `parroquias` VALUES ('913', '374', 'Cuicas');
INSERT INTO `parroquias` VALUES ('914', '374', 'Panamericana');
INSERT INTO `parroquias` VALUES ('915', '374', 'Santa Cruz');
INSERT INTO `parroquias` VALUES ('916', '375', 'Escuque');
INSERT INTO `parroquias` VALUES ('917', '375', 'La Unión');
INSERT INTO `parroquias` VALUES ('918', '375', 'Santa Rita');
INSERT INTO `parroquias` VALUES ('919', '375', 'Sabana Libre');
INSERT INTO `parroquias` VALUES ('920', '376', 'El Socorro');
INSERT INTO `parroquias` VALUES ('921', '376', 'Los Caprichos');
INSERT INTO `parroquias` VALUES ('922', '376', 'Antonio José de Sucre');
INSERT INTO `parroquias` VALUES ('923', '377', 'Campo Elías');
INSERT INTO `parroquias` VALUES ('924', '377', 'Arnoldo Gabaldón');
INSERT INTO `parroquias` VALUES ('925', '378', 'Santa Apolonia');
INSERT INTO `parroquias` VALUES ('926', '378', 'El Progreso');
INSERT INTO `parroquias` VALUES ('927', '378', 'La Ceiba');
INSERT INTO `parroquias` VALUES ('928', '378', 'Tres de Febrero');
INSERT INTO `parroquias` VALUES ('929', '379', 'El Dividive');
INSERT INTO `parroquias` VALUES ('930', '379', 'Agua Santa');
INSERT INTO `parroquias` VALUES ('931', '379', 'Agua Caliente');
INSERT INTO `parroquias` VALUES ('932', '379', 'El Cenizo');
INSERT INTO `parroquias` VALUES ('933', '379', 'Valerita');
INSERT INTO `parroquias` VALUES ('934', '380', 'Monte Carmelo');
INSERT INTO `parroquias` VALUES ('935', '380', 'Buena Vista');
INSERT INTO `parroquias` VALUES ('936', '380', 'Santa María del Horcón');
INSERT INTO `parroquias` VALUES ('937', '381', 'Motatán');
INSERT INTO `parroquias` VALUES ('938', '381', 'El Baño');
INSERT INTO `parroquias` VALUES ('939', '381', 'Jalisco');
INSERT INTO `parroquias` VALUES ('940', '382', 'Pampán');
INSERT INTO `parroquias` VALUES ('941', '382', 'Flor de Patria');
INSERT INTO `parroquias` VALUES ('942', '382', 'La Paz');
INSERT INTO `parroquias` VALUES ('943', '382', 'Santa Ana');
INSERT INTO `parroquias` VALUES ('944', '383', 'Pampanito');
INSERT INTO `parroquias` VALUES ('945', '383', 'La Concepción');
INSERT INTO `parroquias` VALUES ('946', '383', 'Pampanito II');
INSERT INTO `parroquias` VALUES ('947', '384', 'Betijoque');
INSERT INTO `parroquias` VALUES ('948', '384', 'José Gregorio Hernández');
INSERT INTO `parroquias` VALUES ('949', '384', 'La Pueblita');
INSERT INTO `parroquias` VALUES ('950', '384', 'Los Cedros');
INSERT INTO `parroquias` VALUES ('951', '385', 'Carvajal');
INSERT INTO `parroquias` VALUES ('952', '385', 'Campo Alegre');
INSERT INTO `parroquias` VALUES ('953', '385', 'Antonio Nicolás Briceño');
INSERT INTO `parroquias` VALUES ('954', '385', 'José Leonardo Suárez');
INSERT INTO `parroquias` VALUES ('955', '386', 'Sabana de Mendoza');
INSERT INTO `parroquias` VALUES ('956', '386', 'Junín');
INSERT INTO `parroquias` VALUES ('957', '386', 'Valmore Rodríguez');
INSERT INTO `parroquias` VALUES ('958', '386', 'El Paraíso');
INSERT INTO `parroquias` VALUES ('959', '387', 'Andrés Linares');
INSERT INTO `parroquias` VALUES ('960', '387', 'Chiquinquirá');
INSERT INTO `parroquias` VALUES ('961', '387', 'Cristóbal Mendoza');
INSERT INTO `parroquias` VALUES ('962', '387', 'Cruz Carrillo');
INSERT INTO `parroquias` VALUES ('963', '387', 'Matriz');
INSERT INTO `parroquias` VALUES ('964', '387', 'Monseñor Carrillo');
INSERT INTO `parroquias` VALUES ('965', '387', 'Tres Esquinas');
INSERT INTO `parroquias` VALUES ('966', '388', 'Cabimbú');
INSERT INTO `parroquias` VALUES ('967', '388', 'Jajó');
INSERT INTO `parroquias` VALUES ('968', '388', 'La Mesa de Esnujaque');
INSERT INTO `parroquias` VALUES ('969', '388', 'Santiago');
INSERT INTO `parroquias` VALUES ('970', '388', 'Tuñame');
INSERT INTO `parroquias` VALUES ('971', '388', 'La Quebrada');
INSERT INTO `parroquias` VALUES ('972', '389', 'Juan Ignacio Montilla');
INSERT INTO `parroquias` VALUES ('973', '389', 'La Beatriz');
INSERT INTO `parroquias` VALUES ('974', '389', 'La Puerta');
INSERT INTO `parroquias` VALUES ('975', '389', 'Mendoza del Valle de Momboy');
INSERT INTO `parroquias` VALUES ('976', '389', 'Mercedes Díaz');
INSERT INTO `parroquias` VALUES ('977', '389', 'San Luis');

-- ----------------------------
-- Table structure for representante
-- ----------------------------
DROP TABLE IF EXISTS `representante`;
CREATE TABLE `representante` (
  `representante_id` int(11) NOT NULL AUTO_INCREMENT,
  `contribuyente_id` int(11) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellido` varchar(20) DEFAULT NULL,
  `rif` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`representante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of representante
-- ----------------------------

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `seudonimo` varchar(45) NOT NULL,
  `clave` varchar(65) NOT NULL,
  `cedula` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `rol` tinyint(4) DEFAULT '2',
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('2', 'admin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '12345', 'oscar2', 'lopez', 'gerente', '2017-04-21 15:22:45', '1', '1');
INSERT INTO `usuarios` VALUES ('3', 'darwinvas', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '20122996', 'darwin2', 'vasquez', 'secretario', '0000-00-00 00:00:00', '1', '2');
