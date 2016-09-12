TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER triggerBibliotecario_delete AFTER delete ON class_bibliotecario\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_Bibliotecario\',\'DELETE\');\n  END' 'CREATE DEFINER=`root`@`localhost` TRIGGER triggerBibliotecario_update AFTER update ON class_bibliotecario\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_Bibliotecario\',\'UPDATE\');\n  END' 'CREATE DEFINER=`root`@`localhost` TRIGGER triggerBibliotecario_insert AFTER insert ON class_bibliotecario\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_Bibliotecario\',\'INSERT\');\n  END'
sql_modes=1073741824 1073741824 1073741824
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
