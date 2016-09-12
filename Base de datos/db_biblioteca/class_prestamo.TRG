TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER triggerPrestamo_insert AFTER INSERT ON class_prestamo\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_prestamo\',\'INSERT\');\n  END' 'CREATE DEFINER=`root`@`localhost` TRIGGER triggerPrestamo_update AFTER UPDATE ON class_prestamo\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_prestamo\',\'UPDATE\');\n  END' 'CREATE DEFINER=`root`@`localhost` TRIGGER triggerPrestamo_delete AFTER DELETE ON class_prestamo\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_prestamo\',\'DELETE\');\n  END'
sql_modes=1073741824 1073741824 1073741824
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
