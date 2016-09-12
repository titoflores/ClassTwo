TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER triggerLibro_insert AFTER INSERT ON class_libro\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_libro\',\'INSERT\');\n  END' 'CREATE DEFINER=`root`@`localhost` TRIGGER triggerLibro_update AFTER update ON class_libro\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_libro\',\'UPDATE\');\n  END' 'CREATE DEFINER=`root`@`localhost` TRIGGER triggerLibro_delete AFTER DELETE ON class_libro\n  FOR EACH ROW\n  BEGIN\n	INSERT INTO \n				bitacora \n	VALUES(NULL,NULL,@@hostname,substring_index(user(),\'@\',1),\'class_libro\',\'DELETE\');\n  END'
sql_modes=1073741824 1073741824 1073741824
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
